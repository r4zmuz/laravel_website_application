@extends('links.layout')
@section('content')

<div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Veebilehtede hoidla</h2>
        </div>
        <div class="col-lg-12 text-center" style="margin-top:10px;margin-bottom: 10px;">
            <a class="btn btn-success " href="{{ route('links.create') }}"> Lisa linke</a>
            <a class="btn btn-secondary " href="{{ route('links.index') }}"> Tagasi</a>
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
                        <form action="{{ route('links.destroy',$link->id) }}" method="POST" onsubmit="return confirm('Kas soovite kustutada?');" >

                            <a class="btn btn-info" href="{{ route('links.show',$link->id) }}">Näita</a>
                            <a class="btn btn-primary" href="{{ route('links.edit',$link->id) }}">Muuda</a>

                            @csrf <!--peab alati olema kui POST meetodit kasutame-->
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Kustuta</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <div class="alert alert-alert">Alustage lisamist andmebaasi.</div>
    @endif

    {!! $links->links() !!}

    @endsection