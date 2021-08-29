
<?php

require_once('config.php'); 
//IMAGE FUNCTIONS

// Input: none
// Returns: All image titles, ids, and file paths
function GetImagesAllWithTitle() {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT travelimage.ImageID, UID, Path, Title FROM travelimage INNER JOIN travelimagedetails ON travelimage.ImageID=travelimagedetails.ImageID";
        //$sql = "SELECT UID, travelimage.ImageID, travelimage.Path, travelimagedetails.Title FROM travelimage INNER JOIN travelimagedetails ON travelimage.ImageID=travelimagedetails.ImageID";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
     
                $images[$i]=$result;
         
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}

// Input: none
// Returns: Six of the highest rated images - ImageID, Rating, and file path
function GetImagesAllWithRating() {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT travelimagerating.ImageID, Path, travelimagerating.Rating FROM travelimage INNER JOIN travelimagerating ON travelimage.ImageID=travelimagerating.ImageID ORDER BY Rating DESC LIMIT 6";
        //$sql = "SELECT UID, travelimage.ImageID, travelimage.Path, travelimagedetails.Title FROM travelimage INNER JOIN travelimagedetails ON travelimage.ImageID=travelimagedetails.ImageID";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['ImageID'] == NULL)
            {
                break;
            }
     
                $images[$i]=$result;
         
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}

// Input: none
// Returns: Six of the most recent - ImageID, UserID, and file path
function GetImagesAllDESC() {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT ImageID, UID, Path FROM travelimage ORDER BY Path DESC LIMIT 6";
        //$sql = "SELECT UID, travelimage.ImageID, travelimage.Path, travelimagedetails.Title FROM travelimage INNER JOIN travelimagedetails ON travelimage.ImageID=travelimagedetails.ImageID";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['Path'] == NULL)
            {
                break;
            }
     
                $images[$i]=$result;
         
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}

//Input: Image Id
// Returns: User ID, File Path, Lat, Long, and title for that image.
function GetImagesForID($ID) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT travelimage.ImageID, UID, Path, Latitude, Longitude, Title from travelimage, travelimagedetails WHERE travelimage.ImageID = :id AND travelimagedetails.ImageID= :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $ID]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
            $images[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}

//Input: PostId
//Returns: Image information for all images associated with post
function GetImagesForPost($postID) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT travelimage.ImageID, UID, Path from travelimage, travelpostimages WHERE PostID=:id AND travelimage.ImageID=travelpostimages.ImageID;";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $postID]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
            $images[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}
//Input: User ID
//Output: Image information for all images created by that user
function GetImagesForUser($userID) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * from travelimage WHERE UID=:id;";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $userID]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
            $images[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}

//Input: City Code
//Output: All image for images in that city
function GetImagesForCity($cityCode) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT travelimage.ImageID, UID, Path, Title FROM travelimage, travelimagedetails WHERE CityCode=:code AND travelimage.ImageID=travelimagedetails.ImageID;";
        $statement = $pdo->prepare($sql);
        $statement->execute(['code' => $cityCode]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
            $images[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}
//Input: Country Code
//Output: All image for images in that Country
function GetImagesForCountry($countryCode) {

        $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT travelimage.ImageID, UID, Path from travelimage, travelimagedetails WHERE CountryCodeISO=:code AND travelimage.ImageID=travelimagedetails.ImageID;";
        $statement = $pdo->prepare($sql);
        $statement->execute(['code' => $countryCode]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
            $images[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}



//Input: ImageId
//OUtput: Returns the country inforamtion for the image given
function FindImageCountryByID($id) {

    $country = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT geocities.AsciiName, geocountries.CountryName, travelimagedetails.ImageID FROM travelimagedetails INNER JOIN geocountries ON geocountries.ISO=travelimagedetails.CountryCodeISO INNER JOIN geocities ON geocities.CountryCodeISO=travelimagedetails.CountryCodeISO WHERE ImageID=$id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['AsciiName'] == NULL)
            {
                break;
            }
    

            $country[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $country;
}
//*END OF IMAGE FUNCTIONS */

//POST FUNCTIONS 

//Input: None
//Output: Basic Post information for all posts
function GetPostsAll() {

        $posts = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT PostID, UID, Title, Message from travelpost";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
       
            $posts[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    return $posts;
}

//Input a post ID
// Output detailed post information for that post
function GetPostsByID($postID) {

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT PostID, UID, Title, Message, PostTime from travelpost WHERE PostID=:id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $postID]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $result;
}

//Input a user ID
// Output: basic post information for all posts by user
function GetPostsByUserID($uID) {

    $posts = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT PostID,Title from travelpost WHERE UID=:id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $uID]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $posts[$i] = $statement->fetch(PDO::FETCH_ASSOC);
            if ($posts[$i]['PostID'] == NULL)
            {
                break;
            }
          
            
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $posts;
}
/*END OF POST FUNCTIONS */

//USER FUNCTIONS 
//Input: none
//Returns: All UserNames and User IDs in DB
function GetUsersAll() {

        $users = array();


    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT FirstName,LastName, UID, Address, City, Region, Country, Postal, Email, Privacy, Phone from traveluserdetails";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
                $users[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    return $users;
}

//Input: User ID
//Returns: Detailed user information - User Name, address, city, region, country, postal, and email of input User ID
function GetUsersByID($userID) {
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT FirstName,LastName, UID, Address, City, Region, Country, Postal, Email, Privacy, Phone from traveluserdetails WHERE UID=:id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $userID]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['UID'] == NULL)
            {
                break;
            }
                $user = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $user;

    
}

//*END OF USER FUNCTIONS */


//COUNTRY FUNCTIONS 

//Input: none
//Returns: basic country information for all countries
function GetCountriesAll() {

    $countries = array();


try{
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT ISO, CountryName from geocountries";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    for($i=0; $i<$statement->rowCount(); $i++){
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result['CountryName'] == NULL)
        {
            break;
        }
            $countries[$i] = $result;
        }
    $pdo = null;
}
catch (PDOException $e) {
    die( $e->getMessage() );
}
return $countries;
}



//Input: none
//Returns: basic country information for all countries that have images
function GetCountriesWithImages() {

    $countries = array();


try{
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT DISTINCT ISO, CountryName from geocountries, travelimagedetails WHERE geocountries.ISO = travelimagedetails.CountryCodeISO"; //Finish Implementing
    $statement = $pdo->prepare($sql);
    $statement->execute();
    for($i=0; $i<$statement->rowCount(); $i++){
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result['CountryName'] == NULL)
        {
            break;
        }
            $countries[$i] = $result;
        }
    $pdo = null;
}
catch (PDOException $e) {
    die( $e->getMessage() );
}
return $countries;
}

//Input: country code
//Returns: detailed country information for that country
function GetCountriesByID($countryCode) {

    $countries = array();
    
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT CountryName, Capital, Area, Population, CurrencyCode, CountryDescription from geocountries WHERE ISO=:code";
        $statement = $pdo->prepare($sql);
        $statement->execute(['code' => $countryCode]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['CountryName'] == NULL)
            {
                break;
            }
                $countries[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $countries;

    
}

/*END OF COUNTRY FUNCTIONS */

//CITY FUNCTIONS 

//Input: none
//Returns: basic city information for all cities
function GetCitiesAll() {

    $cities = array();


try{
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT GeoNameID, AsciiName from geocities";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    for($i=0; $i<$statement->rowCount(); $i++){
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result['AsciiName'] == NULL)
        {
            break;
        }
            $cities[$i] = $result;
        }
    $pdo = null;
}
catch (PDOException $e) {
    die( $e->getMessage() );
}
return $cities;
}
//Input: none
//Returns: basic city information for all cities with images
function GetCitiesWithImages() {

    $cities = array();
    
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//NEED TO FINISH IMPLEMENTING!!!
        $sql = "SELECT DISTINCT AsciiName, GeoNameID from geocities, travelimagedetails WHERE geocities.GeoNameID=travelimagedetails.CityCode";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['AsciiName'] == NULL)
            {
                break;
            }
                $cities[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $cities;

    
}

//Input: city code
//Returns: detailed country information for that city
function GetCitiesByID($cityCode) {

    $cities = array();
    
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT AsciiName, geocities.Population, Elevation, CountryName, Latitude, Longitude from geocities, geocountries WHERE geocities.GeoNameID=:code AND geocities.CountryCodeISO = geocountries.ISO";
        $statement = $pdo->prepare($sql);
        $statement->execute(['code' => $cityCode]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['AsciiName'] == NULL)
            {
                break;
            }
                $cities[$i] = $result;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $cities;

    
}

//*END OF CITIES FUNCTIONS */


//SEARCH FUNCTIONS 


//Input: search term
//Output: Find all basic image information for images with the search term in the title.
function SearchImages($search) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $search = "%$search%";

        $sql = "SELECT Title, travelimagedetails.ImageID, Path from travelimagedetails, travelimage WHERE Title LIKE :term AND travelimagedetails.ImageID = travelimage.ImageID";
        $statement = $pdo->prepare($sql);
        $statement->execute(['term' => $search]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['Title'] == NULL)
            {
                break;
            }
    

            $images[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}

//Input: search term and a country code
//Output: Find all basic image information for images from the country given with the search term in the title.
function SearchImagesByNameAndCountry($search, $country) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $search = "%$search%";

        $sql = "SELECT Title, travelimagedetails.ImageID, Path from travelimagedetails, travelimage WHERE Title LIKE :term AND CountryCodeISO = :country AND travelimagedetails.ImageID = travelimage.ImageID";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':term', $search, PDO::PARAM_STR, 12);
        $statement->bindParam(':country', $country, PDO::PARAM_STR, 12);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['Title'] == NULL)
            {
                break;
            }
    

            $images[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}


//Input: search term and a city code
//Output: Find all basic image information for images from the city given with the search term in the title.

function SearchImagesByNameAndCity($search, $city) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $search = "%$search%";

        $sql = "SELECT Title, travelimagedetails.ImageID, Path from travelimagedetails, travelimage WHERE Title LIKE :term AND CityCode = :city AND travelimagedetails.ImageID = travelimage.ImageID";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':term', $search, PDO::PARAM_STR, 12);
        $statement->bindParam(':city', $city, PDO::PARAM_STR, 12);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['Title'] == NULL)
            {
                break;
            }
    

            $images[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}
//Input: search term and a city code and a country code
//Output: Find all basic image information for images from the city and country given with the search term in the title.

function SearchImagesByNameCountryAndCity($search, $city, $country) {

    $images = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $search = "%$search%";

        $sql = "SELECT Title, travelimagedetails.ImageID, Path from travelimagedetails, travelimage WHERE Title LIKE :term AND CityCode = :city AND CountryCodeISO = :country AND travelimagedetails.ImageID = travelimage.ImageID";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':term', $search, PDO::PARAM_STR, 12);
        $statement->bindParam(':city', $city, PDO::PARAM_STR, 12);
        $statement->bindParam(':country', $country, PDO::PARAM_STR, 12);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['Title'] == NULL)
            {
                break;
            }
    

            $images[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $images;
}



//Input: search term
//Output: Find all basic post information for posts with the search term in the title.
function SearchPosts($search) {

    $posts = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $search = "%$search%";

        $sql = "SELECT Title, PostID from travelpost WHERE Title LIKE :term";
        $statement = $pdo->prepare($sql);
        $statement->execute(['term' => $search]);
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['Title'] == NULL)
            {
                break;
            }
    

            $posts[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $posts;
}

//*END OF SEARCH FUNCTIONS */


//ACCOUNT - REGISTER FUNCTIONS


//Verifies that the input fields are not empty
function emptyInputRegister($firstName, $lastName, $email, $pwd, $pwd_confirm) {
    $result = false;
    if (empty($firstName) || empty($lastName) || empty($email) || empty($pwd) || empty($pwd_confirm)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
//Verfies that both passwords given are the same.
function checkPwdRegister($pwd, $pwd2) {
    $result = false;
    if ($pwd !== $pwd2) { //if not equal return false
        $result = false;
    }
    else {
        $result = true;
    }
    return $result;
}


//Input: user information
//Result: User account is added to traveluser table and the traveluserdetails table and signs into session.
function registerUser($firstName, $lastName, $email, $address, $country, $city, $pwd) {


    $uid = 0;
    $currentTime = date('Y-m-d H:i:s');//Set Current Date
    $state = 1;
    $privacy = 2;

    try {
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO traveluser (UserName, Pass, State, DateJoined) VALUES (?, ?, ?, ?)";
    $statement = $pdo->prepare($sql);
    $statement -> bindParam(1, $email, PDO::PARAM_STR);
    $statement -> bindParam(2, $pwd, PDO::PARAM_STR);
    $statement -> bindParam(3, $state, PDO::PARAM_STR);
    $statement -> bindParam(4, $currentTime, PDO::PARAM_STR);
    $statement->execute();

    $sql = "SELECT UID FROM traveluser WHERE DateJoined = :time ";
    $statement = $pdo->prepare($sql);
    $statement -> bindParam(":time", $currentTime, PDO::PARAM_STR);
    $statement->execute();
    for($i=0; $i<$statement->rowCount(); $i++){
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $uid = $result["UID"];
    }
    if ($uid == 0)
    {
        echo "ERROR: USER ID NOT FOUND";
    }
    else {

    $sql = "INSERT INTO traveluserdetails (FirstName, LastName, Address, City, Country, Email, UID, Privacy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; //not a working sql query
    $statement = $pdo->prepare($sql);
    $statement -> bindParam(1, $firstName, PDO::PARAM_STR);
    $statement -> bindParam(2, $lastName, PDO::PARAM_STR);
    $statement -> bindParam(3, $address, PDO::PARAM_STR);
    $statement -> bindParam(4, $city, PDO::PARAM_STR);
    $statement -> bindParam(5, $country, PDO::PARAM_STR);
    $statement -> bindParam(6, $email, PDO::PARAM_STR);
    $statement -> bindParam(7, $uid, PDO::PARAM_INT);
    $statement -> bindParam(8, $privacy, PDO::PARAM_INT);
    $statement->execute();


    session_start();
    $_SESSION["UserName"] = $email;
    $_SESSION["UID"] = $uid;
    $_SESSION["FirstName"] = $firstName;
    $_SESSION["LastName"] = $lastName;
    $_SESSION["loggedin"] = true;
    if ($state == 2)
    $_SESSION["admin"] = true;
    else{
    $_SESSION["admin"] = false;
    }
    header("location: index.php?success");
    exit();



    }
              
}
catch (PDOException $e) {
    die($e->getMessage());
}
    $pdo = null;

}

/*ACCOUNT - SIGN IN FUNCTIONS */

//Checks if the login inputs are filled
function emptyInputLogin($email, $pwd) {
    $result = false;
    if (empty($email) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//Input: Email
//Result: checks if user exists. Returns user information if true
function userExist($email) {
    $result = false;
    try {
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT UserName, Pass, traveluser.UID, FirstName, LastName, State FROM traveluser, traveluserdetails WHERE traveluserdetails.UID = traveluser.UID AND UserName = ?";
    $statement = $pdo->prepare($sql);
    $statement -> bindParam(1, $email, PDO::PARAM_STR);
    $statement->execute();
    $resultData = $statement->fetch(PDO::FETCH_ASSOC);

      if ($row = $resultData) {
          return $row;
      }
      else {
          $result = false;
          return $result;
      }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
        $pdo = null;
}

//Takes in email and password
//Output: Logs in user if account information is correct
function loginUser($email, $pwd) {
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
    $userExist = userExist($email);

    if ($userExist === false) {
        header("location: login.php?error=invalidUser");
        exit();
    }

    $pwdVerify = $userExist["Pass"];
    //$checkPwd = password_verify($pwd, $pwdHashed);
    
    if ($pwd !== $pwdVerify) {
        header("location: login.php?error=invalidLogin");
        exit();
    }
    else if ($pwd === $pwdVerify) {
        session_start();
        $_SESSION["UserName"] = $userExist["UserName"];
        $_SESSION["UID"] = $userExist["UID"];
        $_SESSION["FirstName"] = $userExist["FirstName"];
        $_SESSION["LastName"] = $userExist["LastName"];
        $_SESSION["loggedin"] = true;
        if ($userExist["State"] == 2)
        $_SESSION["admin"] = true;
        else{
        $_SESSION["admin"] = false;
        }
        header("location: index.php?success");
        exit();
    }
}
//*END ACCOUNT - SIGN IN FUNCTIONS */

//REVIEW AND RATING FUNCTIONS


//Input: ImageId
//OUtput: reutns image rating information for image given
function FindRatingByID($id) {

    $ratings = 0;
    $ratingAVG = 0;

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM travelimagerating WHERE ImageID = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result['Rating'] == NULL)
            {
                break;
            }
    

            
            $ratingAVG = $ratingAVG + $result["Rating"];
            $ratings++;
            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    $ratingAVG = $ratingAVG/$ratings;
    return number_format((float)$ratingAVG, 2, '.', '');
   
}

//Input: Image Id and User Ud
//Output: True if user has already reviewed image. False if never reviewed image
function checkForDuplicateReviews($imageID, $userID){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


       
        $sql = "SELECT ImageID, UID from travelimagerating WHERE ImageID = :imageID AND UID = :userID";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters

            $stmt->bindParam(":imageID", $imageID, PDO::PARAM_STR);
            $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);

        
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    return 1;
                } 
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
    
            // Close statement
            unset($stmt);
        }
        
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return 0;
    // Close connection
    unset($pdo);
}

// Input: Rating, comment, image Id, and user ID for iamge review
// Output: Checks for duplicate review, if false then inserts review into DB
function addReview($rating, $comment, $imageID, $userID) {

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $currentTime = date('Y-m-d H:i:s');//Set Current Date

       
        if (checkForDuplicateReviews($imageID, $userID) == 1)
        {
            echo "<div class='container'><div class='alert alert-danger text-center'>
            <strong>Error:</strong> User has already reviewed Image
          </div></div>";
            
        }
        else{
       
            $sql = "INSERT INTO travelimagerating (ImageID, Rating, UID, Review, ReviewTime) VALUES (:imageID, :rating, :userID, :comment, :currentTime)"; 
            if($stmt = $pdo->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":rating", $rating, PDO::PARAM_STR);
                $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);
                $stmt->bindParam(":imageID", $imageID, PDO::PARAM_STR);
                $stmt->bindParam(":userID", $userID, PDO::PARAM_STR);
                $stmt->bindParam(":currentTime", $currentTime, PDO::PARAM_STR);
            
                
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    //Execute insert. Data is now in the DB if no errors. 
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
        
                // Close statement
                unset($stmt);
            }
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    // Close connection
    unset($pdo);
    }
    
// Input: Image ID
// Output: Returns all review information for given image
function retrieveReviews($imageID){

    $reviews = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT Rating, Review, ReviewTime, ImageRatingID, FirstName, LastName, travelimagerating.UID from travelimagerating, traveluserdetails WHERE travelimagerating.imageID = :id AND travelimagerating.UID = traveluserdetails.UID";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id', $imageID, PDO::PARAM_STR, 12);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $reviews[$i] = $result;

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $reviews;
}


    
// Input: ImageRatingID
// Output: Deletes review for ratingID provided

function deleteReview($imageRatingID){

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM travelimagerating WHERE ImageRatingID = :id"; 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":id", $imageRatingID, PDO::PARAM_STR);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                //Execute insert. Data is now in the DB if no errors. 
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
    
            // Close statement
            unset($stmt);
        }
        }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    // Close connection
    unset($pdo);
}

// Input: none
// Output: Returns information for the last two ratings in the db
function GetLastTwoReviews(){

    $reviews = array();

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT Rating, Review, ReviewTime, ImageRatingID, ImageID, FirstName, LastName, travelimagerating.UID from travelimagerating, traveluserdetails WHERE  travelimagerating.UID = traveluserdetails.UID ORDER BY ReviewTime DESC LIMIT 2";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        for($i=0; $i<$statement->rowCount(); $i++){
            $reviews[$i] = $statement->fetch(PDO::FETCH_ASSOC);
          

            }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }

    return $reviews;


}
// END REVIEW AND RATING FUNCTIONS

// UPDATE USER FUNCTIONS

// Input: User information
// Output: Updates the user information with the given inputs
function updateUserInfo($fname, $lname, $uid, $address, $city, $region, $country, $postal, $email, $privacy, $phone){

    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $sql = "UPDATE traveluserdetails SET FirstName = :fname, LastName = :lname, Address = :address, City = :city, Region = :region, Country = :country, Postal = :postal, Phone = :phone, Email = :email, Privacy = :privacy  WHERE UID = :uid"; 

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fname", $fname, PDO::PARAM_STR);
            $stmt->bindParam(":lname", $lname, PDO::PARAM_STR);
            $stmt->bindParam(":address", $address, PDO::PARAM_STR);
            $stmt->bindParam(":city", $city, PDO::PARAM_STR);
            $stmt->bindParam(":region", $region, PDO::PARAM_STR);
            $stmt->bindParam(":country", $country, PDO::PARAM_STR);
            $stmt->bindParam(":postal", $postal, PDO::PARAM_STR);
            $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":privacy", $privacy, PDO::PARAM_INT);
            $stmt->bindParam(":uid", $uid, PDO::PARAM_INT);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                //Execute insert. Data is now in the DB if no errors. 
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
    
            // Close statement
            unset($stmt);
        }
        }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    // Close connection
    unset($pdo);

}

// END UPDATE USER FUNCTIONS


?>