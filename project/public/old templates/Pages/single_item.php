<!DOCTYPE html>
<html lang="en">
<?php
// Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : single_item.php
        // Description :this page displays the single producvt from the GET and offers the customer the oppertunity to update the order amount and add to the basket  (fresh start foods website Graded Unit)

//includes autoload function so classes can be called
include '/xampp/htdocs/Workspace/includes/autoload.inc.php';
// includes the header
include '/xampp/htdocs/Workspace/includes/header.inc.php';

    //new instance of basket class
if(isset($_POST['amount_to_order'])){
  //this holds all variable before adding to the databse
  $amount_to_order = $_POST['amount_to_order'];
  $product_name= $_POST['product_name'];
  $price_per_pack= $_POST['price_per_pack'];
  $pack_size= $_POST['pack_size'];
  $price_per_kg= $_POST['price_per_kg'];
  
 //calls add to basket and passes the variables to add
   $basket->add_to_basket($product_name,$price_per_pack,$pack_size,$price_per_kg,$amount_to_order);
   header('Location:../../Workspace/Pages/basket.php');
   }
    // if statement takes product name posted and fills the card from the database from the card name and provides form for amount to order 
    if(isset($_GET['product_name'])){
        $product_name = $_GET['product_name'];
        //new instance of product 
        $product = new Product();

        $product->retrieve_one_product($product_name);
        $product_ID = $product->get_product_ID();
        $product_name = $product->get_product_name();
        $type = $product->get_type();
        $price_per_pack = $product->get_price_per_pack();
        $pack_size = $product->get_pack_size();
        $price_per_kg = $product->get_price_per_kg();
        $product_description = $product->get_product_description();
        $product_img = $product->get_product_img();
        $in_stock = $product->get_in_stock();

    };
    //results of sql query are used to fill the card 
    
    echo '<section class="product">';
    echo '<div class="product">';
    echo '  <div class="productImage">';
    echo '      <img class="item" id="product_img" src="data:image/jpeg;base64,' . base64_encode($product_img) . '" alt=""/>';
    echo '     <h2 class="product_header"><span>Product Name - </span>'.$product_name.'</h2>'; 
    echo '  </div>';
    echo '  <h5 class="product_header"><span>type - </span>'.$type.'</h5>';
    echo '  <h5 class="product_header"><span>price per pack - </span>'.$price_per_pack.'</h5>';
    echo '  <h5 class="product_header"><span>pack size - </span>'.$pack_size.'</h5>';
    echo '  <h5 class="product_header"><span>price per kg - </span>'.$price_per_kg.'</h5>';
    echo '  <h5 class="product_description"><span>Product description - </span>'.$product_description.'</h5>';
    echo '  <h5 class="product_header">in stock: '.$in_stock.'</h5>'; 
    echo '</div>';
    echo '</section>';

  echo'  <form method="post" action="  ../../Workspace/Pages/single_item.php? amount_to_order">
            <input type="hidden" id="product_name" name="product_name" value="'.$product_name.'">
            <input type="hidden" id="price_per_pack" name="price_per_pack" value="'.$price_per_pack.'">
            <input type="hidden" id="pack_size" name="pack_size" value="'.$pack_size.'">
            <input type="hidden" id="price_per_kg" name="price_per_kg" value="'.$price_per_kg.'">
            <label for="amount_to_order">Amount to order:</label>
            <input type="number" id="amount_to_order" name="amount_to_order"><br><br>
            <button type="submit" class="btn btn-primary"  name="submit">Add to basket</button>'
  ?> 
  
  
  <?php
    // includes the footer
    include '/xampp/htdocs/Workspace/includes/footer.inc.php';
?>
   </html>