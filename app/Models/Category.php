<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'status',
        'detail',
    ];

    public function scopeSearch($query, $s, $request)
    {
        return $query->where(function ($q) use ($s, $request) {
            if (!empty($s)) {
                $q->where(function ($q2) use ($s, $request) {
                    $q2->where('name', 'like', '%' . $s . '%');
                    $q2->orWhere('code', 'like', '%' . $s . '%');
                    $q2->orWhere('status', $s);
                });
            }
            if (!empty($request->code)) {
                $q->where('code', $request->code);
            }
            if (!empty($request->name)) {
                $q->where('name', $request->name);
            }
            if (!empty($request->status)) {
                $q->where('status', $request->status);
            }
        });
//
//        return $query->where(
//            function ($s) use ($request) {
//                if (!empty($request->s)) {
//                    $s = $request->s;
//                    $s->where('name', 'like', '%' . $s . '%');
//                    $s->orWhere('code', 'like', '%' . $s . '%');
//                    $s->orWhere('status', $s);
//                }
//                if (!empty($request->code)) {
//                    $s->where('code', $request->code);
//                }
//                if (!empty($request->name)) {
//                    $s->where('name', $request->name);
//                }
//                if (!empty($request->status)) {
//                    $s->where('status', $request->status);
//                }
//            }
//        );
    }
}
