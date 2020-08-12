<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CookieController;

class HomepageController extends Controller
{
    public function index(Request $request)
    {

      $cookieController = new CookieController();
      $productController = new ProductController();

      $products = Product::all();

      return view('homepage', [
        'products' => $products,
      ]);


    }

    public function error(Request $request){

      return view('errorPage');

    }
}
