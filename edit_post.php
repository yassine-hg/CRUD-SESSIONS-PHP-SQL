<?php
include "database.php";

$db = connect();
$query = [];
$errorMessage = "";

if ($db) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $queryfetch = $db->prepare("SELECT * FROM posts WHERE id = :id");
        $queryfetch->execute(["id" => $id]);
        $query = $queryfetch->fetch(PDO::FETCH_ASSOC);

        if (!$query) {
            $errorMessage = "An error occurred. Please retry.";
        } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
            $title = $_POST["title"];
            $body = $_POST["body"];

            if (!empty($title) && !empty($body)) {
                $edite = $db->prepare("UPDATE posts SET title = :title, body = :body WHERE id= :id");
                $edite->execute([
                    ":title" => $title,
                    ":body" => $body,
                    ":id" => $id
                ]);
                if ($edite) {
                    header("Location: read_post.php");
                    exit;
                } else {
                    $errorMessage = "Error, try again.";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="edite_post.css">
</head>
<body>
    <div>
        <?php if ($errorMessage): ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form action="" method="post" class="edit-form">
            <h4>Edit Post</h4>
            <input type="text" name="title" placeholder="Title" value="<?php echo isset($query["title"]) ? $query["title"] : ""; ?>">
            <textarea name="body" placeholder="Body"><?php echo isset($query["body"]) ? $query["body"] : ""; ?></textarea>
            <input type="submit" value="Update" class="btn-submit">
        </form>
    </div>
</body>
</html>
