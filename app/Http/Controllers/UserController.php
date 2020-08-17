<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function account(Request $request){

      $user = Auth::user();
      
      return view('accountDetail', [
        'categories' => 'omega',
      ]);
    }
}
