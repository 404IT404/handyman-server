<?php 
    $host = "localhost";
    $db_user = "root";
    $db_name = "handyman_db";
    $db_password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connected Successfully";
    } catch (PDOException $error) {
        echo "Connect Failed: " . $error->getMessage();
    }
?>