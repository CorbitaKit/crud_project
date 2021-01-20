<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    protected $fillable = ['order_id','total_quantity','total_amount','product_id'];
}
