<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Order;
use App\OrderedProduct;
use App\Product;
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


    public function approveOrder($id){
        $order = Order::findOrFail($id);

        $order->update(['status' => 'Approved']);

        return response('updated',200);
    }


    public function getApprovedOrders(){

        $orders = Order::where('status','Approved')->get();

        return response(json_encode($orders),200);
    }

    public function getPendingOrders(){
        $orders = Order::where('status','Pending')->get();

        return response(json_encode($orders),200);
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

    		$this->updateProductQuantity($value);
    	}
    }


    private function updateProductQuantity($value){

    	$product = Product::findOrFail($value['value']);

    	$product->update(['quantity' => $value['original_quantity'] - $value['quantity']]);

    }


    public function getOrder($id){
    	$order = Order::with('customer','ordered_products','ordered_products.product')->where('id',$id)->first();

    	return response(json_encode($order),200);
    }

}
