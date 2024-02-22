<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'order_date',
        'shipping_date',
        'amount',
        'sub_total',
        'total',
        'discount',
        'withholding_tax',
        'shop_code'
    ];

    public function scopeSearch($query, $request)
    {
        return $query->where(
            function ($search) use ($request) {
                if (!empty($request->keyword)) {
                    $search->where('orders.name', 'like', '%' . $request->keyword . '%');
                }
                if (!empty($request->id)) {
                    $search->where('orders.id', 'like', '%' . $request->id . '%');
                }
                if (!empty($request->order_date)) {
                    $search->where('orders.order_date', 'like', '%' . $request->order_date . '%');
                }
                if (!empty($request->shipping_date)) {
                    $search->where('orders.shipping_date', 'like', '%' . $request->shipping_date . '%');
                }
            }
        );
    }
}
