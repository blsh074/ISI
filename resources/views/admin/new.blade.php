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
        
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
        <div class="panel-body" >
            <form method="POST" action="/admin/product/save" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Name</label>
                        <div class="col-md-9">
                            <input id="name" name="name" type="text" placeholder="Product name" class="form-control input-md">
 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="brand">Category</label>
                        <div class="col-md-9">
                            <!--
                            <input id="brand" name="brand" type="text" placeholder="Brand name" class="form-control input-md">
                            -->
                            <select name="brand" id="brand">
                                <option value="Bargain">Bargain</option>
                                <option value="Audible">Audible</option>
                                <option value="Textbooks">Textbooks</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="description"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="price">Price</label>
                        <div class="col-md-9">
                            <input id="price" name="price" type="text" placeholder="Product price" class="form-control input-md">
 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="author">Author</label>
                        <div class="col-md-9">
                            <input id="author" name="author" type="text" placeholder="author name" class="form-control input-md">
 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="isbn">ISBN</label>
                        <div class="col-md-9">
                            <input id="isbn" name="isbn" type="text" placeholder="ISBN" class="form-control input-md">
 
                        </div>
                    </div>
                    
                    <!--<div class="form-group">
                        <label class="col-md-3 control-label" for="imageurl">Image URL</label>
                        <div class="col-md-9">
                            <input id="imageurl" name="imageurl" type="text" placeholder="Image URL" class="form-control input-md" >
 
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">File</label>
                        <div class="col-md-9">
                            <input id="file" name="file" class="input-file" type="file">
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