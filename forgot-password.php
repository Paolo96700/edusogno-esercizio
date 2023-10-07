<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" href="assets/styles/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
include "header.php";
?>
    <h1>Reset Password</h1>

    <div class="container">
        <div class="container_form">
            <form action="reset-password-logic.php" method="post" class="form">
                <label for="email">email</label>
                <input type="email" name="email" id="email">

                <button>Invia</button>
            </form>
        </div>
    </div>

    
</body>
</html>