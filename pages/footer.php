<footer>
<img src="travel-images/vertAd.jfif" height="150"/> 
    <?php 
        if (!isset($_SESSION['UserName'])) {

    ?>
            
            <p><a href="viewFavorites.php">Favorites</a> | <a href="register.php">Register</a> | <a href="login.php">Login</a></p>

            <p>Created By: Donovan Byler & Nicolas LaQuatra | <a href="https://github.com/Dbyler8/Web-Programming-Final">Github</a></p>
<?php   }
        else if (isset($_SESSION['UserName'])) { ?>
            <p><a href="viewFavorites.php">Favorites</a> | <a href="#">My Account</a> | <a href="logout.php">Logout</a>
            <?php if ($_SESSION["admin"] == true)
                {?>
                  | <a href="editUsers.php" >Edit Users (Admin)</a>
                <?php }?>    
            
            </p>
            <p>Created By: Donovan Byler & Nicolas LaQuatra | <a href="https://github.com/Dbyler8/Web-Programming-Final">Github</a></p>

<?php   }   ?>
</footer>