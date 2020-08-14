<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;

class Tag extends Model
{

  use SoftDeletes;

  public function products(){
    return $this->belongsToMany(Product::class);
  }
}
