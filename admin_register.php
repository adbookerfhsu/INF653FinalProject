<?php
    session_start();
    require_once('util/valid_admin.php');
    require('model/database.php'); 
    require('model/admin_db.php'); 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim(filter_input(INPUT_POST, 'username'));
        $password = trim(filter_input(INPUT_POST, 'password'));
        $confirmpassword = trim(filter_input(INPUT_POST, 'confirmpassword'));

        //check for empty username
        if (empty($username)) {
            $error_username = "Please enter a username.";
        } else if (strlen($username) < 5) {
            $error_username = "Username must be five characters or longer.";
        } else { 
            // see if the username already exists
            $query = "SELECT COUNT(*) 
                    FROM administrators 
                    WHERE username = :username";
            $statement = $db->prepare($query);
            $statement->bindParam(':username', $username);
            $statement->execute();
            
            if ($statement->fetchColumn()) {
                $error_username = "The username you entered is already taken.";
            } 
        }

        //check for empty password
        if (empty($password)) $error_password = "Please enter a password.";
        
        //check password against regex - had to comment out because supplied password didn't follow these rules
        //$res = array("options"=>array("regexp"=>"/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/"));
        //if(!filter_var($password, FILTER_VALIDATE_REGEXP, $res)) {
        //    $error_password = "Your password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
        //}
        //check password and password confirmation match
        if ($password != $confirmpassword) {
            $error_confirmpassword = "The passwords you entered did not match.";
        }
        //if no errors exist
        if (empty($error_username) && empty($error_password) && empty($error_confirmpassword)) {
            add_admin($username, $password);
            header("Location: admin.php");
        }
    }
    
?>
<?php include 'view/header_admin.php'; ?>
<main id="admin-login">
    <h2 id="admin_login_form">Register a new admin user</h2>
    <p>"I have a bad feeling about this!" <br>~Obi-Wan Kenobi, Star Wars I: The Phantom Menace, 1999. <br>(All fields Required.)</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" autofocus>
            <span class="error_message"><?php if(!empty($error_username)) echo $error_username; ?></span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <span class="error_message"><?php if(!empty($error_password)) echo $error_password; ?></span>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirmpassword" id="confirmpassword" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            <span class="error_message"><?php if(!empty($error_confirmpassword)) echo $error_confirmpassword; ?></span>
        </div>
        <div>
            <input type="submit" class="button blue" value="REGISTER">
        </div>
        <div>
        <?php include 'view/amyslinks.php'; ?>   
        </div>
    </form>
</main>
<?php include 'view/footer.php'; ?>