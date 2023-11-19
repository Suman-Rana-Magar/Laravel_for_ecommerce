<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <title>Customer Register</title>
    <style>
        body {
            /* background-color: #63cee0; */
            background-image: url("{{ asset('images/blue_background.jpg') }}");
        }

        .pagetitle {
            text-align: center;
        }

        .supermain {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main {
            border-style: groove;
            border-color: dimgrey;
            border-radius: 20px;
            width: 50%;
            background-color: ghostwhite;
        }

        .submit {
            text-align: center;
        }

        #input-field {
            margin: auto;
            width: 90%;
        }
    </style>

</head>

<body>
    @if (session('success'))
    <div class="alert alert-success" style="width: 45%; text-align: center; margin: auto;">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger" style="width: 45%; text-align: center; margin: auto;">
        {{ session('error') }}
    </div>
    @endif
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">User Registration</h2>

                                <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                        <input type="text" id="form3Example1cg" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Your Email</label>
                                        <input type="email" id="form3Example3cg" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label for="image" class="form-label">Profile Picture</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" />
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                        <input type="password" id="form3Example4cdg" class="form-control form-control-lg" name="password_confirmation" value="{{old('password_confirmation')}}" />
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-info btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!" class="fw-bold text-body"><a href="{{route('users.index')}}"><u>Login here</u></a></a></p>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>