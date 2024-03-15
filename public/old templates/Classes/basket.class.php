 

<?php
Class Basket extends DB{
// Author : Christopher Macfarlane
// Date : 15/5/2023
// Title : basket.class.php
// Description :class creation for Basket(fresh start foods website Graded Unit)



//initiating all variables used
    private$product_name;
    private$price_per_pack;
    private$pack_size;
    private$price_per_kg;
    private$amount_to_order;
    private$cost;
    private$total=0;
    private$temp;
    // sets and gets for all variables
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
    public function get_amount_to_order(){
        return $this->amount_to_order;
    }
    public function set_amount_to_order($amount_to_order){
        $this->amount_to_order =$amount_to_order;
    }
    public function set_cost($cost){
        $this->cost =$cost;
    }
    public function get_cost(){
        return $this->cost;
    }
    public function set_total($total){
        
        $this->total =$total;
    }
    public function get_total(){
        return $this->total;
    }
    public function set_temp($temp){
        
        $this->temp =$temp;
    }
    public function get_temp(){
        return $this->temp;
    }
    // function to  add up the total price of the order in the basket
    public function add_to_total(){
       $temp= $this->get_temp();
       $temp_total= $this->get_total();
            $total =$temp_total=$temp;
            $this->set_total($total);
    }
    // function to retrieve SUM cost from database
    public function calculate_total(){
        // Prepares an SQL statement to be executed by the execute() method
            $sql ="SELECT SUM(cost)  FROM basket ";
            try{
            $result=$this->dbConnect()->prepare($sql);
            
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                $msg = "<h1>" . $e->getMessage() . "<h1>";
                echo $msg;
            }
            
            if($row){
                
                echo'
                
                <table>
                
                <tr>
                   
                <th>Order Total</th>';
                 //displays all the rows from the data base as the sum of all costs.
                foreach ($row as $rs) {
                    echo'Order Total    : £  ';
                     echo $rs;
                     echo '<form class="register-form" method="GET" action="../../Workspace/Pages/previous_orders.php? order_price  " name="register">
                      <input type="hidden" id="order_price" name="order_price" value="'.$rs.'">
                      <input class ="btn-primary login-button" type="submit" name="submit" id="submit" value="Place Order">
                            </form>';
                       
                    }} 
                    //else statment prints if no records exist in the table.
            else {
                echo "No result Found";
             }
        
          
    } 
    // function to set the cost ready to be entered into the table 
    public function calculate_cost($amount_to_order,$price_per_pack){
       $amount_to_order=$this->get_amount_to_order();
       $price_per_pack=$this->get_price_per_pack();
       $cost =$amount_to_order * $price_per_pack;
       $this->set_cost($cost);
    }


    // this function adds a product to the basket from the single item page and runs the other functions to calculate cost
    public function add_to_basket($product_name,$price_per_pack,$pack_size,$price_per_kg,$amount_to_order
    ){
        $this->set_amount_to_order($amount_to_order);
        $this->set_price_per_pack($price_per_pack);
        $this->calculate_cost($amount_to_order,$price_per_pack);
        $cost=$this->get_cost();
        // Prepares an SQL statement to be executed by the execute() method
        $sql ="INSERT INTO basket
        (product_name, price_per_pack,  pack_size, price_per_kg, amount_to_order, cost)
        VALUE(:product_name, :price_per_pack,  :pack_size, :price_per_kg, :amount_to_order, :cost)";
    //this try statment protects against sql injection attacks
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':product_name',$product_name);
            $result->bindParam(':price_per_pack',$price_per_pack);
            $result->bindParam(':pack_size',$pack_size);
            $result->bindParam(':price_per_kg',$price_per_kg);
            $result->bindParam(':amount_to_order',$amount_to_order);
            $result->bindParam(':cost',$cost);
            $result->execute();
        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo $msg;
        }

    } //this function deletes the basket from the basket page when the order is placed 
    public function delete_basket(){
        // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE  FROM basket";

        try{
            $result = $this->dbConnect()->prepare($sql);
           
            $result->execute();
        }
        catch(PDOException $e)
        {
            $msg = "<h1>" .$e->getMessage() . "<h1>";
            echo $msg;
    
        }


    }

   // retrieves all rows from the basket table and prints them to the screen 
    public function retrieve_basket(){

        $row ="";
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "SELECT * FROM basket "; 
        // Executes a prepared statement
       try{
             $result = $this-> dbConnect()->prepare($sql);
             
             $result->execute();
     
             $row = $result->fetchAll();
     
       }
       catch(PDOException $e){
         $msg = "<h1>" . $e->getMessage() . "<h1>";
         echo  $msg;
        }
        if($row){
        echo'
        
        <table>
        <tr>
            <th>Product Name</th>
            <th>Price per pack</th>
            <th>Pack size</th>
            <th>Price per KG</th>
            <th>Amount to order</th>
            <th>Cost</th>
            <th></th>';
            //prints each row with a form to update the amount to be orders
            foreach ($row as $rs) {
               
         echo '<tr>
                        <td>
                        '.$rs['product_name'].'
                        </td>
                        <td>
                        £'.$rs['price_per_pack'].'
                        </td>
                        <td>
                    '.$rs['pack_size'].'g
                        </td>
                        <td>
                        £ '.$rs['price_per_kg'].'
                        </td>
                        <td>
                        <form class="register-form" method="GET" action="../../Workspace/Pages/basket.php? amount_to_order " name="register">
                            <input type="hidden" id="product_name" name="product_name" value='.$rs['product_name'].'>
                            <input type="hidden" id="price_per_pack" name="price_per_pack" value="'.$rs['price_per_pack'].'">
                            <input type="hidden" id="pack_size" name="pack_size" value="'.$rs['pack_size'].'">
                            <input type="hidden" id="price_per_kg" name="price_per_kg" value="'.$rs['price_per_kg'].'">
                            <label class ="register-label" for="amount_to_order">  :</label>
                            <input class ="register-input" type="number" id="amount_to_order" name="amount_to_order" value="'.$rs['amount_to_order'].'">
                        </td>
                        <td>
                        '.$rs['cost'].'
                        </td>
                    <td>
                        <input class ="btn-primary login-button" type="submit" name="update" id="update" value="Update">
                        </form>
                        </td>
            </tr>'; 
                
            }
        } 
        //else stament print if no rows are in the table 
        else {
            echo "No result Found";
        }
        echo'  </table>';

    }
    //this function is called when the amount is updated by the user on the basket page
    public function update_amount($product_name,$amount_to_order,$price_per_pack){
        $this->set_amount_to_order($amount_to_order);
        $this->set_price_per_pack($price_per_pack);
        $this->calculate_cost($amount_to_order,$price_per_pack);
        $cost=$this->get_cost();
       
        echo $cost;
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "UPDATE basket
        SET amount_to_order = :amount_to_order,
        cost = :cost
        WHERE product_name = :product_name";
        //this try statement protects against SQL injection attacks
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':product_name',$product_name);
            $result->bindParam(':amount_to_order',$amount_to_order);
            $result->bindParam(':cost',$cost);
            $result->execute();
        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo $msg;
        }

    }

}
?>