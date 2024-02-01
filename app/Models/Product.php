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

    public function scopeSearch($query, $request)
    {
        return $query->where(
            function ($s) use ($request) {
                if (!empty($request->s)) {
                    $s = $request->s;
                    $s->where('products.name', 'like', '%' . $s . '%');
                    $s->orWhere('products.category_id', 'like', '%' . $s . '%');
                    $s->orWhere('products.price', $s);
                    $s->orWhere('categories.name', $s);
                }
                if (!empty($request->name)) {
                    $s->where('products.name', $request->name);
                }
                if (!empty($request->categoryId)) {
                    $s->where('products.category_id', $request->categoryId);
                }
                if (!empty($request->exp_date)) {
                    $s->where('products.exp_date', $request->exp_date);
                }
            }
        );
    }
}
