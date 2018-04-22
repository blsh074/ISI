@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">
          <img class="card-img-top img-fluid" src="/storage/{{$product->file_id}}" alt="" style="width: 100%; height: 100%">
          <br>
          <p></p>
          <p></p>
          <div>
            <p></p>
          </div>
          @if(auth()->id() == 1)
          @else
          <div style="width:50%; margin:10% auto;" align='center'>
                  <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product" ><span class="fa fa-shopping-cart">Buy</span> </a>
          </div>
          @endif
        </div>

        <!-- /.col-lg-3 -->

        <div class="col-lg-9" style="margin:-8% auto;">
          
           <!-- /cart <div class="card mt-4">  -->
          
              <table class="table table-hover">
                <thead >
                <tr>
                    <th colspan="2"><h1>Product Detail</h1></th>
                    
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><h4><label for="1" class="col-md-8 control-label">Product Name:</label></h4></td>
                    <td><font size="6">{{$product->name}}</font></td>
                  </tr>
                  <tr>
                    <td><h4><label for="2" class="col-md-4 control-label">Price:</label></h4></td>
                    <td><font size="6">${{$product->price}}</font></td>
      
                  </tr>
                  <tr>
                    <td><h4><label for="2" class="col-md-4 control-label">Category:</label></h4></td>
                    <td><font size="6">{{$product->brand}}</font></td>
      
                  </tr>
                  <tr>
                    <td><h4><label for="3" class="col-md-4 control-label">Author:</label></h4></td>
                    <td><font size="6">{{$product->author}}</font></td>
      
                  </tr>
                  <tr>
                    <td><h4><label for="4" class="col-md-4 control-label">ISBN:</label></h4></td>
                    <td><font size="6">{{$product->isbn}}</font></td>
      
                  </tr>
                  <tr>
                    <td><h4><label for="4" class="col-md-4 control-label">Description:</label></h4></td>
                    <td><font size="6">{{$product->description}}</font></td>
      
                  </tr>
                  <tr>
                    <td><h4><label for="4" class="col-md-4 control-label">Rating:</label></h4></td>
                    <td>
                <font size="6">
                     
                @if($averagestar == '0')
                ------------
                @else
                {{$averagestar}}
                @endif
              <span class="text-warning"> 
                @if($averagestar == 5)
                &#9733; &#9733; &#9733; &#9733; &#9733;
                  @else
                  @if($averagestar >= 4)
                    &#9733; &#9733; &#9733; &#9733; &#9734;
                    @else
                      @if($averagestar >= 3)
                      &#9733; &#9733; &#9733; &#9734; &#9734;
                      @else
                        @if($averagestar >= 2)
                        &#9733; &#9733;  &#9734;  &#9734;  &#9734;
                        @else
                          @if($averagestar >= 1)
                          &#9733; &#9734; &#9734; &#9734; &#9734;
                          @else
                          
                          @endif
                        @endif
                      @endif
                  @endif
                @endif</span></font>
                    </td>
                  </tr>
              <p></p>
              </tbody>
              </div>
              </div>
          </div>
          <!-- /.card 
          
          <div class="card-header">
              <h1>Product Reviews</h1>
              <p>---------------------------------------------</p>
            </div>
            <div class="card-body">
          
          -->
          <br>
          <br>
          @if($averagestar == '0')
                    
          @else
          <div class="card card-outline-secondary my-4">
            
            <table class="table table-hover">
                <thead>
                <tr>
                    <th colspan="2"><h1>Product Reviews</h1></th>
                    
                </tr>
                </thead>
                <tbody>
            
            
              
              @foreach($ratings as $rating)
              <tr>
                <td class="col-sm-1 col-md-1"><img class="card-img-top" src="/images/user.png" alt="" style="width: 100px; height: 100px"></td>  
                <td>
              <h2>
                {{$rating->message}}
              </h2>
              <small class="text-muted">Posted {{$rating->user_id}} by {{$rating->created_at}} on </small>
                </td>
              </tr>
              @endforeach
            
            
              </tbody>
            </table>  
            </div>
            

          @endif
          <!-- /.card </div> -->

        </div>
        <!-- /.col-lg-9 -->

      </div>

    </div>
    <!-- /.container -->

    <!-- Footer 
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Own by ABookstore</p>
      </div>
      <!-- /.container 
    </footer>-->
@endsection

  
    




