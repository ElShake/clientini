<?php
require "header.php";
?>


<main>
    <div class="wrapper-main">
        <section class="section-default">
            <form action="includes/reset-request.inc.php" class="row justify-content-center bg-light" method="POST">
                <div class="form-group bg-secondary m-2 p-2 rounded-5">
                    <h1 class="text-light text-center">SIGNUP</h1>
                    <p>An email will be send to you with the istruction to reset your password</p>
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'emptyfields') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Insert an Email!</><p></p>';
                        } elseif ($_GET['error'] == 'emailnotfound') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Email not found!</><p></p>';
                        } elseif ($_GET['error'] == 'invalidemail') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Invalid Email</><p></p>';
                        }
                    } elseif (isset($_GET['reset']) && $_GET['reset'] == 'success') {
                        echo '<p class="font-weight-bold text-center text-success text-red">Email sended!</><p></p>';
                    }
                    ?>
                    <input type="text" name="email" placeholder="place@holder.ph" class="form-control">
                    <p></p>
                    <button type="submit" name="reset-request-submit" class="form-control btn-primary btn-sm w-50 mx-auto">Send</button>
                    <?php
                    if (isset($_GET["reset"])) {
                        if ($_GET["reset"] == "success") {
                            echo '<p class="signupsuccess">Check your e-mail!</p>';
                        }
                    }

                    ?>
                </div>
            </form>
        </section>
    </div>

</main>


<?php
require "footer.php";
?>