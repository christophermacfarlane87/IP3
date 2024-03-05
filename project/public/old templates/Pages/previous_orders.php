<!DOCTYPE html>
<html lang="en">
<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : previous orders.php
        // Description :this page is primarily for displaying all  previous orders  (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';
 //this holds all variable before adding to the databse
    //new instance of Basket class and completed order class
$completed_order = new completed_order();
$basket = new Basket();

// if statment check if order has been posted and lists order then deletes current basket
if(isset($_GET['order_price'])){
    $order_price = $_GET['order_price'];
   
    $completed_order->create_order($order_price); 
    $basket->delete_basket();
     }

?>
    
    <main>


    <h1> Order is complete!</h1>
    </main>
    <?php
     // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>