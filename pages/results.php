<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Search</title>
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


<?php require_once("header.php"); ?>

<!-- USE FOR SEARCHING POST TITLES -->

<div class="container">
<div class="jumbotron">

<?php 
//$search = "Ed";

if (isset($_GET['imageSearch']))
{
    $search = $_GET['imageSearch'];
    if (!isset($_GET['country']) && !isset($_GET['city'])){
        $images = SearchImages($search);
        foreach($images as $result){ 
            ?>
            <div class="row">
            <h2><?php echo $result['Title']?></h2>
   
            <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"><img src="travel-images/thumb/<?php echo $result['Path'];?>"></a>
            <form method="post" action="viewFavorites.php">
            <button class="btn btn-primary" type="submit" name="ImageFav" value="<?php echo $result['ImageID'];?>" style="margin-top: 15px;"><span class="glyphicon glyphicon-heart" style="margin-right: 3px"></span>Favorite Image</button>
            </form>
            </div>
            <?php
        }

    }
    else if (isset($_GET['country']) && !isset($_GET['city'])){
        $images=SearchImagesByNameAndCountry($search, $_GET['country']); 
        foreach($images as $result){
            ?>
                <div class="row">
                <h2><?php echo $result['Title']?>
              
                <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"><img src="travel-images/thumb/<?php echo $result['Path'];?>"></a>
                <form method="post" action="viewFavorites.php">
                <button class="btn btn-primary" type="submit" name="ImageFav" value="<?php echo $result['ImageID'];?>" style="margin-top: 15px;"><span class="glyphicon glyphicon-heart" style="margin-right: 3px"></span>Favorite Image</button>
                </form>
                </div>
            <?php
        }
        
    }
    else if (isset($_GET['city']) && !isset($_GET['country'])){
        $images=SearchImagesByNameAndCity($search, $_GET['city']); 
            foreach($images as $result){
                ?>
                <div class="row">
                <h2><?php echo $result['Title']?></h2>
                
                <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"><img src="travel-images/thumb/<?php echo $result['Path'];?>"></a>
                <form method="post" action="viewFavorites.php">
                <button class="btn btn-primary" type="submit" name="ImageFav" value="<?php echo $result['ImageID'];?>" style="margin-top: 15px;"><span class="glyphicon glyphicon-heart" style="margin-right: 3px"></span>Favorite Image</button>
                </form>
                </div>
                <?php
            }
    }

    else if (isset($_GET['city']) && isset($_GET['country'])){
        $images=SearchImagesByNameCountryAndCity($search, $_GET['city'], $_GET['country']); 
            foreach($images as $result){
                ?>
                <div class="row">
                <h2><?php echo $result['Title']?></h2>
               
                <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"><img src="travel-images/thumb/<?php echo $result['Path'];?>"></a>
                <form method="post" action="viewFavorites.php">
                <button class="btn btn-primary" type="submit" name="ImageFav" value="<?php echo $result['ImageID'];?>" style="margin-top: 15px;"><span class="glyphicon glyphicon-heart" style="margin-right: 3px"></span>Favorite Image</button>
                </form>
                </div>
                <?php
            }
        }

}
else if (isset($_GET['postSearch'])){
    $images = SearchPosts($_GET['postSearch']);
    foreach($images as $result){ 
        ?>
        <div class="row">
        <h1><a href="post.php?id=<?php echo $result['PostID']?>"><?php echo $result['Title']?></a></h1>
        <form method="post" action="viewFavorites.php">
            <button class="btn btn-primary" type="submit" name="PostFav" value="<?php echo $result['PostID'];?>" style="margin-top: 15px;"><span class="glyphicon glyphicon-heart" style="margin-right: 3px"></span>Favorite Post</button>
            </form>
        </div>
        <?php
    }
    
}
?>
</div>
</div>




<?php require_once("footer.php"); ?>


</body>
</html> 