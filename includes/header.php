<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/responsive.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="<?php if ($pageTitle === 'PlayMyCity' || $pageTitle === 'PlayMyCity | Fan Registration' || $pageTitle === 'PlayMyCity | Artist Registration') { echo "landing-page"; } ?>">
<div class="wrapper">
<header class="<?php if($pageTitle !== 'PlayMyCity' && $pageTitle !== 'PlayMyCity | Fan Registration' && $pageTitle !== 'PlayMyCity | Artist Registration') {echo "shadow";}else{echo "landing-page-header";}?>">

  <div id="logo">
  <a href="<?php if(isset($_SESSION['username'])){
                    if($_SESSION['user_type'] === 'Artist'){
                      echo 'index.php';
                    }else{
                      echo 'artists.php';
                      }
                  }else{ 
                    echo 'index.php';
                  } ?>">
    <img src="img/play-my-city-Official-orange.png" class="logo-image">
  <!--      <h1>PlayMyCity</h1>-->
  </a>
  </div> <!-- end logo -->

    <nav>
      <ul>
        

      </ul>
    </nav>
      <input type="text" name="search" placeholder="Search..." class="searchbox input-box">
  <div id="profile-details"><span>
    <?php if(isset($_SESSION['username'])){
            if(isset($_SESSION['user_type'])){
              $user_type = $_SESSION['user_type'];
              if($user_type === 'Fan'){
                echo '<a id="profile-link" href="fan-profile.php?fan='.$_SESSION['username'].'">'.$_SESSION['username'].'</a>';
              }else{
                echo '<a id="profile-link" href="artist-profile.php?artist='.$_SESSION['username'].'">'.$_SESSION['stagename'].'</a>';
              }
            } 
     }else{
    echo "Guest";
    } ?>
    </span><span><?php if(isset($_SESSION['username'])){echo'<a href="logout.php" id="logout-link">Logout</a>';} ?></span></div>
</header>
<div class="container">