<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['id', 'value', 'order_id', 'product_id', 'quantity'];
    public $timestamps = false;
    use HasFactory;
}
