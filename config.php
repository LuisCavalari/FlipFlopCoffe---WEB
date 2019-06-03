<?php
    define("BASE_URL","http://localhost/flipflop/");
    $dsn = "mysql:dbname=Flipflop;host=127.0.0.1";
    $dbuser = "root";
    $dbpass = "assembly@";
    global $pdo;
    try {
        $pdo = new PDO($dsn,$dbuser,$dbpass);
    } catch (PDOException $th) {
        echo $th->getMessage();
    }

?>