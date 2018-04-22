@extends('layouts.app')

@section('Shopping Carts', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Product</th>
                    <th></th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Subtotal</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                    
                <div class="card mt-4">
                        <div class="card-body">
                          <h4><label for="1" class="col-md-4 control-label">P.O number:</label></h4><font size="5">{{$order->id}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Purchase date:</label></h4><font size="4">{{$order->created_at}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Customer name:</label></h4><font size="4">{{$userdata->name}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Shipping address:</label></h4><font size="4">{{$userdata->address}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Total order amount:</label></h4><font size="4">${{$order->count}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Status:</label></h4><font size="4">{{$order->status}}
                          @if($order->status == 'Cancel')
                                 ---cancel by vendor
                          @endif
                          </font>
                         <h4><label for="1" class="col-md-4 control-label">
                             @if($order->status == 'Cancel')
                             Cancel date:
                             @else
                             Shipment date:
                             @endif
                             </label></h4><font size="4">
                            @if($order->status == 'Shipping')
                                {{$order->updated_at}}
                            @else   @if($order->status == 'Cancel')
                                    {{$order->updated_at}}
                                    @else 
                                        wait for shipping
                                    @endif
                            @endif
                            
                            
                          </font>
                        </div>
                  </div>
                    
                    
                @foreach($items as $item)
                    <tr>
                        <td class="col-sm-1 col-md-1">
                            <div class="media">
                                <img class="media-object" src="/storage/{{$item->product->file_id}}" style="width: 100px; height: 80px;">
                                
                            </div>
                        </td>
                        <td class="col-sm-8 col-md-6" style="text-align: center">
                            <div class="media-body">
                                    <h4 class="media-heading">{{$item->product->name}}</h4>
                                </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center">1</td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->product->price}}</strong></td>
                        <td class="col-sm-1 col-md-1">
                            <!--<a href="/removeItem/{{$item->id}}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Remove
                                </button>
                            </a>-->
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h4>Total price</h3></td>
                    <td class="text-right"><h3><strong>
                        @if($total != $order->count)
                        <del>${{$total}}</del> <font color="green"><ins>${{$order->count}}</ins></font>
                        @else
                        ${{$total}}
                        @endif
                    
                    </strong></h3>
                    </td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   
                        @if($order->status == 'Pending')
                            <a href="/order/shipping/{{$order->id}}"> <button type="button" class="btn btn-default">
                            <span class="fa fa-shopping-cart"></span> Shipped
                            </button>
                            </a>
                        @endif
                    </td>
                    <td>
                        @if($order->status == 'Pending')
                            <a href="/order/hold/{{$order->id}}"> <button type="button" class="btn btn-default">
                            <span class="fa fa-shopping-cart"></span> Hold
                            </button>
                            </a>
                        @endif
                        
                        @if($order->status == 'Hold')
                            <a href="/order/shipping/{{$order->id}}"> <button type="button" class="btn btn-default">
                            <span class="fa fa-shopping-cart"></span> Shipped
                            </button>
                            </a>
                        @endif
                    </td>
                    <td>
                        
                        @if($order->status == 'Pending')
                            <a href="/order/cancel/{{$order->id}}"> <button type="button" class="btn btn-default">
                            <span class="fa fa-shopping-cart"></span> Cancel
                            </button>
                            </a>
                        @endif
                        
                        @if($order->status == 'Hold')
                            <a href="/order/cancel/{{$order->id}}"> <button type="button" class="btn btn-default">
                            <span class="fa fa-shopping-cart"></span> Cancel
                            </button>
                            </a>
                        @endif
                        
                        </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>

@endsection