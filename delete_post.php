<?php

    include "database.php";

    $db = connect();

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $delete = $db->prepare("DELETE FROM posts WHERE id=:id");
        $delete->execute(["id"=>$id]);

        if($delete){
            header('Location: read_post.php');
            exit;
        }else{
            echo "error";
        }
    }

?>
