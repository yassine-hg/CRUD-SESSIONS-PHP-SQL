<?php

    include "database.php";

    $db = connect();

    if($db){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if(!empty($username) && !empty($email) && !empty($password)){
                $query = $db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :email, :password)");
                if($query->execute(["username"=>$username, "email"=>$email, "password"=>$password])){
                    header("Location: read_users.php");
                    exit;
                }else{
                    echo "Error";
                }
            }else{
                echo "Fill all the blanks";
            }
        }else{
            echo "Error in the database";
        }
    }

   
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h4>Enter your username</h4>
        <input type="text" name="username">
        <h4>email</h4>
        <input type="text" name="email">
        <h4>Enter your password</h4>
        <input type="password" name="password">
        <input type="submit">
    </form>
</body>
</html>
