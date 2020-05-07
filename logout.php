<?php 
    session_start();
    //unset variable(s)
    if (isset($_SESSION['userid'])) {
        $firstname = $_SESSION['userid'];
        unset($_SESSION['userid']);
    }
    //end session
    session_destroy();
    //delete session cookie
    $name = session_name();
    $expire = strtotime('-1 year');
    $params = session_get_cookie_params();
    $path = $params['path'];
    $domain = $params['domain'];
    $secure = $params['secure'];
    $httponly = $params['httponly'];
    setcookie($name, '', $expire, $path, $domain, $secure, $httponly);

    include('view/header.php');
?>

    <main>
        <h1>"Inconceivable!" (`Vizzini)</h1>
        <br>
        <p>Thank you for visiting my page, "<?php echo $firstname ?>".<br> Hello. My name is Indigo Montoya. You killed my father. Prepare to die. ~Indigo Montoya</p>
        <p> Both quotes above are from "The Princess Bride", 1987</p> 
        <p>
            <a href="index.php">Click here</a> to go back to Amy's Movie quotes list.
        </p>
        <br>
    </main>

<?php include('view/footer.php'); ?>