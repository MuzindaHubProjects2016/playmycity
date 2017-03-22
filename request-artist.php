<?php 
$pageTitle = 'PlayMyCity | Requests';
include('includes/header.php');
include('includes/connect.php');

session_start();
if(isset($_SESSION['username'])){
$fan = $_SESSION['username'];
$artist = $_GET['artist'];  

if(isset($_SESSION['requested'])){
  $requested = $_SESSION['requested'];
}
        
if($requested){
  //Unrequest
  $sql="DELETE FROM requests WHERE artist_id = '$artist' AND fan_username = '$fan' ";
  mysqli_query($connect, $sql);
  
  //update artist requests from the requests table
  $new_requests = "SELECT playmycity_fans.*, playmycity_artists.*
  FROM playmycity_fans
  INNER JOIN requests
  ON playmycity_fans.fan_username = requests.fan_username
  INNER JOIN playmycity_artists
  ON requests.artist_id = playmycity_artists.artist_id
  WHERE requests.artist_id = '$artist'";

  $result = mysqli_query($connect, $new_requests);
  $rowcount = mysqli_num_rows($result);

  $requests_update = "UPDATE playmycity_artists SET requests='$rowcount'
  WHERE artist_id = '$artist' ";
  mysqli_query($connect, $requests_update);
  
  //Go back to fan page
  header('Location: fan-artist-view.php?artist='.$artist);
}else{
  
  if(isset($_POST['request_artist']))
  $artist = $_GET['artist'];
  $fan = $_GET['fan'];


//Add new request to requests table
$sql = "INSERT INTO requests VALUES ('$artist', '$fan')";
mysqli_query($connect, $sql);

//update artist requests from the requests table
$new_requests = "SELECT playmycity_fans.*, playmycity_artists.*
FROM playmycity_fans
INNER JOIN requests
ON playmycity_fans.fan_username = requests.fan_username
INNER JOIN playmycity_artists
ON requests.artist_id = playmycity_artists.artist_id
WHERE requests.artist_id = '$artist'";

$result = mysqli_query($connect, $new_requests);
$rowcount = mysqli_num_rows($result);

$requests_update = "UPDATE playmycity_artists SET requests='$rowcount'
WHERE artist_id = '$artist' ";
mysqli_query($connect, $requests_update);

//Go back to fan page
header('Location: fan-artist-view.php?artist='.$artist);
}
}else{
  header('Location: login.php');
}
?>

<?php include('includes/footer.php'); ?>