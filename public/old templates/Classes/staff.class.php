<?php

class staff extends DB{
    
    // Author : Christopher Macfarlane
    // Date : 15/5/2023
    // Title : staff.class.php
    // Description :class creation for staff(fresh start foods website Graded Unit)


    //initiating all variables used

    private $staff_ID;
    private $staff_PIN;
    private$staff_f_name ;
    private$staff_l_name;
    private$staff_email;
    private $staff_phone;
    private$staff_password;
    private $staff_house_num;
    private$staff_address;
    private $staff_city;
    private$staff_post_code;


      // sets and gets for all variables
    public function get_staff_ID(){
        return $this->staff_ID;
    }
    public function get_staff_PIN(){
        return $this->staff_PIN;
    }
    public function set_staff_PIN($staff_PIN){
        $this->staff_PIN =$staff_PIN;
    }
    public function get_staff_f_name(){
        return $this->staff_f_name;
    }
    public function set_staff_f_name($staff_f_name){
        $this->staff_f_name =$staff_f_name;
    }
    public function get_staff_l_name(){
        return $this->staff_l_name;
    }
    public function set_staff_l_name($staff_l_name){
        $this->staff_l_name =$staff_l_name;
    }
    public function get_staff_email(){
        return $this->staff_email;
    }
    public function set_staff_email($staff_email){
        $this->staff_email =$staff_email;
    }
    public function get_staff_phone(){
        return $this->staff_phone;
    }
    public function set_staff_phone($staff_phone){
        $this->staff_phone =$staff_phone;
    }
    public function get_staff_password(){
        return $this->staff_password;
    }
    public function set_staff_password($staff_password){
        $this->staff_password =$staff_password;
    }
    public function get_staff_house_num(){
        return $this->staff_house_num;
    }
    public function set_staff_house_num($staff_house_num){
        $this->staff_house_num =$staff_house_num;
    }
    public function get_staff_address(){
        return $this->staff_address;
    }
    public function set_staff_address($staff_address){
        $this->staff_address =$staff_address;
    }
    public function get_staff_city(){
        return $this->staff_city;
    }
    public function set_staff_city($staff_city){
        $this->staff_city =$staff_city;
    }
    public function get_staff_post_code(){
        return $this->staff_post_code;
    }
    public function set_staff_post_code($staff_post_code){
        $this->staff_post_code =$staff_post_code;
    }
    
   
    //function creates new staff member row on staff table
    public function create_new_staff($staff_PIN, $staff_f_name, $staff_l_name, $staff_email, $staff_phone, $staff_password,            $staff_house_num, $staff_address, $staff_city, $staff_post_code){
       // Prepares an SQL statement to be executed by the execute() method
       $sql = "INSERT INTO staff 
        (staff_PIN, staff_f_name, staff_l_name, staff_email, staff_phone, staff_password, staff_house_num, staff_address, staff_city, staff_post_code)
        VALUE(:staff_PIN, :staff_f_name, :staff_l_name, :staff_email, :staff_phone, :staff_password, :staff_house_num, :staff_address, :staff_city, :staff_post_code)";
       
       //this try statement protects against SQL injection attacks 
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':staff_PIN',$staff_PIN);
            $result->bindParam(':staff_f_name',$staff_f_name);
            $result->bindParam(':staff_l_name',$staff_l_name);
            $result->bindParam(':staff_email',$staff_email);
            $result->bindParam(':staff_phone',$staff_phone);
            $result->bindParam(':staff_password',$staff_password);
            $result->bindParam(':staff_house_num',$staff_house_num);
            $result->bindParam(':staff_address',$staff_address);
            $result->bindParam(':staff_city',$staff_city);
            $result->bindParam(':staff_post_code',$staff_post_code);
            $result->execute();
            
        }
        //the catch prints out any errors
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo  $msg;
        }
 
}
    // function updates existing staff member 
    public function update_user($staff_PIN,$staff_f_name,$staff_l_name,$staff_email,$staff_phone,$staff_password,$staff_house_num,$staff_address,$staff_city,$staff_post_code){
             // Prepares an SQL statement to be executed by the execute() method
            $sql = "UPDATE staff
                    SET staff_PIN = :staff_PIN,
                        staff_f_name = :staff_f_name,
                        staff_l_name = :staff_l_name,
                        staff_email = :staff_email,
                        staff_phone = :staff_phone,
                        staff_password = :staff_password,
                        staff_house_num = :staff_house_num,
                        staff_address = :staff_address,
                        staff_city = :staff_city,
                        staff_post_code = :staff_post_code
                    WHERE cust_ID = :cust_ID";
                    //this try statement protects against SQL injection attacks
            try{
                $result =$this->dbConnect()->prepare($sql);
                $result->bindParam(':staff_PIN',$staff_PIN);
                $result->bindParam(':staff_f_name',$staff_f_name);
                $result->bindParam(':staff_l_name',$staff_l_name);
                $result->bindParam(':staff_email',$staff_email);
                $result->bindParam(':staff_phone',$staff_phone);
                $result->bindParam(':staff_password',$staff_password);
                $result->bindParam(':staff_house_num',$staff_house_num);
                $result->bindParam(':staff_address',$staff_address);
                $result->bindParam(':staff_city',$staff_city);
                $result->bindParam(':staff_post_code',$staff_post_code);
                $result->execute();
            }
             //the catch prints out any errors 
            catch(PDOException $e){
                $msg = "<h1>" . $e->getMessage() . "<h1>";
                echo $msg;
            }
        }
    //function deletes a staff member matching staff ID
    public function delete_user($staff_ID){
         // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE FROM staff WHERE staff_ID = :staff_ID";
         //this try statement protects against SQL injection attacks
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':staff_ID',$staff_ID);
            $result->execute();
        }
    //the catch prints out any errors
        catch(PDOException $e)
        {
            $msg = "<h1>" .$e->getMessage() . "<h1>";
                echo $msg;
        }
    }
    // this function finds a staff member and store the details as variables based on staff ID
    public function find_staff($staff_ID){

            
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT * FROM staff WHERE staff_ID :staff_ID";
        //this try statement protects against SQL injection attacks
        try{
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam('staff_ID', $staff_ID);
            $result->execute();
         
            $row = $result->fetch();
            //if statment checks if the row is empty and binds the values to variables
            if($row >0){
                
                
                $this->set_staff_f_name($row['staff_f_name']);
                $this->set_staff_l_name($row['staff_l_name']);
                $this->set_staff_email($row['staff_email']);
                $this->set_staff_phone($row['staff_phone']);
                $this->set_staff_password($row['staff_password']);
                $this->set_staff_house_num($row['staff_house_num']);
                $this->set_staff_address($row['staff_address']);
                $this->set_staff_city($row['staff_city']);
                $this->set_staff_post_code($row['staff_post_code']);
            }
        }
             //the catch prints out any errors
        catch(PDOException $e){
                $msg = "<h1>" .$e->getMessage() . "<h1>";
                echo $msg;
        }
    }
}