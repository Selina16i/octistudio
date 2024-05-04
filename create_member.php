<?php
    $servername = "localhost";
    $db_name = "octistudio";
    $db_username = "root";
    $db_password = "";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name); // Connexion à la base de données

    /*Vérifie la connexion*/
    if ($conn->connect_error) {
        exit("Connexion échouée :".$conn->connect_error);
    }

    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : 'client';
    $job = isset($_POST['job']) ? $_POST['job'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    $sql = "INSERT INTO members (last_name, first_name, role, job, email, password, date, status) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $last_name, $first_name, $role, $job, $email, $password, $status);
    
    if ($stmt->execute()) {
        echo "Registration succeed.";
    } else {
        echo "Error: ".$stmt->error;
    }

    $stmt->close();
    $conn->close();
?>