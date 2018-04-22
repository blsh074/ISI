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
        $products = Product::paginate(8);
        
        if (request('sort') == 'price') {
              $products = Product::orderBy('price', 'ASC')->paginate(8);
        }
        if (request('sort') == 'price2') {
              $products = Product::orderBy('price', 'DESC')->paginate(8);
        }
        if (request('q')) {
             $products = Product::where('name', 'like', '%'.request('q').'%')->paginate(8);
             
        }
        if (request('brand')) {
             $products = Product::where('brand', 'Bargain')->paginate(8);
        }
        if (request('brand1')) {
             $products = Product::where('brand', 'Audible')->paginate(8);
        }
        if (request('brand2')) {
             $products = Product::where('brand', 'Textbooks')->paginate(8);
        }
        
        

        return view('main.index',['products' => $products]);

    }
    
    public function searching()
    {
        //dump(request('q'));

        if(request('brand') == 'all'){
            
            if(request('price') == ''){
                $products = Product::where('name', 'like', '%'.request('q').'%')
                    ->paginate(8);
            }else{
                $products = Product::where('name', 'like', '%'.request('q').'%')
                    ->orderBy('price', request('price'))
                    ->paginate(8);
            }
            
            
        }else{
            if(request('price') == ''){
                $products = Product::where('brand', request('brand'))
                    ->where('name', 'like', '%'.request('q').'%')
                    ->paginate(8);
                }else{
                    $products = Product::where('brand', request('brand'))
                    ->where('name', 'like', '%'.request('q').'%')
                    ->orderBy('price', request('price'))
                    ->paginate(8);
                }
        }
        

        return view('main.index',['products' => $products]);

    }
}