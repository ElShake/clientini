<?php
require "header.view.php";
?>

<main>
    <?php
    if (isset($_SESSION['UserId'])) {
      require "client.view.php";
    } else {
        echo '<p class"login-status">Please login!</p>';
    }
    ?>
</main>

<?php
require "footer.view.php";
?>