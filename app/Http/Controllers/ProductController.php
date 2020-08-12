<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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


      $validator = Validator::make($request->all(), [
        'name' => ['required', 'max:255'],
        'description' => ['required', ],
        'base' => ['required', 'numeric'],
        'decimal' => ['numeric', ],
        'stock' => ['numeric', ],
        'product_code' => ['required', 'unique:products', 'max:255'],
    ]);

    if ($validator->fails()) {
      return redirect('/error')
            ->withErrors($validator);
    }

    $validatedData = $validator->valid();


    //Price input check
    if(empty($validatedData['decimal'])){
      $price = $validatedData['base'].'.00';
    } else {
      $price = $validatedData['base'].'.'.$validatedData['decimal'];
    }



      $product = new Product();
      $product->name = $validatedData['name'];
      $product->description = $validatedData['description'];
      $product->price = $price;

      //Stock input check
      if(!(empty($validatedData['stock']))){
        $product->stock = $validatedData['stock'];
      }

      $product->product_code = $validatedData['product_code'];
      $product->save();

      return redirect('/');
    }

    public function edit(Request $request, $id){

      $product = Product::FindOrFail($id);

      $validator = Validator::make($request->all(), [
        'name' => ['required', 'max:255'],
        'description' => ['required', ],
        'base' => ['required', 'numeric'],
        'decimal' => ['numeric', ],
        'stock' => ['numeric', ],
        'product_code' => ['required', 'unique:products', 'max:255'],
    ]);

    if ($validator->fails()) {
      return redirect('/error')
            ->withErrors($validator, 'editProduct');
    }

    $validatedData = $validator->valid();


    //Price input check
    if(empty($validatedData['decimal'])){
      $price = $validatedData['base'].'.00';
    } else {
      $price = $validatedData['base'].'.'.$validatedData['decimal'];
    }

      $product->name = $validatedData['name'];
      $product->description = $validatedData['description'];
      $product->price = $price;

      //Stock input check
      if(!(empty($validatedData['stock']))){
        $product->stock = $validatedData['stock'];
      }

      $product->product_code = $validatedData['product_code'];
      $product->save();

      return redirect('/');

    }





    public function getAllProductsInStock(){
      $productsInStock = Product::where('stock', '>', 0)->get();
      return $productsInStock;
    }


}
