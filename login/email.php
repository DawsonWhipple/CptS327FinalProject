<?php
    include_once 'header.php';
    require_once 'includes/functions.inc.php';
    if(isset($_POST["submit"])) {

        $verificationCode = $_SESSION["vCode"];
        $userVerificationCode = $_POST["verify"];
    
        if($userVerificationCode == $verificationCode){
            header("location: index.php");

        }
        else {
            session_start();
            session_unset();
            session_destroy();
            header("location: login.php?error=incorrectverification");
            exit();
        }
    
    }
?>

<section>
    <h2>Verify Email</h2>
    <form method="post">
        <input type="text" name="verify" placeholder="Verification Code"><br>
        <br>
        <button type="submit" name = "submit">verify</button>
    </form>
</section>