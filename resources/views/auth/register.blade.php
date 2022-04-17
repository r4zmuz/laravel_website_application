<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreeri</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-left: 38vw; margin-top: 25vh">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>Registreeri</h4><hr>
           <form action="{{ route('auth.save') }}" method="post">
           @csrf
            @if(Session::get('success'))  <!-- kuvame teavitus sonumid-->
            <div class="alert alert-success">
                {{Session::get('success')}} 
            </div>

            @endif
            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>

            @endif

            <div class="form-group">
                    <label><strong>Nimi</strong></label>
                    <input type="text" class="form-control" name="name" placeholder="Sisestage Nimi" value="{{ old('name') }}"><!-- {{ old('name') }} jatab meelde viimati sisestatud andmed-->
                    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
                </div>
    
              <div class="form-group">
                 <label><strong>Email</strong></label>
                 <input type="text" class="form-control" name="email" placeholder="Sisestage Email" value="{{ old('email') }}"> <!-- {{ old('email') }} mitte kasutada paroolis kuna pole turvaline-->
                 <span class="text-danger">@error('email'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label><strong>Parool</strong></label>
                 <input type="password" class="form-control" name="password" placeholder="Sisestage parool">
                 <span class="text-danger">@error('password'){{ $message }} @enderror</span>
              </div>
              <button type="submit" class="btn btn-block btn-primary">Registreeri</button>
              <br>
              <a href="{{ route('auth.login')}}">Juba konto olemas? Sisene</a>
           </form>
      </div>
   </div>
</div>
    
</body>
</html>