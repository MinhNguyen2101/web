<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    

    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="screen">

            <div class="screen__content">

                @if (Session::has('msg'))
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        <p class="alert alert-danger">{{ Session::get('msg') }}</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}" class="login">
                    @csrf

                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="User name / Email" name="email"
                            value="{{ old('email') }}">
                        <div class="col-md-6">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size:13px; color:red ">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" placeholder="Password" name="password">
                        <div class="col-md-6">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size:13px; color:red ">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button class="button login__submit">
                        <span class="button__text">Log In Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div class="social-login">
                    <h5> <a href="{{ route('register') }}" style="text-decoration: none;color:white"> Register Now </a>
                    </h5>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
