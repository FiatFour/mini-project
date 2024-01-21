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
            function ($search) use ($request) {
                if (!empty($request->keyword)) {
                    $keyword = $request->keyword;
                    $search->where('products.name', 'like', '%' . $keyword . '%');
                    $search->orWhere('products.category_id', 'like', '%' . $keyword . '%');
                    $search->orWhere('products.price', $keyword);
                    $search->orWhere('categories.name', $keyword);
                }
                if (!empty($request->name)) {
                    $search->where('products.name', $request->name);
                }
                if (!empty($request->categoryId)) {
                    $search->where('products.category_id', $request->categoryId);
                }
                if (!empty($request->exp_date)) {
                    $search->where('products.exp_date', $request->exp_date);
                }
            }
        );
    }
}
