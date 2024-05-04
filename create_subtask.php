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

    $task_id = $_GET['task_id'];
    $task_name = $_POST['task_name'];

    $directory_location = "projects/".$project_name."/".$task_name."/";

    $new_subtask_name = $_POST['new_subtask_name'];

    if (!file_exists($directory_location.$new_subtask_name)) {
        mkdir($directory_location.$new_subtask_name, 0755, true);
        echo "Le dossier de la tâche a été créé avec succès.";

        $sql = "INSERT INTO subtasks (name, project_id, task_id) VALUES ('$new_subtask_name', '$project_id', '$task_id')";
        if ($conn->query($sql) === TRUE) {
            echo "La tâche a été ajouté à la base de données avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la tâche : ".$conn->error;
        }
    } else {
        echo "Le dossier de la tâche existe déjà.";
    }
?>
