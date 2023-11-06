
<?php
require_once("../utils/helper.php");

session_start();
    if(isset($_SESSION['user'])){
        header('Location: ../admin/index.php');
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
        <input type="password" class="mb-3" id="password" name="password" required>
            
            <button type="submit" style="margin-top:1.4rem">Login</button>
        </form>
        <a href="register-form.php">Register</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(title ,message, type, confirmText) {
            Swal.fire({
                title: title,
                text: message,
                icon: type,
                confirmButtonText: confirmText
            });
        }
        <?php 
        if(isset($_SESSION['flash_message'])){
            $message = $_SESSION['flash_message'];
            $func = "showAlert('" . $message['title'] . "','" . $message['message'] . "','". $message['type'] . "','" . $message['confirm_text'] . "')";
            echo $func;
            clearFlashMessage();
        } ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script></body>

</body>
</html>
