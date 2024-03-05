<?php

class stock_count extends DB{

    // Author : Christopher Macfarlane
    // Date : 15/5/2023
    // Title : stock.class.php
    // Description :class creation for stock_count(fresh start foods website Graded Unit)


    //initiating all variables used
    private $count_ID;
    private $product_ID;
    private $product_name;
    private $type;
    private $price_per_pack;
    private $pack_size;
    private $price_per_kg;
    private $product_description;
    private $amount_in_stock;
    private $holding_value;
    private $subtotal;
    private $total_value;

    // sets and gets for all variables
    public function get_count_ID(){
        return $this->count_ID;
    }
    public function get_holding_product_ID(){
        return $this->product_ID;
    }
    public function get_holding_product_name(){
        return $this->product_name;
        
    }
    public function set_holding_product_name($product_name){
        $this->product_name =$product_name;
    }
    public function get_holding_type(){
        return $this->type;
    }
    public function set_holding_type($type){
        $this->type =$type;

    }
    public function get_holding_price_per_pack(){
        return $this->price_per_pack;
    }
    public function set_holding_price_per_pack($price_per_pack){
        $this->price_per_pack =$price_per_pack;

    }
    public function get_holding_pack_size(){
        return $this->pack_size;
    }
    public function set_holding_pack_size($pack_size){
        $this->pack_size =$pack_size;

    }
    public function get_holding_price_per_kg(){
        return $this->price_per_kg;
    }
    public function set_holding_price_per_kg($price_per_kg){
        $this->price_per_kg =$price_per_kg;

    }
    public function get_holding_product_description(){
        return $this->product_description;
    }
    public function set_holding_product_description($product_description){
        $this->product_description =$product_description;


    }
    public function get_holding_amount(){
        return $this->amount_in_stock;
    }
    public function set_holding_amount($amount_in_stock){
        $this->amount_in_stock =$amount_in_stock;

    }
    public function get_holding_value(){
        return $this->holding_value;
    }
    public function set_holding_value($holding_value){
        $this->holding_value =$holding_value;

    }
    public function get_sub_total_value(){
        return $this->subtotal;
    }
    public function set_sub_total_value($subtotal){
        $this->subtotal =$subtotal;

    }
    public function get_total_value(){
        return $this->total_value;
    }
    public function set_total_value($total_value){
        $this->total_value =$total_value;

    }
    // this function creates a new stock count 
    public function create_count( $count_ID, $product_ID,$product_name, $type, $price_per_pack, $pack_size,$price_per_kg, $product_description, $amount_in_stock, $holding_value, $subtotal, $total_value){
             // Prepares an SQL statement to be executed by the execute() method
            $sql ="INSERT INTO stock
            (count_ID, product_ID,product_name, type, price_per_pack, pack_size,price_per_kg, product_description, amount_in_stock, holding_value, subtotal, total_value)
            VALUE(:count_ID, :product_ID, :product_name, :type, :price_per_pack, :pack_size, :price_per_kg, :product_description, :amount_in_stock, :holding_value, :subtotal, :total_value)";
            //this try statement protects against SQL injection attacks 
            try{
                $result =$this->dbConnect()->prepare($sql);
                $result->bindParam(':countID',$count_ID);
                $result->bindParam(':product_ID',$product_ID);
                $result->bindParam(':product_name',$product_name);
                $result->bindParam(':price_per_pack',$price_per_pack);
                $result->bindParam(':pack_size',$pack_size);
                $result->bindParam(':price_per_kg',$price_per_kg);
                $result->bindParam(':product_description',$product_description);
                $result->bindParam(':amount_in_stock',$amount_in_stock);
                $result->bindParam(':holding_value',$holding_value);
                $result->bindParam(':subtotal',$subtotal);
                $result->bindParam(':total_value',$total_value);
            }
             //the catch prints out any errors
            catch(PDOException $e){
                $msg = "<h1>" . $e->getMessage() . "<h1>";
                echo $msg;
            }
     }
  
     // this function deletes a product based on product id 
    public function delete_product($product_ID){
         // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE FROM stock WHERE product_ID = :product_ID";
        //this try statement protects against SQL injection attacks 
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':product_ID',$product_ID);
            $result->execute();
        }//the catch prints out any errors
        catch(PDOException $e)
        {
            $msg = "<h1>" .$e->getMessage() . "<h1>";
            echo $msg;

        }
    }
    // this function updates values of products in the count
    public function update_count( $product_ID,$product_name, $type, $price_per_pack, $pack_size,$price_per_kg, $product_description, $amount_in_stock, $holding_value, $subtotal, $total_value){
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "UPDATE stock
        SET 
            product_ID = :product_ID,
            product_name = :product_name,
            type = :type,
            price_per_pack = :price_per_pack,
            pack_size = :pack_size,
            price_per_kg = :price_per_kg,
            product_description = :product_description,
            amount_in_stock = :amount_in_stock,
            holding_stock_value = :holding_stock_value,
            subtotal = :subtotal,
            total_value = :total_value
        WHERE user_ID = :user_ID";
        //this try statement protects against SQL injection attacks 
        try{
        $result =$this->dbConnect()->prepare($sql);
        $result->bindParam(':product_ID',$product_ID);
        $result->bindParam(':product_name',$product_name);
        $result->bindParam(':type',$type);
        $result->bindParam(':price_per_pack',$price_per_pack);
        $result->bindParam(':pack_size',$pack_size);
        $result->bindParam(':price_per_kg',$price_per_kg);
        $result->bindParam(':product_description',$product_description);
        $result->bindParam(':amount_in_stock',$amount_in_stock);
        $result->bindParam(':holding_stock_value',$holding_stock_value);
        $result->bindParam(':subtotal',$subtotal);
        $result->bindParam(':total_value',$total_value);
        }
        //the catch prints out any errors
        catch(PDOException $e){
        $msg = "<h1>" . $e->getMessage() . "<h1>";
        echo $msg;
        }
    }
    //this function deletes a count once it has been submitted
    public function delete_count(){
         // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE FROM stock WHERE count_ID = :count_ID";
        //this try statement protects against SQL injection attacks 
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':count_ID',$count_ID);
            $result->execute();
        }
        //the catch prints out any errors
        catch(PDOException $e)
        {
            $msg = "<h1>" .$e->getMessage() . "<h1>";
            echo $msg;

        }
    }
   
    

    }