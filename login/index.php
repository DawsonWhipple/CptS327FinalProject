<?php
    include_once 'header.php';
?>

        <section>
            <h1>Homepage</h1>
            <?php
                if(isset($_SESSION["useruid"])) {
                    echo "<p>Logged in as: " . $_SESSION["useruid"] . "</p>";
                    echo "<li><a href= 'includes/logout.inc.php'>Logout</a></li>";
                }
                else {
                    echo "<p>click on the above links to be directed to the Sign Up page and Login page respectively.</p>";
                }
            ?>
        </section>

<?php
    include_once 'footer.php';
?>