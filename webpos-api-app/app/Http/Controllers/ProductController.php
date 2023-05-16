<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{   
    //return list of all products on the database
    public function getAllProducts(){
        try{

            $product = Product::get();
            $success = false;
            $status = 2;
            $message = 'Something went wrong';
            $result = array();
    
            if ( $product->isNotEmpty() )  {
                $result = $product;
                $success = true;
                $status = 1;
                $message = 'Retrived successfuly'; 
                
            }
    
            return response([
                "success" => $success,
                "status" => $status,
                "message"=> $message,
                'result' => $result,
            ]);


        }catch ( \Throwable $exception) {

            $response['success'] = false;
            $response['status'] = 5;
            $response['message'] = 'Something went wrong';
            $response['result'] = $exception;
            return response($response);
        }
       
    }

    //update quantity of the product in db
    public function updateProductQuntity(Request $request){
        try{
            
            $productId = $request['product_id'];
            $newQuantity = $request['new_quantity'];
            if(isset($productId) && isset($newQuantity)){

                $product = Product::find($productId);
        
                if ($product) {
                    $product->quantity = $newQuantity;
                    $product->save();
        
                    // return true; // Quantity updated successfully
                    $success = true;
                    $status = 1;
                    $message = 'Updated successfuly'; 
                }else{
                    $success = false;
                    $status = 2;
                    $message = 'Something went wrong';
                }
        
        
                return response([
                    "success" => $success,
                    "status" => $status,
                    "message"=> $message,
                ]);
            }else{
                return response([
                    "success" => false,
                    "status" => 3,
                    "message"=> 'missing input requierd',
                ]);
            }

        } catch ( \Throwable $exception) {

            $response['success'] = false;
            $response['status'] = 5;
            $response['message'] = 'Something went wrong';
            $response['result'] = $exception;
            return response($response);
        }
        
        
    }

    

}
