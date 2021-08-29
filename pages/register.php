<?php

    include_once("dataAccessFunctions.php");
    include_once("config.php");

    if (isset($_POST['submit'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $pwd = $_POST['pwd'];
        $pwd_confirm = $_POST['pwd2'];

        if(emptyInputRegister($firstName, $lastName, $email, $pwd, $pwd_confirm)) {
            header("location: register.php?error=emptyInput");
        }
        else if (!checkPwdRegister($pwd, $pwd_confirm)) {
            header("location: register.php?error=pwdMatch");
        }
        else {
        
        registerUser($firstName, $lastName, $email, $address, $country, $city, $pwd); //register user function

        }


    }
?>

<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Register</title>

    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Nav Bar -->

    <?php require_once("header.php"); ?>
    
    <!-- End -->

    <?php

        if (isset($_GET['error'])) {
            if ($_GET["error"] === "emptyInput") {
                echo "<div class = \"alert alert-danger alert-dismissible col-md-offset-3\" role=\"alert\" style=\"max-width: 50%; \">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><center><strong>Error:</strong> All fields required to register!</center></div></div>";
            }
            else if ($_GET["error"] === "pwdMatch") {
                echo "<div class = \"alert alert-danger alert-dismissible col-md-offset-3\" role=\"alert\" style=\"max-width: 50%; \">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><center><strong>Error:</strong> Passwords do not match!</center></div></div>";
              }
        }

    ?>

<div class="container">
    <div class="row">
    <h2 class="text-center">Register Account</h2>
    <form action="register.php" method="POST" class="text-center">
        <div class="col-md-6 form-group">
            <label for="firstName">First Name:</label>
            <input type="text" class="form-control" id="inputFirst" name="firstName" placeholder="First Name">
        </div>
        <div class="col-md-6 form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" class="form-control" id="inputLast" name="lastName" placeholder="Last Name">
        </div>
        <div class="col-md-6 form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
        </div>
        <div class="col-md-6 form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
        </div>
        <div class="col-md-6 form-group">
            <label for="lastName">Country:</label>
            <select name="country" class="form-control">
			          <option value=null selected>Choose...</option>
                <?php
                    $countries = GetCountriesAll();
                    foreach ($countries as $result) { ?>
                        <option value='<?php echo $result["CountryName"]; ?>'><?php echo $result['CountryName']; ?></option>;
                        <?php } ?>
			</select>
        </div>
        <div class="col-md-6 form-group">
            <label for="lastName">City:</label>
            <select name="city" class="form-control">
			          <option value=null selected>Choose...</option>
                <?php
                    $cities = GetCitiesAll();
                    foreach ($cities as $result) { ?>
                        <option value='<?php echo $result["AsciiName"]; ?>'><?php echo $result['AsciiName']; ?></option>;
                        <?php } ?>
			</select>
        </div>
        <div class="col-md-6 form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="inputPwd" name="pwd" placeholder="Password">
        </div>
        <div class="col-md-6 form-group">
            <label for="pwd2">Confirm Password:</label>
            <input type="password" class="form-control" id="inputPwd2" name="pwd2" placeholder="Confirm Password">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Register">
    </form>
    </div>
</div>


<div style="margin-top: 105px;">
<?php include_once("footer.php"); ?>

</div>
</body>
</html>