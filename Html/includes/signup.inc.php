<?php
    if(isset($_POST['signup-submit'])){
        require 'dbh.inc.php';

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordr = $_POST['passwordr'];

        if(empty($username) || empty($email) || empty($password) || empty($passwordr)){
            header("Location: ../signup.php?error=emptyfields&user=".$username.'$email='.$email);
            exit();
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../signup.php?error=invalidemailuser");
            exit();
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
            header("Location: ../signup.php?error=invalidemail&user=".$username."&email=".$email);
            exit();
        }
        elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header("Location: ../signup.php?error=invalidemail&email=".$email);
            exit();
        }
        elseif ($password !== $passwordr){
            header("Location: ../signup.php?error=passwordcheck&user=".$username.'$email='.$email);
            exit();
        }
        else {
            $sql="SELECT username FROM users WHERE username=?";
            $stmt = $PDOconn->prepare($sql);
            $stmt->bindParam(1,$username, PDO::PARAM_STR);
            $stmt->execute();
            $result=($stmt->rowCount());
            $sqle="SELECT email FROM users WHERE email=?";
            $stmte = $PDOconn->prepare($sqle);
            $stmte->bindParam(1,$email, PDO::PARAM_STR);
            $stmte->execute();
            $resulte=($stmte->rowCount());
            if($result>0) {
                header("Location: ../signup.php?error=usertaken&email=".$email);
                exit();
            }
            elseif($resulte>0) {
                header("Location: ../signup.php?error=emailtaken&user=".$username);
                exit();
            }
            else{
                $sql = "INSERT INTO users(username,email,password) VALUES (?,?,?)";
                $stmt = $PDOconn->prepare($sql);
                $hpassword= password_hash($password, PASSWORD_DEFAULT);
                $stmt->bindParam(1,$username, PDO::PARAM_STR);
                $stmt->bindParam(2,$email, PDO::PARAM_STR);
                $stmt->bindParam(3,$hpassword, PDO::PARAM_STR);
                $stmt->execute();
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }

        $stmt->$PDOconn=null;
    }
