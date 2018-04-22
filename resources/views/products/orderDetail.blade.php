@extends('layouts.app')

@section('Shopping Carts', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            
            <div class="card mt-4">
                        <div class="card-body">
                          <h4><label for="1" class="col-md-4 control-label">P.O number:</label></h4><font size="5">{{$track->id}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Purchase date:</label></h4><font size="4">{{$track->created_at}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Customer name:</label></h4><font size="4">{{$userdata->name}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Shipping address:</label></h4><font size="4">{{$userdata->address}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Total order amount:</label></h4><font size="4">${{$track->count}}</font>
                          <h4><label for="1" class="col-md-4 control-label">Status:</label></h4><font size="4">{{$track->status}}
                          @if($track->status == 'Cancel')
                                 ---cancel by vendor
                          @endif
                          </font>
                          
                         <h4><label for="1" class="col-md-4 control-label">
                             @if($track->status == 'Cancel')
                             Cancel date:
                             @else
                             Shipment date:
                             @endif
                             </label></h4><font size="4">
                            @if($track->status == 'Shipping')
                                {{$track->updated_at}}
                            @else   @if($track->status == 'Cancel')
                                    {{$track->updated_at}}
                                    @else 
                                        wait for shipping
                                    @endif
                            @endif
                            
                            
                          </font>
                        </div>
                  </div>
            
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
                    
                @foreach($items as $item)
                    <tr>
                        <td class="col-sm-2 col-md-2">
                            <div class="media">
                                <a class="thumbnail pull-left" href="#"> <img class="media-object" src="/storage/{{$item->product->file_id}}" style="width: 100px; height: 72px;"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{$item->product->name}}</a></h4>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            
                        </td>
                        <td class="col-sm-1 col-md-1 text-center">1</td>
                        
                        <td class="col-sm-1 col-md-1 text-center"><strong>${{$item->product->price}}</strong></td>
                        
                        <td class="col-sm-1 col-md-1">
                            @if($track->status == 'Shipping')
                                  @php
                            $ratingcount =0 ;
                            @endphp
                            @foreach($ratings as $rating)
                                @if($rating->product_id == $item->product->id)
                                @php
                                    $ratingcount++ ;
                                @endphp
                                @endif
                            @endforeach 
                                 @if($ratingcount == 0)
                                     <form method="POST" action="/rc/{{$item->product->id}}" class="form-horizontal" enctype="multipart/form-data" role="form">
                                 {!! csrf_field() !!}
                                 <div class="form-group">
                                        <textarea class="form-control" id="textarea" name="description"></textarea>
                                        Star:
                                        <select name="star" id="star">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                </div>
                                <button id="submit" name="submit" class="btn btn-primary">Comment</button>
                                </form>
                                 @endif
                                  
                            @endif
                                        
                                    
                             
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h4>Total price</h3></td>
                    <td class="text-right"><h3><strong>
                        @if($total != $track->count)
                        <del>${{$total}}</del> <font color="green"><ins>${{$track->count}}</ins></font>
                        @else
                        ${{$total}}
                        @endif
                    </strong></h3>
                    </td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <!--   
                        @if($track->status == 'Pending')
                            <a href="/track/cancel/{{$track->id}}"> <button type="button" class="btn btn-default">
                            <span class="fa fa-shopping-cart"></span> Cancel
                            </button>
                            </a>
                        @endif
                        
                        @if($track->status == 'Hold')
                            <a href="/track/cancel/{{$track->id}}"> <button type="button" class="btn btn-default">
                            <span class="fa fa-shopping-cart"></span> Cancel
                            </button>
                            </a>
                        @endif
                        -->
                    </td>
                    <td>
                        <a href="/"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Continue shopping
                            </button>
                        </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>

@endsection