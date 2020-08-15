<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;

class TagController extends Controller
{
  public function create(Request $request){

    $name = 'Hard';

    $tag = new Tag;

    $tag->name = $name;

    $tag->save();

  }

  public function edit(Request $request){

  }

  public function delete(Request $request){
    $id = 1;
    $tag = Tag::FindOrFail($id);

    $tag->delete();
  }

  public function restore(Request $request){
    $id = 1;
    $tag = Tag::onlyTrashed()
                    ->where('id', $id)
                    ->restore();
  }


}
