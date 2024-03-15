<?php

class  completed_order extends DB{


    // Author : Christopher Macfarlane
    // Date : 15/5/2023
    // Title : completed_order.class.php
    // Description :class creation for completed_order(fresh start foods website Graded Unit)

    //initiating all variables used
    private $order_ref;
    private $order_price;
    

    // sets and gets for all variables
    public function getOrder_ref(){
        return $this->order_ref;
    }
    public function setOrder_ref($order_ref){
        $this->order_ref =$order_ref;

    }
    public function getOrder_price(){
        return $this->order_price;
    }
    public function setOrder_price($order_price){
        $this->order_price =$order_price;

    }
    // this function creates a new order 
    public function create_order($order_price){
        // Prepares an SQL statement to be executed by the execute() method
        $sql ="INSERT INTO completed_order
        ( order_price)
        VALUE( :order_price)";
    
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':order_price',$order_price);
            $result->execute();
           
          
        }
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo $msg;
        }}
        //function used to delete a completed order
    public function deleteOrder(){
       // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE FROM completed_order WHERE order_ref = :order_ref";
        //this try statement protects against SQL injection attacks
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':order_ref',$order_ref);
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
