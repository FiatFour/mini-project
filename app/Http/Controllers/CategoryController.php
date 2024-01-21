<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use stdClass;

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
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
                $query->orWhere('code', 'like', '%' . $keyword . '%');
                $query->orWhere('status', $keyword);
            })
            ->when($code, function ($query) use ($code) {
                $query->where('code', $code);
            })
            ->when($name, function ($query) use ($name) {
                $query->where('name', $name);
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->paginate(5);

        $categories2 = Category::all();

        // dd($categories);
        // The Array of names of variables we want to create

        $status_obj = $this->status_obj();
        return view('categories.index', compact('categories', 'keyword', 'status', 'code', 'name', 'categories2', 'status_obj'));
    }

    public function status_obj()
    {
        // $status_array = array("id");
        // $status_array['id'][0] = 'ใช้งาน';
        // $status_array['id'][1] = 'ไม่ได้ใช้งาน';
        // $status_obj = new stdClass(); //change array to stdClass object
        // $status_obj->id[0] = 'ใช้งาน'; //change array to stdClass object
        // $status_obj->id[1] = 'ไม่ได้ใช้งาน'; //change array to stdClass object
        // array_push($status_array, "id", "ใช้งาน");
        // array_push($status_array, "id", "ไม่ได้ใช้งาน");
        // dd($status_obj);

        $status_obj = collect([
            (object)[
                'status' => 'yes',
                'name' => 'ใช้งาน',
            ],
            (object)[
                'status' => 'no',
                'name' => 'ไม่ได้ใช้งาน',
            ]
        ]);

        // dd($status_obj);

        return $status_obj;
    }

    public function create()
    {
        // $categoryGenes = CategoryGene::orderBy('name', 'ASC')->get();
        $category = new Category();
        $page_title = __('manage.add') . __('categories.page_title');
        return view('categories.form', compact('category', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' =>  $request->id == null ? 'required|unique:categories' : 'required',
            'name' => 'required',
            'status' => 'required',
            'detail' => 'required',
        ]);

        //TODO
        // $validator->stopOnFirstFailure()->fails()
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => $validator->getMessageBag()->first()
            ]);
        }
        if ($request->test_form) {

            $category = Category::firstOrNew(['id' => $request->id]);
            $category->code = $request->code;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->detail = $request->detail;
            $category->save();

            // $message = 'Category added successfully.';
            // Session::flash('success', $message);
            return response()->json([
                'success' => true,
                'redirect' => route('categories.index'),
            ]);
        }
    }

    public function edit(Category $category)
    {
        // $category = Category::find($id);

        if ($category == null) {
            $message = 'category not found.';
            Session::flash('error', $message);

            return redirect()->route('categories.index');
        }

        $page_title = __('manage.edit') . __('categories.page_title');
        return view('categories.form', compact('category', 'page_title'));
    }

    //TODO
    public function show(Category $category)
    {
        if ($category == null) {
            $message = 'category not found.';
            Session::flash('error', $message);

            return redirect()->route('categories.index');
        }
        $page_title = 'TODO';
        $view = true;
        return view('categories.form', compact('category', 'view'));
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            Session::flash('error', 'Category not found');
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }

        $category->delete();

        Session::flash('success', 'Category deleted successfully');
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
            'redirect' => route('categories.index')
        ]);
    }
}
