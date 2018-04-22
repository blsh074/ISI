@extends('layouts.app')
 
@section('Admin shop', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
 
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/admin/product/new"><button class="btn btn-success">New Product</button></a>
                <a href="/admin/product/promotion"><button class="btn btn-success">New Promotion</button></a>
            </div>
        
        <form class="form-horizontal" method="GET" action="/admin/products">
        <input id="q" name="q" type="text" placeholder="Product name">
        <input id="n" name="n" type="text" placeholder="Product id">
        <button type="submit" class="btn btn-primary">Search</button>
        </form>
        
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <td>Id</td>
                    <td>Image</td>
                    <td>Name</td>
                    <td>brand</td>
                    <td>Price</td>
                    <td>File</td>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><a class="thumbnail pull-left" href="/product/{{$product->id}}"> <img class="media-object" src="/storage/{{$product->file_id}}" style="width: 100px; height: 72px;"></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->brand}}</td>
                            <td>{{$product->price}}$</td>
                            <td><a href="/admin/product/destroy/{{$product->id}}"><button class="btn btn-danger">Del</button></a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div class="put-right" align="center" >
            {{ $products->appends(request()->except('page'))->links() }}
        </div>
@endsection