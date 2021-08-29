<?php
session_start();


if (!isset($_SESSION['numPosts']))
{
  $_SESSION['posts']= array();
  $_SESSION['numPosts'] = 0;
}
if (!isset($_SESSION['numImages']))
{
  $_SESSION['images']= array();
  $_SESSION['numImages'] = 0;
}

if (!isset($_SESSION['loggedin']))
{
  $_SESSION["loggedin"] = false;
}

if (!isset($_SESSION['admin']))
{
  $_SESSION["admin"] = false;
}
/*if (!isset($_SESSION['admin']))
{
  $_SESSION["admin"] = false;
}*/


?>


<nav class="navbar navbar-inverse" style="border-radius: 0;">
        <div class="container">
          <div class="navbar-header navbar-left">
            <img alt="Brand" src="travel-images/logo.png" width="40px" height="30px" style="margin-top: 10px; margin-right: 10px;">
            <a class="navbar-brand navbar-right" href="index.php">Final Project</a>
          </div>
          <?php 
            if (isset($_SESSION['UID'])) {
          ?>
          <ul class="nav navbar-nav" style="margin-left: 15px;">
            <li class=""><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="advancedSearch.php">Search</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Browse
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="browsePosts.php">Posts</a></li>
                  <li><a href="browseImages.php">Images</a></li>
                  <li><a href="browseUsers.php">Users</a></li>
                </ul>
              </li>
          </ul>
          <form class="navbar-form navbar-right" action="results.php" method="get">
                <a type="button" href="user.php?UID=<?php echo $_SESSION['UID']; ?>" class="btn btn-default"><i class="glyphicon glyphicon-user"></i></a>
                <div class="input-group">
                  <input type="text" class="form-control" name="imageSearch" style="height:33.5px" placeholder="Search">
                  <div class="input-group-btn">
                    <button class="btn  btn-default" type="submit">
                      <i class="glyphicon glyphicon-search"><?php //output name need proper sql querry ?></i>
                    </button>
                  </div>
                </div>
              
          </form>
          <?php } else { ?>
          <ul class="nav navbar-nav" style="margin-left: 15px;">
            <li class=""><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="advancedSearch.php">Search</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Browse
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="browsePosts.php">Posts</a></li>
                  <li><a href="browseImages.php">Images</a></li>
                  <li><a href="browseUsers.php">Users</a></li>
                </ul>
              </li>
          </ul>
          <form class="navbar-form navbar-right" action="results.php" method="get">
                <div class="input-group">
                  <input type="text" class="form-control" name="imageSearch" style="height:33.5px" placeholder="Search">
                  <div class="input-group-btn">
                    <button class="btn  btn-default" type="submit">
                      <i class="glyphicon glyphicon-search"><?php //output name need proper sql querry ?></i>
                    </button>
                  </div>
                </div>
              
          </form>
          <?php } ?>
        </div>
   

    <div class="container" style="color:white">
          <?php       
              if ($_SESSION["loggedin"] == true)
              {
                echo 'Welcome, '.$_SESSION["FirstName"].' '. $_SESSION["LastName"];
              }
          ?>
        </div>

        </nav>
        <div class="container">
        <center>
        <img src="travel-images/ad.png" height="125px" width="400" />
        </center>
        </div>
        </br>