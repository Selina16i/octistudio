<?php
    $servername = "localhost";
    $db_name = "octistudio";
    $db_username = "root";
    $db_password = "";
            
    $conn = new mysqli($servername, $db_username, $db_password, $db_name); // Connexion à la base de données

    if ($conn->connect_error) {
        exit("Connexion échouée :".$conn->connect_error);
    }

    $project_id = $_GET['project_id'];
    $project_name = $_POST['project_name'];
    
    $directory_location = "projects/".$project_name."/";

    $new_task_name = $_POST['new_task_name'];

    if (!file_exists($directory_location.$new_task_name)) {
        mkdir($directory_location.$new_task_name, 0755, true);
        echo "Le dossier de la tâche a été créé avec succès.";

        $sql = "INSERT INTO tasks (name, project_id) VALUES ('$new_task_name', '$project_id')";
        if ($conn->query($sql) === TRUE) {
            echo "La tâche a été ajouté à la base de données avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la tâche : " . $conn->error;
        }
    } else {
        echo "Le dossier de la tâche existe déjà.";
    }
?>
