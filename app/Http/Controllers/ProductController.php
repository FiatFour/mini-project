<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $name = $request->name;
        $exp_date = $request->exp_date;
        $categoryId = $request->categoryId;
        $products = Product::select('products.*', 'categories.name AS categoryName')
            ->latest('products.id')
            ->leftJoin(
                'categories','categories.id',
                'products.category_id'
            )
            ->search($request)
            ->paginate(5);

        $products2 = Product::all();

        $categories = Category::select('name', 'id', 'name AS categoryName', 'id AS categoryId')->get();
        // dd($products);
        // dd($categories);
        return view('products.index', compact('products', 'products2', 'keyword', 'name', 'exp_date', 'categories', 'categoryId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $productGenes = ProductGene::orderBy('name', 'ASC')->get();
        $product = new Product();
        $categories = Category::select('name', 'id', 'name AS categoryName', 'id AS categoryId')->orderBy('categoryName', 'ASC')->get();
        $page_title = __('manage.add') . __('products.page_title');

        return view('products.form', compact('product', 'page_title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' =>  $request->id == null ? 'required|unique:products' : 'required',
            'categoryId' => 'required',
            'price' => 'required',
            'exp_date' => 'required',
        ]);

        //TODO
        // $validator->stopOnFirstFailure()->fails()
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                // 'message' => $validator->getMessageBag()->first()
            ]);
        }

        // Starting date must be greater than current date
        if (!empty($request->mfg_date)) {
            $mfgDate = Carbon::createFromFormat('Y-m-d', $request->mfg_date);
            $expDate = Carbon::createFromFormat('Y-m-d', $request->exp_date);

            if ($expDate->lte($mfgDate) == true) {
                return response()->json([
                    'success' => false,
                    'errors' => ['exp_date' => "EXP date can not be less than MFG date"]
                ]);
            }
        }

        if ($request->test_form) {

            $product = Product::firstOrNew(['id' => $request->id]);
            $product->name = $request->name;
            $product->category_id = $request->categoryId;
            $product->price = $request->price;
            $product->mfg_date = $request->mfg_date;
            $product->exp_date = $request->exp_date;
            $product->detail = $request->detail;
            $product->save();

            return response()->json([
                'success' => true,
                'redirect' => route('products.index'),
            ]);
        }
    }

    public function edit(Product $product)
    {
        if ($product == null) {
            $message = 'product not found.';
            Session::flash('error', $message);

            return redirect()->route('products.index');
        }

        $categories = Category::select('name', 'id', 'name AS categoryName', 'id AS categoryId')->orderBy('categoryName', 'ASC')->get();

        $page_title = __('manage.edit') . __('products.page_title');
        return view('products.form', compact('product', 'page_title', 'categories'));
    }

    //TODO
    public function show(Product $product)
    {
        if ($product == null) {
            $message = 'product not found.';
            Session::flash('error', $message);

            return redirect()->route('products.index');
        }

        $categories = Category::select('name', 'id', 'name AS categoryName', 'id AS categoryId')->orderBy('categoryName', 'ASC')->get();

        $page_title =  __('manage.view') . __('products.page_title');
        $view = true;
        return view('products.form', compact('product', 'view', 'categories'));
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            Session::flash('error', 'Product not found');
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        $product->delete();

        Session::flash('success', 'Product deleted successfully');
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
            'redirect' => route('products.index')
        ]);
    }
}
