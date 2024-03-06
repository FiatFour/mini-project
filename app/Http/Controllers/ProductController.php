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
        $category_id = $request->category_id;
        $product_id = $request->product_id;
        $s = $request->s;
        $products = Product::select('products.*', 'categories.name AS categoryName')
            ->latest('products.id')
            ->leftJoin(
                'categories', 'categories.id',
                'products.category_id'
            )
                ->search($request->s, $request)->paginate(PER_PAGE);

        $products2 = Product::select('id', 'name');

        $categories = Category::select('name', 'id', 'name AS category_name', 'id AS category_id')->get();
        return view('products.index', compact('products', 'products2', 's', 'name', 'exp_date', 'categories', 'category_id', 'product_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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

        $validator->after(function ($validator) use ($request) {
            $mfg_date = Carbon::createFromFormat('Y-m-d', $request->mfg_date);
            $exp_date = Carbon::createFromFormat('Y-m-d', $request->exp_date);

            if ($exp_date->lte($mfg_date)) {
                $validator->errors()->add('exp_date', "EXP date can not be less than MFG date");
            }
        });

        //TODO
        // $validator->stopOnFirstFailure()->fails()
        if ($validator->fails()) {
            return $this->responseValidateAllFailed($validator);
        }

        $product = Product::firstOrNew(['id' => $request->id]);
        $product->name = $request->name;
        $product->category_id = $request->categoryId;
        $product->price = $request->price;
        $product->mfg_date = $request->mfg_date;
        $product->exp_date = $request->exp_date;
        $product->detail = $request->detail;
        $product->save();

        $redirect_route = route('products.index');
        return $this->responseValidateSuccess($redirect_route);
    }

    public function edit(Product $product)
    {
        if ($product == null) {
            return redirect()->route('products.index');
        }

        $categories = Category::select('name', 'id', 'name AS categoryName', 'id AS categoryId')->orderBy('categoryName', 'ASC')->get();

        $page_title = __('manage.edit') . __('products.page_title');
        return view('products.form', compact('product', 'page_title', 'categories'));
    }

    public function show(Product $product)
    {
        if ($product == null) {
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
            return $this->responseEmpty('Product');
        }

        $product->delete();
        return $this->responseDeletedSuccess('Product', products.index);
    }
}
