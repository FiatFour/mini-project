<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $orders = Order::select('*')
            ->search($request)
            ->paginate(5);

        return view('orders.index', compact('orders', 'keyword'));
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
//        dd($request->all());
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
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
//                $product = Product::select('*')->where('name', $request->order_name)->first();
//                dd($orderDetail);
//            $ord = OrderDetail::firstOrNew(['order_id' => $orderDetail['order_id']]);
            $ord = OrderDetail::firstOrNew(['id' => $orderDetail['id']]);
            $ord->order_id = $order->id;
            $ord->product_id = $orderDetail['product_id'];
//                $ord->category_id = $orderDetail['category_id'];
            $ord->amount = $orderDetail['amount'];
            $ord->sub_total = $orderDetail['sub_total'];
            $ord->total = $orderDetail['total'];
            $ord->save();

            $orderAmount += $orderDetail['amount'];
            $orderTotal += $orderDetail['total'];
//                $orderSubTotal += $orderDetail['sub_total'];
        }

        if ($request->discount != null) {
            $order->discount = $request->discount;
        }

        if ($request->withholding_tax != null) {
            $order->withholding_tax = true;
            $orderTotal = $orderTotal * (100 / 103);
        } else {
            $order->withholding_tax = false;
        }

        $order->amount = $orderAmount;
        $order->total = $orderTotal;
        $order->sub_total = ($orderAmount + $orderTotal) * (100 / 107);
        $order->save();

//        return response()->json([
//            'success' => true,
//            'redirect' => route('orders.index'),
//        ]);

        $redirect_route = route('orders.index');
        return $this->responseValidateSuccess($redirect_route);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if ($order == null) {
            $message = 'order not found.';
            Session::flash('error', $message);

            return redirect()->route('orders.index');
        }
        $order_detail_list = OrderDetail::select('order_details.*', 'products.name AS product_name', 'products.price AS price', 'categories.name AS category_name')
            ->latest('order_details.id')
            ->leftJoin('products', 'products.id',
                'order_details.product_id')
            ->leftJoin('categories', 'categories.id',
                'order_details.category_id')
            ->where('order_details.order_id', $order->id)
            ->get();

        $page_title = __('manage.edit') . __('orders.page_title');
        $view = true;
        return view('orders.form', compact('order', 'page_title', 'order_detail_list', 'view'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        if ($order == null) {
            $message = 'order not found.';
            Session::flash('error', $message);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (empty($order)) {
            Session::flash('error', 'Order not found');
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ]);
        }

        $order->delete();

        Session::flash('success', 'Order deleted successfully');
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
            'redirect' => route('orders.index')
        ]);

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


//    Don't use
    public function getProduct(Request $request)
    {
        $product = Product::select('products.*', 'categories.name AS categoryName')
            ->leftJoin('categories', 'categories.id', 'products.category_id')
            ->where('products.name', $request->productName)
            ->first();

        if (empty($product)) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json([
            'success' => true,
            'categoryName' => $product->categoryName,
            'price' => $product->price,
        ]);
    }
}
