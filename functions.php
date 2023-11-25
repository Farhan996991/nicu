<?php
    include "dbconfig.php";

function login($userid, $password2)
{
    if (!is_null($userid) && !is_null($password2)) {
        try {
            global $conn;
            $stmt = $conn->prepare("SELECT * from user where userid = :userid");
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            if ($stmt->rowCount() < 1) {
                // User not found
                header("Location: login.php?invalid");
                exit();
            }
            $result = $stmt->fetch();
            // var_dump($result['password'], md5($password2));die;
            if (md5($password2) == $result['password']) {
                // Password is correct
                session_start();
                $_SESSION['userid'] = $result['userid'];
                $_SESSION['name'] = $result['name'];
                header("Location: index.php"); // Redirect to the main dashboard
                exit();
            } else {
                // Incorrect password
                header("Location: login.php?invalid");
                exit();
            }
        } catch (PDOException $e) {
            header("Location: login.php?error2");
            exit();
        }
    } else {
        header("Location: login.php?error1");
        exit();
    }
}

?>