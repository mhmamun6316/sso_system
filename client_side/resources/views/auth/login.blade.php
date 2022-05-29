<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">

                  <h3 class="mb-4">Sign in</h3>
                  @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                  @endif
                  <div class="mb-4">
                    <form action="{{ route('sso.login') }}" method="POST">
                    @csrf
                        <button class="btn btn-success btn-lg" onclick="event.preventDefault();
                        this.closest('form').submit();"> SSO Login</button>
                    </form>
                  </div>

                  <form id="local_form" action="{{ route('login') }}"  method="POST">
                    @csrf
                      <div class="form-outline mb-4">
                        <input type="email" name="local_email" class="form-control form-control-lg" />
                        <label class="form-label" for="typeEmailX-2">Email</label>
                      </div>

                      <div class="form-outline mb-4">
                        <input type="password" name="local_password" class="form-control form-control-lg" />
                        <label class="form-label" for="typePasswordX-2">Password(Local)</label>
                      </div>

                      <button type="submit" class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                  </form>

                  <hr class="my-4">
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>

        $(document).ready(function() {
            // $('#sso_login').click(function(){
            //     //alert("hello");
            //     window.open(`http://127.0.0.1:8080/loginfromoutside`, '_blank', `location=yes,height=570,width=520,scrollbars=yes,status=yes,`)
            // });

            $('#local_login').click(function(){
                $('#sso_form').addClass('d-none');
                $('#local_form').removeClass('d-none');
            });

            // $('#sso_login').submit(function() {
            //     $.ajax({
            //         type: "POST",
            //         url: 'http://127.0.0.1:81/api/login',
            //         data: {
            //             email: $("#email").val(),
            //             password: $("#password").val()
            //         },
            //         success: function(data)
            //         {
            //             if (typeof data.user === 'object' && data.user !== null) {
            //                 window.location.replace('http://127.0.0.1:81/dashboard');
            //             }
            //             else {
            //                 alert("please provide a valid email and password");
            //             }
            //         }
            //     });
            //     //this is mandatory other wise your from will be submitted.
            //     return false;
            // });
        });
    </script>
</body>
</html>


