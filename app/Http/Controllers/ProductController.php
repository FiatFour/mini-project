<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $exp_date = $request->exp_date;
        $categoryId = $request->categoryId;
        $product_id = $request->product_id;
        $s = $request->s;
        $products = Product::select('products.*', 'categories.name AS categoryName')
            ->latest('products.id')
            ->leftJoin(
                'categories', 'categories.id',
                'products.category_id'
            )
            ->search($request->s, $request)->paginate(PER_PAGE);

        $products2 = Product::all();

        $categories = Category::select('name', 'id', 'name AS categoryName', 'id AS categoryId')->get();
        // dd($products);
        // dd($categories);
        return view('products.index', compact('products', 'products2', 's', 'name', 'exp_date', 'categories', 'categoryId', 'product_id'));
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
            'name' => [
                'required', 'string',
                Rule::unique('products', 'name')->ignore($request->id),
            ],
            'categoryId' => 'required',
            'price' => 'required',
            'exp_date' => 'required',
        ], [], [
            'name' => __('products.name'),
            'categoryId' => __('products.category_id'),
            'price' => __('products.price'),
            'exp_date' => __('products.exp_date'),
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

        $product = Product::firstOrNew(['id' => $request->id]);
        $product->name = $request->name;
        $product->category_id = $request->categoryId;
        $product->price = $request->price;
        $product->mfg_date = $request->mfg_date;
        $product->exp_date = $request->exp_date;
        $product->detail = $request->detail;
        $product->save();

//        return response()->json([
//            'success' => true,
//            'redirect' => route('products.index'),
//        ]);

        $redirect_route = route('products.index');
        return $this->responseValidateSuccess($redirect_route);
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

    public function show(Product $product)
    {
        if ($product == null) {
            $message = 'product not found.';
            Session::flash('error', $message);

            return redirect()->route('products.index');
        }

        $categories = Category::select('name', 'id', 'name AS categoryName', 'id AS categoryId')->orderBy('categoryName', 'ASC')->get();

        $page_title = __('manage.view') . __('products.page_title');
        $view = true;
        return view('products.form', compact('product', 'view', 'categories', 'page_title'));
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
