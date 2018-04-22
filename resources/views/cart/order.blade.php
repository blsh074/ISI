@extends('layouts.app')

@section('Shopping Carts', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <div class="col-md-4">
                <form class="form-horizontal" method="GET" action="/order">
                <input id="pid" name="pid" type="text" placeholder="Product id" >
                <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <p>Filter: 
                        <a href="/order"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> All
                            </button>
                        </a>
            
                        <a href="/order?status=pending"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Pending orders
                            </button>
                        </a>
                        
                        <a href="/order?status=hold"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Hold orders
                            </button>
                        </a>
                        
                        <a href="/order?status=past"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Past orders
                            </button>
                        </a>
            </p>
            
            
                
            
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>P.O number</th>
                    <th>Purchase dates</th>
                    <th class="text-center">Customer name</th>
                    <th class="text-center">total order amounts</th>
                    <th>status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td class="col-sm-1 col-md-1">
                        <a href="/order/{{$order->id}}">{{$order->id}}</a>
                        </td>
                        <td class="col-sm-1 col-md-1" >{{$order->created_at}}</td>
                        <td class="col-sm-1 col-md-1 text-center">{{$order->user->name}}</td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>{{$order->count}}</strong></td>
                        <td class="col-sm-1 col-md-1">{{$order->status}}</td>
                    </tr>
                @endforeach

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td></td>
                    <td class="text-right"><h3><strong></strong></h3></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection