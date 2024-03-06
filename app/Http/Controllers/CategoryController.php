<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use stdClass;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $status = $request->status;
        $code = $request->code;
        $s = $request->s;
        $categories = Category::select('*')
            ->search($request->s, $request)->paginate(PER_PAGE);

        $categories2 = Category::select('id', 'name');
        $status_obj = $this->statusObj();
        return view('categories.index', compact('categories', 's', 'status', 'code', 'name', 'categories2', 'status_obj'));
    }

    public function statusObj()
    {
        $status_obj = collect([
            (object)[
                'status' => 2, // Bug
                'name' => 'ไม่ได้ใช้งาน',
            ],
            (object)[
                'status' => 1,
                'name' => 'ใช้งาน',
            ]
        ]);

        return $status_obj;
    }

    public function create()
    {
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
            'code' => [
                'required', 'string',
                Rule::unique('categories', 'code')->ignore($request->id),
            ],
            'name' => 'required',
            'status' => 'required',
            'detail' => 'required',
        ], [], [
            'code' => __('categories.code'),
            'name' => __('categories.name'),
            'status' => __('categories.status'),
            'detail' => __('categories.detail'),
        ]);

        //TODO
        // $validator->stopOnFirstFailure()->fails()
        if ($validator->fails()) {
            return $this->responseValidateAllFailed($validator);
        }

        $category = Category::firstOrNew(['id' => $request->id]);
        $category->code = $request->code;
        $category->name = $request->name;
        $category->status = $request->status;
        $category->detail = $request->detail;
        $category->save();

        $redirect_route = route('categories.index');
        return $this->responseValidateSuccess($redirect_route);
    }

    public function edit(Category $category)
    {
        if ($category == null) {
            return redirect()->route('categories.index');
        }

        $page_title = __('manage.edit') . __('categories.page_title');
        return view('categories.form', compact('category', 'page_title'));
    }

    //TODO
    public function show(Category $category)
    {
        if ($category == null) {
            return redirect()->route('categories.index');
        }
        $page_title = __('manage.view') . __('categories.page_title');
        $view = true;
        return view('categories.form', compact('category', 'view', 'page_title'));
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            return $this->responseEmpty($category);
        }

        $category->delete();
        return  $this->responseDeletedSuccess('Category', 'categories.index');
    }
}
