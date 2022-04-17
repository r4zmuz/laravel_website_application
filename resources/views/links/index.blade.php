@extends('links.layout')

@section('content')

<div class="container">
         <div class="row">
            <div class="col-lg-12 ">
                   <h2>Töölaud</h2><hr>
                   <table class="table table-hover">
                      <thead>
                        <th>Nimi</th>
                        <th>Email</th>
                        <th class="text-right"><a href="{{ route('auth.logout') }}">Logout</a></th> 
                      </thead>
                      <tbody>
                         <tr>
                            <td>{{ $LoggedUserInfo['name'] }}</td> <!-- sellega kuvan sisselogitud kasutajanime-->
                            <td>{{ $LoggedUserInfo['email'] }}</td>
                         </tr>
                      </tbody>
                   </table>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center">Veebilehtede hoidla</h3>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="{{ route('links.create') }}"> Lisa linke</a>
            <a class="btn btn-secondary " href="{{ route('links.all') }}"> Kõik lingid</a>
		</div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @if(sizeof($links) > 0)
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Pealkiri</th>
                <th>URL</th>
                <th width="280px">Rohkem valikuid</th>
            </tr>
            @foreach ($links as $link)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $link->name }}</td>
                    <td>{{ $link->url }}</td> 
                    <td>
                        <form action="{{ route('links.destroy',$link->id) }}" method="POST" onsubmit="return confirm('Kas soovid kustutada?');" >

                            <a class="btn btn-info" href="{{ route('links.show',$link->id) }}">Näita</a>
                            <a class="btn btn-primary" href="{{ route('links.edit',$link->id) }}">Muuda</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Kustuta</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-alert">Alusta lisamist andmebaasi.</div>
    @endif

    {!! $links->links('pagination::bootstrap-4') !!}

@endsection