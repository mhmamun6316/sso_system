
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
						User Identification System
					</span>

					<a href="#" class="btn-face login-btn m-b-10">
                        Login
					</a>

					<a href="#" class="btn-google register-btn m-b-10">
                        Register
					</a>

                    <div class="login100-form-main">
                        <form id="login_form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="p-t-20 p-b-9">
                                <span class="txt1">
                                    Email
                                </span>
                            </div>

                            <input class="form-control input100" type="text" name="loginEmail" placeholder="enter your email">

                            <div class="p-t-13 p-b-9">
                                <span class="txt1">
                                    Password
                                </span>
                            </div>

                            <input class="input100 form-control" type="password" name="loginPassword" placeholder="enter your password">

                            <div class="container-login100-form-btn m-t-17">
                                <button class="login100-form-btn" type="submit">
                                    Sign In
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="register100-form-main d-none">
                        <form id="registration_form" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="p-t-20 p-b-9">
                                <span class="txt1">
                                    Name
                                </span>
                            </div>

                            <input class="input100 form-control" type="text" id="name" name="name" placeholder="enter your name">

                            <div class="p-t-13 p-b-9">
                                <span class="txt1">
                                    Email
                                </span>
                            </div>

                            <input class="input100 form-control" type="text" id="email" name="email" placeholder="enter your email">

                            <div class="p-t-13 p-b-9">
                                <span class="txt1">
                                    Password
                                </span>
                            </div>

                            <input class="input100 form-control" type="password" id="password" name="password" placeholder="enter your password">

                            <div class="p-t-13 p-b-9">
                                <span class="txt1">
                                    Confirm Password
                                </span>
                            </div>

                            <input class="input100 form-control" type="password" id="confirm_password" name="confirm_password" placeholder="re-type your password">

                            <div class="container-login100-form-btn m-t-17">
                                <button class="login100-form-btn" type="submit">
                                    Sign Up
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

    <script>
        $(document).ready(function(){
            $('.register-btn').click(function(){
                $('.login100-form-main').addClass('d-none');
                $('.register100-form-main').removeClass('d-none');
            });

            $('.login-btn').click(function(){
                $('.login100-form-main').removeClass('d-none');
                $('.register100-form-main').addClass('d-none');
            });

            // login form validation
            if($("#login_form").length > 0)
            {
                $('#login_form').validate({
                    rules:{
                        loginEmail : {
                            required : true,
                            maxlength : 50,
                            email : true
                        },
                        loginPassword : {
                            required : true,
                            minlength : 8,
                            maxlength : 20
                        }
                    },
                    messages : {
                        loginEmail : {
                            required : 'Enter your email',
                            email : 'Enter valid email detail',
                            maxlength : 'Email should not be more than 50 character'
                        },
                        loginPassword : {
                            required : 'Enter your password',
                            minlength : 'Password must be minimum 8 character long',
                            maxlength : 'Password must be maximum 20 character long'
                        }
                    }
                });
            }

            // registration form validation
            if($("#registration_form").length > 0)
            {
                $('#registration_form').validate({
                    rules:{
                        name : {
                            required : true,
                            maxlength : 255
                        },
                        email : {
                            required : true,
                            maxlength : 50,
                            email : true
                        },
                        password : {
                            required : true,
                            minlength : 8,
                            maxlength : 20
                        },
                        confirm_password : {
                            equalTo: "#password"
                        }
                    },
                    messages : {
                        name : {
                            required : 'Enter your name',
                            maxlength : 'Name should not be more than 255 character'
                        },
                        email : {
                            required : 'Enter your email',
                            email : 'Enter valid email detail',
                            maxlength : 'Email should not be more than 50 character'
                        },
                        password : {
                            required : 'Enter your password',
                            minlength : 'Password must be minimum 8 character long',
                            maxlength : 'Password must be maximum 20 character long'
                        }
                    }
                });
            }

        });
    </script>

    @if (Session::has('fail'))
        <script>
            swal("Sorry!!","{!! Session::get('fail') !!}","error",{
                button:"okk",
            })
        </script>
    @endif

</body>
</html>
