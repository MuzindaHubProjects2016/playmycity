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
        ?>
<!--       Populate artist list -->
           <a href="fan-artist-view.php?artist=<?php echo $row['artist_id']; ?>"><li id="<?php echo $row['artist_id']; ?>" class="artist-name"><span id="stage-name"> <?php echo $row['artist_stagename']; ?></span><span class="artist-image-url"><?php echo $row['artist_profile_pic']; ?></span><span class="requests"><?php echo $row['requests']; ?></span><span class="confirmed-shows"><?php echo $row['confirmed_shows']; ?></span></li></a>
          
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