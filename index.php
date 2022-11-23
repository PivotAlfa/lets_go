<?php
session_start();
if (isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ ."/connection.php";
    $sql = "Select * from user where id = {$_SESSION['user_id']}";
    $result = $mysqli-> query($sql);
    $user = $result->fetch_assoc();

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
        <script src="/js/validation.js" defer></script>
    </head>
    <body>
        
        <h1>Welcome Home</h1>
        <?php if(isset($user)):?>
            <p>Hi <?= htmlspecialchars($user['username'])?></p>
            <p>
                <a href="log-out.php">Log out</a>
            </p>
        <?php else:?>
            <p>
                <a href = "login.php">Log in</a> or <a href="signup.html">Sign up</a>
            </p>
        <?php endif;?>
    </body>
</html>