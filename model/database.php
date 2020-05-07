<?php
    //local development server connection
    $dsn = 'mysql:host=localhost;dbname=amysmoviequotes';
    $username = 'root';
    

    // Heroku connection
    
    //$dsn = 'mysql:host=o677vxfi8ok6exrd.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=YourJawsDBdbname';
    //$username = 'xk1zadb0rkai9ro3';
    //$password = 'chps6e6uir8o19l0';
    
    try {
        //local development server connection
        //if using a $password, add it as 3rd parameter
       $db = new PDO($dsn, $username);

        // Heroku connection
        //$db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>
