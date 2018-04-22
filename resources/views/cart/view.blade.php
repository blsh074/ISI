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
                    <th></th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Subtotal</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td style="vertical-align:middle"><a class="thumbnail pull-left" href="/product/{{$item->product_id}}"> <img class="media-object" src="/storage/{{$item->product->file_id}}" style="width: 100px; height: 72px;"> </a></td>
                        <td class="col-sm-8 col-md-6" style="vertical-align:middle">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading" align='center'><a href="/product/{{$item->product_id}}">{{$item->product->name}}</a></h4>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align:middle">1</td>
                        <td class="col-sm-1 col-md-1 text-center" style="vertical-align:middle"><strong>${{$item->product->price}}</strong></td>
                        <td class="col-sm-1 col-md-1" style="vertical-align:middle">
                            <a href="/removeItem/{{$item->id}}"> <button type="button" class="btn btn-danger">
                                    <span class="fa fa-remove"></span> Remove
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="col-sm-1 col-md-1 text-center"><h3>Total price</h3></td>
                    <td  class="col-sm-1 col-md-1 text-center">
                        <h3><strong>
                        @if(!empty($discounttotal))
                           <del>${{$total}}</del> <font color="green"><ins>${{$discounttotal}}</ins></font>
                        @else
                        ${{$total}}
                        @endif
                    </strong></h3>
                    </td>
                    <td></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="3">
                         @php
                                $pcode = App\Cart::where('user_id',Auth::user()->id)->first();
                        @endphp
                        
                        @if($pcode->discount_record == 0)
                        <form action="/cart/discount">

                          <input id="pc" name="pc" type="text" class="form-controlsc" placeholder="Promo code" size="12">


                            <button type="submit" class="btn btn-secondary">Redeem</button>

                        </form>
                        @endif
                        @if(!empty($message))
                           {{$message}}
                        @else
                        @endif
                        
                    </td>
                    
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="/lists"> <button type="button" class="btn btn-default">
                                <span class="fa fa-shopping-cart"></span> Continue shopping
                            </button>
                        </a></td>
                    <td>
                        
                        @if($total>0)
                           <form action="/track" method="POST" id="from_1">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">
                                Checkout
                            </button></td>
                        </form>
                        @else
                        <form action="">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-not">
                                Checkout
                            </button></td>
                        </form>
                        @endif
                        
                        
                        
                        
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>


@endsection

@section('scripts.footer')
        
    <script>
        var loading = false;
        
        $(document).on("submit", "form_1", function(e){
            e.preventDefault();
            
            
            let href = $(this).attr('action')
            
            
            
            if (!loading) {
                axios.post(href).then(()=> {
                    window.location  = '/track'
                    loading = false;
                })    
            }
            
            loading = true;
            
            return false;
        });
        
       
    </script>
@endsection