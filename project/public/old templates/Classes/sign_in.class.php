<?php
class Sign_in extends DB{
    // Author : Christopher Macfarlane
    // Date : 15/5/2023
    // Title : sign_in.class.php
    // Description :class creation for sign_in(fresh start foods website Graded Unit)




    //initiating all variables used

    private$first_name ;
    private$last_name;
    private$email;
    private$password;
    private$found;
    private$cust_ID;
    private$name;
    private$company_ID;

    // sets and gets for all variables
    public function get_first_name(){
        return $this->first_name;
    } 
    public function set_first_name($first_name){
        $this->first_name =$first_name;
    }
    public function set_cust_ID($cust_ID){
        $this->cust_ID =$cust_ID;
    } 
   
    public function get_cust_ID(){
        return $this->cust_ID;
    }
    public function set_company_ID($company_ID){
        $this->company_ID =$company_ID;
    } 
   
    public function get_company_ID(){
        return $this->company_ID;
    }
   
    public function get_name(){
        return $this->name;
    }
    public function set_name($name){
        $this->name =$name;
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
    public function get_found(){
        return $this->found;
    }
    public function set_found($found){
        $this->found =$found;
    }

    public function get_password(){
        return $this->password;
    }
    public function set_password($password){
        $this->password =$password;
    }
    // function that checks for existing login details
    public function check_existing_sign_in( $email,$password){
        $found = False;
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT email FROM customer
                WHERE email = :email";
        //this try statement protects against SQL injection attacks
        try
        {
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':email', $this->email);
            $result->execute();

            $rows = $result->fetch(PDO::FETCH_NUM);
            if($rows > 0){
                $found = True;
            }
        }
        //the catch prints out any errors 
        catch(PDOException $e)
        {
            $msg = "<h1>" . $e->getMessage() . "</h1>";
            echo $msg;
        }

        return $found;
    }

        
//function validates that email matches password 
    public function validateLogin($email, $password){

        $found = False;
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT password FROM customer
                WHERE email = :email";
        //this try statement protects against SQL injection attacks
        try
        {
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':email', $email);
            $result->execute();

            $row = $result->fetch(PDO::FETCH_ASSOC);
            // if statement checks if row with $email exists 
            if($row > 0){
                
                if(($password == $row['password'])){
                    $found = True;
                }
                // error checking for sign in 
                else
                {
                    $msg = "<h1> Password incorrect.</h1>";
                    echo $msg;
                }
            }
            // error checking for sign in 
            else
            {
                $msg = "<h1>Email address or Password incorrect.</h1>";
                echo $msg;
            }
    }
    //the catch prints out any errors 
    catch(PDOException $e)
    {
        $msg = "<h1>" . $e->getMessage() . "</h1$row>";
        echo $msg;
    }

    return $found;

}


}



    ?>