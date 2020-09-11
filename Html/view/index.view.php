<?php
require "header.view.php";
?>

<main>
    <?php
    if (isset($_SESSION['userId'])) {
      require "client.php";
    } else {
        echo '<p class"login-status">You are not logged!</p>';
    }
    ?>
</main>

<?php
require "footer.view.php";
?>