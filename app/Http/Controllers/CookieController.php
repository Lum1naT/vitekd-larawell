<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class CookieController extends Controller
{

    public function setCookie($name, $value, $minutes = 2628000){

      Cookie::queue(Cookie::make($name, $value, $minutes));

      }

      public function getCookie($name){
        $cookie = Cookie::get($name);
        return $cookie;
      }

      public function getAllCookies(){
        $cookies = Cookie::get();
        return $cookies;
      }

      public function forgetCookie($name){
        Cookie::queue(Cookie::forget($name));
      }

      public function forgetAllCookies(){
        $cookies = Cookie::get();
        $cookiesToRemember = ['XSRF-TOKEN', 'laravel_session'];
        foreach ($cookies as $cookieKey => $cookieValue) {

          if (!(in_array($cookieKey, $cookiesToRemember))) {
            Cookie::queue(Cookie::forget($cookieKey));
          }

        }
      }

}
