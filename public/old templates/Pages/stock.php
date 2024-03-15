<!DOCTYPE html>
<html lang="en">
<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : stock.php
        // Description :this page is primarily for displaying all items for updating  (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';
  //new instance of product class
$product = new Product();
?>
    
    <main class ="product_update">
        <?php
        //calls the listed product to be updated 
$product->list_updating_products()
?>
    </main>
    <?php
       // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>