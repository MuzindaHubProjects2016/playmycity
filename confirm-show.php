<?php 
$pageTitle = 'PlayMyCity | Confirm Show';
include('includes/header.php');
include('includes/connect.php');

if(isset($_SESSION['username'])){
$artist = $_SESSION['username'];
$city_name = $_GET['city']; 
  
$sql="SELECT city_id FROM cities WHERE city_name = '$city_name'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$city = $row['city_id'];

echo $artist;
echo $city;
//Add new confirmed_shows table
$confirm_show = "INSERT INTO confirmed_shows VALUES ('$artist', '$city', '1')";
mysqli_query($connect, $confirm_show);

//header('Location: artist-profile.php?artist='.$artist);

}else{
  header('Location: login.php');
}
?>

<?php include('includes/footer.php'); ?>