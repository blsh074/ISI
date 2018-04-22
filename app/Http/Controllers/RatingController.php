<?php

namespace App\Http\Controllers;
use App\Rating;
use App\Product;
use App\Track;
use App\TrackItem;
use App\Cart;
use App\CartItem;
use App\User; 
use Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class RatingController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index ($productId){
        $rating = new Rating();
        $rating->user_id=Auth::user()->id;
        $rating->product_id= $productId;
        $rating->message ='description';
        $rating->star ='1';
        $rating->save();
        
        return view('comment');
    }
    
    public function addItem ($productId){
        
        $rating = new Rating();
        $rating->user_id=Auth::user()->name;
        $rating->product_id=$productId;
        $rating->message =Request::input('description');
        $rating->star =Request::input('star');
        $rating->save();
        
        return redirect('/track');
    }
}
