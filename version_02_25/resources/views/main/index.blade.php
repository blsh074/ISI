 
@extends('layouts.app')
 
@section('Digital shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @foreach ($products as $product)
 
                    <div class="col-sm-6 col-xs-4">
                        <div class="thumbnail" >
                            <img src="{{$product->imageurl}}" class="img-responsive">
                            <div class="caption">
                                <div class="row">
                                    <div class="col-xs-6 col-xs-6">
                                        <h3>{{$product->name}}</h3>
                                    </div>
                                    <div class="col-xs-6 col-xs-6 price">
                                        <h3>
                                            <label>${{$product->price}}</label></h3>
                                    </div>
                                </div>
                                <p>{{$product->description}}</p>
                                <div class="row">
                                    <div class="col-xs-6 col-xs-offset-3">
                                        <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> Buy</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
        <div class="put-right" align="center" >
            {{ $products->links() }}
        </div>
    </div>
 
@endsection