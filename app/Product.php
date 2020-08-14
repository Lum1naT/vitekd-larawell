<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Product extends Model
{

  use SoftDeletes;

    public function categories(){
      return $this->belongsToMany(Category::class);
    }


      public function tags(){
        return $this->belongsToMany(Tag::class);
      }

}
