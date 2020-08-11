<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{

  public function detail($id){

    $product = Product::FindOrFail($id);

    return view('productDetail', [
      'product' => $product,
    ]);
  }

    public function create(Request $request)
    {

      if(empty($request->decimal)){
        $price = $request->base.'.00';
      } else {
        $price = $request->base.'.'.$request->decimal;
      }


      $product = new Product();
      $product->name = $request->name;
      $product->description = $request->description;
      $product->price = $price;

      if(!(empty($product->stock))){
        $product->stock = $request->stock;
      }

      $product->product_code = $request->product_code;
      $product->save();

      return redirect('/');
    }





    public function getAllProductsInStock(){
      $productsInStock = Product::where('stock', '>', 0)->get();
      return $productsInStock;
    }


}
