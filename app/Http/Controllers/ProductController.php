<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    
    public function fetchProducts(){

    	return response(json_encode(Product::get()),200);

    }

    public function store(Request $request){

    	

    	Product::create($this->setData($request));

    	return response("success",200);
    }
    public function update(Request $request, $id){

    	$product = Product::findOrFail($id);

    	$product->update($this->setData($request));

    	return response('success',200);
    }

    public function getProduct($id){

    	return response(json_encode(Product::where('id',$id)->first()),200);
    }

    public function destroy($id){
    	Product::findOrFail($id)->delete();

    	return response('deleted',200);
    }
    private function setData($request){
    	$data = array(

    		'product_name' => $request->product_name,
    		'description' => $request->description,
    		'price' => $request->price,
    		'quantity' => $request->quantity
    	);

    	return $data;
    }
}
