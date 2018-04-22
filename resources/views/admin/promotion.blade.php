@extends('layouts.app')
 
@section('New Product', 'Page Title')
 
@section('sidebar')
    @parent
@endsection
 
@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title">New Promotion code</div>
        </div>
        <div class="panel-body" >
            <form method="POST" action="/admin/promotion/save" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="uid">UID</label>
                        <div class="col-md-9">
                            <input id="uid" name="uid" type="text" placeholder="User id" class="form-control input-md">
                             *Null for all users
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="pcode">CODE</label>
                        <div class="col-md-9">
                            <input id="pcode" name="pcode" type="text" placeholder="Promotion Code" class="form-control input-md" required="">
 
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