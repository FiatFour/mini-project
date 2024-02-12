<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{

    function getSubdistricts(Request $request)
    {
        $list = District::select('id', 'name_th', 'zip_code')
            ->where(function ($query) use ($request) {
                $query->where('amphure_id', $request->parent_id);
                if (!empty($request->s)) {
                    $query->where('name_th', 'like', '%' . $request->s . '%');
                }
            })
            ->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name_th,
                    'zip_code' => $item->zip_code
                ];
            });
        return response()->json($list);
    }

    function getProvinces(Request $request)
    {
        $list = Province::select('id', 'name_th')
            ->where(function ($query) use ($request) {
                if (!empty($request->s)) {
                    $query->where('name_th', 'like', '%' . $request->s . '%');
                }
                if (!empty($request->parent_id)) {
                    $query->where('geography_id', $request->parent_id);
                }
            })
            ->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name_th
                ];
            });
        return response()->json($list);
    }

    function getProducts(Request $request)
    {
//        dd($request->all());
        $list = Product::select('id', 'name')
            ->where(function ($query) use ($request) {
                if (!empty($request->s)) {
                    $query->where('name', 'like', '%' . $request->s . '%');
                }
            })
//            ->search($request->s, $request)
//            ->orderBy('name')
            ->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            });

//        dd($list);

        return response()->json($list);
    }

//    function getProducts(Request $request)
//    {
////        dd($request->all());
//        $list = Product::select('id', 'name')
//            ->where(function ($query) use ($request) {
//                if (!empty($request->parent_id)) {
//                    $query->where('category_id', $request->parent_id);
//                }
//            })
//            ->search($request->s, $request)
//            ->orderBy('name')
//            ->get()->map(function ($item) {
//                return [
//                    'id' => $item->id,
//                    'text' => $item->name
//                ];
//            });
//
//        return response()->json($list);
//    }

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

    function getPrices(Request $request)
    {
        $list = Product::select('id', 'price')
            ->where(function ($query) use ($request) {
                $query->where('id', $request->parent_id);
                if (!empty($request->s)) {
                    $query->where('price', 'like', '%' . $request->s . '%');
                }
            })
            ->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->price
                ];
            });
        return response()->json($list);
    }

function getCategories(Request $request)
    {
        $list = Product::select('products.*', 'categories.name AS category_name')
            ->leftJoin(
                'categories', 'categories.id',
                'products.category_id'
            )
            ->where(function ($query) use ($request) {
                $query->where('products.id', $request->parent_id);
                if (!empty($request->s)) {
                    $query->where('products.category_name', 'like', '%' . $request->s . '%');
                }
            })
            ->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->category_name
                ];
            });
        return response()->json($list);
    }

}
