<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-left: 38vw; margin-top: 25vh">
   <div class="row" style="margin-top:45px">
      <div class="col-md-4 col-md-offset-4">
           <h4>Logi Sisse</h4><hr>
           <form action="{{ route('auth.checking') }}" method="post"> 
            @csrf <!-- Ei tohi kindlasti unustada, muidu ei toimi !!!-->
           
            @if(Session::get('fail')) <!-- kuvame teavitus sonumid-->
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
            @endif
            @if(Session::get('success')) <!-- kuvame teavitus sonumid välja logimise jaoks-->
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>

            @endif
              <div class="form-group">
                 <label><strong>Email</strong></label>
                 <input type="text" class="form-control" name="email" placeholder="Sisestage Email" value="{{ old('email') }}">
                 <span class="text-danger">@error('email'){{ $message }} @enderror</span>
              </div>
              <div class="form-group">
                 <label><strong>Parool</strong></label>
                 <input type="password" class="form-control" name="password" placeholder="Sisestage parool">
                 <span class="text-danger">@error('password'){{ $message }} @enderror</span>
              </div>
              <button type="submit" class="btn btn-block btn-primary">Sisene</button>
              <br>
              <a href="{{ route('auth.register') }}">Registreeri</a>
           </form>
      </div>
   </div>
</div>
    
</body>
</html>