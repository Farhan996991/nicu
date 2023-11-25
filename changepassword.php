<?php
session_start();

// Check if the user is logged in, replace with your session validation logic
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Include your database configuration file (e.g., "dbconfig.php")
    include "dbconfig.php";

    // Define the user ID
    $userid = $_SESSION['userid'];

    // Query the database to retrieve the hashed password for the user
    try {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user WHERE userid = :userid");
        $stmt->bindParam(":userid", $userid);
        $stmt->execute();

        if ($stmt->rowCount() < 1) {
            // User not found
            header("Location: login.php?invalid");
            exit();
        }

        $result = $stmt->fetch();

        // Verify the old password
        if (md5($oldPassword) == $result['password']) {
            // Check if the new password matches the confirmation
            if ($newPassword === $confirmPassword) {
                // Hash and update the new password in the database
                $hashedNewPassword = md5($newPassword);

                // Update the user's password in the database
                $updateStmt = $conn->prepare("UPDATE user SET password = :newPassword WHERE userid = :userid");
                $updateStmt->bindParam(":newPassword", $hashedNewPassword);
                $updateStmt->bindParam(":userid", $userid);
                $updateStmt->execute();

                // Redirect to a success page
                
                ?>
                <script>
                    alert("Password Change Successfully");
                    window.location.href = "index.php";
                </script>
                <?php
                exit();
            } else {
                // Password confirmation does not match
                
                ?>
                <script>
                    alert("Password confirmation does not match");
                    window.location.href = "index.php";

                </script>
                <?php
                exit();
            }
        } else {
            // Old password is incorrect
            

            ?>
                <script>
                    alert("Old password is incorrect");
                    window.location.href = "index.php";
                </script>
                <?php
            exit();
        }
    } catch (PDOException $e) {
        header("Location: index.php?error=database");
        exit();
    }
}
?>
