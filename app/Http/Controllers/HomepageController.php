<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\CategoryController;

class HomepageController extends Controller
{
    public function index(Request $request)
    {

      $cookieController = new CookieController();
      $productController = new ProductController();
      $categoryController = new CategoryController();

      $products = Product::all();
      $categories = Category::all();

      $category = Category::FindOrFail(3);

      $categoryController::getCategoryProducts($category);


      return view('homepage', [
        'products' => $products,
        'categories' => $categories,
      ]);

      
    }

    public function error(Request $request){

      return view('errorPage');

    }
}
