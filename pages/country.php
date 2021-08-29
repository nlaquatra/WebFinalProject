<!DOCTYPE html>
<html  lang="en">
<head>
    <?php
    require_once('dataAccessFunctions.php'); 
    ?>
    <title>Country</title>

    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">

</head>
<body>

    <!-- NavBar -->
    
    <?php require_once("header.php"); ?>

    <!-- End Nav -->

<div class="container">
<div class="jumbotron">
<?php 

$country = $_GET["country"];
//$country = "AE"; //Remove when done testing

$countries = GetCountriesByID($country);
//CountryName, Capital, Area, Population, CurrencyCode, CountryDescription
foreach($countries as $result){
    
    $name = $result['CountryName'];?>
    <h2>Country Name: <?php echo $result['CountryName'];?></h2>
    <h4>Capital: <?php echo $result['Capital'];?></h4>
    <h4>Area: <?php echo $result['Area'];?></h4>
    <h4>Population: <?php echo $result['Population'];?></h4>
    <h4>Currency Code: <?php echo $result['CurrencyCode'];?></h4>
    <h4>Description: <?php echo $result['CountryDescription'];?></h4>
    <?php

$filename = 'Country_Flags.csv';
if (($h = fopen("{$filename}", "r")) !== FALSE) 
{
  // Each line in the file is converted into an individual array that we call $data
  // The items of the array are comma separated
  while (($data = fgetcsv($h, 1000)) !== FALSE) 
  {

  
        
        // loop thru each image in dataset and see if its country matches reques
            if ($data[0] == $name) {
                // we have a match so add that image to filtered array
              ?>
              <img width="200px;" src="<?php echo $data[2];?>">
              <?php
                
            }
    }


  // Close the file
  fclose($h);
}




?> 
    <?php
}
?>
</div>
</div>
<hr>


<div class="container">
    <div class="row">
    <h2 class="text-center">Pictures</h2>
<?php 
//Display images after listing info for countries


$images=GetImagesForCountry($country); 
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

<!-- End Footer -->
   

</body>
</html> 