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
    ?>

</head>
<body>

    <!-- NavBar -->

    <?php require_once("header.php"); ?>

    <!-- End Nav -->


<?php
//Reference: https://thisinterestsme.com/store-array-session-php/
if (isset($_POST['clearFavorites']))
{
session_unset();
}
if (isset($_POST['clearFavoriteImage']))
{
$id = $_POST['clearFavoriteImage'];

unset($_SESSION['images'][$id]);
}
if (isset($_POST['clearFavoritePost']))
{
$id = $_POST['clearFavoritePost'];
unset($_SESSION['posts'][$id]);
    
}
if (isset($_POST['PostFav']))
{
$_SESSION ['posts'][] = $_POST['PostFav'];
$_SESSION['numPosts']++;

}
if (isset($_POST['ImageFav']))
{
$_SESSION ['images'][] = $_POST['ImageFav'];
$_SESSION['numImages']++;
}
?>
<div class="container">
<div class="jumbotron">
<h2 class="text-center">Favorite Images</h2>
    <div class="row">

<?php

if(isset($_SESSION['images'])){
    foreach($_SESSION['images'] as $i => $id){
        //Print out the product ID.
        $images=GetImagesForID($id); 
        foreach($images as $result){
                ?>
                <div col style="float: left; width: 23.33%; padding: 5px;">
                <h4><?php echo $result['Title']?></h4>
                 <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"><img src="travel-images/square-medium/<?php echo $result['Path'];?>"></a>
                 <form method="post" action="viewFavorites.php">
                    <button class="btn btn-primary" type="submit" name="clearFavoriteImage" value="<?php echo $i;?>" style="margin-right: 20px; margin-top: 15px;">Remove</button>
                    </div>
                </form>
                <?php
        }
        

     
    }

    
}
?>
</div>
</div>
</div>
<hr>
<div class="container">
<div class="jumbotron">
<h2 class="text-center">Favorite Posts</h2>
    <div class="row text-center">
<?php
    
if(isset($_SESSION['posts'])){

    foreach($_SESSION['posts'] as $i => $id){
        //Print out the product ID.
        $result=GetPostsByID($id); 
        ?>
            <div col style="float: left; width: 23.33%; padding: 5px; margin-top: 15px;">
            <a href="post.php?id=<?php echo $result['PostID'];?>"> <h4><?php echo $result['Title']?></h4></a>
            <hr>

            <form method="post" action="viewFavorites.php">
                    <button class="btn btn-primary" type="submit" name="clearFavoritePost" value="<?php echo $i;?>">Remove</button>
            </div>
            </form>
        <?php
        
  
        
     
    }

    
}



/*
for ($i=0; $i<$_SESSION["numImages"]; $i++)
{  
    $images=GetImagesForID($_SESSION['images'][$i]); 
    foreach($images as $result){
    ?>
    <h2><a href="travelImage.php?id=<?php echo $result['ImageID'];?>">Image Link</a></h2>
    <img src="travel-images/small/<?php echo $result['Path'];?>">
    <?php
}
?>
<hr>


<?php 
}
?>
<h1>Favorite Posts</h1>
<hr>
<?php

for ($i=100; $i<$_SESSION["numPosts"]+100; $i++)
{  
    $result=GetPostsByID($_SESSION[$i]); ?>
    <a href="post.php?id=<?php echo $result['PostID']; ?>"><h1><?php echo $result['Title'];?></h1></a>

<?php */



?>
</div>
</div>
</div>

<form method="post" action="viewFavorites.php">
<center><button class="btn btn-primary" type="submit" name="clearFavorites" value="3" style="margin-right: 20px;">Clear All Favorites</button></center>
<br>
</form>


    <!-- Footer -->

    <?php require_once("footer.php"); ?>

    <!-- End Footer -->
   
</body>
</html> 