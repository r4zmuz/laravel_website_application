@extends('links.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Lingi Info</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('links.index') }}"> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group" style="margin-left:-16px;">
                <strong>Name:</strong>
                {{ $link->name }}
            </div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>URL:</strong>
                {{ $link->url }}
            </div>
        </div>
		
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $link->detail }}
            </div>
        </div>
    </div>
@endsection