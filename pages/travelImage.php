<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Travel Image</title>
    <?php
    require_once('dataAccessFunctions.php'); 
    ?>
    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css">
</head>
<body>




<!-- Start Nav -->

  <?php require_once("header.php"); ?>

  <?php


//Set ID
$id = $_GET['id'];

if (isset($_POST["optradio"]))
{
  addReview($_POST["optradio"], $_POST["comment"], $id, $_SESSION["UID"]);
}

if (isset($_POST["delete"]))
{
  deleteReview($_POST["delete"]);
}

//Grab Data Here
$country = FindImageCountryByID($id); 
foreach($country as $result){
  
    $countryName= $result['CountryName'];
    $cityName = $result['AsciiName'];
}

$rating = FindRatingById($id); 

$images=GetImagesForID($id);
foreach($images as $result){
  
    $title = $result['Title'];
    $path = $result['Path'];
    $lat = $result['Latitude'];
    $long = $result['Longitude'];
}



?>

<!-- End -->

  <div class="container">

    <div class="row">

      <div class="col-sm-8 blog-main">

        <div class="blog-post">
  
          <h2 class="blog-post-title"><?php echo $title; ?></h2>
          <img src="travel-images/medium/<?php echo $path; ?>">
      
        </div><!-- blog-post -->


      </div><!-- /.blog-main -->

  <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <?php


      ?>

      <h3 style="margin-left: 60px;">Rating</h3>
      <p style="margin-left: 70px; margin-top: 20px; font-size: 25px;"><?php echo $rating ?></p>
  <?php if ($_SESSION["loggedin"] == true) { ?>
      <form action="travelimage.php?id=<?php echo $id ?>" method="post">  
        <p><bold>Select your rating:</bold></p>
        <div class="form-group">
        <label class="radio-inline"><input type="radio" value="1" name="optradio">1</label>
        <label class="radio-inline"><input type="radio" value="2" name="optradio">2</label>
        <label class="radio-inline"><input type="radio" value="3" name="optradio">3</label> 
        <label class="radio-inline"><input type="radio" value="4" name="optradio">4</label> 
        <label class="radio-inline"><input type="radio" value="5" name="optradio">5</label> 
        </div>
        <div class="form-group">
          <label for="comment">Comments:</label>
          <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Add Review</button> 
      </form>
     <?php } ?> 

    </div>
        <form method="post" action="viewFavorites.php">
        <button class="btn btn-primary" type="submit" name="ImageFav" value="<?php echo $id?>" style="margin-right: 10px;"><span class="glyphicon glyphicon-heart" style="margin-right: 3px"></span>Favorite Image</button>
        </form>
    <div class="sidebar-module">
      <h4>Image Details</h4>
      <?php

      ?>
      <table class="table table-bordered">
          <tr>
            <th>Country</th>
            <td><?php echo $countryName; ?></td>
          </tr>
          <tr>
            <th>City</th>
            <td><?php echo $cityName; ?></td>
          </tr>
          <tr>
            <th>Latitude</th>
            <td><?php echo $lat; ?></td>
          </tr>
          <tr>
            <th>Longitude</th>
            <td><?php echo $long; ?></td>
          </tr>
      </table>
    </div>
    </div>

  <div class="reviews">
  
  </div>

    <!--USE THIS FOR THE MAP? Taken from W3 schools page on collaspes https://www.w3schools.com/bootstrap/bootstrap_collapse.asp-->
    <!-- Doesn't look great, I know, but she did specifically say to use according --> 
 <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title text-center">
              <button class="btn btn-info" data-toggle="collapse" data-parent="#accordion" href="#collapse1" style="text-decoration: none; color: white;">
              Toggle Map</button>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <iframe width="968" height="250" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/view?key=AIzaSyAdJVu6UrYbOdp4Jfzvo-9d7CU71m5jBDQ&center=<?php echo $lat ?>,<?php echo $long ?>&zoom=14">
            </iframe>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title text-center">
              <button class="btn btn-info" data-toggle="collapse" data-parent="#accordion" href="#collapseReviews" style="text-decoration: none; color: white;">
              Show Reviews</button>
            </h4>
          </div>
          <div id="collapseReviews" class="panel-collapse collapse">
              <!-- Put Reviews Here -->
              <?php
              $reviews=retrieveReviews($id);
              foreach($reviews as $result){
                  
                $rating = $result['Rating'];
                $review = $result['Review'];
                $time = $result['ReviewTime'];
                $fname = $result['FirstName'];
                $lname = $result['LastName'];
                $uid = $result['UID'];
                $ImageRatingID = $result['ImageRatingID'];
              ?>

                <b>Rating: <?php echo $rating; ?></b>
                <p>Review: <?php echo $review; ?></p>
                <p>Reviewed by: <a href="user.php?UID=<?php echo $uid?>"> <?php echo $fname; ?> <?php echo $lname; ?></a> at- <?php echo $time;?></p>
                <?php if ($_SESSION["admin"] == true)
                {?>

                     <form action="travelimage.php?id=<?php echo $id ?>" method="post">  
                    <button class="btn btn-danger" type="submit" value="<?php echo $ImageRatingID ?>" name="delete">Delete Review</button>
                    </form>
            
                <?php }?>
              <?php }?>
          </div>
        </div>
      </div>
    </div>

      </div> 

      



     <?php require_once("footer.php"); ?> 


</body>
</html> 