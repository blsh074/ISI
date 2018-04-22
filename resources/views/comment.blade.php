@extends('layouts.app')
 
@section('New Product', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">New Product</div>
        </div>
        <div class="panel-body" >
            <form method="POST" action="/rc/save/{id}" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="description"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="star">Star</label>
                        <div class="col-md-9">
                            <input id="star" name="star" type="text" placeholder="" class="form-control input-md" required="">
 
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary">Insert</button>
                        </div>
                    </div>
 
                </fieldset>
 
            </form>
        </div>
    </div>
@endsection