<?php

namespace App\Http\Controllers;

use App\Enums\Actions;
use App\Enums\Resources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $s = $request->s;
        $users = User::select('*')
            ->search($request->s, $request)->paginate(PER_PAGE);

        $users2 = User::select('id', 'name')->get();

        return view(
            'users.index',
            [
                'users' => $users,
                's' => $s,
                'username' => $username,
                'name' => $name,
                'users2' => $users2,
            ]
        );
    }

    public function create()
    {
        $user = new User();
        $page_title = __('manage.add') . __('users.page_title');
        return view(
            'users.form',
            [
                'user' => $user,
                'page_title' => $page_title,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'username' =>  $request->id == null ? 'required|unique:users' : 'required|unique:users,username,'.$request->id.',id',
            'username' => [
                'required', 'string',
                Rule::unique('users', 'username')->ignore($request->id),
            ],
            'name' => 'required',
            'email' => [
                'required', 'string', 'max:255', 'email',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
            'password' => [
                'required', 'string', 'min:8',
            ],
            'phone' => 'required|numeric',
        ], [], [
            'username' => __('users.username'),
            'password' => __('users.password'),
            'name' => __('users.name'),
            'email' => __('users.email'),
            'branch_id' => __('users.branch'),
            'department_id' => __('users.department'),
            'role_id' => __('users.role'),
        ]);
        //TODO
//        if ($validator->stopOnFirstFailure()->fails()) {
//            return response()->json([
//                'success' => false,
//                'errors' => $validator->errors(),
//                'message' => $validator->getMessageBag()->first(),
//            ]);
//        }
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                // 'message' => $validator->getMessageBag()->first()
            ]);
        }

        //TODO
        $user = User::firstOrNew(['id' => $request->id]);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();

        $redirect_route = route('users.index');
        return $this->responseValidateSuccess($redirect_route);
    }

    public function edit(User $user)
    {
        if ($user == null) {
            return redirect()->route('users.index');
        }
        $page_title = __('manage.edit') . __('users.page_title');
        return view('users.form', compact(
            'user',
            'page_title'
        ));
    }

    public function show(User $user)
    {
        if ($user == null) {
            return redirect()->route('users.index');
        }
        $page_title = __('manage.show') . __('users.page_title');
        $view = true;
        return view('users.form', compact('user', 'view', 'page_title'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return $this->responseEmpty('User');
        }

        $user->delete();
        return $this->responseDeletedSuccess('User', 'users.index');
    }
}
