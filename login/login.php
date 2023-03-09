<?php
    include_once 'header.php';
?>

<section>
    <h2>Login</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="uid" placeholder="Email..."><br>
        <input type="password" name="pwd" placeholder="Password..."><br>
        <br>
        <button type="submit" name = "submit">Login</button>
    </form>
</section>

<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        }
        else if($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect Login!</p>";
        }
        else if($_GET["error"] == "incorrectverification") {
            echo "<p>Incorrect Verification Code!</p>";
        }
    }
?>

<?php
    include_once 'footer.php';
?>