<!DOCTYPE html>
<html lang="en">

<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : index.php
        // Description :this page is primarily for displaying all items   (fresh start foods website Graded Unit)

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
        <section>
        <h1>Fruit and Vegetables</h1>
    </section>
        <section class="cards">
<?php
//declares fruit-veg as type so only fruit-veg items are displayed
    $type = "fruit-veg";
   $product->retrieve_cards($type);
?></section>
    <section>
        <h1>Fresh Meats</h1>
    </section>
        <section class="cards">
<?php
//declares Fresh-meat as type so only Fresh-meat items are displayed
    $type = "Fresh-meat";
   $product->retrieve_cards($type);
?></section>
   <section>
        <h1>Frozen</h1>
    </section>
        <section class="cards">
<?php
//declares Frozen as type so only Frozen items are displayed
    $type = "Frozen";
   $product->retrieve_cards($type);
?></section>
    <section>
        <h1>Fish</h1>
    </section>
        <section class="cards">
<?php
//declares Fish as type so only Fish items are displayed
    $type = "Fish";
   $product->retrieve_cards($type);
?></section>
    <section>
        <h1>Dairy</h1>
    </section>
        <section class="cards">
<?php
//declares Dairy as type so only Dairy items are displayed
    $type = "Dairy";
   $product->retrieve_cards($type);
?></section>
    <section>
        <h1>Drystore</h1>
    </section>
        <section class="cards">
<?php
//declares Drystore as type so only Drystore items are displayed
    $type = "Drystore";
   $product->retrieve_cards($type);
?></section>
    <section>
        <h1>Desserts</h1>
    </section>
        <section class="cards">
<?php
//declares Desserts as type so only Desserts items are displayed
    $type = "Desserts";
   $product->retrieve_cards($type);
?></section>
    <section>
        <h1>Bakery</h1>
    </section>
        <section class="cards">
<?php
//declares bakery as type so only bakery items are displayed
    $type = "Bakery";
   $product->retrieve_cards($type);
?></section>
       


    </main>
    <?php
     // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>