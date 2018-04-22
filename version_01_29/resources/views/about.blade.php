@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                    <h1>about page!</h1>
                    <img src="{{asset('resources/assets/images/blacktie.jpg')}}"/>
                    <img src="{{URL::asset('/images/blacktie.jpg')}}" />
            </div>
        </div>
    </div>
</div>
@endsection
