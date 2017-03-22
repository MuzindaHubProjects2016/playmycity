<?php 
$pageTitle = 'PlayMyCity | Artists';
include('includes/header.php');
include('includes/connect.php');

if(isset($_GET['artist'])){
  $artist = $_GET['artist'];  
}else{
  header('Location: artists.php');
}

$sql = "SELECT playmycity_fans.*, playmycity_artists.*
FROM playmycity_fans
INNER JOIN requests
ON playmycity_fans.fan_username = requests.fan_username
INNER JOIN playmycity_artists
ON requests.artist_id = playmycity_artists.artist_id
WHERE requests.artist_id = '$artist'";

$zero_requests = false;
$result = mysqli_query($connect, $sql);
$rowcount = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

if(!$row){
  $zero_requests = true;  
  $sql = "SELECT * FROM playmycity_artists WHERE artist_id ='$artist'";
  $result2 = mysqli_query($connect, $sql);
  $rowcount = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result2);
  $row['fan_profile_pic'] = '';
}

if($row){  // if a record exists in requests table
foreach($row as $key => $value){
  $result_arr[$key] = $value;
}
?>
<div id="artist-bio-requests-page" class="clearfix">
    <div id="artist-image-requests-page">
      <img class="requests-propic" src="<?php echo $row['artist_profile_pic']; ?>">
    </div>
    <div id="artist-view">
      <ul>
        <li><span class="span-label">First Name:</span><span id="bio-firstname"><?php echo $result_arr['artist_firstname']; ?></span></li>
        <li><span class="span-label">Last Name:</span><span id="bio-lastname"><?php echo $result_arr['artist_lastname']; ?></span></li>
        <li><span class="span-label">Genre:</span><span id="bio-genre"><?php echo $result_arr['main_genre']?></span></li>
        <li><span class="span-label">City:</span><span id="bio-city"><?php echo $result_arr['artist_city']?></span></li>
        <li><span class="span-label">Requests:</span><span id="bio-requests"><?php echo $rowcount; ?> </span></li>
        <li class="bio-confirmed"><a href="#"><span class="span-label">Confirmed:</span><span id="bio-confirmed"><?php echo $result_arr['confirmed_shows']; ?></span></a></li>
      </ul>
  </div>
  
  <form class="request-artist" action="request-artist.php?artist=<?php echo $artist; ?>&fan=<?php echo $_SESSION['username'];?>" method="post">
    <button type="submit" name="request_artist">
      
      <?php // change button text based on requested or not
        if(isset($_SESSION['username'])){
          
          $fan = $_SESSION['username'];
          $exists = "SELECT *
                  FROM requests
                  WHERE artist_id = '$artist' AND fan_username = '$fan' ";

          $requested = mysqli_query($connect, $exists);
          $row = mysqli_fetch_assoc($requested);
          
          if($row){
            $_SESSION['requested'] = true;
            echo "Unrequest";
          }else{
            $_SESSION['requested'] = false;
          echo "Request ".$result_arr['artist_stagename'];
          }
          
        }else{
          echo "Login to request ".$result_arr['artist_stagename'];
        }
  
      ?>
      
    </button> 
</form>
</div>

<?php
echo '<h1 id="'.$result_arr['artist_id'].'" class="artist-name-big">'.$result_arr['artist_stagename'].'<span class="requests requests-big">'.$rowcount.'</span></h1>';

$result = mysqli_query($connect, $sql); //redeclare $result to refresh it

echo '<div id="requests-propic" class="clearfix">';

while($row = mysqli_fetch_assoc($result)){
  if($zero_requests){

  }else{
    echo '<img alt="Fan Pro Pic" class="requests-propic" src="'.$row['fan_profile_pic'].'">';
  }
}
echo '</div>';
}else{
  header('Location: artists.php');
}
?>
<a href="artists.php" id="request-artist-link">Request another Artist...</a>
<?php include('includes/footer.php'); ?>