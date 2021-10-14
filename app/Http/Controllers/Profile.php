<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import HTTP library
use Illuminate\Support\Facades\Http;

class Profile extends Controller
{
    function  list() {
        $url = 'https://jsonplaceholder.typicode.com/posts';

        //return as HTML body
        //return Http::get('https://jsonplaceholder.typicode.com/posts')->body();
        
        //return as JSON 
        //return Http::get('https://jsonplaceholder.typicode.com/posts')->json();
        $data = Http::get($url)->json();
        return view('profiles',['data' => $data]);

    }
}
