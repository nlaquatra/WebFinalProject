<!DOCTYPE html>
<html  lang="en">
<head>

    <title>Edit Users (Admin)</title>
    <?php
    require_once('dataAccessFunctions.php'); 
    ?>
    <link rel="stylesheet" href="bootstrap-3.4.1/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="bootstrap-3.4.1/js/bootstrap.js"></script> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <!-- Nav Bar -->

    <?php require_once("header.php"); ?>

    <?php 
    $cities = GetCitiesAll(); 
    $countries = GetCountriesAll(); 

    if (isset($_POST["user"]))
    {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $uid = $_POST['user'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $region = $_POST['region'];
        $country = $_POST['country'];
        $postal = $_POST['postal'];
        $email = $_POST['email'];
        $privacy = $_POST['privacy'];
        $phone = $_POST['phone'];

        updateUserInfo($fname, $lname, $uid, $address, $city, $region, $country, $postal, $email, $privacy, $phone);
      
    }

    ?>
    
    <div class="container">

    <div class="panel-group" id="accordion">
        <?php
        $users=GetUsersAll();
        foreach($users as $result){


        $fname = $result['FirstName'];
        $lname = $result['LastName'];
        $uid = $result['UID'];
        $address = $result['Address'];
        $city = $result['City'];
        $region = $result['Region'];
        $country = $result['Country'];
        $postal = $result['Postal'];
        $email = $result['Email'];
        $privacy = $result['Privacy'];
        $phone = $result['Phone'];
       
        ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title text-center">
              <button class="btn btn-warning" data-toggle="collapse" data-parent="#accordion" href="#user-<?php echo $uid?>" style="text-decoration: none; color: white;">
              Edit <?php echo $fname;?> <?php echo $lname;?> (UID - <?php echo $uid;?>)</button>
            </h4>
          </div>
          <div id="user-<?php echo $uid?>" class="panel-collapse collapse">
              <!-- Put Reviews Here -->
              <form action="editUsers.php" method="post">
    
    
    <div class="form-group">
        <label for="fname">First Name:</label>
        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname;?>">
    </div>
    <div class="form-group">
        <label for="lname">Last Name:</label>
        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname;?>" required>
    </div>

    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address;?>" required> 
    </div>
    <div class="form-group">
        <label for="city">City:</label>
        <select class="form-control" id="city" name="city">
            <option value="<?php echo $city;?>" selected><?php echo $city;?></option>
            <?php 
            foreach($cities as $result){
                    ?>
                    <option value="<?php $result['AsciiName'];?>"><?php echo $result['AsciiName'];?></option>
                    <?php
            }?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="region">Region:</label>
        <input type="text" class="form-control" id="region" name="region" value="<?php echo $region;?>">
    </div>
    <div class="form-group">
        <label for="country">Country:</label>
        <select class="form-control" id="country" name="country">
            <option value="<?php echo $country;?>" selected><?php echo $country;?></option>
            <?php 
            foreach($countries as $result){
                    ?>
                    <option value="<?php $result['CountryName'];?>"><?php echo $result['CountryName'];?></option>
                    <?php
            }?>
        </select>
    </div>
    <div class="form-group">
        <label for="postal">Postal:</label>
        <input type="text" class="form-control" id="postal" name="postal" value="<?php echo $postal;?>">
    </div>
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>">
    </div>
    <div class="form-group">
        <label for="phone">Privacy:</label>
        <input type="number" class="form-control" id="privacy" name="privacy" min="1" max="2" value="<?php echo $privacy;?>">
    </div>

    <button type="submit" class="btn btn-success" value="<?php echo $uid?>" name="user">Update User Information (UID - <?php echo $uid?>)</button>

    </form>
    
    </div>
    </div>
              <?php }?>
       
       
     
    </div> <!--END ACORDIAN -->


    <!-- End -->
    </div>

    </div>

    <!-- Footer -->

    <?php require_once("footer.php"); ?>

    <!-- End -->
</body>
</html>