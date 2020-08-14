<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

class TagController extends Controller
{
  public function create(Request $request){

    $name = 'Dummy Tag';

    $tag = new Tag;

    $tag->name = $name;

    $tag->save();

  }

  public function edit(Request $request){

  }

  public function delete(Request $request){

  }


}
