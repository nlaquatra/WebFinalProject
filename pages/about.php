<!DOCTYPE html>
<html  lang="en">
<head>

    <title>About Us</title>

    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <!-- Nav Bar -->

    <?php require_once("header.php"); ?>
    
    <!-- End -->

    <div class="container">
        <div class="jumbotron">
        <h1>Final Project</h1>
        <p class="lead">This Travel Image Website was created by Donovan Byler & Nicolas LaQuatra for the Web Programming II Final Project</p>
        <p class="lead">Additional documentation available here: <a href="https://github.com/Dbyler8/Web-Programming-Final">Github</a></p>
        <p>This project is for CS 44106 - WP2 at Kent State University taught by Dr. A. Guercio.</p>
        <p class="lead">Date: <?php echo date("l F jS \of Y"); ?></p>
        </div>
    </div>
    <hr>
    <div class="container text-center">
        <div class="jumbotron">
        <h1 style="margin-bottom: 20px;">Project Breakdown</h1>
        <div class="row">
    <div class="col-6 col-md-4">
        <h2><span class="glyphicon glyphicon-user" style="margin-right: 5px;"></span>Donovan Byler</h2>
        <ul style="list-style-type: none;">
            <li>Data Access Layer</li>
            <li>Data Display Functions</li>
            <li>Project Organization</li>
            <li>Basic Page Templates</li>
            <li>Google Map Embed</li>
            <li>Flag Images</li>
            <li>Search and Favorites Scripting</li>
            <li>Image Review System</li>
            <li>Edit User System (For Admins)</li>
        </ul>
    </div>
    <div class="col-6 col-md-4">
        <h3><span class="glyphicon glyphicon-wrench" style="margin-right: 5px;"></span>Tools/Resources</h3>
            <ul style="list-style-type: none; margin-right: 45px;">
                <li>Visual Studio Code</li>
                <li>XAMPP</li>
                <li>BootStrap/W3Schools</li>
            </ul>
    </div>
    <div class="col-6 col-md-4">
        <h2><span class="glyphicon glyphicon-user" style="margin-right: 5px;"></span>Nic LaQuatra</h2>
            <ul style="list-style-type: none; margin-right: 45px;">
                <li>Styling of Pages</li>
                <li>HTML Structure</li>
                <li>Image Filter on Homepage</li>
                <li>Login Form</li>
                <li>Login/Logout System</li>
                <li>Registration Form</li>
                <li>Registration functions</li>

            </ul>
    </div>
  </div>
        </div>
    </div>
    <br>
    <br>


    <!-- Footer -->

    <?php require_once("footer.php"); ?>

    <!-- End -->
</body>
</html>