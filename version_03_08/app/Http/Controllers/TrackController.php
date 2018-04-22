<?php

namespace App\Http\Controllers;

use App\Product;
use App\Track;
use App\TrackItem;
use App\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrackController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addItem (){

        $track = Track::where('user_id',Auth::user()->id);

        //if(!$track){
            $track =  new Track();
            $track->user_id=Auth::user()->id;
            $track->save();
        //}

        $cartItems = (auth()->user()->cartItems);
        
        foreach($cartItems as $cartItem){
            $trackItem  = new Trackitem();
            $trackItem->product_id=$cartItem->product_id;
            $trackItem->track_id= $track->id;
            $trackItem->save();
        }

        return redirect('/track');
        

    }
    
    
    public function index()
    {
        $track = Track::where('user_id',Auth::user()->id);
        if(request()->wantsJson()){
            
            //$products = datatables()->of(Product::query())->toJson();
            return datatables()->of(Track::where('user_id',auth()->id())->latest())->toJson();
        }
        
        return view('cart.track');
    }
    
    public function orderDetail(Track $track){
        //$item = TrackItem::where('id',$track->id);
        
        $items = $track->trackItem;
        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }
        
        //$itemDetail = Product::where('id', TrackItem::product()->id);
        
        
        
        
        return view('products.orderDetail',compact('track','items','total'));
    }

}
    