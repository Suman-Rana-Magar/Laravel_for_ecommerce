<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('images/llooggoo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Change Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #63cee0;
        }

        .eye-icon {
            margin-top: 5px;
            padding-left: 5px;
            cursor: pointer;
        }

        .main {

            text-align: center;
        }

        .profile-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
        }

        .user-details {
            font-size: 18px;
        }

        .user-name {
            font-weight: bold;
            margin-top: 0;
        }

        .user-email {
            color: #007bff;
        }

        #input-field {
            width: 95%;
            margin: auto;
        }

        .submit {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div style="width: 50%; border-style: groove; margin: 20px 25%; border-radius: 25px; background-color: #f0f0f0;">
        <form method="post" action="{{route('users.updatePassword',Auth::user()->id)}}" enctype="multipart/form-data">
            @csrf
            <div style="margin-top: 10px;" class="mb-3" id="input-field">
                <label for="password1" class="form-label">Old Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="password1" name="oldPassword" value="{{ old('oldPassword') }}">
                    <i class="bi bi-eye-slash eye-icon" id="eye1"></i>
                    @error('oldPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3" id="input-field">
                <label for="password2" class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="password2" name="newPassword" value="{{ old('newPassword') }}">
                    <i class="bi bi-eye-slash eye-icon" id="eye2"></i>
                    @error('newPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3" id="input-field">
                <label for="password3" class="form-label">Re-Type New Password</label>
                <div class="input-group">
                    <input type="password" class="form-control @error('newPassword_confirmation') is-invalid @enderror" id="password3" name="newPassword_confirmation" value="{{ old('newPassword_confirmation') }}">
                    <i class="bi bi-eye-slash eye-icon" id="eye3"></i>
                    @error('reNewPassword')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="submit">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
        <div class="submit">
            <a href="{{ route('users.cancel') }}"><button class="btn btn-secondary">Cancel</button></a>
        </div>
    </div>
    <script src="{{asset('js/login-pass.js')}}"></script>
    <script src="{{asset('js/reg-pass.js')}}"></script>
    <script src="{{asset('js/reg-con-pass.js')}}"></script>
</body>

</html>