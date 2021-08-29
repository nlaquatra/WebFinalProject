<?php

require_once('dataAccessFunctions.php'); 

if(isset($_GET['submit'])){
    if($_GET['inlineRadioOptions'] == 'option1'){
         //Run query for Top
         $query = "SELECT * FROM cardetails ORDER BY caradded asc";
    }
    else if($_GET['inlineRadioOptions'] == 'option2'){
         //Run query for datedesc
         $query = "SELECT * FROM cardetails ORDER BY caradded desc";
    }
}
else {
    $query = "SELECT * FROM cardetails ORDER BY id asc";
}

?>
<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Home Page</title>

    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Nav Bar -->

    <?php require_once("header.php"); ?>
    
    <!-- End -->

    <?php 

      if (isset($_GET["success"])) {
        echo "<div class = \"alert alert-success alert-dismissible\" role=\"alert\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button><center><strong>Success!</strong> You have successfully logged in!</center></div>";
      }

    ?>

    <div class="container">
        <div >
        <!--
            Side Bar
            Lists
                Continents, Countries, and cities
                Clicks go to links to country/city, or to search
        -->
        </div>
        <!--CAROUSEL ADOPTED FROM W3SCHOOLS.COM EXAMPLE-->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
        
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="travel-images/medium/5856697109.jpg" width="100%">
              <div class="carousel-caption">
                <h3>Build a travel network</h3>
                <p>Connect with fellow adventurers</p>
              </div>
            </div>
        
            <div class="item">
              <img src="travel-images/medium/5855752464.jpg" width="100%">
              <div class="carousel-caption">
                <h3>Save your Favorites</h3>
                <p>Add the best images to your page</p>
              </div>
            </div>
        
            <div class="item">
              <img src="travel-images/medium/5856616479.jpg" width="100%">
              <div class="carousel-caption">
                <h3>Search a massive database</h3>
                <p>Get access to premier content</p>
              </div>
            </div>
          </div>
        
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div> <!--End Carousel-->
    </div> <!-- End Conainer -->
    <hr>
    <br>

    <div class="container">
        <div class="row text-center">
            <div class="col-lg-4">
                <h3><span class="glyphicon glyphicon-info-sign" style="margin-right: 6px;"></span>About Us</h3>
                <p class="lead mb-0">Learn more about the Project Team here.</p>
                <a href="about.php"><button class="btn btn-primary" style="margin-top: 5px;">About</button></a>
            </div>
            <div class="col-lg-4">
                <h3><span class="glyphicon glyphicon-th-list" style="margin-right: 6px;"></span>View Posts</h3>
                <p class="lead mb-0">Access and read other posts below here.</p>
                <a href = "browsePosts.php"><button class="btn btn-primary" style="margin-top: 5px;">List Posts</button></a>
            </div>
            <div class="col-lg-4">
                <h3><span class="glyphicon glyphicon-camera" style="margin-right: 6px;"></span>Geographical Areas</h3>
                <p class="lead mb-0">View all the continents, countries, and cities</p>
                <a href = "browseArea.php"><button class="btn btn-primary" style="margin-top: 5px;">View</button></a>
            </div>
        </div>
    </div> <!-- End Container -->
    <hr>
    <br>    
    
    <div class="container">
        <div class="row text-center">
            <h1>Travel Images</h1>
            <form action="index.php" method="POST">
            <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Top Rated
            </label>
            <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Newest
            </label>
            <label class="radio-inline">
            <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option3"> Recent Reviews
            </label>
            <label class="btn-inline">
            <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Filter" />
            </label> 
        </div>
      </div>
      <hr>
    <?php 
      if(isset($_POST['submit'])) {
        $filter = $_POST['inlineRadioOptions'];
    ?>

      <div class="container">
        <div class="row">
              <?php
                if ($filter === "option1") {
                    $img = GetImagesAllWithRating();
                    foreach($img as $result) { ?>
                    <div style="float: left; width: 33.33%; height: 33.33%; padding: 15px;">
                    <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <img src="travel-images/square-medium/<?php echo $result['Path'];?>" class="img-responsive center-block"> </a> 
                    </div>
              <?php }
                }
                else if ($filter === "option2") {
                  $img = GetImagesAllDESC();
                  foreach($img as $result) { ?>
                    <div style="float: left; max-width: 33.33%; height: 33.33%; padding: 15px;">
                    <a href="travelimage.php?id=<?php echo $result['ImageID'];?>"> <img src="travel-images/square-medium/<?php echo $result['Path'];?>" class="img-responsive center-block"> </a> 
                    </div>
              <?php }
              }
              else if ($filter === "option3") {
                $review = GetLastTwoReviews();
                foreach($review as $result) { 

                  $rating = $result['Rating'];
                  $review = $result['Review'];
                  $time = $result['ReviewTime'];
                  $fname = $result['FirstName'];
                  $lname = $result['LastName'];
                  $uid = $result['UID'];
                  $ImageRatingID = $result['ImageRatingID'];
                  $imageID = $result['ImageID'];
                  
                  ?>

                  <div style="float: left; max-width: 33.33%; height: 33.33%; padding: 15px;">
                  <p><a href="travelimage.php?id=<?php echo $imageID;?>">Link to image</a></p> 
                  <p><b>Rating: <?php echo $rating; ?></b>
                  <p>Review: <?php echo $review; ?></p>
                  <p>Reviewed by: <a href="user.php?UID=<?php echo $uid?>"> <?php echo $fname; ?> <?php echo $lname; ?></a> at- <?php echo $time;?></p></p>
                  </div>
            <?php }
            }
        } //End isset
              ?>
            </div>
        </div>
    </div>





<?php require_once("footer.php"); ?>

</body>
</html> 