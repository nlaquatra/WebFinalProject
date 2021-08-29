<!DOCTYPE html>
<html  lang="en">
<head>

    <title>City</title>
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
        <div class="jumbotron">
    <?php 

    $city = $_GET["id"];
    //$city = 5913490; //REMOVE WHEN DONE TESTING!!!!


    $cities = GetCitiesByID($city);
    //AsciiName, Population, Elevation, CountryName, Latitude, Longitude
    foreach($cities as $result){
        ?>
        <h2>City Name: <?php echo $result['AsciiName'];?></h2>
        <?php $cityName=$result['AsciiName'] ?>
        <h4>Population: <?php echo $result['Population'];?></h4>
        <h4>Elevation: <?php echo $result['Elevation'];?></h4>
        <?php $lat = $result['Latitude'];?>
        <?php $long = $result['Longitude'];?>
        
        <?php
    }
    ?>
    <center><iframe
        width="300"
        height="250"
        style="border:0"
        
        loading="lazy"
        allowfullscreen
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAdJVu6UrYbOdp4Jfzvo-9d7CU71m5jBDQ
        &q=<?php echo $cityName;?>
        &zoom=3">
    </iframe></center>
    </div>
    </div>

    <div class="container">
    <div class="row">
    <h2 class="text-center">Pictures</h2>
    <?php 

    //Display Images for city here

    $images=GetImagesForCity($city); 
    foreach($images as $result){
        ?>
        <div col style="float: left; width: 33.33%; padding: 5px;">
        <?php echo "<a href=\"travelImage.php?id=$result[ImageID]\"><img src=\"travel-images/small/$result[Path]\" class=\"img-responsive\"></a>"; ?>
        </div>
        <?php
    }
    ?>
    </div>
    </div>

    <!-- Footer -->
    <?php require_once("footer.php"); ?>

</body>
</html> 