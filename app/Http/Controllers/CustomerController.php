<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    public function fetchCustomers(){

    	return response(json_encode(Customer::get()),200);
    }

    public function store(Request $request){

    	

    	Customer::create($this->setData($request));

    	return response('success',200);
    }

    public function getCustomer($id){

    	return response(json_encode(Customer::where('id',$id)->first()),200);
    }

    public function update(Request $request, $id){

    	$customer = Customer::findOrFail($id);

    	$customer->update($this->setData($request));

    	return response('success',200);
    }

    public function destroy($id){
    	Customer::findOrFail($id)->delete();

    	return response('success',200);
    }


    private function setData($request){

    	$customer_data = array(
    		'firstname' => $request->firstname,
    		'lastname' => $request->lastname,
    		'email' => $request->email,
    		'phone' => $request->phone,
    		'address' => $request->address
    	);

    	return $customer_data ;
    }
}
