<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">

    <title>Renta CMS</title>
</head>
<header>

</header>

<body>

    <div class="wrapper fadeInDown">
        <div id="formContent">

            <div class="fadeIn first">
                <img src="../img/logo.png" id="icon" alt="User Icon" />
            </div>
            <h3 class="fadeIn first" >Reset Password</h3>

            @if (Session::has('fail'))
                <div class="alert alert-success">{{ Session::get('fail') }}</div>
            @endif

            @error('password')
                <div class="alert alert-info" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <form action="/resetPass" method="post" id="reset-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="password" name="password" class="fadeIn second" placeholder="Password" >
                <input type="password" name="confirm_password" class="fadeIn third" placeholder="Confirm Password">
                <input type="submit" class="fadeIn fourth" value="reset password">
            </form>

        </div>
    </div>
    <footer></footer>
    <script type="text/javascript" src=""></script>

    <script src="{{asset('js/jquery-3.5.0.min.js')}}"></script>

</body>

</html>
