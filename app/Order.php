<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['transaction_number','customer_id','status'];


    public function customer(){
    	return $this->hasOne('App\Customer','id','customer_id');
    }

    public function ordered_products(){
    	return $this->hasMany('App\OrderedProduct','order_id');
    }
}
