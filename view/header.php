<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INF 653 Final Project by Amy Booker</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="view/css/main.css" />
</head>

<!-- the body section -->
<body>
    <header>
        <img src="view/amysmoviequotes.png" alt="Amys Logo" class="center"/>
            <h1>Amy's Movie Quotes</h1>
        </div>
        <div id="pageLinks">
            <?php 
                session_start();
                if (!isset($_SESSION['userid'])) {
            ?>
                <p>
                    <a href="register.php">Register</a>
                </p>
            <?php } else { 
                $userid = $_SESSION['userid'];
            ?>
                <p>
                    Welcome <?php echo $userid ?>! (<a href="logout.php">Sign Out</a>)
                </p>
            <?php } ?>
        </div>
    </header>