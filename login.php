<?php 
$is_invalid = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST'){ 
    $mysqli = require __DIR__ ."/connection.php";
    $sql = sprintf("Select * from user where email = '%s'", $mysqli-> real_escape_string($_POST['email']));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    


if ($user){
    if(password_verify($_POST['password'],$user['password_hash'])){
        session_start();
        session_regenerate_id();
        $_SESSION['user_id']= $user['id'];
        header("Location:index.php");
        exit;
    };
    }
    $is_invalid = true;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="/js/validation.js" defer></script>
</head>

<body>
    <h1>Login</h1>
    <?php if ($is_invalid): ?>
        <em>Invalid Login</em>
    <?php endif;?>    
    
    <form method="post">
        
        <div>
            <label for="email">email</label>
            <input type="email" id="email" name="email" value = "<?=htmlspecialchars($_POST['email']?? " ")?>">

        </div>
        
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        
        
        <button>Login</button>
    </form>
    

</body>