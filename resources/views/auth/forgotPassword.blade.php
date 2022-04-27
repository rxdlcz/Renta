<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap5.min.css">
    <link rel="stylesheet" href="css/login.css">

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
            <h3 class="fadeIn first">Forgot Password</h3>
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @error('email')
                <div class="alert alert-info" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <form action="/sendforgotPassword" method="post" id="reset-form">
                @csrf
                <input type="email" name="email" class="fadeIn second" placeholder="Email" required>
                <input type="submit" class="fadeIn fourth" value="Send reset password email">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="/login">Sign in</a>
            </div>

        </div>
    </div>
    <footer></footer>
    <script type="text/javascript" src="js/bootstrap5.js"></script>

    <script src="js/jquery-3.5.0.min.js"></script>
</body>

</html>
