<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Home Page</title>
    <?php
    require_once('dataAccessFunctions.php'); 
    ?>
    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<!-- NavBar -->

<?php require_once("header.php"); ?>

<!-- End Nav -->

<div class="container">
<?php $users = GetUsersAll();
    foreach($users as $result){ 
?>
        <div class="row text-center">
            <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><?php echo $result['FirstName'];?> <?php echo $result['LastName'];?></div>
            <div class="panel-body">
                <?php echo "<a href=\"user.php?UID=$result[UID]\" style=\"text-decoration: none; \"><p>USER ID: $result[UID]</a></p>"; ?>
            </div>
            </div>
        </div>
            <?php
                }
            ?>
</div>

<!-- Footer -->

<?php require_once("footer.php"); ?>

<!-- End footer -->

</body>
</html> 