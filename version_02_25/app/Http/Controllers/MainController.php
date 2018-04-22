<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

//use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        //dump(request('q'));
       
        //$products = Product::all();
        $products = Product::paginate(6);
        
        if (request('sort') == 'price') {
              $products = Product::orderBy('price', 'ASC')->paginate(6);
        }
        if (request('q')) {
             $products = Product::where('name', 'like', '%'.request('q').'%')->paginate(6);
        }


        return view('main.index',['products' => $products]);

    }
}
