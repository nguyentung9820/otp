<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login with us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('home/img/logo/logo.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>
<div class="limiter">
    <div class="container-login100" id="bodyLogin">
        <div id="formLogin">
            <form method="POST" action="{{route('register')}}">
                {{ csrf_field() }}
                <h1 style="color:black" class="login100-form-title">
                    Join with us
                </h1>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" value="{{old('username')}}" name="username" placeholder="Email" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>
                @error('username')<span style="color:red; padding: 0 0 15px 15px">{{ $message }}</span>@enderror


                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                @error('password')<span style="color:red;padding: 0 0 15px 15px">{{ $message }}</span>@enderror
                <div class="container-login100-form-btn">
                    <button type="submit" style="background: #103D8F" class="login100-form-btn btn-primary">Register</button>
                </div>
                <div style="text-align: center; padding: 20px 0 0 0">
                    <a href="/">Sign in now</a>
                </div>
            </form>
            @if(session('notification'))
                <div style="color: red;text-align: center;">
                    {{session('notification')}}
                </div>
            @endif

        </div>
    </div>
</div>

<style>
    #formLogin
    {
        width:500px;
        background: white;
        border-radius: 20px;
        height:380px;
        padding: 25px 45px 25px 45px;
        margin: 50px 0 0 0;
    }
</style>

<!--===============================================================================================-->
<script src="{{asset('login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('login/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('login/vendor/tilt/tilt.jquery.min.js')}}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{asset('login/js/main.js')}}"></script>
</body>

</html>
