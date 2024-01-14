<?php 
    include "../../model/database/db_connection.php";

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        $username = filter_var($data['username'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = $data['password'];

        $hashed_password =  password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = "INSERT INTO client (username, password) VALUES (:username, :password)";
            $query = $conn->prepare($stmt);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $query->execute();
            
            echo json_encode(["message" => "User created successfully"]);
        } catch (PDOException $error) {
            echo json_encode(["error" => "Error: " . $e->getMessage()]);
        }
    }
?>