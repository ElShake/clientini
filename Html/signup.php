<?php
require "header.php";
?>


<main>
    <div class="wrapper-main">
        <section class="section-default">
            <?php
                if(isset($_GET["newpwd"])){
                    if($_GET["newpwd"]== "passwordupdated"){
                        echo '<p class="signupsuccess">Your password has been reset!</p>';
                    }
                }
             else {?>
            <form action="includes/signup.inc.php" class="row justify-content-center bg-light" method="POST">
                <div class="form-group bg-secondary m-2 p-2 rounded-5">
                    <h1 class="text-light text-center">SIGNUP</h1>
                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'emptyfields') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Fill in all fields</><p></p>';
                        } elseif ($_GET['error'] == 'invalidemailuser') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Invalid Email and User</><p></p>';
                        } elseif ($_GET['error'] == 'invaliduser') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Invalid User</><p></p>';
                        } elseif ($_GET['error'] == 'invalidemail') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Invalid Email</><p></p>';
                        } elseif ($_GET['error'] == 'passwordcheck') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Passwords doesn' . "'" . 't match</><p></p>';
                        } elseif ($_GET['error'] == 'usertaken') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Username already exist</><p></p>';
                        } elseif ($_GET['error'] == 'emailtaken') {
                            echo '<p class="font-weight-bold text-center text-danger text-red">Email already exist</><p></p>';
                        }
                    } elseif (isset($_GET['signup']) && $_GET['signup'] == 'success') {
                        echo '<p class="font-weight-bold text-center text-success text-red">Signup successfull!</><p></p>';
                    }
                    ?>
                    <input type="text" name="username" placeholder="Username" class="form-control">
                    <p></p>
                    <input type="text" name="email" placeholder="place@holder.ph" class="form-control">
                    <p></p>
                    <input type="password" name="password" placeholder="Not your birthday" class="form-control">
                    <p></p>
                    <input type="password" name="passwordr" placeholder="Repeat password" class="form-control">
                    <p></p>
                    <button type="submit" name="signup-submit" class="form-control btn-primary btn-sm w-50 mx-auto">Signup</button>
                    <p></p>
                    <a href="reset-password.php" class="text-center">Forgot your password?</a>
                </div>
            </form>
                <?php }?>
        </section>
    </div>

</main>


<?php
require "footer.php";
?>