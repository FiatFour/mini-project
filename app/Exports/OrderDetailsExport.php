<?php

namespace App\Exports;

use App\Models\OrderDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderDetailsExport implements FromCollection
{
    public $order_list;

    public function __construct($order_list)
    {
        $this->order_list = $order_list;
    }

    public function view(): View
    {
        return view('orders.selections.export-order-detail-template', [
            'orders' => $this->order_list,
        ]);
    }
}
