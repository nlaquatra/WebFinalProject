<!DOCTYPE html>
<html  lang="en">
<head>
    <?php
    require_once('dataAccessFunctions.php'); 
    ?>
    <title>Browse Images</title>

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

<div style="float:right; margin-right: 100px;">
    <h3>Filter By Country</h3>
    <ul>
       <?php $countries = GetCountriesWithImages(); 
       foreach($countries as $result) { ?> 
            <li> <a href="browseImages.php?country=<?php echo $result['ISO'];?>" > <?php echo $result['CountryName'];?></li></a>
        <?php } ?>  
    </ul>


    <h3>Filter By City</h3>
    <ul>
       <?php $cities = GetCitiesWithImages(); 
       foreach($cities as $result) { ?> 
            <li> <a href="browseImages.php?city=<?php echo $result['GeoNameID'];?>" > <?php echo $result['AsciiName'];?></a></li>
        <?php } ?>  
    </ul>

</div>

<div class="container">
    <div class="row">

    <?php
$search=""; 
if (!isset($_GET['city']) && !isset($_GET['country']))
{
    $images=GetImagesAllWithTitle();; 
    foreach($images as $result){
        ?>
        <div col style="float: left; width: 33.33%; padding: 5px;">
        <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <h4> <?php echo $result['Title'];?></h4> </a>
    
        <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <img src="travel-images/small/<?php echo $result['Path'];?>" class="img-responsive"> </a>
        </div>
        <?php
        
    }
}

else if (isset($_GET['city']))
{
    $images=SearchImagesByNameAndCity($search, $_GET['city']); 
    foreach($images as $result){
        ?>
        <div col style="float: left; width: 33.33%; height: 33.33%; padding: 5px; margin-left: 15px;">
        <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <h4> <?php echo $result['Title'];?></h4> </a>
    
        <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <img src="travel-images/small/<?php echo $result['Path'];?>"> </a>
        </div>
        <?php
    }
    
}

else if (isset($_GET['country']))
{
    $images=SearchImagesByNameAndCountry($search, $_GET['country']); 
    foreach($images as $result){
        ?>
        <div col style="float: left; width: 33.33%; height: 33.33%; padding: 5px; margin-left: 15px;">
        <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <h4> <?php echo $result['Title'];?></h4> </a>
    
        <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <img src="travel-images/small/<?php echo $result['Path'];?>"> </a>
        </div>
        <?php
    }
    
}
    
?>
</div>
</div>

    <!-- Footer -->

    <?php require_once("footer.php"); ?>

    <!-- End Footer -->

</body>
</html> 