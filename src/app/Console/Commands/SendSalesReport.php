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
	o.date_added > ?
AND o.date_added < ?
AND o.order_status_id IN (1,2,4,6,11,14)
', [$yesterday->timestamp, $today->timestamp]);

        if ($count->size > 0) {
            $rows = DB::select('
SELECT
	g.goodsname,
	SUM(og.quantity) size,
	SUM(og.total) total
FROM
	ims_lionfish_comshop_order_goods og
LEFT JOIN ims_lionfish_comshop_goods g ON og.goods_id = g.id
LEFT JOIN ims_lionfish_comshop_order o ON og.order_id = o.order_id
WHERE
	og.addtime > ?
AND og.addtime < ?
AND o.order_status_id IN (1,2,4,6,11,14)
GROUP BY
	og.goods_id
', [$yesterday->timestamp, $today->timestamp]);

            dump($rows);

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
//            $client->sendSalesReport($yesterday->toDateString(), $content);
        }
    }
}
