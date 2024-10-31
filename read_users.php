<?php

    include "database.php";

    $db = connect();

    if($db){
        
        $fetch = $db->query("SELECT * FROM users");
        $queryfetch = $fetch->fetchAll(PDO::FETCH_ASSOC);

        if($queryfetch){
            echo "<table border='3'>";
            echo "<th>id</th><th>username</th><th>email</th><th>password</th>";

            foreach($queryfetch as $po){
                echo '<tr>';
                echo '<td>' . $po['id'] . '</td>';
                echo '<td>' . $po['username'] . '</td>';
                echo '<td>' . $po['email'] . '</td>';
                echo '<td>' . $po['password'] . '</td>';
                echo "<td><a href='update.php?id=" . $po['id'] . "'>Edit</a></td>";
                echo "<td><a href='delete.php?id=" . $po['id'] . "'>Delete</a></td>";
                echo '</tr>';
            }
            echo '</table>';
        }else{
            echo 'Error';
        }
    }else{
        echo "Error with the database";
    }
?>
