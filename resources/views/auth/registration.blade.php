<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap5.css">
    <link rel="stylesheet" href="css/login.css">

    <title>REGISTER</title>
</head>
<header>

</header>

<body>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="../img/logo.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form action="{{ route('register-user') }}" method="post">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-success">{{ Session::get('fail') }}</div>
                @endif
                @csrf
                @error('email')
                    <div class="alert alert-info" role="alert">
                        Email is already taken
                    </div>
                @enderror
                @error('username')
                    <div class="alert alert-info" role="alert">
                        Username is already taken
                    </div>
                @enderror
                <input type="text" id="login" name="firstname" class="fadeIn second" placeholder="Firstname"
                    value="{{ old('firstname') }}" required>
                <input type="text" name="lastname" class="fadeIn second" placeholder="Lastname"
                    value="{{ old('lastname') }}" required>
                <input type="email" name="email" class="fadeIn second" placeholder="Email" value="{{ old('email') }}"
                    required>
                <input type="text" name="username" class="fadeIn second" placeholder="Username"
                    value="{{ old('username') }}" required>
                <input type="password" id="password" name="password" class="fadeIn third" placeholder="Password"
                    minlength="8" required>

                <input type="submit" class="fadeIn fourth" value="Register">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="login">Sign-in</a>
            </div>

        </div>
    </div>
    <footer></footer>
    <script type="text/javascript" src="js/bootstrap5.js"></script>
</body>

</html>
