<?php 
    $firstname = filter_input(INPUT_GET, 'firstname');
    include('view/header.php');
?>

    <main>
        <?php if ($firstname == NULL) { ?>
                
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get" id="register_form">
                <label for="firstname">Please enter your first name:</label>
                <input type="text" id="firstname" name="firstname" maxlength="50" required>
                <input type="submit" value="REGISTER" class="button blue">
            </form>

        <?php } else { 

                $lifetime = 60 * 60 * 24 * 7; //one week
                session_set_cookie_params($lifetime, '/');
                session_start();
                $_SESSION['userid'] = $firstname;
                
        ?>
            <h1>Thank you for registering, <?php echo $firstname ?>!</h1>
            <p>
                <a href="index.php">Click here</a> to view Amy's Movies list.
            </p>
            <br>
        <?php } ?>
    </main>

<?php include('view/footer.php'); ?>