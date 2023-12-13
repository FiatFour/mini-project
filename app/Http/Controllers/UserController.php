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

        // if ( !empty($request->get('keyword')) || !empty($request->get('username')) || !empty($request->get('name'))) {
        // dd($request->get('keyword'), $request->get('username'), $request->get('name'));
        // $users = $users->Where('username', 'like', '%' . $request->get('keyword') . '%');
        // $users = $users->orWhere('name', 'like', '%' . $request->get('keyword') . '%');
        // $users = $users->orWhere('email', 'like', '%' . $request->get('keyword') . '%');
        // $users = $users->Where('username', $request->get('username'));
        // $users = $users->Where('name', $request->get('name'));
        // dd($users);
        // }

        $users2 = User::all();

        return view('users.index', compact('users', 'keyword', 'username', 'name', 'users2'));
    }

    public function create()
    {
        // $userGenes = UserGene::orderBy('name', 'ASC')->get();
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $user = new User();
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->save();

            $message = 'User added successfully.';
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
        $user = User::find($id);

        if ($user == null) {
            $message = 'user not found.';
            Session::flash('error', $message);

            return redirect()->route('users.index');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (empty($user)) {
            Session::flash('error', 'User not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'User not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $user->username = $request->username;
            $user->name = $request->name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->phone = $request->phone;
            $user->save();

            Session::flash('success', 'User updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
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
        $user = User::find($id);

        if ($user == null) {
            $message = 'user not found.';
            Session::flash('error', $message);

            return redirect()->route('users.index');
        }

        return view('users.view', compact('user'));
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Session::flash('error', 'User not found');
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        $user->delete();

        Session::flash('deleted', 'User deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}
