<?php

class Product extends DB{
    // Author : Christopher Macfarlane
    // Date : 15/5/2023
    // Title : product.class.php
    // Description :class creation for product(fresh start foods website Graded Unit)



    //initiating all variables used
    private$product_ID;
    private$product_name;
    private$price_per_pack;
    private$pack_size;
    private$price_per_kg;
    private$product_description;
    private$product_img;
    private$type;
    private$in_stock;
    //default img covers any product that dont have an image on the table
    private$default_img = "../../Workspace/image/coming_soon.jpg";

    
    // sets and gets for all variables
    public function get_product_ID(){
        return $this->product_ID;
    }
    public function set_product_ID($product_ID){
        $this->product_ID =$product_ID;
    }
    public function get_product_img(){
        return $this->product_img;
    }
    public function set_product_img($product_img){
        $this->product_img =$product_img;
    }
    public function get_product_name(){
        return $this->product_name;
    }
    public function set_product_name($product_name){
        $this->product_name =$product_name;
    }
    public function get_price_per_pack(){
        return $this->price_per_pack;
    }
    public function set_price_per_pack($price_per_pack){
        $this->price_per_pack =$price_per_pack;
    }
    public function get_type(){
        return $this->type;
    }
    public function set_type($type){
        $this->type =$type;
    }
    public function get_pack_size(){
        return $this->pack_size;
    }
    public function set_pack_size($pack_size){
        $this->pack_size =$pack_size;
    }
    public function get_price_per_kg(){
        return $this->price_per_kg;
    }
    public function set_price_per_kg($price_per_kg){
        $this->price_per_kg =$price_per_kg;
    }
    public function get_product_description(){
        return $this->product_description;
    }
    public function set_product_description($product_description){
        $this->product_description =$product_description;
    }
    public function get_in_stock(){
        return $this->in_stock;
    }
    public function set_in_stock($in_stock){
        $this->in_stock =$in_stock;
    }
    public function get_default_img(){
        return $this->default_img;
    }
   
   
   // this function create a new product 
    public function create_new_product( $product_name,$type,$price_per_pack,$pack_size,$price_per_kg,$product_description,$in_stock){
        // Prepares an SQL statement to be executed by the execute() method
        $sql ="INSERT INTO product
        (product_name, type, price_per_pack,  pack_size, price_per_kg, product_description, in_stock)
        VALUE(:product_name, :type,  :price_per_pack,  :pack_size, :price_per_kg, :product_description, :in_stock)";
        //this try statement protects against SQL injection attacks
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':product_name',$product_name);
            $result->bindParam(':product_name',$product_name);
            $result->bindParam(':price_per_pack',$price_per_pack);
            $result->bindParam(':type',$type);
            $result->bindParam(':pack_size',$pack_size);
            $result->bindParam(':price_per_kg',$price_per_kg);
            $result->bindParam(':product_description',$product_description);
            $result->bindParam(':in_stock',$in_stock);
            $result->execute();
        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo $msg;
        }
    }
    //function for updating a product on the products table 
    public function update_product($product_name,$price_per_pack,$pack_size,$price_per_kg,$product_description,$type){
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "UPDATE product
                    SET type = :type,
                    price_per_pack = :price_per_pack,
                    pack_size = :pack_size,
                        price_per_kg = :price_per_kg,
                        product_description = :product_description
                        
                    WHERE product_name = :product_name";

                 //this try statement protects against SQL injection attacks
            try{
                $result =$this->dbConnect()->prepare($sql);
                $result->bindParam(':product_name',$product_name);
                $result->bindParam(':price_per_pack',$price_per_pack);
                $result->bindParam(':pack_size',$pack_size);
                $result->bindParam(':price_per_kg',$price_per_kg);
                $result->bindParam(':product_description',$product_description);
                $result->bindParam(':type',$type);
                $result->bindParam(':address_FL',$address_FL);
                $result->bindParam(':city',$city);
                $result->bindParam(':post_code',$post_code);
            }
            //the catch prints out any errors 
            catch(PDOException $e){
                $msg = "<h1>" . $e->getMessage() . "<h1>";
                echo $msg;
            }
    }
    // this function selects all product from the products table and lists them to be updated in a form 
    public function list_updating_products(){
        $row ="";
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT * FROM product "; // Limit to 5 items, change to your preferred limit and 'table' name
     
        //this try statement protects against SQL injection attacks
       try{
             $result = $this-> dbConnect()->prepare($sql);
             //$result->bindParam(':type', $type);
             $result->execute();
     
             $row = $result->fetchAll();
     
       }
       //the catch prints out any errors 
       catch(PDOException $e){
             $msg = "<h1>" . $e->getMessage() . "<h1>";
             echo  $msg;
        }
        //if statement echos all rows from the results
        if($row){
                echo'
                <table>
                <tr class ="row">
                <th>Product Name</th>
                <th>Product type</th>
                <th>Price per pack</th>
                <th>Pack size</th>
                <th>Price per KG</th>
                <th>Product Description</th>
                <th>Amount in stock</th>
                <th></th>';
            foreach ($row as $rs) {
                // Output the product as a card
                echo '<section>
                <tr class ="row">
                <form class="register-form" method="POST" action="../../Workspace/Pages/stock.php" name="register">
                
                <td class ="column">
                <label class ="register-label" for="product_name"> Product name :</label>
                <input class ="register-input" type="text" id="product_name" name="product_name" placeholder="'.$rs['product_name'].'">
                </td>
                <td class ="column">
                <label class ="register-label" for="type"> Product type :</label>
                <input class ="register-input" type="text" id="type" name="type" placeholder="'.$rs['type'].'">
                </td>
                <td class ="column">
                <label class ="register-label" for="price_per_pack"> Price per pack :</label>
                <input class ="register-input" type="text" id="price_per_pack" name="price_per_pack" placeholder="'.$rs['price_per_pack'].'">
                </td>
                <td class ="column">
                <label class ="register-label" for="pack_size"> Pack size :</label>
                <input class ="register-input" type="text" id="pack_size" name="pack_size" placeholder="'.$rs['pack_size'].'">
                </td>
                <td class ="column">
                <label class ="register-label" for="price_per_kg"> Price per KG :</label>
                <input class ="register-input" type="text" id="price_per_kg" name="price_per_kg" placeholder="'.$rs['price_per_kg'].'">
                </td>
                <td class ="column">
                <label class ="register-label" for="product_description"> Product description :</label>
                <input class ="register-input" type="text" id="product_description" name="product_description" placeholder="'.$rs['product_description'].'">
                </td>
                <td class ="column">
                <label class ="register-label" for="in_stock"> Amount in stock :</label>
                <input class ="register-input" type="text" id="in_stock" name="in_stock" placeholder="'.$rs['in_stock'].'">
                </td>
                <td class ="column">
                <input class ="btn-primary login-button" type="submit" name="submit" id="submit" value="Update">
                </td>
                </tr></section>'
                ; 
                
            }
        } 
        // prints if there are no rows in the table
        else {
            echo "No result Found";
        }
         echo'  </table>';
    }
        //this function retrieves products by type so they can be displayed 
    public function retrieve_cards($type){
      $basket = new Basket();

      
      $row ="";
        // Prepares an SQL statement to be executed by the execute() method
            $sql = "SELECT * FROM product WHERE type LIKE '$type' "; // Limit to 5 items, change to your preferred limit and 'table' name

        //this try statement protects against SQL injection attacks
        try{
                $result = $this-> dbConnect()->prepare($sql);
                //$result->bindParam(':type', $type);
                $result->execute();

                $row = $result->fetchAll();

        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo  $msg;
            
        }
         // Returns an array containing all of the remaining rows in the result set
    
        //if statment prints checks if the row have value 
        if($row){
   
            foreach ($row as $rs) {
                $this->set_product_name($rs['product_name']);
                $this->set_type($rs['type']);
                $this->set_price_per_pack($rs['price_per_pack']);
                $this->set_pack_size($rs['pack_size']);
                $this->set_price_per_kg($rs['price_per_kg']);
                $this->set_product_description($rs['product_description']);
                $this->set_product_img($rs['product_img']);
                $this->set_in_stock($rs['in_stock']);
                // Output the product as a card
                
           
            //this if statment uses the image on the database if there is one 
            if($this->get_product_img()!= null){
                echo '
                <div class = "card">
                <a href="../../Workspace/Pages/single_item.php? product_name='.$rs['product_name'].'">
                <img class = "card-image" src="data:image/jpeg;base64,'.base64_encode($this->get_product_img()).'" class="card-img-top" alt="..."></a>
                <div class="card-body">
                <h5 class="card-title">Name : '.$rs['product_name'].'</p>
                <h5 class="card-title">Price per pack : £'.$rs['price_per_pack'].'</p>
                <h5 class="card-title">Pack size : '.$rs['pack_size'].'g</p>
                <h5 class="card-title">Price per kg : £'.$rs['price_per_kg'].'</p>
                <p class="card-text">Product Description : '.$rs['product_description'].'</p>
                </div> 
                
                </div>
                '; 
            }
            //else statment applies a default image to any product that doesnt have an image in the table
            else{
                echo '
                <div class = "card">
                <a href="../../Workspace/Pages/single_item.php?product_name='.$rs['product_name'].'">
                <img class = "card-image" src="../../Workspace/image/coming_soon.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title">Name : '.$rs['product_name'].'</p>
                <h5 class="card-title">Price per pack : £'.$rs['price_per_pack'].'</p>
                <h5 class="card-title">Pack size : '.$rs['pack_size'].'g</p>
                <h5 class="card-title">Price per kg : £'.$rs['price_per_kg'].'</p>
                <p class="card-text">Product Description : '.$rs['product_description'].'</p>
                
                </div>
                <form method="post" action="  ../../Workspace/Pages/basket.php? product_name='.$rs['product_name'].'price_per_pack='.$rs['price_per_pack'].',pack_size='.$rs['pack_size'].',price_per_kg='.$rs['price_per_kg'].', amount_to_order">
                <label for="amount_to_order">Amount to order:</label>
                <input type="number" id="amount_to_order" name="amount_to_order"><br><br>
                <button type="submit" class="btn btn-primary"  name="submit">Add to Basket</button>
                </div>
                '; 
            }

         }
        } 
         //else print if no results are in the table
        else {
            echo "No result Found";
        }
   
    }
    //function deletes product with matching product ID 
    public function delete_product($product_ID){
        // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE FROM product WHERE product_ID = :product_ID";
        //this try statement protects against SQL injection attacks
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':product_ID',$product_ID);
            $result->execute();
        }
        //the catch prints out any errors 
        catch(PDOException $e)
        {
            $msg = "<h1>" .$e->getMessage() . "<h1>";
            echo $msg;

        }
    }
    //this function retrieves a single product
    public function retrieve_one_product($product_name){
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT * FROM product WHERE product_name = :product_name";
        //this try statement protects against SQL injection attacks
        try
        {
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':product_name', $product_name);
            $result->execute();
            $row = $result->fetch();
            $this->set_product_name($row['product_name']);
            $this->set_type($row['type']);
            $this->set_price_per_pack($row['price_per_pack']);
            $this->set_pack_size($row['pack_size']);
            $this->set_price_per_kg($row['price_per_kg']);
            $this->set_product_description($row['product_description']);
            $this->set_product_img($row['product_img']);
            $this->set_in_stock($row['in_stock']);
           

        }
        //the catch prints out any errors 
        catch(PDOException $e)
        {
            $msg = "<h1>" . $e->getMessage() . "</h1>";
            echo $msg;
        }

        return $row;

    }    


}