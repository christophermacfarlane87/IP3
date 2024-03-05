<!DOCTYPE html>
<html lang="en">
<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : sign_in.php
        // Description :this page displaysthe form to sign then checks details upon subition  (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';
//this holds all variable before adding to the databse
   

$found = false;
$msg = null;

$email ="";
$password ="";
$first_name="" ;
$last_name="";
session_start();

// checks to see if the form has been submitted then validates the login 
if(isset($_POST['submit']))
{//new instance of Sign_in class
  $sign_in = new Sign_in();
  $email =$_POST['email'];
  $password=$_POST['password'];

  $found = $sign_in->validateLogin($email,$password);
    //applies login to the session to keep customer logged in 
  if($found){
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;

  }
    }
    //redirects to the customer account page 
    if(isset($_SESSION['email'])){
    header('Location:../../Workspace/Pages/account.php');

}
session_write_close();


?>
    
    <main>
    <form class="register-form" method="POST" action="../../Workspace/Pages/sign_in.php" name="Login">
  <div class="imgcontainer">
    <img src="../../Workspace/image/1.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    
    <label for="email" ><b>Username</b></label>
   
    <input type="text" id= "email" name ="email" placeholder="Email" >

    <label for="password"><b>Password</b></label>
    <input type="password" id = "password" name = "password" placeholder="Enter Password"  >
    <input class ="btn-primary login-button" type="submit" name="submit" id="submit" value="Login">
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    <br>
    <label for="newUser">Dont have an account?</label>
    <span class="psw">Forgot <a href="#">password?</a></span>
 </form>
 <button class = "btn-primary login-button"type= "submit"><a href="../../Workspace/Pages/register.php">Register</a></button>
  </div>

    </main>
    <?php
         // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>