<!DOCTYPE html>
<html lang="en">
<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : staf_logout.php
        // Description :this page displays the form to sign out then then detroys session data  (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';
//if statement checks to see if form has been poster then destroys session and redirects to inde
if(isset($_POST['yes'])){
    session_start();
    $_SESSION = array();
    session_destroy();
    header("Location:../../Workspace/Pages/index.php");
}
//if statement checks to see if form has been posted then redirects to staff
if(isset($_POST['no'])){
    header("Location:../../Workspace/Pages/staff.php");
}

?>
    
    <main>
    <section class="register-form">
                <div >
                    <h1 >Logout</h1>
                    <form  method="post" action="../../Workspace/Pages/staff_logout.php" name="logout">
                        <p>Do you wish to logout?</p>
                        <input  type="submit" name="yes" value="Yes">
                        <input  type="submit" name="no" value="No">
                    </form>
                </div>
            </section>

    </main>
    <?php
    // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>