<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_id',
        'name',
        'price',
        'mgf_date',
        'exp_date',
        'detail',
    ];

    public function scopeSearch($query, $s, $request)
    {
        return $query->where(function ($q) use ($s, $request) {
            if (!empty($s)) {
                $q->where(function ($q2) use ($s, $request) {
                    $q2->where('products.name', 'like', '%' . $s . '%');
                    $q2->orWhere('products.category_id', 'like', '%' . $s . '%');
                    $q2->orWhere('products.price', $s);
                    $q2->orWhere('categories.name', $s);
                });
            }
            if (!empty($request->name)) {
                $q->where('products.name', $request->name);
            }
            if (!empty($request->category_id)) {
                $q->where('products.category_id', $request->category_id);
            }
            if (!empty($request->exp_date)) {
                $q->where('products.exp_date', $request->exp_date);
            }
        });

//        return $query->where(
//            function ($s) use ($request) {
//                if (!empty($request->s)) {
//                    $s = $request->s;
//                    $s->where('products.name', 'like', '%' . $s . '%');
//                    $s->orWhere('products.category_id', 'like', '%' . $s . '%');
//                    $s->orWhere('products.price', $s);
//                    $s->orWhere('categories.name', $s);
//                }
//                if (!empty($request->name)) {
//                    $s->where('products.name', $request->name);
//                }
//                if (!empty($request->categoryId)) {
//                    $s->where('products.category_id', $request->categoryId);
//                }
//                if (!empty($request->exp_date)) {
//                    $s->where('products.exp_date', $request->exp_date);
//                }
//            }
//        );
    }
}
