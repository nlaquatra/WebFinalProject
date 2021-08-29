<?php
    require_once('dataAccessFunctions.php'); 

// Login
if (isset($_POST["submit"])) {
    $email = $_POST["username"];
    $pwd = $_POST["pwd"];
    if (emptyInputLogin($email, $pwd) !== false) {
        header("location: login.php?error=emptyInput");
        exit();
    }
    loginUser($email, $pwd);
}

?>
<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Profile Information</title>
    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style>
    body {
  padding-top: 50px;
  padding-bottom: 20px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<body>

<div class="container">
        <center>
        <img src="travel-images/ad.png" height="125px" width="400" style="" />
        </center>
        </div>
        </br>


<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
<?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] === "emptyInput") {
        echo "<div class = \"alert alert-danger alert-dismissible \" role=\"alert\"><center><strong>Error:</strong> All fields required to login!</center>
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div></div>";
      }
      else if ($_GET["error"] === "invalidLogin" || $_GET["error"] === "invalidUser") {
        echo "<div class = \"alert alert-danger alert-dismissible\" style=\"max-width: auto; \" role=\"alert\"><center><strong>Error:</strong> Incorrect Username and/or Password</center>
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div></div>";
      }
    }

    if (isset($_GET["logout"])) {
      echo "<div class = \"alert alert-success alert-dismissible\" role=\"alert\"><center><strong>Success:</strong> You have successfully logged out!</center>
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div></div>";
    }
  ?>
  </div>
</div>
<div class="container" style="background-color: #c7c6c1; max-width: 40%; border: 1px solid black; border-radius: 15px;">

      <form action="login.php"class="form-signin" method="POST">
        <h2 class="form-signin-heading text-center">Sign in</h2>
        <label for="inputUser" class="sr-only">Email address</label>
        <input type="email" id="inputUser" name="username" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="submit">Sign in</button>
        <a type="button" class="btn btn-lg btn-primary btn-block" href="index.php">Back to Home</a>
      </form>

</div> <!-- /container -->
</div>

<div style="margin-top: 105px;">
<?php include_once("footer.php"); ?>
</div>

</body>
</html>
