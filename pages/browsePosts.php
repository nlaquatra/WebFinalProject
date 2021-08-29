<!DOCTYPE html>
<html lang="en">
<head>

    <title>Browse Users</title>
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
    <!-- Navbar -->

    <?php require_once("header.php"); ?>

    <!-- End Nav -->

    <div class="container">
        <div class="row">
    <?php $posts=GetPostsAll(); 
    foreach($posts as $result){
        $id = $result['PostID'];
        $uID = $result['UID'];
        ?>
        <h1> <a href="post.php?id=<?php echo $id;?>" style="text-decoration: none;"><?php echo $result['Title'];?></h1>

        <?php echo "<a href=\"user.php?UID=$uID\" style=\"text-decoration: none; \"><p style=\"font-size: 16px;\">User ID: $result[UID]</a></p>"; ?>
        <p style="font-size: 16px;">Message:</p> <p><?php echo $result['Message'];?></p>
        <hr>
        <?php
    }
    ?>
        </div>
    </div>
<!-- Footer -->
<?php require_once("footer.php"); ?>
<!-- End Footer -->

</body>
</html> 