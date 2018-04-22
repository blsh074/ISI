 
@extends('layouts.app')
 
@section('Digital shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="container">

        <header class="jumbotron my-4">
            <h1>Product Lists</h1>
            <form action='/lists/searching' >
            <div class="col-md-6">
                
                <label class="col-md-0 control-label">Category:</label>
                <select name="brand" id="brand">
                                <option value="all">All</option>
                                <option value="Bargain">Bargain Books</option>
                                <option value="Audible">Audible Bestsellers</option>
                                <option value="Textbooks">Textbooks</option>
                </select>
            

                <label class="col-md-0 control-label">Price:</label>
                <select name="price" id="price">
                                <option value="">All</option>
                                <option value="ASC">Lowest first</option>
                                <option value="DESC">Highest first</option>

                </select>
                
                <input id="q" name="q" type="text" placeholder="Product name" class="form-control">
                
                
            </div>
            <div class="col-md-2">
                <br>
                <button type="submit" class="btn btn-primary btn-lg">Search</button>
            </div>
            </form>
            <br>
            <p></p>
            <br>

        </header>
        
        <div class="row">
            <div class="col-xs-12">
                @foreach ($products as $product)
 
                    <div class="col-sm-3 col-xs-2">
                        <div class="thumbnail" >
                            <a href="/product/{{$product->id}}"><img src="/storage/{{$product->file_id}}" class="img-responsive" style="width: 200px; height: 250px";></a>
                            <div class="caption">
                                
                                <div class="rowindex" >
                                    
                                        <h2 class="hindex">{{$product->name}}</h2>
                                    
                                </div>
                                
                                <p class="hindex2">{{$product->brand}}</p>
                                
                                <h3 class="hindex2"><label>${{$product->price}}</label></h3>

                                
                                <div class="row">
                                    <div class="col-xs-3 col-xs-offset-3">
                                        
                                        @if(auth()->id() == 1)
                                        @else<a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> Add to cart</a>
                                        @endif
                                        <!--<a href="/product/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> view</a>-->
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