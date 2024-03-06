<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $id = $request->id;
        $order_date = $request->order_date;
        $shipping_date = $request->shipping_date;

        $orders = Order::select('*')
            ->search($request->s, $request)
            ->paginate(5);

        $d = Order::all();

        return view('orders.index', compact('orders', 'keyword', 'd', 'id', 'order_date', 'shipping_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = __('manage.add') . __('orders.page_title');

        $order = new Order();
        return view('orders.form', compact('page_title', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_name' => 'required',
            'order_phone' => 'required|numeric',
            'order_address' => 'required',
            'order_date' => 'required',
            'shipping_date' => 'required',
        ], [
            'order_name.required' => 'The order name field is required.',
            'order_phone.required' => 'The order phone field is required.',
            'order_phone.numeric' => 'The order phone must be a number.',
            'order_address.required' => 'The order address field is required.',
            'order_date.required' => 'The order date field is required.',
            'shipping_date.required' => 'The shipping date field is required.',
        ]);

        $validator->after(function ($validator) use ($request) {
            $order_date = Carbon::createFromFormat('Y-m-d', $request->order_date);
            $shipping_date = Carbon::createFromFormat('Y-m-d', $request->shipping_date);

            if ($shipping_date->lte($order_date)) {
                $validator->errors()->add('shipping_date', 'Shipping date must be greater than order date.');
            }
        });

        if ($validator->fails()) {
            return $this->responseValidateAllFailed($validator);
        }

        $order = Order::firstOrNew(['id' => $request->order_id]);
        if (is_null($order->id)) {
            $order_count = Order::count() + 1;
            $prefix = 'OD';
            if (!($order->exists)) {
                $shop_code = generateRecordNumber($prefix, $order_count,false);
            }
            $order->shop_code = $shop_code;
        }

        $order->name = $request->order_name;
        $order->phone = $request->order_phone;
        $order->address = $request->order_address;
        $order->order_date = $request->order_date;
        $order->shipping_date = $request->shipping_date;
        $order->save();

        $orderAmount = 0;
        $orderTotal = 0;

        foreach ($request->order_detail as $orderDetail) {
            $ord = OrderDetail::firstOrNew(['id' => $orderDetail['id']]);
            $ord->order_id = $order->id;
            $ord->product_id = $orderDetail['product_id'];
            $ord->sub_total = $orderDetail['sub_total'];
            $ord->total = $orderDetail['total'];
            $ord->save();

            $orderAmount += $orderDetail['amount'];
            $orderTotal += $orderDetail['total'];
        }

        if ($request->discount != null) {
            $order->discount = $request->discount;
        }

        if ($request->withholding_tax != false) {
            $order->withholding_tax = $orderTotal - ($orderTotal * (100 / 103));
        } else {
            $order->withholding_tax = 0;
        }

        $order->amount = $orderAmount;
        $order->sub_total = ($orderAmount + $orderTotal) * (100 / 107);
        $order->vat = $orderTotal - $order->sub_total;
        $order->total = $orderTotal;

        $order->save();

        $redirect_route = route('orders.index');
        return $this->responseValidateSuccess($redirect_route);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if ($order == null) {
            return redirect()->route('orders.index');
        }
        $order_detail_list = OrderDetail::select('order_details.*', 'products.category_id AS category_id', 'products.name AS product_name', 'products.price AS price', 'categories.name AS category_name')
            ->latest('order_details.id')
            ->leftJoin('products', 'products.id',
                'order_details.product_id')
            ->leftJoin('categories', 'categories.id',
                'products.category_id')
            ->where('order_details.order_id', $order->id)
            ->get();

        $page_title = __('manage.view') . __('orders.page_title');
        $view = true;
        return view('orders.form', compact('order', 'page_title', 'order_detail_list', 'view'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        if ($order == null) {
            return redirect()->route('orders.index');
        }

        $order_detail_list = OrderDetail::select('order_details.*', 'products.category_id AS category_id', 'products.name AS product_name', 'products.price AS price', 'categories.name AS category_name')
            ->latest('order_details.id')
            ->leftJoin('products', 'products.id',
                'order_details.product_id')
            ->leftJoin('categories', 'categories.id',
                'products.category_id')
            ->where('order_details.order_id', $order->id)
            ->get();

        $page_title = __('manage.edit') . __('orders.page_title');
        $edit = true;

        return view('orders.form', compact('order', 'page_title', 'order_detail_list', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (empty($order)) {
            return $this->responseEmpty('Order');
        }
        $order->delete();

        return $this->responseDeletedSuccess('Order', 'orders.index');
    }

    function getPriceAndCategory(Request $request)
    {
        $data = Product::select('products.id','products.category_id AS category_id', 'products.name AS product_name', 'products.price AS price', 'categories.name AS category_name')
            ->leftJoin('categories', 'categories.id',
                'products.category_id')
            ->where('products.id', $request->id)
            ->first();
        return [
            'success' => true,
            'data' => $data,
        ];
    }

    public function export(Request $request)
    {
        $order_id = $request->order_id;

        if(!empty($order_id)){
            $order_list = Order::find($order_id)->first();
            return Excel::download(new OrdersExport($order_list, true), 'template.xlsx');
        }else{
            $order_list = Order::select('*')->get();
            return Excel::download(new OrdersExport($order_list), 'template.xlsx');
        }
    }

    public function printOrderDetailsPdf(Request $request){
        $pdf = Pdf::loadView('orders.pdfs.order-detail.pdf'
        );
// (Optional) Setup the paper size and orientation
        return  $pdf->stream();

//        $pdf = PDF::loadView(
//            'orders.pdfs.purchase-order.pdf',
//            [
//                'd' => $install_equipment_po,
//                'install_equipment_po_lines' => $install_equipment_po_lines,
//                'summary' => $summary,
//        );
    }

}
