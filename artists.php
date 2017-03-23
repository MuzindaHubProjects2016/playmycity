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
          $artist = $row['artist_id'];
          $new_shows = "SELECT * FROM confirmed_shows WHERE artist_id ='$artist'";
          $shows = mysqli_query($connect, $new_shows);
          $confirmed_shows = mysqli_num_rows($shows);
        ?>
<!--       Populate artist list -->
          <?php if(isset($_SESSION['username'])){
          if($_SESSION['user_type']==='Artist'){
          echo '<a href="artist-artist-view.php?artist='.$artist.'">';
          }
          }else{
          echo '<a href="fan-artist-view.php?artist='.$artist.'">';
        }
        ?>
        <li id="<?php echo $row['artist_id']; ?>" class="artist-name"><span id="stage-name"><?php echo $row['artist_stagename']; ?></span><span class="artist-image-url"><?php echo $row['artist_profile_pic']; ?></span><span class="requests"><?php echo $row['requests']; ?></span><span class="confirmed-shows"><?php echo $confirmed_shows; ?></span><span id="artist-city" class="hidden-data"> <?php echo $row['artist_city']; ?></span><span id="genre" class="hidden-data"> <?php echo $row['main_genre']; ?></span></li></a>
          
        <form action="request-artist.php?artist=<?php echo $row['artist_id']; ?>" method="post">
           <button type="submit" name="request_artist" class="play-my-city">PlayMyCity</button>
          </form>

        <?php  }  ?> <!-- close while statement -->
        
      </ul>
    </div><!-- end artist-list-wrap -->

  </div> <!-- end artist-list-container -->
<!--
    <button id="rate">Rate</button>
    <button id="hate">Hate</button>
-->
  </section>

  <?php include('includes/footer.php'); ?>