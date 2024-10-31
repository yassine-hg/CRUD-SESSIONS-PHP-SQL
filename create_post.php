<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="create_post.css">
</head>
<body>
    <form action="" method="post">
        <h4>Enter the Title</h4>
        <input type="text" name="title" placeholder="Post Title">
        <h4>Enter the Body</h4>
        <textarea name="body" rows="4" placeholder="Post Body"></textarea>
        <input type="submit" value="Submit">
        <div class="message">
            <?php
                include "database.php";
                $db = connect();
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $title = $_POST["title"];
                    $body = $_POST["body"];
                    $author_id = 1;
                    if (!empty($title) && !empty($body)) {
                        $send = $db->prepare("INSERT INTO posts (title, body, author_id) VALUES(:title, :body, :author_id)");
                        if ($send->execute(["title" => $title, "body" => $body, "author_id" => $author_id])) {
                            header("Location: read_post.php");
                            exit;
                        } else {
                            echo "Error double-checking.";
                        }
                    } else {
                        echo "Fill all the inputs.";
                    }
                } else {
                    echo "Error in the database.";
                }
            ?>
        </div>
    </form>
</body>
</html>
