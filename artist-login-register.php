<?php include('includes/connect.php');
$pageTitle = 'PlayMyCity | Artist Registration';
  include('includes/header.php');
?>

<section id="section-login-page">
  <h1 class="form-heading">Artist Registration</h1>
  
  <form action="artist-registration.php" method="post">
    <table>
      <tr>
        <td><label for="artist_firstname">First Name</label></td>
        <td><input type="text" id="artist_firstname" name="artist_firstname" placeholder="Firstname" class="input-box"></td>
      </tr>
      
      <tr>
        <td><label for="artist_lastname">Last Name</label></td>
        <td><input type="text" id="artist_lastname" name="artist_lastname" placeholder="Last Name" class="input-box"></td>
      </tr>
      
      <tr>
        <td><label for="artist_stagename">Stage Name</label></td>
        <td><input type="text" id="artist_stagename" name="artist_stagename" placeholder="Stage Name" class="input-box"></td>
      </tr>
      
      <tr>
        <td><label for="artist_password">Password</label></td>
        <td><input type="password" id="artist_password" name="artist_password" placeholder="Password" class="input-box"></td>
      </tr>
      
      <tr>
        <td><label for="artist_city">City</label></td>
        <td>
          <select id="artist_city" name="artist_city" class="input-box">
            <option selected></option>
            <?php 
              while ($row = mysqli_fetch_assoc($cities)){
                echo '<option>'.$row['city_name'].'</option>';
              }
            ?>
          </select> 
        </td>
      </tr>
      
      <tr>
        <td><label for="main_genre">Main Genre</label></td>
        <td><select id="main_genre" name="main_genre" placeholder="Main Genre" class="input-box">
          <option selected></option>
          <?php 
              while ($row = mysqli_fetch_assoc($genres)){
                echo '<option>'.$row['genre_name'].'</option>';
              }
            ?>
          </select>
        </td>
      </tr>
       
      <tr>
        <td><label for="artist_email">E-mail</label></td>
        <td><input type="text" id="artist_email" name="artist_email" placeholder="E-mail" class="input-box"></td>
      </tr>
      
    </table>
    
    <button type="submit" name="artist_signup">Sign Up</button>  
  </form>
</section>

<?php include('includes/footer.php'); ?>