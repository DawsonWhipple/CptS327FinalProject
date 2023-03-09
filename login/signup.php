<?php
    include_once 'header.php';
?>

<section>
    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Full Name..."><br>
        <input type="text" name="email" placeholder="Email..."><br>
        <input type="text" name="uid" placeholder="Username..."><br>
        <input type="password" name="pwd" placeholder="Password..."><br>
        <input type="password" name="pwdrepeat" placeholder="Repeat Password..."><br>
        <br>
        <button type="submit" name = "submit">Sign Up</button>
    </form>
</section>
<?php
    if(isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        }
        else if($_GET["error"] == "invaliduid") {
            echo "<p>Choose a proper username!</p>";
        }
        else if($_GET["error"] == "invalidemail") {
            echo "<p>Choose a proper email!</p>";
        }
        else if($_GET["error"] == "passwordsdontmatch") {
            echo "<p>Passwords don't match!</p>";
        }
        else if($_GET["error"] == "stmtfailed") {
            echo "<p>Something went wrong, Try again!</p>";
        }
        else if($_GET["error"] == "usernametaken") {
            echo "<p>Username already in use!</p>";
        }
        else if($_GET["error"] == "none") {
        echo "<p>You have signed up!</p>";
        }
    }
?>

<?php
    include_once 'footer.php';
?>