<?php include('includes/connect.php');
$pageTitle = 'PlayMyCity | Artists';
  include('includes/header.php');
?>

  <section>
  <div id="artist-list-container" class="clearfix">
    <div id="artist-list-wrap">
      <ul id="artist-list">
        
        <?php
        
        while ($row = mysqli_fetch_assoc($artists)) {
          
          //update artist requests from the requests table
          $artist = $row['artist_id'];
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
          
           //Populate artist list 
           echo '<a href="fan-artist-view.php?artist='.$row['artist_id'].'"><li id="'.$row['artist_id'].'" class="artist-name"><span id="stage-name">'.$row["artist_stagename"].'</span><span class="artist-image-url">'.$row["artist_profile_pic"].'</span><span class="requests">'.$row["requests"].'</span><span class="confirmed-shows">'.$row["confirmed_shows"].'</span><button class="play-my-city">PlayMyCity</button></li></a>';

          }      
        ?>
        
      </ul>
    </div><!-- end artist-list-wrap -->

  </div> <!-- end artist-list-container -->
<!--
    <button id="rate">Rate</button>
    <button id="hate">Hate</button>
-->
  </section>

  <?php include('includes/footer.php'); ?>