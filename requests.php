<?php 
$pageTitle = 'PlayMyCity | Requests';
include('includes/header.php');
include('includes/connect.php');

$sql = "SELECT playmycity_fans.*, playmycity_artists.*
FROM playmycity_fans
INNER JOIN requests
ON playmycity_fans.fan_username = requests.fan_username
INNER JOIN playmycity_artists
ON requests.artist_id = playmycity_artists.artist_id
WHERE requests.artist_id = 1";

$result = mysqli_query($connect, $sql);
$rowcount = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

foreach($row as $key => $value){
  $result_arr[$key] = $value;
}

echo '<div id="artist-bio-requests-page">
  <div id="artist-image-requests-page">
    <img class="requests-propic" src="'.$row['artist_profile_pic'].'">
  </div>
  <div id="artist-details">
    <ul>
      <li>First Name:<span id="bio-firstname">'.$result_arr['artist_firstname'].'</span></li>
      <li>Last Name:<span id="bio-lastname">'.$result_arr['artist_lastname'].'</span></li>
      <li>Genre:<span id="bio-genre">'.$result_arr['main_genre'].'</span></li>
      <li>City:<span id="bio-city">'.$result_arr['artist_city'].'</span></li>
      <li>Requests:<span id="bio-requests">'.$rowcount.'</span></li>
      <li class="bio-confirmed"><a href="#">Confirmed:<span id="bio-confirmed">'.$result_arr['confirmed_shows'].'</span></a></li>
    </ul>
</div>
</div>';

echo '<h1 id="'.$result_arr['artist_id'].'" class="artist-name-big">'.$result_arr['artist_stagename'].'<span class="requests requests-big">'.$rowcount.'</span></h1>';

$result = mysqli_query($connect, $sql); //redeclare $result to refresh it

echo '<div id="requests-propic" class="clearfix">';
while($row = mysqli_fetch_assoc($result)){

  echo '<img class="requests-propic" src="'.$row['fan_profile_pic'].'">';

}
echo '</div>';
?>
<?php include('includes/footer.php'); ?>