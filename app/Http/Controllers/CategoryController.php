<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Category;
use App\Product;

class CategoryController extends Controller
{
  public function create(Request $request){

    $name = 'Kappa';
    $description = 'This is a dummy description';

    if(false){
      $isChild = 'Omega';
    } else {
      $isChild = null;
    }

    $category = new Category;

    $category->name = $name;
    $category->description = $description;
    $category->is_child_of = $isChild;

    $category->save();

  }

  public function edit(Request $request){

  }

  public function delete(Request $request){
    // $category = Cagetory::FindOrFail(1);
  }

  static function getCategoryProducts(Category $category){

    $queryResult = DB::table('category_product')->where('category_id', $category->id)->get('product_id');

    $products = $queryResult->toArray();

    //from StdClass to Array
    $productsArray = json_decode(json_encode($products), true);

    $result = [];

    foreach ($productsArray as $key => $value) {
      foreach ($value as $key => $productId) {
        $product = Product::find($productId);
        array_push($result, $product);
      }
    }

    return $result;



  }

  static function getProductsCount(Category $category){
    $queryResult = DB::table('category_product')->where('category_id', $category->id)->count();

    return $queryResult;


  }

}
