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
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <img src="../img/logo.png" id="icon" alt="User Icon" />
            </div>

            <!-- Login Form -->
            <form id="login-form">
                @csrf

                <div class="alert alert-danger" style="display:none;">Invalid credentials.</div>

                <input type="text" id="login" name="username" class="fadeIn second" placeholder="Username" required>
                <input type="password" id="password" name="password" class="fadeIn third" placeholder="Password"
                    required>
                <input type="submit" class="fadeIn fourth" value="Login">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>
    <footer></footer>
    <script type="text/javascript" src="js/bootstrap5.js"></script>

    <script src="js/jquery-3.5.0.min.js"></script>

    <script>
        $(function() {

            $('#login-form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "/login-user",
                    processData: false,
                    data: $('#login-form').serialize(),
                    beforeSend: function() {
                        $('.alert-danger').css("display", "none");
                    },
                    success: function(data) {
                        if (data.status) {
                            window.location.href = "/location";
                        } else {
                            $('.alert-danger').css("display", "block");
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
