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
//        $orders = Order::select('*')->paginate(5);

        $orders = Order::select('*')
            ->search($request)
            ->paginate(5);

//        dd($orders);
        return view('orders.index', compact('orders', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $page_title = __('manage.add') . __('orders.page_title');

        $products = Product::select('products.*', 'categories.name AS categoryName')
            ->latest('products.id')
            ->leftJoin(
                'categories', 'categories.id',
                'products.category_id'
            )
            ->paginate(5);

        $products2 = Product::all();
        $order = new Order();

        return view('orders.form', compact('product', 'page_title', 'products', 'products2', 'order'));
    }

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


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd($request->all());

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

        if ($request->test_form) {

            $orderDetails = $formData['orderDetails'];
            $order = $formData['orderForm'];

            $orderName = $order[0]['value'];
            $orderPhone = $order[1]['value'];
            $orderAddress = $order[2]['value'];
            $orderDate = $order[3]['value'];
            $orderShippingDate = $order[4]['value'];

            $order = Order::firstOrNew(['id' => $request->order_id]);
            $order->name = $orderName;
            $order->phone = $orderPhone;
            $order->address = $orderAddress;
            $order->order_date = $orderDate;
            $order->shipping_date = $orderShippingDate;
            $order->save();

            $orderAmount = 0;
            $orderTotal = 0;
            $orderSubTotal = 0;

            foreach ($orderDetails as $orderDetail) {
                $product = Product::select('*')->where('name', $orderDetail['productName'])->first();

                $ord = OrderDetail::firstOrNew(['order_id' => $request->order_id]);
                $ord->order_id = $order->id;
                $ord->product_id = $product->id;
                $ord->category_id = $product->category_id;
                $ord->amount = $orderDetail['amount'];
                $ord->sub_total = $orderDetail['sub_total'];
                $ord->total = $orderDetail['total'];
                $ord->save();

                $orderAmount += $orderDetail['amount'];
                $orderTotal += $orderDetail['total'];
                $orderSubTotal += $orderDetail['sub_total'];
            }

            $order->amount = $orderAmount;
            $order->total = $orderTotal;
            $order->sub_total = $orderSubTotal;
            $order->save();

            return response()->json([
                'success' => true,
                'redirect' => route('orders.index'),
            ]);
        }

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
        $orderDetailsWithRelations = OrderDetail::select('order_details.*', 'products.name AS productName', 'products.price', 'categories.name AS categoryName')
            ->latest('order_details.id')
            ->leftJoin('products', 'products.id',
                'order_details.product_id')
            ->leftJoin('categories', 'categories.id',
                'order_details.category_id')
            ->where('order_details.order_id', $order->id)
            ->paginate(10);

        $page_title = __('manage.edit') . __('orders.page_title');
        $view = true;
        return view('orders.form', compact('order', 'page_title', 'orderDetailsWithRelations', 'view'));
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

//        $orderDetailsWithRelations = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
//            ->join('products', 'order_details.product_id', '=', 'products.id')
//            ->select('order_details.*', 'orders.*', 'products.*', 'products.name AS productName')
//            ->where('order_details.order_id', $order->id)
//            ->orderBy('order_details.id', 'ASC')
//            ->get();

        $orderDetailsWithRelations = OrderDetail::select('order_details.*', 'products.name AS productName', 'products.price', 'categories.name AS categoryName')
            ->latest('order_details.id')
            ->leftJoin('products', 'products.id',
                'order_details.product_id')
            ->leftJoin('categories', 'categories.id',
                'order_details.category_id')
            ->where('order_details.order_id', $order->id)
//            ->paginate(10);
            ->get();
//        dd($orderDetailsWithRelations);

        $page_title = __('manage.edit') . __('orders.page_title');
        $edit = true;

        $products = Product::select('products.*', 'categories.name AS categoryName')
            ->latest('products.id')
            ->leftJoin(
                'categories', 'categories.id',
                'products.category_id'
            )
            ->paginate(5);

        $products2 = Product::all();
        return view('orders.form', compact('order', 'page_title', 'orderDetailsWithRelations', 'edit', 'products', 'products2'));
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
}
