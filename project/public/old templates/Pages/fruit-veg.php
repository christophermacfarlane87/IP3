

<!DOCTYPE html>
<html lang="en">
<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : fruit-veg.php
        // Description :this page is primarily for displaying all items of type fruit-veg  (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';
 //this holds all variable before adding to the databse
    //new instance of product class
$product = new Product();
$type = ""
?>
    
    <main>
    <h1>Fruit and Vegetables</h1>
    </section>
    <section class="cards">
<?php
//declares fruit-veg as type so only fruit-veg items are displayed
    $type = "fruit-veg";
   $product->retrieve_cards($type);
?></section>
    </main>
    <?php
    // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>