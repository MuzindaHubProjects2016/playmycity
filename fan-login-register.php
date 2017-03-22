<?php include('includes/connect.php');
$pageTitle = 'PlayMyCity | Fan Registration';
  include('includes/header.php');
?>

<section id="section-login-page">
  <h1 class="form-heading">Fan Registration</h1>

  <form action="fan-registration.php" method="post">
    
    <table>

      <tr>
        <td><label for="fan_username">Username</label></td>
        <td><input type="text" id="fan_username" name="fan_username" placeholder="Username" class="input-box"></td>
      </tr>

      <tr>
        <td><label for="fan_firstname">First Name</label></td>
        <td><input type="text" id="fan_firstname" name="fan_firstname" placeholder="First Name" class="input-box"></td>
      </tr>

      <tr>
        <td><label for="fan_lastname">Last Name</label></td>
        <td><input type="text" id="fan_lastname" name="fan_lastname" placeholder="Username" class="input-box"></td>
      </tr>
      
      <tr>
        <td><label for="fan_city">City</label></td>
        <td>
          <select id="fan_city" name="fan_city" class="input-box">
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
        <td><label for="fan_email">E-mail</label></td>
        <td><input type="text" id="fan_email" name="fan_email" placeholder="E-mail" class="input-box"></td>
      </tr>

      <tr>
        <td><label for="fan_password">Password</label></td>
        <td><input type="password" id="fan_password" name="fan_password" placeholder="Password" class="input-box"></td>
      </tr>

    </table>
    
    <button type="submit" name="fan_signup">Sign Up</button>  
  </form>
</section>

<?php include('includes/footer.php'); ?>