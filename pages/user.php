<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Profile Information</title>
    <?php
    require_once('dataAccessFunctions.php'); 
    ?>
    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">

    <?php 
    
    //Grab Data

    $id = $_GET["UID"];
    $result=GetUsersByID($id); 



    ?>
</head>
<body>

    <!-- NavBar -->

    <?php require_once("header.php"); ?>

    <!-- End Nav -->


    <div class="jumbotron text-center">
        <h2>Name: <?php echo $result['FirstName'];?> <?php echo $result['LastName'];?></h2>
        <h4>USER ID: <?php echo $result['UID'];?></h4>

        <?php if ($result['Privacy'] == 2) { ?>
            <p>Address: Private
        <?php } else {?>
            <p>Address: <?php echo $result['Address'];?></p>
        <?php }?>

        <p>City: <?php echo $result['City'];?></p>
        <p>Region: <?php echo $result['Region'];?></p>
        <p>Country: <?php echo $result['Country'];?></p>

        <?php if ($result['Privacy'] == 2) { ?>
            <p>Postal: Private
        <?php } else {?>
            <p>Postal: <?php echo $result['Postal'];?></p>
        <?php }?>

        <p>Email: <?php echo $result['Email'];?></p>

        <?php if ($result['Privacy'] == 2) { ?>
            <p>Phone: Private
        <?php } else {?>
            <p>Phone: <?php echo $result['Phone'];?></p>
        <?php }?>
    </div> <!-- End Jumbo -->

    <hr>

    <div class="jumbotron text-center">
        <h2 style="margin-bottom: 15px;">Posts</h2>
    <?php 
    $posts=GetPostsByUserID($id); 
    foreach($posts as $result)
    {
        if (isset($result['PostID']))
        {
        $postID = $result['PostID'];
        $title = $result['Title'];?>


            <?php echo "<a href=\"post.php?id=$postID\"><h4 style=\"display: inline; text-align: center;\">" . $title . "<br>";?></a>

    <?php
    
        }
    }
    ?>

    </div>
    <!-- Footer -->

    <?php require_once("footer.php"); ?>

    <!-- End Footer -->
   
</body>
</html> 