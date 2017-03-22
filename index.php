<?php include('includes/connect.php');
$pageTitle = 'PlayMyCity';
  include('includes/header.php');
?>

<?php // Login Script
  if(isset($_POST['login'])){
    
    $user_type = $_POST['user_type'];
    $login_username = $_POST['login_username'];
    $login_password = $_POST['login_password'];
    
    if($user_type === 'Fan'){
      
      $sql = "SELECT * FROM playmycity_fans WHERE fan_username = '$login_username' AND fan_password = '$login_password' ";
      $result = mysqli_query($connect, $sql);
      $rowcount = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);
      
    }else{
      
      $sql = "SELECT * FROM playmycity_artists WHERE artist_stagename = '$login_username' AND artist_password = '$login_password' ";
      $result = mysqli_query($connect, $sql);
      $rowcount = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);
      
    }
    
    if($row){
      
      session_start();
      
      if($user_type === 'Fan'){
        $_SESSION['username'] = $row['fan_username'];
        $_SESSION['user_type'] = $user_type;
        header('Location: fan-profile.php'); 
      }else{
        $_SESSION['username'] = $row['artist_id'];
        $_SESSION['user_type'] = $user_type;
        header('Location: artist-profile.php');
      }
    }else{
      header('Location: index.php');
    }
    
  }
?>

<section id="section-login-page">
  
<!--
  Try to refactor so that there is only one form but with user type dropdown.
  If user type is 'Artist' add field 'Stage Name' & 'Main Genre'
  If user type is 'Artist' then save in playmycity_artists
  If user type is 'Fan' remove fields 'Stage Name' & 'Main Genre'
  If user type is 'Fan' then save in playmycity_fans
-->
 
  <div id="fan-login" class="login-type">
    <a href="fan-login-register.php" class="login-type">Fan Registration</a>
  </div>
  
  <div id="artist-login" class="login-type">
    <a href="artist-login-register.php" class="login-type">Artist Registration</a>
  </div>
   <a href="login.php" id="login-link">Log In</a>
</section>

<?php include('includes/footer.php'); ?>