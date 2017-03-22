<?php 
include('includes/connect.php');

$flag = true; //TODO: Start with true instead then set false when a field is empty to avoid last item resetting the flag to true

if(isset($_POST['fan_signup'])){ //CHECK if there are any missing fields

foreach($_POST as $key => $value){
  if(empty($_POST[$key])){   // !$value means value is empty
    if($key != "fan_signup"){
      $flag = false; //flag should be set here since were are excluding fan_signup. put outside this if, $flag will always be false
      echo $key." is missing <br>";
    }
  }
}

//CHECK if username is already used and redirect to enter a different username

$exists = false;

while ($row = mysqli_fetch_assoc($fans)){
  if($_POST['fan_username'] === $row['fan_username']){
    $exists = true;    
  }
}

  if(!$exists) {
    if($flag) {
      $fan_username = $_POST['fan_username'];
      $fan_firstname = $_POST['fan_firstname'];
      $fan_lastname = $_POST['fan_lastname'];
      $fan_password = $_POST['fan_password'];
      $fan_email = $_POST['fan_email'];
      $fan_city = $_POST['fan_city'];
      //$fan_profile_pic = $_POST['fan_profile_pic'];

      $sql = "INSERT INTO playmycity_fans VALUES ('$fan_username', '$fan_firstname', '$fan_lastname', '$fan_password', '$fan_email', '$fan_city', '' )";
      //with mysqli you dont have to specify the column names first
      mysqli_query($connect, $sql);
    }else{
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