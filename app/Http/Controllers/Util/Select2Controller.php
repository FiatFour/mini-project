<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    function getProducts(Request $request)
    {
        dd($request->all());
        $list = Product::select('id', 'name')
            ->where(function ($query) use ($request) {
                if (!empty($request->parent_id)) {
                    $query->where('category_id', $request->parent_id);
                }
            })
            ->search($request->s, $request)
            ->orderBy('name')
            ->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            });

        return response()->json($list);
    }

    function getUsers(Request $request)
    {
        $list = User::select('id', 'name')
            ->where(function ($query) use ($request) {
                if (!empty($request->parent_id)) {
                    $query->where('id', $request->parent_id);
                }
            })
            ->search($request->s, $request)
            ->orderBy('name')
            ->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            });

        return response()->json($list);
    }


}
