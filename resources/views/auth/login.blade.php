<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap5.css">
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
    <form action="{{route('login-user')}}" method="post">
      @csrf

      @if(Session::has('success'))
      <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('fail'))
      <div class="alert alert-danger">{{Session::get('fail')}}</div>
      @endif

      <input type="text" id="login" name="username" class="fadeIn second" placeholder="Username" required>
      <input type="password" id="password" name="password" class="fadeIn third" placeholder="Password" required>
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
</body>

</html>
