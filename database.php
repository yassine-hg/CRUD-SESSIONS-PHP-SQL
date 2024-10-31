<?php 

    function connect(){

        $hostname = "localhost";
        $dbname = "blog_systems";
        $username = "blog_systems";
        $password = "blog12344";
        
        $dsn = "mysql::host=$hostname;dbname=$dbname";

        try{
            return new PDO($dsn, $username, $password);
        }catch(Exception $e){
            echo $e->getMessage();
            return null;
        }
    }

?>
