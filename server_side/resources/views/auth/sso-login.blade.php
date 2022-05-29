
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('loginForm') }}/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('loginForm') }}/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('loginForm') }}/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('loginForm') }}/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('loginForm') }}/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('loginForm') }}/css/main.css">
<!--===============================================================================================-->
    <style>
        .error
        {
            color:#FF0000;
        }
    </style>
</head>
<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url({{ asset('loginForm') }}/images/bg-01.jpg);">
			<div class="wrap-login100 p-l-70 p-r-70 p-t-30 p-b-30">
				<div class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-30">
						SSO Login
                    </span>

                    <div class="login100-form-main">
                        <form action="{{ route('sso.login') }}" method="POST">
                            @csrf
                            <div class="p-t-20 p-b-9">
                                <span class="txt1">
                                    Email
                                </span>
                            </div>

                            <input class="form-control input100" type="text" name="email" placeholder="enter your email">

                            <div class="p-t-13 p-b-9">
                                <span class="txt1">
                                    Password
                                </span>
                            </div>

                            <input class="input100 form-control" type="password" name="password" placeholder="enter your password">

                            <div class="container-login100-form-btn m-t-17">
                                <button class="login100-form-btn" type="submit">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ asset('loginForm') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
	<script src="{{ asset('loginForm') }}/vendor/animsition/js/animsition.min.js"></script>
	<script src="{{ asset('loginForm') }}/vendor/bootstrap/js/popper.js"></script>
	<script src="{{ asset('loginForm') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{ asset('loginForm') }}/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('fail'))
        <script>
            swal("Sorry!!","{!! Session::get('fail') !!}","error",{
                button:"okk",
            })
        </script>
    @endif

</body>
</html>
