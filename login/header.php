<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head> 
        <meta charset="utf-8">
        <title>cs327finalproject</title>
    </head>
    <body> 
        <h1>CS327 Final Project: 2FA Website</h1>
        <h2>Author: Dawson Whipple</h2>
        <nav>
            <div class="wrapper"> 
                <ul>
                <li><a href= 'index.php'>Home</a></li>
                    <?php
                        if(!isset($_SESSION["useruid"])) {
                            echo "<li><a href= 'signup.php'>Sign Up</a></li>";
                            echo "<li><a href= 'login.php'>Login</a></li>";
                            
                        }
                    ?>
                </ul>
            </div>
        </nav>
    <div class="wrapper">