<?php
if (isset($_POST["reset-request-submit"])) {
    require 'dbh.inc.php';
    $email = $_POST["email"];
    if (empty($email)) {
        header("Location: ../reset-password.php?error=emptyfields");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../reset-password.php?error=invalidemail&email=" . $email);
        exit();
    } else {
        $sqle = "SELECT email FROM users WHERE email=?";
        $stmte = $PDOconn->prepare($sqle);
        $stmte->bindParam(1, $email, PDO::PARAM_STR);
        $stmte->execute();
        $resulte = ($stmte->rowCount());
        if ($resulte = 0) {
            header("Location: ../reset-password.php?error=emailnotfound&email=" .$email);
            exit();
        } else {
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);
            $url = ("http://localhost/WEBTEST/Html/index.php/create-new-password.php?selector=" . $selector . "$validator=" . bin2hex($token));
            $expires = date("U") + 1800;
            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
            $stmte = $PDOconn->prepare($sqle);
            $stmte->bindParam(1, $email, PDO::PARAM_STR);
            $stmte->execute();
            $sql = "INSERT INTO pwdReset (pwdRedetEmail, pwdRedetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
            $stmte = $PDOconn->prepare($sqle);
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            $stmte->bindParam(1, $email, PDO::PARAM_STR);
            $stmte->bindParam(2, $selector, PDO::PARAM_STR);
            $stmte->bindParam(3, $hashedToken, PDO::PARAM_STR);
            $stmte->bindParam(4, $expires, PDO::PARAM_STR);
            $stmte->execute();

            $stmt->$PDOconn = null;

            $to = $email;
            $subject = 'Reset your password for invoicesite';
            $message = '<p>We received a reset password request. The link to password reset is show below, if you have not 
    make this request, you can ignore this email</p>';
            $message .= '<p>Here is your password reset link:</br>';
            $message .=  '<a href"' . $url . '">' . $url . '</a></p>';
            $headers = "From: local <localmail@local.com>\r\n";
            $headers .= "Reply-To: local <localmail@local.com>\r\n";
            $headers .= "Content-type: text/html\r\n";
            mail($to, $subject, $message, $headers);
            header("Location: ../reset-password.php?reset=success");
        }
    }
} else {
    header("Location: ../index.php");
}
