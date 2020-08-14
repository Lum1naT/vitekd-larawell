<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

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

  

}
