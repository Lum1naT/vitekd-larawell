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
    $id = 1;
    $category = Cagetory::FindOrFail($id);
    
  }

  public function delete(Request $request){
    $id = 1;
    $category = Category::FindOrFail($id);

    $category->delete();

    }

  public function restore(Request $request){
    $id = 1;
    $category = Category::onlyTrashed()
                    ->where('id', $id)
                    ->restore();
  }

  static function isParentCategory(Category $category){

    $hasChildren = DB::table('categories')
                            ->where('is_child_of', $category->id)
                            ->count();
    if($hasChildren != 0){
      return true;
    }

    return false;

  }

  //returns an array of child category id(s)
  static function getAllCategoryChildrenId(Category $category){

    $children = DB::table('categories')
                            ->where('is_child_of', $category->id)
                            ->get('id');



    $childrenStd = $children->toArray();

    //from StdClass to Array
    $childrenArray = json_decode(json_encode($childrenStd), true);


    $childrenResult = [];


    foreach ($childrenArray as $key => $value) {
      foreach ($value as $key => $categoryId) {
        array_push($childrenResult, $categoryId);
      }
    }

    return($childrenResult);

  }

  //returns an array with all the children of a category
  static function getChildrenOfCategory(array $categories, array $input = []){

    $childFound = false;

    foreach ($categories as $key => $category) {

      echo "checking category id: ".$category->id."<br>";




                              if (CategoryController::isParentCategory($category)) {
                                $childFound = true;
                                //returns id of children categories
                                $children = DB::table('categories')
                                                        ->where('is_child_of', $category->id)
                                                        ->get('id');

                                $childrenStd = $children->toArray();

                                //from StdClass to Array
                                $childrenArray = json_decode(json_encode($childrenStd), true);


                                $childrenResult = $input;
                                $categoriesResult = [];


                                foreach ($childrenArray as $key => $value) {
                                  foreach ($value as $key => $categoryId) {
                                    array_push($childrenResult, $categoryId);
                                    $category = Category::find($categoryId);
                                    array_push($categoriesResult, $category);

                                  }
                                }

                                CategoryController::getChildrenOfCategory($categoriesResult, $childrenResult);


    } else {
      $childrenResult = $input;

    }



  }   //endforeach



  if (!$childFound) {
    dump($childrenResult);
  }


}

  static function getCategoryProducts(Category $category){




    $queryResult = DB::table('category_product')
                            ->where('category_id', $category->id)
                            ->get('product_id');

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

  static function getCategoryProductsCount(Category $category){



    $queryResult = DB::table('category_product')->where('category_id', $category->id)->count();

    return $queryResult;


  }

}
