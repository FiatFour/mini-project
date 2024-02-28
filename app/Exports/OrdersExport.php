<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromView, WithStyles
{
    /**
//    * @return \Illuminate\Support\Collection
    */
    public $order_list;
    public $order_id;

    public function __construct($order_list, $order_id = false)
    {
        $this->order_list = $order_list;
        $this->order_id = $order_id;
    }

    public function styles(Worksheet $sheet)
    {
        $blue_bg = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3399FF']
            ]
        ];

        $yellow_bg = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00']
            ]
        ];

        $red_bg = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F44336']
            ]
        ];

        $green_bg = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '8FCE00']
            ]
        ];

        if($this->order_id != null){
            return [
                1 => $blue_bg,
                'A1' => $blue_bg,
                'B1' => $yellow_bg,
                'C1' => $yellow_bg,
                'D1' => $yellow_bg,
                'E1' => $yellow_bg,
                'F1' => $yellow_bg,
                'G1' => $green_bg,
                'H1' => $red_bg,
                'I1' => $red_bg,
                'J1' => $red_bg,
                'K1' => $red_bg,
                'L1' => $red_bg,
            ];
        }else{
            return [
                1 => $blue_bg,
                'A1' => $blue_bg,
                'B1' => $yellow_bg,
                'C1' => $yellow_bg,
                'D1' => $yellow_bg,
                'E1' => $green_bg,
                'F1' => $red_bg,
                'G1' => $red_bg,
                'H1' => $red_bg,
                'I1' => $red_bg,
                'J1' => $red_bg,
            ];
        }

    }
    public function view(): View
    {

        return view('orders.export-order-template', [
            'order_id' => $this->order_id,
            'd' => $this->order_list
        ]);
    }

//    public function collection()
//    {
//        return Order::all();
//    }
}
