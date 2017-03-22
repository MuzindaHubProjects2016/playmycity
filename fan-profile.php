<?php 
$pageTitle = 'PlayMyCity | Profile';
include('includes/header.php');
include('includes/connect.php');

if(isset($_SESSION['username']) && $_SESSION['user_type'] === 'Fan'){
//  echo "Welcome ".$_SESSION['username'];
}else{
  header('Location: login.php');
}

$profile = $_SESSION['username'];

$my_requests = "SELECT playmycity_fans.*, playmycity_artists.*
FROM playmycity_artists
INNER JOIN requests
ON playmycity_artists.artist_id = requests.artist_id
INNER JOIN playmycity_fans
ON requests.fan_username = playmycity_fans.fan_username
WHERE requests.fan_username = '$profile'";

$sql = "SELECT *
FROM playmycity_fans
WHERE fan_username = '$profile' ";

$result = mysqli_query($connect, $sql);
$result_requests = mysqli_query($connect, $my_requests);
$rowcount = mysqli_num_rows($result_requests);
$row = mysqli_fetch_assoc($result);

foreach($row as $key => $value){
  $result_arr[$key] = $value;
}

echo '<div id="artist-bio-requests-page" class="clearfix">
  <div id="artist-image-requests-page">
    <img class="requests-propic" src="'.$row['fan_profile_pic'].'">
  </div>
  <div id="artist-details">
    <ul>
      <li><span class="span-label">Username:</span><span id="bio-genre">'.$result_arr['fan_username'].'</span></li>
      <li><span class="span-label">First Name:</span><span id="bio-firstname">'.$result_arr['fan_firstname'].'</span></li>
      <li><span class="span-label">Last Name:</span><span id="bio-lastname">'.$result_arr['fan_lastname'].'</span></li>
      <li><span class="span-label">City:</span><span id="bio-city">'.$result_arr['fan_city'].'</span></li>
      <li><span class="span-label">My Requests:</span><span id="bio-requests">'.$rowcount.'</span></li>
    </ul>
      
</div>
</div>';

echo '<h1 id="'.$result_arr['fan_username'].'" class="artist-name-big">'.$result_arr['fan_username'].'<span class="requests requests-big">'.$rowcount.'</span></h1>';

$result = mysqli_query($connect, $my_requests); 

echo '<div id="requests-propic" class="clearfix">';
while($row = mysqli_fetch_assoc($result)){

  echo '<img alt="Artist Pro Pic" class="requests-propic" src="'.$row['artist_profile_pic'].'">';

}
echo '</div>';
?>
<a href="artists.php" id="request-artist-link">Request an Artist...</a>
<?php include('includes/footer.php'); ?>