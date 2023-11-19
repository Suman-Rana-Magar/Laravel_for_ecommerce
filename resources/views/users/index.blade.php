<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login | MeroDress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link type="text/css" href="{{asset('css/volt.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <style>
        body {
            background-color: #63cee0;
        }

        .eye-icon {
            margin-top: 5px;
            padding-left: 5px;
            cursor: pointer;
        }
        .pass-link:hover{
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <main>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <p class="text-center">
                    <a href="{{route('products.index')}}" class="d-flex align-items-center justify-content-center">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Back to homepage
                    </a>
                </p>
                @if (session('success'))
                <div class="alert alert-success" style="width: 50%; text-align: center; margin: auto;">
                    {{ session('success') }}
                </div>
                @elseif(session('error'))
                <div class="alert alert-danger" style="width: 50%; text-align: center; margin: auto;">
                    {{ session('error') }}
                </div>
                @endif
                <div class="row justify-content-center form-bg-image">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Login to our platform</h1>
                            </div>
                            <form action="{{route('users.check')}}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="email"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control @error ('email') is-invalid @enderror" placeholder="Email" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="password"><i class="fa-solid fa-key"></i></span>
                                    <input type="password" name="password" id="password1" value="{{old('password')}}" class="form-control @error ('email') is-invalid @enderror" placeholder="Password" required>
                                    <i class="bi bi-eye-slash eye-icon" id="eye1"></i>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <a class="pass-link" href="{{route('users.forgot_password')}}">Forgot password?</a>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800">Sign in</button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <span class="fw-normal">
                                    Not registered?
                                    <a href="{{route('users.create')}}" class="fw-bold">Create account</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{asset('js/login-pass.js')}}"></script>
</body>

</html>