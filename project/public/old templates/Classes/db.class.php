<?php

class DB {
    // Author : Christopher Macfarlane
    // Date : 15/5/2023
    // Title : db.class.php
    // Description :class creation for DB(fresh start foods website Graded Unit)



    //initiating all variables used
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dataBaseName = "fsfdatabase";


    //this function connects to the database
    protected function dbConnect() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dataBaseName;
        //this try statement protects against SQL injection attacks
        try {
            $pdo = new PDO($dsn, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
        //the catch prints out any errors 
        catch(PDOException $e) {
            echo "<h1>Database connection failed.</h1><br>";
            exit($e->getMessage());
        }

    }

}