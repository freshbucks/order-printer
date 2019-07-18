<?php

namespace App\Console\Commands;

use App\Helpers\DingTalk\Client;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendSalesReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bc:sales:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Sales Report';

    /**
     * Execute the console command.
     *
     * @param Client $client
     * @return mixed
     */
    public function handle(Client $client)
    {
        //*/
        $yesterday = Carbon::yesterday('PRC');
        $today = Carbon::today('PRC');
        /*/
        $yesterday = Carbon::today('PRC');
        $today = Carbon::tomorrow('PRC');
        //*/

        $count = DB::selectOne('
SELECT
	SUM(total) total,
	SUM(fullreduction_money) reduce,
	COUNT(*) size,
	COUNT(DISTINCT head_id) leader
FROM
	ims_lionfish_comshop_order o
WHERE
	o.pay_time > ?
AND o.pay_time < ?
AND o.order_status_id = 1
', [$yesterday->timestamp, $today->timestamp]);

        if ($count->size > 0) {
            $rows = DB::select('
SELECT
	g.id,
	g.goodsname,
	r.size,
	r.total
FROM
	ims_lionfish_comshop_goods g
RIGHT JOIN (
	SELECT
		og.goods_id goods_id,
		sum(og.total) total,
		sum(og.quantity) size
	FROM
		ims_lionfish_comshop_order_goods og
	RIGHT JOIN ims_lionfish_comshop_order o ON o.order_id = og.order_id
	WHERE
		o.pay_time > ?
	AND o.pay_time < ?
	AND o.order_status_id = 1
	GROUP BY
		og.goods_id
) r ON g.id = r.goods_id
', [$yesterday->timestamp, $today->timestamp]);

            $content = "# 销售报告" . $yesterday->toDateString() . "  \n";
            $total = round($count->total - $count->reduce, 2);
            $content .= "订单:$count->size 销售:$total 开团:$count->leader \n  \n";
            $content .= "## 销售清单  \n";
            foreach ($rows as $key => $row) {
                $index = $key + 1;
                $content .= "$index.【 $row->size 】$row->goodsname  \n";
//                $total = round($row->total, 2);
//                $content .= "销量: **$row->size** 销售额: **$total**  \n";
            }
            $client->sendSalesReport($yesterday->toDateString(), $content);
        }
    }
}
