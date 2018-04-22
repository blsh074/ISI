<?php

namespace App\Http\Controllers;
use App\Cart;
use App\CartItem;
use App\Promotion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addItem ($productId){
        
        if(Auth::user()->id == 1){
            return redirect('/lists');
        }

        $cart = Cart::where('user_id',Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }

        $cartItem  = new Cartitem();
        $cartItem->product_id=$productId;
        $cartItem->cart_id= $cart->id;
        $cartItem->save();

        return redirect('/cart');

    }

    public function showCart(){
        $cart = Cart::where('user_id',Auth::user()->id)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }

        $items = $cart->cartItems;
        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }
        $discounttotal = '';
        $discount_record = $cart->discount_record;
        if($discount_record == 1){
            $discounttotal = $total * 0.8;
            $cart->count= $discounttotal;
        }else{
            $cart->count= $total;
        }
        
        
        $cart->save();
        
        return view('cart.view',['items'=>$items,'total'=>$total,'discounttotal'=>$discounttotal]);
    }
    
    public function discount(){
        
        $promocode =Request::input('pc');
        $dbpromotioncode = Promotion::where('code','=',$promocode )->first();
        
        if($dbpromotioncode != null){
            $cart = Cart::where('user_id',Auth::user()->id)->first();
            $promotioncode_id = Promotion::where('code','=',$promocode )->delete();

            if(!$cart){
                $cart =  new Cart();
                $cart->user_id=Auth::user()->id;
                $cart->save();
            }

            $items = $cart->cartItems;
            $total=0;
            foreach($items as $item){
                $total+=$item->product->price;
            }

            $discounttotal = $total * 0.8;
            
            $cart->count= $discounttotal;
            $cart->discount_record = 1;
            $cart->save();


            return view('cart.view',['items'=>$items,'total'=>$total,'discounttotal'=>$discounttotal]);

        }else{

        //echo ("wrong code");
        $message = 'Wrong code';
            
        $cart = Cart::where('user_id',Auth::user()->id)->first();
            if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Auth::user()->id;
            $cart->save();
        }

        $items = $cart->cartItems;
        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }
        
        $cart->count= $total;
        $cart->save();

        return view('cart.view',['items'=>$items,'total'=>$total, 'message'=>$message]);
        };
    }

    public function removeItem($id){

        CartItem::destroy($id);
        return redirect('/cart');
    }
    
    
    //public function checkout(){
        //$cart = Cart::where('user_id',Auth::user()->id)->first();
        //$cart->discount_record = 0;
        //$cart->save();
        //CartItem::truncate();
        //return redirect('/track');
    //}

}