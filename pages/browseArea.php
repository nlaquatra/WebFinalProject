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

    <div class="container">
        <div class="jumbotron">
            <h2>Countries</h2>
            <a href="browseAreaCity.php" style="color: white; text-decoration: none;"><button class="btn-sm btn-primary" value="View Cities" style="margin-bottom: 10px;">View Cities</a></button>
            <?php
                $countries = GetCountriesWithImages();
                foreach($countries as $result) {
                ?>
                <?php echo "<a href=\"country.php?country=$result[ISO]\"><p style=\"font-size: 17px; \">$result[CountryName]</a></p>"; } ?>
        </div>
            </div>

    <!-- Footer -->

    <?php require_once("footer.php"); ?>

    <!-- End Footer -->

</body>
</html> 