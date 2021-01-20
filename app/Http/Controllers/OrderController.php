<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Order;
use App\OrderedProduct;
class OrderController extends Controller
{


	public function getOrders(){
		return response(json_encode(Order::with('customer')->get()),200);
	}


    public function store(Request $request){
    	DB::beginTransaction();

    	try{

    		$data = new Order;

	    	$data->transaction_number = $request->transaction_number;
	    	$data->customer_id = $request->customer['value'];
	    	$data->status = 'Pending';

	    	$data->save();

	    	$this->saveOrderedData($request,$data->id);

	    	DB::commit();

	    	return response('success',200);
    	}catch(\Exception $e){
    		DB::rollback();
    		
    	}
    }

    private function saveOrderedData($request, $id){

    	foreach ($request->order_products as $products => $value) {
    		
    		$data = array(
    			'order_id' => $id,
    			'total_quantity' => $value['quantity'],
    			'total_amount' => $value['total'],
    			'product_id' => $value['value']
    		);

    		OrderedProduct::create($data);
    	}
    }


    public function getOrder($id){
    	$order = Order::with('customer','ordered_products','ordered_products.product')->where('id',$id)->first();

    	return response(json_encode($order),200);
    }

}
