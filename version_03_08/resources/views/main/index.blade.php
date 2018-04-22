 
@extends('layouts.app')
 
@section('Digital shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="container">
        Filter:<a href="?sort=price"> Price</a> | <a href="?q=new"> brand</a>
        <br></br>
        <div class="row">
            <div class="col-xs-12">
                @foreach ($products as $product)
 
                    <div class="col-sm-6 col-xs-4">
                        <div class="thumbnail" >
                            <img src="{{$product->imageurl}}" class="img-responsive" style="width: 300px; height: 150px";>
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
                                        <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> Buy</a>
                                        <a href="/product/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> view</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
        <div class="put-right" align="center" >
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
    </div>
 
@endsection