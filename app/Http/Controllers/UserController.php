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
//        $this->authorize(Actions::View . '_' . Resources::User);
        $name = $request->name;
        $username = $request->username;
        $s = $request->s;
        $users = User::select('*')
            ->search($request->s, $request)->paginate(PER_PAGE);

        $users2 = User::all();

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
//        $this->authorize(Actions::Manage . '_' . Resources::User);
        $user = new User();
        $page_title = __('manage.add') . __('users.page_title');
        // $userGenes = UserGene::orderBy('name', 'ASC')->get();
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
//        dd($request->all());

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

//            return response()->json([
//                'success' => true,
//                'redirect' => route('users.index'),
//            ]);

        $redirect_route = route('users.index');
        return $this->responseValidateSuccess($redirect_route);
    }

    public function edit(User $user)
    {
        // $user = User::find($id);
//        $this->authorize(Actions::Manage . '_' . Resources::User);
        if ($user == null) {
            $message = 'user not found.';
            Session::flash('error', $message);

            return redirect()->route('users.index');
        }
        $page_title = __('manage.edit') . __('users.page_title');
        return view('users.form', compact(
            'user',
            'page_title'
        ));
    }

    //TODO
    public function show(User $user)
    {
//        $this->authorize(Actions::View . '_' . Resources::User);
        if ($user == null) {
            $message = 'user not found.';
            Session::flash('error', $message);

            return redirect()->route('users.index');
        }
        $page_title = __('manage.show') . __('users.page_title');
        $view = true;
        return view('users.form', compact('user', 'view', 'page_title'));
    }

    public function destroy($id)
    {
//        $this->authorize(Actions::Manage . '_' . Resources::User);
        $user = User::find($id);

        if (empty($user)) {
            Session::flash('error', 'User not found');
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }

        $user->delete();

        Session::flash('deleted', 'User deleted successfully');
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
            'redirect' => route('users.index')
        ]);
    }
}
