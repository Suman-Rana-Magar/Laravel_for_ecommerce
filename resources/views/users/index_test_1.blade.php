<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/login-reg.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <style>
    form i {
      margin-left: -30px;
      cursor: pointer;
    }

    .invalid-feedback {
      color: red;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="title-text">
      <div class="title login">Login Form</div>
      <div class="title signup">Signup Form</div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Login</label>
        <label for="signup" class="slide signup">Signup</label>
        <div class="slider-tab"></div>
      </div>
      <div class="form-inner">

        <form action="{{route('users.check')}}" class="login" method="post">
          @csrf
          <div class="field">
            <input type="email" placeholder="Email Address" name="email" value="{{old('email')}}" class="form-control form-control-lg @error('email') is-invalid @enderror" >
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="field">
            <input type="password" id="password1" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" >
            <i class="bi bi-eye-slash" id="eye1"></i>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="pass-link"><a href="#">Forgot password?</a></div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login">
          </div>
        </form>

        <form method="post" action="{{route('users.store')}}" class="signup" enctype="multipart/form-data">
          @csrf
          <div class="field">
            <input type="text" placeholder="Your Name" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" >
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="field">
            <input type="email" placeholder="Password" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" >
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="field">
            <input type="file" placeholder="Profile Picture" class="form-control @error('image') is-invalid @enderror" id="image" name="image" >
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="field">
            <input type="password" id="password2" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" >
            <i class="bi bi-eye-slash" id="eye2"></i>
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="field">
            <input type="password" id="password3" placeholder="Confirm password" class="form-control form-control-lg" name="password_confirmation" value="{{old('password_confirmation')}}"  >
            <i class="bi bi-eye-slash" id="eye3"></i>
          </div>
          <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Signup">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="{{asset('js/login-reg.js')}}"></script>
  <script src="{{asset('js/login-pass.js')}}"></script>
  <script src="{{asset('js/reg-pass.js')}}"></script>
  <script src="{{asset('js/reg-con-pass.js')}}"></script>
</body>

</html>