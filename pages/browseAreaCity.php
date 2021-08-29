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
            <h2>Cities</h2>
            <a href="browseArea.php" style="color: white; text-decoration: none;"><button class="btn-sm btn-primary" value="View Countries" style="margin-bottom: 10px;">View Countries</a></button>
            <?php
                $cities = GetCitiesWithImages();
                foreach($cities as $result) {
                ?>
                <?php echo "<a href=\"city.php?id=$result[GeoNameID]\"><p>$result[AsciiName]</a></p>"; } ?>
        </div>
            </div>

    <!-- Footer -->

    <?php require_once("footer.php"); ?>

    <!-- End Footer -->

</body>
</html> 