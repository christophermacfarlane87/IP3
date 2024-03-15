<?php
   // Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : account-nav.inc.php
        // Description :an include for autoloading classes(fresh start foods website Graded Unit)


     //this include allows classes to be called through the website



spl_autoload_register('Autoload');
//this function create a file path to the classes 
function Autoload($className){
    $path = "/xampp/htdocs/Workspace/classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;
    $fullPath = strtolower($fullPath);
    
    if(!file_exists($fullPath)){
        return false;
    }
    include_once $fullPath;

}
