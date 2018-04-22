<?php

namespace App\Http\Controllers;

use App\Product;
use App\Track;
use App\TrackItem;
use App\Cart;
use App\CartItem;
use App\Rating;
use App\Notification;
use App\Promotion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class TrackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addItem (){


        $cart = Cart::where('user_id',Auth::user()->id)->first()->count;
        $track = Track::where('user_id',Auth::user()->id);
        //if(!$track){
            $track =  new Track();
            $track->user_id=Auth::user()->id;
            $track->count= $cart;
            $track->save();
        //}

        $po = $track->id;

        $cartItems = (auth()->user()->cartItems);

        foreach($cartItems as $cartItem){
            $trackItem  = new Trackitem();
            $trackItem->product_id=$cartItem->product_id;
            $trackItem->track_id= $track->id;
            $trackItem->save();
        }

        //return redirect('/checkout');

        if($track->count >= 1000){
            $code = Str::random(6);
        $promotion  = new Promotion();
        $promotion->uid =Auth::user()->id;
        $promotion->code = $code;

        $notification  = new Notification();
        $notification->user_id = Auth::user()->id;
        $notification->notifiable_id = 0;
        $notification->notifiable_type = 'promotion';
        $notification->data = $code;

        $notification->save();
        $promotion->save();
        }

        $cart = Cart::where('user_id',Auth::user()->id)->first();
        $cart->discount_record = 0;
        $cart->save();
        CartItem::truncate();

        return redirect()->route('po', $po);
    }


    public function index()
    {



        if (request('status') == 'past') {
            if(request()->wantsJson()){
                return datatables()->of(
                    Track::where('user_id',auth()->id())
                        ->where(function ($query) {
                            $query->where('status','Shipping')
                                ->orWhere('status','Cancel');
                        })
                        ->latest()
                    )->toJson();
            }
            return view('cart.track', [
                    'status' => 'past'
                ]);

        }

        if (request('status') == 'current') {
            if(request()->wantsJson()){
                return datatables()->of(
                    Track::where('user_id',auth()->id())
                        ->where(function ($query) {
                            $query->where('status','Pending')
                                ->orWhere('status','Hold');
                        })
                        ->latest()
                    )->toJson();
            }

            return view('cart.track', [
                    'status' => 'current'
                ]);
        }

        $track = Track::where('user_id',Auth::user()->id);

        if(request()->wantsJson()){

            $products = datatables()->of(Product::query())->toJson();
            return datatables()->of(Track::where('user_id',auth()->id())->latest())->toJson();
        }


        return view('cart.track', [
            'status' => ''
        ]);
    }


    public function orderDetail(Track $track){
        //$item = TrackItem::where('id',$track->id);

        //$users = Track::where(user::all());
        $userdata = $track->user;

        $items = $track->trackItem;

        $count=0;
        foreach($items as $item){
            $count+=1;
        }

        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }

        $ratings = Rating::where('user_id',Auth::user()->name)->get();
        //$itemDetail = Product::where('id', TrackItem::product()->id);




        return view('products.orderDetail',compact('track','items','total','count','userdata','ratings'));
    }

    public function guestcancel(Track $track)
    {

        //$orders = Track::findOrFail($order);
        $track->status = 'Cancel';
        $track->save();

        $userdata = $track->user;

        $items = $track->trackItem;

        $count=0;
        foreach($items as $item){
            $count+=1;
        }

        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }

        //$itemDetail = Product::where('id', TrackItem::product()->id);
        return view('products.orderDetail',compact('track','items','total','count','userdata'));
        //return view('welcome');
    }







    //Admine Order
    public function orderpage()
    {

        if (request('pid')) {
             $orders = Track::where('id',request('pid'))->get();
             return view('cart.order',compact('orders'));
        }


        $orders = Track::all();

        if (request('status') == 'pending') {
            $orders = $orders->where('status', 'Pending');
        }

        if (request('status') == 'hold') {
            $orders = $orders->where('status', 'Hold');
        }

        if (request('status') == 'past') {
            $orders = Track::where('status', 'Cancel')
            ->orWhere('status','Shipping')
            ->get();
        }

        //$total->trackItem->product->sum(DB::raw('price'));



        $orders = $orders->reverse();


        return view('cart.order',compact('orders'));
        //return view('welcome');
    }

    public function orderprocess(Track $order){

        $userdata = $order->user;

        $items = $order->trackItem;

        //$count=0;
        //foreach($items as $item){
        //    $count+=1;
        //}

        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }

        //$order->count = $total;
        //$order->save();

        //$itemDetail = Product::where('id', TrackItem::product()->id);
        return view('products.orderProcess',compact('order','items','total','userdata'));
    }

    public function shipping(Track $order)
    {

        $order->status = 'Shipping';
        $order->save();

        $userdata = $order->user;

        $items = $order->trackItem;

        $count=0;
        foreach($items as $item){
            $count+=1;
        }

        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }


        $notification  = new Notification();

        $notification->user_id = $userdata->id;
        $notification->notifiable_id = $order->id;
        $notification->notifiable_type = 'status';
        $notification->data = 'Shipping';

        $notification->save();

        return view('products.orderProcess',compact('order','items','total','count','userdata'));
    }

    public function hold(Track $order)
    {

        $order->status = 'Hold';
        $order->save();

        $userdata = $order->user;

        $items = $order->trackItem;

        $count=0;
        foreach($items as $item){
            $count+=1;
        }

        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }

        $notification  = new Notification();

        $notification->user_id = $userdata->id;
        $notification->notifiable_id = $order->id;
        $notification->notifiable_type = 'status';
        $notification->data = 'Hold';
        //$notification->read_at =Request::input('author');

        $notification->save();

        return view('products.orderProcess',compact('order','items','total','count','userdata'));
    }

    public function cancel(Track $order)
    {

        $order->status = 'Cancel';
        $order->save();

        $userdata = $order->user;

        $items = $order->trackItem;

        $count=0;
        foreach($items as $item){
            $count+=1;
        }

        $total=0;
        foreach($items as $item){
            $total+=$item->product->price;
        }

        $notification  = new Notification();

        $notification->user_id = $userdata->id;
        $notification->notifiable_id = $order->id;
        $notification->notifiable_type = 'status';
        $notification->data = 'Cancel';
        //$notification->read_at =Request::input('author');

        $notification->save();

        return view('products.orderProcess',compact('order','items','total','count','userdata'));
    }

    public function deleteinform($id){
        //$po = Notification::where('id',$id)->first()(['notifiable_id']);
        
        $po = Notification::where('id',$id)->first();
        $po->read_at = \Carbon\Carbon::now()->toDateTimeString();;
        $po->save();
        //Notification::destroy($id);

        return redirect()->route('po', $po->notifiable_id);
    }

    public function deletepromotion($id){
        //Notification::destroy($id);
        $po = Notification::where('id',$id)->first();
        $po->read_at = \Carbon\Carbon::now()->toDateTimeString();;
        $po->save();
        return redirect('/cart');

    }



}
