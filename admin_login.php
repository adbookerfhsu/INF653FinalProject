<?php
    require('model/database.php'); 
    require('model/admin_db.php'); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim(filter_input(INPUT_POST, 'username'));
        $password = trim(filter_input(INPUT_POST, 'password'));

        if (empty($username)) $error_username = 'Please enter your username.';
        if (empty($password)) $error_password = 'Please enter your password.';

        if (empty($error_username) && empty($error_password)) {
            if (is_valid_admin_login($username, $password)) {
                session_start();
                $_SESSION['is_valid_admin'] = true;
                header("Location: admin.php");
            } else {
                $error_username = 'Username and password do not validate.';

            }
        }
    }
?>
<?php include 'view/header_admin.php'; ?>
<main>
    <h2>Admin Login - Please sign in!</h2>
    <p>"Just what do you think you are doing, Dave?" <br>~Hal--2001 A Space Odyssey, 1968. <br>(All fields required.)</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
            <span class="error_message"><?php if(!empty($error_username)) echo $error_username; ?></span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <span class="error_message"><?php if(!empty($error_password)) echo $error_password; ?></span>
        </div>
        <div>
            <input type="submit" class="button blue" value="LOG IN">
        </div>
    </form>
</main>
<?php include 'view/footer.php'; ?>