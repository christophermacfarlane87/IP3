<!DOCTYPE html>
<html lang="en">
<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : staff_login.php
        // Description :this page displays the form to sign then checks details upon subition  (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';
//this holds all variable before adding to the databse
$found = false;
$msg = null;
$staff_PIN ="";
$staff_email ="";
$staff_password ="";

session_start();

// checks to see if the form has been submitted then validates the login 
if(isset($_POST['submit']))
{//new instance of login class
  $staff_login = new staff_login();
  $staff_email =$_POST['staff_email'];
  $staff_password=$_POST['staff_password'];
  $staff_PIN=$_POST['staff_PIN'];
  
  $found = $staff_login->validate_staff_Login($staff_email,$staff_password, $staff_PIN);
     //applies login to the session to keep staff logged in 
  if($found){
    $_SESSION['staff_email']=$staff_email;
    $_SESSION['staff_password']=$staff_password;

  }
  //redirects to the staff page
    }
    if(isset($_SESSION['staff_email'])){
    header('Location:../../Workspace/Pages/staff.php');

}
session_write_close();


?>
    
    <main>
    <form class="register-form" method="POST" action="../../Workspace/Pages/staff_login.php" name="Login">
  <div class="imgcontainer">
    <img src="../../Workspace/image/1.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    
    <label for="staff_email" ><b>Username</b></label>
    <input type="text" id= "staff_email" name ="staff_email" placeholder="staff_email" >
    <label for="staff_password"><b>staff_password</b></label>
    <input type="staff_password" id = "staff_password" name = "staff_password" placeholder="Enter staff_password"  >
    <label for="staff_PIN"><b>staff_PIN</b></label>
    <input type="staff_PIN" id = "staff_PIN" name = "staff_PIN" placeholder="Enter staff_password"  >
    <input class ="btn-primary login-button" type="submit" name="submit" id="submit" value="Login">
    <label>
     
    <br>
    
    <span class="psw">Forgot <a href="#">staff_password?</a></span>
 </form>
 <button class = "btn-primary login-button"type= "submit"><a href="../../Workspace/Pages/register.php">Register</a></button>
  </div>

    </main>
    <?php
       // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>