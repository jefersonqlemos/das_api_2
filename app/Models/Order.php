<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'total_value', 'client_id'];
    public $timestamps = false;
    use HasFactory;
}
