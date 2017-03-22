<?php 
include('includes/connect.php');

$flag = true; //TODO: Start with true instead then set false when a field is empty to avoid last item resetting the flag to true

if(isset($_POST['artist_signup'])){ //CHECK if there are any missing fields

foreach($_POST as $key => $value){
  if(empty($_POST[$key])){   // !$value means value is empty
    if($key != "artist_signup"){
      $flag = false; //flag should be set here since were are excluding fan_signup. put outside this if, $flag will always be false
      echo $key." is missing <br>";
    }
  }
}


//CHECK if username is already used and redirect to enter a different username
  
$exists = false;

while ($row = mysqli_fetch_assoc($artists)){
  if($_POST['artist_stagename'] === $row['artist_stagename']){
    $exists = true;    
  }
}
  if(!$exists){
    if($flag){
      $artist_stagename = $_POST['artist_stagename'];
      $artist_password = $_POST['artist_password'];
      $artist_firstname = $_POST['artist_firstname'];
      $artist_lastname = $_POST['artist_lastname'];
      //$requests = $_POST['requests'];
      //$confirmed_shows = $_POST['confirmed_shows'];
      $main_genre = $_POST['main_genre'];
      $artist_city = $_POST['artist_city'];
      //$artist_profile_pic = $_POST['artist_profile_pic'];

      $sql = "INSERT INTO playmycity_artists VALUES ('','$artist_stagename', '$artist_password', '$artist_firstname', '$artist_lastname', '', '', '$main_genre', '$artist_city', '' )";
      //with mysqli you dont have to specify the column names first
      mysqli_query($connect, $sql);
      header('Location: login.php');
    }else {
      echo "Please fill in the Missing Field";
    }
  }else{
    echo "Username Unavailable";
  }
  
}else{
  echo 'No data to process';
}

?>
<?php include('includes/footer.php'); ?>