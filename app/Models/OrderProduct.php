<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_order',
        'product_name',
        'size',
        'discount',
        'disc',
        'qty',
        'price',
        'total_qty',
        'subtotal',
        'total_price',
    ];
}