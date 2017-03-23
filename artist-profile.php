<?php 
$pageTitle = 'PlayMyCity | Requests';
include('includes/header.php');
include('includes/connect.php');

if(isset($_SESSION['username']) && $_SESSION['user_type'] === 'Artist'){
  $id = $_SESSION['username'];
  $sql = "SELECT *
FROM playmycity_artists
WHERE artist_id = '$id' ";
  $result = mysqli_query($connect, $sql);
  $row = mysqli_fetch_assoc($result);
//  echo "Welcome ".$row['artist_stagename'];
}else{
  header('Location: login.php');
}

$profile = $_SESSION['username'];

$my_requests = "SELECT playmycity_fans.*, playmycity_artists.*
FROM playmycity_fans
INNER JOIN requests
ON playmycity_fans.fan_username = requests.fan_username
INNER JOIN playmycity_artists
ON requests.artist_id = playmycity_artists.artist_id
WHERE requests.artist_id = '$profile'";

$sql = "SELECT *
FROM playmycity_artists
WHERE artist_id = '$profile' ";

$result = mysqli_query($connect, $sql);
$result_requests = mysqli_query($connect, $my_requests);
$rowcount = mysqli_num_rows($result_requests);
$row = mysqli_fetch_assoc($result);

foreach($row as $key => $value){
  $result_arr[$key] = $value;
}

echo '<div id="artist-bio-requests-page" class="clearfix">
  <div id="artist-image-requests-page">
    <img class="requests-propic" src="'.$row['artist_profile_pic'].'">
  </div>
  <div id="artist-details">
    <ul>
      <li><span class="span-label">First Name:</span><span id="bio-firstname">'.$result_arr['artist_firstname'].'</span></li>
      <li><span class="span-label">Last Name:</span><span id="bio-lastname">'.$result_arr['artist_lastname'].'</span></li>
      <li><span class="span-label">Genre:</span><span id="bio-genre">'.$result_arr['main_genre'].'</span></li>
      <li><span class="span-label">City:</span><span id="bio-city">'.$result_arr['artist_city'].'</span></li>
      <li><span class="span-label">Requests:</span><span id="bio-requests">'.$rowcount.'</span></li>
      <li class="bio-confirmed"><a href="#"><span class="span-label">My Confirmed Shows:</span><span id="bio-confirmed">'.$result_arr['confirmed_shows'].'</span></a></li>
    </ul>
</div>
</div>';
?>
<div class="artist-list-container clearfix">
<div id="requests-by-city" class="clearfix">
<h1>Requests by City</h1>
  <ul id="city-list">
<?php   
  
$sql="SELECT city_name FROM cities";
$result = mysqli_query($connect, $sql);

while($row = mysqli_fetch_assoc($result)){
  foreach($row as $key => $value){
  
  $city_requests = "SELECT playmycity_fans.*, playmycity_artists.*
  FROM playmycity_fans
  INNER JOIN requests
  ON playmycity_fans.fan_username = requests.fan_username
  INNER JOIN playmycity_artists
  ON requests.artist_id = playmycity_artists.artist_id
  WHERE playmycity_fans.fan_city = '$value' AND requests.artist_id ='$profile'";
  
  $city_fans = mysqli_query($connect, $city_requests);
  $rowcount2 = mysqli_num_rows($city_fans);

?>
  
    <a><li class="city-name"><?php echo $value;  ?><span class="requests"><?php echo $rowcount2; ?></span></li></a>
  
  <form action="confirm-show.php?artist=<?php echo $_SESSION['username']; ?>&city=<?php echo $row['city_name'] ?>" method="post">
       <button type="submit" name="confirm_show" class="play-my-city" id="confirm-show-btn">Confirm Show</button>
  </form>
  
<?php 
  }
} 
?>
  </ul>
</div><!-- requests by city -->
</div> <!-- end list wrap -->
<?php
echo '<h1 id="'.$result_arr['artist_id'].'" class="artist-name-big">'.$result_arr['artist_stagename'].'<span class="requests requests-big">'.$rowcount.'</span></h1>';

$result = mysqli_query($connect, $my_requests); 

echo '<div id="requests-propic" class="clearfix">';
while($row = mysqli_fetch_assoc($result)){

  echo '<img alt="Fan Pro Pic" class="requests-propic" src="'.$row['fan_profile_pic'].'">';

}
echo '</div>';
?>
<?php include('includes/footer.php'); ?>