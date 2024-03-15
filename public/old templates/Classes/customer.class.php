<?php

class Customer extends DB{

    // Author : Christopher Macfarlane
// Date : 15/5/2023
// Title : Customer.class.php
// Description :class creation for Customer(fresh start foods website Graded Unit)


    //initiating all variables used
    private $cust_ID;
    private$company_ID;
    private$first_name ;
    private$last_name;
    private$email;
    private $phone_number;
    private$password;
    private $house_number;
    private$address_first_line;
    private $city;
    private$post_code;
    
    // sets and gets for all variables
    public function get_cust_ID(){
        return $this->cust_ID;
    }
    public function get_company_ID(){
        return $this->company_ID;
    }
    public function set_company_ID($company_ID){
        $this->company_ID =$company_ID;
    }
    public function get_first_name(){
        return $this->first_name;
    }
    public function set_first_name($first_name){
        $this->first_name =$first_name;
    }
    public function get_last_name(){
        return $this->last_name;
    }
    public function set_last_name($last_name){
        $this->last_name =$last_name;
    }
    public function get_email(){
        return $this->email;
    }
    public function set_email($email){
        $this->email =$email;
    }
    public function get_phone_number(){
        return $this->phone_number;
    }
    public function set_phone_number($phone_number){
        $this->phone_number =$phone_number;
    }
    public function get_password(){
        return $this->password;
    }
    public function set_password($password){
        $this->password =$password;
    }
    public function get_house_number(){
        return $this->house_number;
    }
    public function set_house_number($house_number){
        $this->house_number =$house_number;
    }
    public function get_address_first_line(){
        return $this->address_first_line;
    }
    public function set_address_first_line($address_first_line){
        $this->address_first_line =$address_first_line;
    }
    public function get_city(){
        return $this->city;
    }
    public function set_city($city){
        $this->city =$city;
    }
    public function get_post_code(){
        return $this->post_code;
    }
    public function set_post_code($post_code){
        $this->post_code =$post_code;
    }
   
    // this function is called on the register page and creates an new customer
    public function create_new_customer($company_ID, $first_name, $last_name, $email, $phone_number, $password, $house_number, $address_first_line, $city, $post_code){
        
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "INSERT INTO customer 
        (company_ID, first_name, last_name, email, phone_number, password, house_number, address_first_line, city, post_code)
        VALUE(:company_ID, :first_name, :last_name, :email, :phone_number, :password, :house_number, :address_first_line, :city, :post_code)";
        //this try statement protects against SQL injection attacks
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':company_ID',$company_ID);
            $result->bindParam(':first_name',$first_name);
            $result->bindParam(':last_name',$last_name);
            $result->bindParam(':email',$email);
            $result->bindParam(':phone_number',$phone_number);
            $result->bindParam(':password',$password);
            $result->bindParam(':house_number',$house_number);
            $result->bindParam(':address_first_line',$address_first_line);
            $result->bindParam(':city',$city);
            $result->bindParam(':post_code',$post_code);
            $result->execute();
            
        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo  $msg;
        }
 
    }
    // this function selects 1 customer from the customer table based on the email so it can be updated 
    public function get_customer($email){
   
    // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT * FROM customer WHERE email = :email";
        //this try statement protects against SQL injection attacks
        try
        {
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':email', $email);
            $result->execute();
            
            $row = $result->fetch();
            if($row > 0){
                
                
                $this->set_email($row['email']);
                $this->set_first_name($row['first_name']);
                $this->set_last_name($row['last_name']);
                $this->set_password($row['password']);
                $this->set_phone_number($row['phone_number']);
                $this->set_house_number($row['house_number']);
                $this->set_address_first_line($row['address_first_line']);
                $this->set_city($row['city']);
                $this->set_post_code($row['post_code']);
                
            }
        }
        //the catch prints out any errors 
        catch(PDOException $e)
        {
            $msg = "<h1>" . $e->getMessage() . "</h1>";
            echo $msg;
        }
    }
    //this function updates the customer that was found by the find_customer function
    public function update_customer($email,$first_name,$last_name,$phone_number,$password,$house_number,$address_first_line,$city,$post_code){
   
            $this->set_first_name($first_name);
            $this->set_last_name($last_name);
            $this->set_phone_number($phone_number);
            $this->set_password($password);
            $this->set_house_number($house_number);
            $this->set_address_first_line($address_first_line);
            $this->set_city($city);
            $this->set_post_code($post_code);
            // Prepares an SQL statement to be executed by the execute() method 
            $sql = "UPDATE customer 
                    SET 
                        first_name = :first_name,
                        last_name = :last_name,
                        phone_number = :phone_number,
                        password = :password,
                        house_number = :house_number,
                        address_first_line = :address_first_line,
                        city = :city,
                        post_code = :post_code;
                        WHERE email = $email";
           //this try statement protects against SQL injection attacks
            try{
                $result =$this->dbConnect()->prepare($sql);
                $result->bindParam(':first_name',$first_name);
                $result->bindParam(':last_name',$last_name);
                $result->bindParam(':phone_number',$phone_number);
                $result->bindParam(':password',$password);
                $result->bindParam(':house_number',$house_number);
                $result->bindParam(':address_first_line',$address_first_line);
                $result->bindParam(':city',$city);
                $result->bindParam(':post_code',$post_code);
                $result->execute();
            }
            //the catch prints out any errors 
            catch(PDOException $e){
                $msg = "<h1>" . $e->getMessage() . "<h1>";
                echo $msg;
            }
            
    }
    //this function deletes the customer based on the customer ID 
    public function delete_user($cust_ID){

        // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE FROM customer WHERE cust_ID = :cust_ID";
        //this try statement protects against SQL injection attacks
        
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':cust_ID',$cust_ID);
            $result->execute();
        }
        //the catch prints out any errors 
        catch(PDOException $e)
        {
            $msg = "<h1>" .$e->getMessage() . "<h1>";
            echo $msg;
        }
    }
    // this function selects 1 customer from the customer table based on the email so it can be updated 
    public function find_customer($cust_ID){

        $found = false;
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT * FROM customer WHERE cust_ID :cust_ID";
        //this try statement protects against SQL injection attacks
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam('cust_ID', $cust_ID);
            $result->execute();
         
            $row = $result->fetch();
            if($row >0){
                $found =true;
                
                $this->set_first_name($row['first_name']);
                $this->set_last_name($row['last_name']);
                $this->set_email($row['email']);
                $this->set_phone_number($row['phone_number']);
                $this->set_password($row['password']);
                $this->set_house_number($row['house_number']);
                $this->set_address_first_line($row['address_first_line']);
                $this->set_city($row['city']);
                $this->set_post_code($row['post_code']);
            }}
            //the catch prints out any errors 
            catch(PDOException $e)
            {
                $msg = "<h1>" .$e->getMessage() . "<h1>";
                echo $msg;
        
            }
        }
}

