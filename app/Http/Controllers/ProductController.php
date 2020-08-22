<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Product;
use App\Category;
use App\Tag;

class ProductController extends Controller
{


      public function overview(Request $request){

        

      }


      static function addCategory(Product $product, array $categoryId){

        $category = Category::FindOrFail($categoryId);

        $product->categories()->attach($category);

      }

      static function removeCategory(Product $product, array $categoryId){

        $category = Category::FindOrFail($categoryId);

        $product->categories()->detach($category);

      }

      static function addTag(Product $product, array $tagId){

        $tag = Tag::FindOrFail($tagId);

        $product->tags()->attach($tag);

      }

      static function removeTag(Product $product, array $tagId){

        $tag = Tag::FindOrFail($tagId);

        $product->tags()->detach($tag);

      }

  public function detail($id){

    $product = Product::FindOrFail($id);

    $price = explode(".",$product->price);
    if(sizeof($price) == 1){
      array_push($price, "00");
    }


    return view('productDetail', [
      'product' => $product,
      'price_base' => $price[0],
      'price_decimal' => $price[1],
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
            ->withErrors($validator, 'productCreate');
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

      $tagsArray = [1,3];
      $categoriesArray = [3,5];

      ProductController::addTag($product, $tagsArray);
      ProductController::addCategory($product, $categoriesArray);


      $product->save();

      return redirect('/');
    }

    public function edit(Request $request){

      //get id of a product the request is coming from
      $url = $request->path();
      $explodedUri = explode("/", $_SERVER['HTTP_REFERER']);
      $id = $explodedUri[4];

      //

      $product = Product::FindOrFail($id);

      $validator = Validator::make($request->all(), [
        'name' => ['required', 'max:255'],
        'description' => ['required', ],
        'base' => ['required', 'numeric'],
        'decimal' => ['numeric', ],
        'stock' => ['numeric', ],
        'product_code' => ['required', 'unique:products,product_code,'.$id , 'max:255',],
    ]);

    if ($validator->fails()) {
      return redirect('/error')
            ->withErrors($validator, 'productEdit');
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

    public function delete(Request $request){

      $id = 1;
      $product = Product::FindOrFail($id);

      $product->delete();

    }

    public function restore(Request $request){
      $id = 1;
      $product = Product::onlyTrashed()
                      ->where('id', $id)
                      ->restore();

    }


    public function getAllProductsInStock(){
      $productsInStock = Product::where('stock', '>', 0)->get();
      return $productsInStock;
    }


}
