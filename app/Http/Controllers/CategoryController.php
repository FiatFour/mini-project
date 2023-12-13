<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $name = $request->name;
        $status = $request->status;
        $code = $request->code;
        $keyword = $request->keyword;
        $categories = Category::select('*')
        ->when($keyword, function($query) use ($keyword){
            $query->where('name', 'like', '%' . $keyword . '%');
            $query->orWhere('code', 'like', '%' . $keyword . '%');
            $query->orWhere('status', $keyword);
        })
        ->when($status , function($query) use ($status){
            $query->where('status', $status);
        })
        ->when($code , function($query) use ($code){
            $query->where('code', $code);
        })
        ->when($name , function($query) use ($name){
            $query->where('name', $name);
        })
        ->paginate(1);

        $categories2 = Category::all();

        return view('categories.index', compact('categories', 'keyword', 'status', 'code', 'name', 'categories2'));
    }

    public function create()
    {
        // $categoryGenes = CategoryGene::orderBy('name', 'ASC')->get();
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:categories',
            'name' => 'required',
            'status' => 'required',
            'detail' => 'required',
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->code = $request->code;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->detail = $request->detail;
            $category->save();

            $message = 'Category added successfully.';
            Session::flash('success', $message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category == null) {
            $message = 'category not found.';
            Session::flash('error', $message);

            return redirect()->route('categories.index');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if(empty($category)){
            Session::flash('error', 'Category not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'status' => 'required',
            'detail' => 'required',
        ]);

        if ($validator->passes()) {
            $category->code = $request->code;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->detail = $request->detail;
            $category->save();

            Session::flash('success', 'Category updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function view(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category == null) {
            $message = 'category not found.';
            Session::flash('error', $message);

            return redirect()->route('categories.index');
        }

        return view('categories.view', compact('category'));
    }

    public function destroy(Request $request, $id){
        $category = Category::find($id);

        if(empty($category)){
            Session::flash('error', 'Category not found');
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ]);
        }

        $category->delete();

        Session::flash('deleted', 'Category deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
