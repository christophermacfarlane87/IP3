<?php

   // Author : Christopher Macfarlane
        // Date : 15/5/2023
        // Title : header.inc.php
        // Description :an include for header (fresh start foods website Graded Unit)


     //this include posts a header to the page 

     //allows the basket to be added to on any page
$basket = new Basket();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Workspace/CSS/styles.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="banner">
        
            <a href="../../Workspace/Pages/index.php"><img src="../../Workspace/image/1.png" alt=""></a>
            <h1 class="page_title">Fresh Start Foods</h1>
           <a href="../../Workspace/Pages/basket.php"><img class="header-icons" src="../../Workspace/image/shopping_cart.png" alt=""></a>
           <a href="../../Workspace/Pages/previous_orders.php"><img class="header-icons" src="../../Workspace/image/truck.png" alt=""></a>
            <a href="../../Workspace/Pages/sign_in.php"><img class="header-icons" src="../../Workspace/image/user.png" alt=""></a>   </div>
        <section class="header-title-line">
        <button class="menu-button">
            <div class="menu-icon"></div> 
        </button>
     
         <nav >
                <ul>
                        <li><a href="../../Workspace/Pages/fresh-meat.php">Fresh Meat</a></li>
                        <li><a href="../../Workspace/Pages/fish.php">Fish</a></li>
                        <li><a href="../../Workspace/Pages/frozen.php">Frozen</a></li>
                        <li><a href="../../Workspace/Pages/dairy.php">Dairy</a></li>
                        <li><a href="../../Workspace/Pages/fruit-veg.php">Fruit & Veg</a></li>
                        <li><a href="../../Workspace/Pages/dry-store.php">Dry Store</a></li>
                        <li><a href="../../Workspace/Pages/desserts.php">Desserts</a></li>
                        <li><a href="../../Workspace/Pages/bakery.php">Bakery</a></li>
                        
                </ul>   
                   
        </nav>
                </section>
                
            
        
    </header>
