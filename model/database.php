<?php
    //local development server connection
    //$dsn = 'mysql:host=localhost;dbname=amysmoviequotes';
    //$username = 'root';
    

    // Heroku connection
    
    $dsn = 'mysql:host=ijj1btjwrd3b7932.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=jqjwqjkmgmhjdh3c';
    $username = 'wbw4wcacgmkn2no8';
    $password = 'x3v6w99cpfdr108c';
    
    try {
        //local development server connection
        //if using a $password, add it as 3rd parameter
       //$db = new PDO($dsn, $username);

        // Heroku connection
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>
