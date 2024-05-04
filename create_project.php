<?php
    $servername = "localhost";
    $db_name = "octistudio";
    $db_username = "root";
    $db_password = "";
            
    $conn = new mysqli($servername, $db_username, $db_password, $db_name); // Connexion à la base de données

    if ($conn->connect_error) {
        exit("Connexion échouée :".$conn->connect_error);
    }

    $directory_location = 'projects/';

    $new_project_name = $_POST['new_project_name'];

    if (!file_exists($directory_location.$new_project_name)) {
        mkdir($directory_location.$new_project_name, 0755, true);
        echo "Le dossier du projet a été créé avec succès.";

        $sql = "INSERT INTO projects (name) VALUES ('$new_project_name')";
        if ($conn->query($sql) === TRUE) {
            echo "Le projet a été ajouté à la base de données avec succès.";
        } else {
            echo "Erreur lors de l'ajout du projet : " . $conn->error;
        }
    } else {
        echo "Le dossier du projet existe déjà.";
    }
?>