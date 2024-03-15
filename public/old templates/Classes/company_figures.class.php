<?php


class company_figures extends DB{
    // Author : Christopher Macfarlane
// Date : 15/5/2023
// Title : company_figures.class.php
// Description :class creation for company_figures(fresh start foods website Graded Unit)


    //initiating all variables used
    private $company_ID;
    private $company_name;
    private $gp_budget;
    private $sales;
    private $sales_target;
    private $budget_hit;
    private $cost_sales;
    private $holding_stock_value;
    private $spend;

    // sets and gets for all variables
    public function get_company_ID(){
        return $this->company_ID;
    }
    public function set_company_ID($company_ID){
        $this->company_ID =$company_ID;
    
        }
    public function get_budget(){
        return $this->gp_budget;
    }
    public function set_budget($gp_budget){
        $this->gp_budget =$gp_budget;

    }
    public function get_company_name(){
        return $this->company_name;
    }
    public function set_company_name($company_name){
        $this->company_name =$company_name;

    }
    public function get_sales(){
        return $this->sales;
    }
    public function set_sales($sales){
        $this->sales =$sales;

    } 
    public function get_sales_target(){
        return $this->sales_target;
    }
    public function set_sales_target($sales_target){
        $this->sales_target =$sales_target;

    }
    public function get_budget_hit(){
        return $this->budget_hit;
    }
    public function set_budget_hit($budget_hit){
        $this->budget_hit =$budget_hit;

    }
    public function get_cost_sales(){
        return $this->cost_sales;
    }
    public function set_cost_sales($cost_sales){
        $this->cost_sales =$cost_sales;

    }
    public function get_holding(){
        return $this->holding_stock_value;
    }
    public function set_holding($holding_stock_value){
        $this->holding_stock_value =$holding_stock_value;

    }
    public function get_spend(){
        return $this->spend;
    }
    public function set_spend($spend){
        $this->spend =$spend;

    }

    //function to create a new set of company figures ready to creat a stock take 
    public function create_new_figures($gp_budget, $sales, $sales_target, $budget_hit, $cost_sales, $holding_stock_value, $spend){
        
        // Prepares an SQL statement to be executed by the execute() method
        $sql ="INSERT INTO company_figures
        (gp_budget, sales, sales_target, budget_hit, cost_sales, holding_stock_value, spend)
        VALUE(:gp_budget, :sales, :sales_target, :budget_hit, :cost_sales, :holding_stock_value, :spend)";
        //this try statement protects against SQL injection attacks
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':gp_budget',$gp_budget);
            $result->bindParam(':sales',$sales);
            $result->bindParam(':sales_target',$sales_target);
            $result->bindParam(':budget_hit',$budget_hit);
            $result->bindParam(':cost_sales',$cost_sales);
            $result->bindParam(':holding_stock_value',$holding_stock_value);
            $result->bindParam(':spend',$spend);
            $result->execute();
        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo $msg;
        }
        
    }
    // this function is used for the creation of a new compan in the company table
    public function create_new_company($company_ID, $company_name){
        // Prepares an SQL statement to be executed by the execute() method
       $sql ="INSERT INTO company_figures
        (company_ID, company_name)
        VALUE( :company_ID, :company_name)";
        //this try statement protects against SQL injection attacks
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':company_ID',$company_ID);
            $result->bindParam(':company_name',$company_name);
            $result->execute();
           
        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo $msg;
        }
    }
    // this function is used for updating of a company in the company table
    public function update_company_details(){
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "UPDATE company_figures
        SET GP_budget = :Gp_budget,
            sales = :sales,
            sales_target = :sales_target,
            budget_hit = :budget_hit,
            cost_sales = :cost_sales,
            holding_stock_value = :holding_stock_value,
            spend = :spend,
        WHERE company_ID = :company_ID";
        //this try statement protects against SQL injection attacks
        try{
            $result =$this->dbConnect()->prepare($sql);
            $result->bindParam(':GP_budget',$GP_budget);
            $result->bindParam(':sales',$sales);
            $result->bindParam(':sales_target',$sales_target);
            $result->bindParam(':budget_hit',$budget_hit);
            $result->bindParam(':cost_sales',$cost_sales);
            $result->bindParam(':holding_stock_value',$holding_stock_value);
            $result->bindParam(':spend',$spend);
            $result->execute();
        }
        //the catch prints out any errors 
        catch(PDOException $e){
            $msg = "<h1>" . $e->getMessage() . "<h1>";
            echo $msg;
        }

    }
    // this function is used for updating of a company_figures in the company_figures table
    public function update_figures(){
        // Prepares an SQL statement to be executed by the execute() method
        $sql = "UPDATE company_figures
                    SET GP_budget = :Gp_budget,
                        sales = :sales,
                        sales_target = :sales_target,
                        budget_hit = :budget_hit,
                        cost_sales = :cost_sales,
                        holding_stock_value = :holding_stock_value,
                        spend = :spend,
                    WHERE company_ID = :company_ID";
                    //this try statement protects against SQL injection attacks
            try{
                $result =$this->dbConnect()->prepare($sql);
                $result->bindParam(':GP_budget',$GP_budget);
                $result->bindParam(':sales',$sales);
                $result->bindParam(':sales_target',$sales_target);
                $result->bindParam(':budget_hit',$budget_hit);
                $result->bindParam(':cost_sales',$cost_sales);
                $result->bindParam(':holding_stock_value',$holding_stock_value);
                $result->bindParam(':spend',$spend);
                $result->execute();
            }
            catch(PDOException $e){
                $msg = "<h1>" . $e->getMessage() . "<h1>";
                echo $msg;
            }
    }
    public function delete_figures($company_ID){
        // Prepares an SQL statement to be executed by the execute() method
        $sql ="DELETE FROM company_figures WHERE company_ID = :company_ID";
    //this try statement protects against SQL injection attacks
    try{
        $result = $this->dbConnect()->prepare($sql);
        $result->bindParam(':company_ID',$company_ID);
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