<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'order_date',
        'shipping_date',
    ];

    public function scopeSearch($query, $request)
    {
        return $query->where(
            function ($search) use ($request) {
                if (!empty($request->keyword)) {
                    $keyword = $request->keyword;
                    $search->where('orders.name', 'like', '%' . $keyword . '%');
                }
            }
        );
    }
}
