<!DOCTYPE html>
<html lang="en">
<?php

// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : register.php
        // Description :this page is primarily for creating a new customer account (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';
 //this holds all variable before adding to the databse
    //new instance of customer class and company figures
    $customer = new Customer();
    $company_figures = new company_figures();
    $cust_ID ="";
    $company_ID="";
    $company_name ="";
    $first_name="" ;
    $last_name="";
    $email="";
    $phone_number="";
    $password="";
    $house_number="";
    $address_first_line="";
    $city="";
    $post_code="";

    $msg="";
//this if statement check to see if the form has been submitted and calls create new customer class and create new company 
    if (isset($_POST['submit'])){
        
        $company_ID=$_POST['company_ID'];
        $company_name=$_POST['company_name'];
        $first_name=$_POST['first_name'] ;
        $last_name=$_POST['last_name'];
        $email=$_POST['email'];
        $phone_number=$_POST['phone_number'];
        $password=$_POST['password'];
        $house_number=$_POST['house_number'];
        $address_first_line=$_POST['address_first_line'];
        $city=$_POST['city'];
        $post_code=$_POST['post_code'];
        $company_figures->create_new_company($company_ID,$company_name);
        $customer->create_new_customer($company_ID,$first_name,$last_name,$email,$phone_number,$password,$house_number,$address_first_line,$city,$post_code);
        }

?>
    
    <main>
    <form class="register-form" method="POST" action="../../Workspace/Pages/register.php" name="register">
  <label class ="register-label" for="company_ID"> Company ID(5 digits) :</label><br>
  <input class ="register-input" type="text" id="company_ID" name="company_ID" placeholder="******"><br> 
  <label class ="register-label" for="company_name"> Company Name :</label><br>
  <input class ="register-input" type="text" id="company_name" name="company_name" placeholder="Company Name"><br> 
  <label class ="register-label" for="first_name"> First Name :</label><br>
  <input class ="register-input" type="text" id="first_name" name="first_name" placeholder="First Name" required><br>
  <label class ="register-label" for="last_name"> Last name :</label><br>
  <input class ="register-input" type="text" id="last_name" name="last_name" placeholder="Last Name" required>
  <label class ="register-label" for="email"> Email Address :</label><br>
  <input class ="register-input" type="text" id="email" name="email" placeholder="E-mail"><br> 
  <label class ="register-label" for="phone_number"> Phone Number :</label><br>
  <input class ="register-input" type="text" id="phone_number" name="phone_number" placeholder="Phone Number" required> 
  <label class ="register-label" for="password"> Password :</label><br>
  <input class ="register-input" type="text" id="password" name="password" placeholder="Password" required> 
  <label class ="register-label" for="house_number"> House Number :</label><br>
  <input class ="register-input" type="text" id="house_number" name="house_number" placeholder="House Number" required> 
  <label class ="register-label" for="address_first_line"> Street :</label><br>
  <input class ="register-input" type="text" id="address_first_line" name="address_first_line" placeholder="Street" required><br>
  <label class ="register-label" for="city">City :</label><br>
  <input class ="register-input" type="text" id="city" name="city" placeholder="City" required>
  <label class ="register-label" for="post_code">Post Code :</label><br>
  <input class ="register-input" type="text" id="post_code" name="post_code" placeholder="Post Code" required><br>
  <input class ="btn-primary login-button" type="submit" name="submit" id="submit" value="Register">
</form>

    </main>
    <?php
         // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>