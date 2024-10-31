<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="" method="post">
        <h4>Enter Your Information to Log In</h4>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Log in">
        <div class="message">
            <?php
                include_once "database.php";
                $db = connect();
                if ($db) {
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        if (!empty($username) && !empty($password)) {
                            $select = $db->prepare("SELECT username, password FROM users WHERE username = :username");
                            $select->execute([":username" => $username]); 
                            $userdata = $select->fetch(PDO::FETCH_ASSOC); 
                            if ($userdata) {
                                if (password_verify($password, $userdata['password'])) {
                                    header('Location: create_post.php'); 
                                    $_SESSION['username'] = $username;
                                    exit;
                                } else {
                                    echo "Login failed: Incorrect password."; 
                                }
                            } else {
                                echo "Login failed: User not found."; 
                            }
                        } else {
                            echo "Please fill all the information."; 
                        }
                    }
                } else {
                    echo "Error connecting to the database."; 
                }
            ?>
        </div>
    </form>
</body>
</html>

