@extends('links.layout')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Edit Links</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-primary" href="{{ route('links.index') }}"> Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Uuups!!!</strong> Midagi läks valesti.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('links.update',$link->id) }}" method="POST">
        @csrf
        @method('PUT')
        
			
			
        <div class="form-group row">
			 <label class="col-form-label col-sm-1" for="name">Name:</label>
			<div class="col-sm-3">         
                    <input type="text" name="name" value="{{ $link->name }}" class="form-control" placeholder="Name" required>
            </div>
		</div>

        <div class="form-group row">
			 <label class="col-form-label col-sm-1" for="url">URL:</label>
			<div class="col-sm-6">         
                    <input type="text" name="url" value="{{ $link->url }}" class="form-control" placeholder="URL" required>
            </div>
		</div>

			<div class="form-group row">
               <label class="col-form-label col-sm-1" for="detail">Details:</label>
			     <div class="col-sm-6"> 
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Details">{{ $link->detail }}</textarea>
                </div>
            </div>
			
          <div class="offset-sm-3 col-sm-3">
                <button type="submit" class="btn btn-primary">Muuda</button>
            </div>	

			

            
        

    </form>
@endsection