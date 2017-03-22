<?php 

$hostname = 'localhost';
$username = 'root';
$password = '';

$connect = mysqli_connect($hostname, $username, $password);

$selected = mysqli_select_db($connect,"playmycity");
//echo "Connected";

$artists = mysqli_query($connect,"SELECT * FROM playmycity_artists");
$fans = mysqli_query($connect, "SELECT * FROM playmycity_fans");
$cities = mysqli_query($connect, "SELECT * FROM cities");
$genres = mysqli_query($connect, "SELECT * FROM playmycity_genres");
$requests = mysqli_query($connect, "SELECT * FROM requests");
?>