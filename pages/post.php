<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Post (Display Single Post)</title>
    <?php
    require_once('dataAccessFunctions.php'); 
    
    ?>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

    <!-- Nav Bar -->

    <?php require_once("header.php"); ?>

    <!-- End Nav -->

    <?php 

    $postID = 3; //Default Value here
    $postID = $_GET["id"];
    

    $result=GetPostsByID($postID); 
    $uid = $result['UID'];

    ?>
    <div class="container">
        <div class="jumbotron">
        <h2 style="font-size: 37px; margin-bottom: 15px;"><?php echo $result['Title'];?></h2>
        <p style="font-size: 17px"><strong>Post ID:</strong> <?php echo $result['PostID'];?>  <?php echo "<a href=\"user.php?UID=$result[UID]\" style=\"text-decoration: none; \"><strong>User ID:</strong> $result[UID]</a></p>"; ?>
        <p style="font-size: 17px"><strong>Posted at: </strong> <?php echo $result['PostTime']; ?></p>
        <h4><strong>Message:</strong></h4> <p><?php echo $result['Message'];?></p>


    <hr>

    <?php    
    $images=GetImagesForPost($postID); 
    foreach($images as $result){
        ?>
        <div class="row">
            <div col style="float: left; width: 33.33%; padding: 5px;">
        <h4>Image ID: <?php echo $result['ImageID'];?></h4>
       <!-- <h4>USER ID: <?php //echo $result['UID'];?></h4> -->
        <a href="travelimage.php?id=<?php echo $result['ImageID'];?>">
        <img src="travel-images/medium/<?php echo $result['Path'];?>" width="200px" height="150px" alt="Post Image"></a>
            </div>
        </div>
        <?php
    }
    ?>


            <form method="post" action="viewFavorites.php">
            <button class="btn btn-primary" type="submit" name="PostFav" value="<?php echo $postID;?>" style="margin-right: 20px;"><span class="glyphicon glyphicon-heart" style="margin-right: 3px"></span>Favorite Post</button>
            </form>
        </div>


    </div>
    <hr>
    
    <div class="container">
        <div class="row">
            <h3 class="bg-custom" style="margin-bottom: 35px;">More from this User</h3>
            <?php 

                $posts =GetPostsByUserID($uid);
                foreach($posts as $result){
                    
                    $pID = $result['PostID'];
                    $title = $result['Title'];
                    if ($pID != $postID){
            ?>
            <div class="col-md-8">
                <?php echo "<a href=\"post.php?id=$pID\"><h4 style=\"display: inline; margin-right: 30px;\">" . $title; ?></a></h4>
            </div>
            <?php } } ?>
        </div>
    </div>
</div>
<br>
    



    <?php require_once("footer.php"); ?>

</body>
</html> 