<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h4>Register to enter</h4>
        <input type="text" name="username" placeholder="username">
        <input type="password" name="password" placeholder="password">
        <input type="email" name="email" placeholder="Email here">
        <input type="submit" value="register">        
    </form>
</body>
</html>
<?php

    include "database.php";

    $db = connect();

    if($db){
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

            if(!empty($username) && !empty($password) && !empty($email)){
                $storing = $db->prepare("INSERT INTO users ( username, password, email) VALUES (:username, :password, :email)");
                $storing->execute([
                    ":username" => $username,
                    ":password" => $hashedpassword,
                    ":email"=>$email
                ]);
                if($storing){
                    echo "Sucess";
                }else{
                    echo "Error";
                }
            }else{
                echo "Fill all the information";
            }
        }
    }
?>
