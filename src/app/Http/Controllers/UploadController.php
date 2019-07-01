<?php
/**
 * Created by PhpStorm.
 * User: jackie
 * Date: 2019/7/1
 * Time: 11:50 AM
 */

namespace App\Http\Controllers;


use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $data = [];
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->getRealPath();

            $reader = IOFactory::createReader('Csv')->setInputEncoding('GBK');
            $sheet = $reader->load($path)->getSheet(0);
            $rL = $sheet->getHighestRow();
            $oC = [14, 3, 4, 9];

            for ($r=2; $r<=$rL; $r++) {
                $phone = $this->getCell($sheet, $r, 17);
                $data[$phone] = isset($data[$phone]) ? $data[$phone] : [
                    'name' => $this->getCell($sheet, $r, 15),
                    'phone' => $phone,
                    'address' => $this->getCell($sheet, $r, 16),
                    'orders' => []
                ];

                $order = [];
                foreach ($oC as $c) {
                    $order[] = $this->getCell($sheet, $r, $c);
                }
                $data[$phone]['orders'][] = $order;
            }
//            dump($)
//            $reader = ReaderEntityFactory::createCSVReader();
//            $reader->open($file->getRealPath());
//
//            foreach ($reader->getSheetIterator() as $sheet) {
//                foreach ($sheet->getRowIterator() as $row) {
//                    // do stuff with the row
//                    $_row = [];
//                    foreach ($row->getCells() as $cell) {
//                        array_push($_row, $cell);
//                    }
//                    array_push($data, $_row);
//                }
//            }
//
//            $reader->close();
        }
        return view('result', ['data' => $data]);
    }

    private function getCell($sheet, $row, $col) {
        $cid = Coordinate::stringFromColumnIndex($col).$row;
        return trim($sheet->getCell($cid));
    }
}