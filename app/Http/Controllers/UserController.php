<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $keyword = $request->keyword;
        $users = User::select('*')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('username', 'like', '%' . $keyword . '%');
                $query->orWhere('name', 'like', '%' . $keyword . '%');
                $query->orWhere('email', 'like', '%' . $keyword . '%');
            })
            ->when($username, function ($query) use ($username) {
                $query->where('username', $username);
            })
            ->when($name, function ($query) use ($name) {
                $query->where('name', $name);
            })
            ->paginate(2);

        $users2 = User::all();

        return view(
            'users.index',
            [
                'users' => $users,
                'keyword' => $keyword,
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
        $validator = Validator::make($request->all(), [
            'username' =>  $request->id == null ? 'required|unique:users' : 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|numeric',
        ]);
        //TODO
        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
                'message' => $validator->getMessageBag()->first(),
            ]);
        }
        //TODO
        if ($request->test_form) {
            $user = User::firstOrNew(['id' => $request->id]);
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->save();

            // $redirect = route('users.index');
            return response()->json([
                'success' => true,
                'redirect' => route('users.index'),
            ]);
        }
    }

    public function edit(User $user)
    {
        // $user = User::find($id);

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
        if ($user == null) {
            $message = 'user not found.';
            Session::flash('error', $message);

            return redirect()->route('users.index');
        }
        $page_title = 'TODO';
        $view = true;
        return view('users.form', compact('user', 'view'));
    }

    public function destroy(Request $request, $id)
    {
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
