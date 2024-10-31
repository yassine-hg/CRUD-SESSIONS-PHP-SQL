<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="read_post.css">
</head>
<body>
    <?php
        include "database.php";
        $db = connect();

        if($db){
            $query = $db->query("SELECT * FROM posts");
            $queryfetch = $query->fetchAll(PDO::FETCH_ASSOC);

            if($queryfetch){
                echo "<table>";
                echo "<tr><th>ID</th><th>Title</th><th>Body</th><th>Actions</th></tr>";

                foreach($queryfetch as $po){
                    echo "<tr>";
                    echo "<td>" . $po['id'] . "</td>";
                    echo "<td>" . $po['title'] . "</td>";
                    echo "<td>" . $po['body'] . "</td>";
                    echo "<td>
                        <a class='btn edit' href='edit_post.php?id=" . $po['id'] . "'>Edit</a>
                        <a class='btn delete' href='delete_post.php?id=" . $po['id'] . "'>Delete</a>
                    </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='message error'>No posts found.</p>";
            }
        } else {
            echo "<p class='message error'>Error with the database connection.</p>";
        }
    ?>
</body>
</html>
