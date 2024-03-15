<?php
class staff_login extends DB{

    // Author : Christopher Macfarlane
    // Date : 15/5/2023
    // Title : staff+login.class.php
    // Description :class creation for staff_login(fresh start foods website Graded Unit)


    //initiating all variables used
    private$staff_f_name ;
    private$staff_l_name;
    private$staff_email;
    private$staff_password;
    private$staff_PIN;
    private$found;
    private$name;

   // sets and gets for all variables
    public function get_staff_f_name(){
        return $this->staff_f_name;
    } 
    public function set_staff_f_name($staff_f_name){
        $this->staff_f_name =$staff_f_name;
    }
    public function set_staff_PIN($staff_PIN){
        $this->staff_PIN =$staff_PIN;
    } 
   
    public function get_staff_PIN(){
        return $this->staff_PIN;
    }
    public function get_name(){
        return $this->name;
    }
    public function set_name($name){
        $this->name =$name;
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
    public function get_found(){
        return $this->found;
    }
    public function set_found($found){
        $this->found =$found;
    }

    public function get_staff_password(){
        return $this->staff_password;
    }
    public function set_staff_password($staff_password){
        $this->staff_password =$staff_password;
    }
    //function checks if the login exists
    public function check_existing_sign_in( $staff_email,$staff_password,$staff_PIN){
        $found = False;
         // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT staff_email FROM staff
                WHERE staff_email = :staff_email";
        //this try statement protects against SQL injection attacks
        try
        {
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':staff_email', $this->staff_email);
            $result->execute();

            $rows = $result->fetch(PDO::FETCH_NUM);
            //if statement checking if row exists
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
    public function validate_staff_Login($staff_email, $staff_password,$staff_PIN){

    $found = False;
     // Prepares an SQL statement to be executed by the execute() method
    $sql = "SELECT staff_password, staff_PIN FROM staff
            WHERE staff_email = :staff_email";

        try
        {
            $result = $this->dbConnect()->prepare($sql);
            $result->bindParam(':staff_email', $staff_email);
            $result->execute();

            $row = $result->fetch(PDO::FETCH_ASSOC);
            
            if($row > 0){
                
                if(($staff_password == $row['staff_password'])&&($staff_PIN == $row['staff_PIN'])){
                    $found = True;
                }
                //echos message if login is wrong
                else
                {
                    $msg = "<h1> staff_password incorrect.</h1>";
                    echo $msg;
                }
            }
            //echos message if login is wrong
            else
            {
                $msg = "<h1>staff_email address or staff_password incorrect.</h1>";
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