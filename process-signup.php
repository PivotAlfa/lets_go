<?php
if (empty($_POST['name'])) {
    die('Please type your name');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die('Please input proper email adress');
} 

if (strlen($_POST['password'])<8) {
    die('Password should be at least 8 characters');
}

if (!preg_match("/[a-z]/i", $_POST['password'])) {
    die('Password should contain at least one letter');
}

if (!preg_match("/[0-9]/", $_POST['password'])) {
    die('Password should contain at least one number');
}

if ($_POST['password']!=$_POST['password_confirmation']) {
    die("Passwords didn't match");
}

$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$mysqli = require __DIR__ ."/connection.php";

$sql = "insert into user (username, email, password_hash) values(?,?,?)";
$stmt = $mysqli-> stmt_init();

if (! $stmt ->prepare($sql)) {die 
('SQL error occured'. $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);


if ($stmt->execute()){
    header("Location:signup-success.html");
    exit;
} else {
    if ($mysqli->errno === 1062)
        {
    die('this email is already taken');
        }
    else 
       {
         die($mysqli->error . " ". $mysqli->errno);
        }
    
    }

