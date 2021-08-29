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



<div class="panel panel-default">
                    <div class="panel-heading">
                        Search Images

                        <form class="form-inline" action="results.php" method="get">

                        <div class="form-group">
                            <input type="text" name="imageSearch" class="form-control">

                        </div>

                        <div class="form-group">
                            <select class="form-control" id="city" name="country">
                                <option disabled selected value="none">Filter By Country</option>
                               <?php $countries = GetCountriesWithImages(); 
                               foreach($countries as $result) { ?> 
                                    <option value="<?php echo $result['ISO'];?>" > <?php echo $result['CountryName'];?></option>
                                <?php } ?>  
                                </select>
                        </div>

                       <div class="form-group">
                            <select class="form-control" id="city" name="city">
                                <option disabled selected value="none">Filter By City</option>
                               <?php $cities = GetCitiesWithImages(); 
                               foreach($cities as $result) { ?> 
                                    <option value="<?php echo $result['GeoNameID'];?>" > <?php echo $result['AsciiName'];?></option>
                                <?php } ?>  
                            </select>
                        </div>


            
                        <button type="submit" class= "btn btn-primary" value="Submit">Filter</button>
                        </form>
                        
                    </div>

            </div>

            <div class="panel panel-default">
                    <div class="panel-heading">
                        Search Posts By Title

                        <form class="form-inline" action="results.php" method="get">

                        <div class="form-group">
                            <input type="text" name="postSearch" class="form-control">

                        </div>

                        <button type="submit" class= "btn btn-primary" value="Submit">Filter</button>
                        </form>
                        
                    </div>

            </div>



<?php require_once("footer.php"); ?>


</body>
</html> 