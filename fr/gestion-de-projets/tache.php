<!DOCTYPE html>

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
    $project_name = $_GET['project_id'];

    $task_id = $_GET['task_id'];
    $task_name = $_GET['task_name'];
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $task_name ?></title>
    </head>

    <body>
        <p>Tâches</p>

        <div id="create_subtask">
            <div id="new_subtask">
                <form id="new_subtask_form" action="../../create_subtask.php?project_id=<?php echo $project_id ?>&task_id=<?php echo $task_id ?>" method="POST">
                    <div>
                        <input type="hidden" name="project_name" value="<?php echo $project_name ?>">
                        <input type="hidden" name="task_name" value="<?php echo $project_name ?>">

                        <label for="new_subtask_name">Nom de la sous-tâche</label>
                        <input type="text" id="new_subtask_name" name="new_subtask_name" required>
                    </div>

                    <button type="submit">Créer la tâche</button>
                </form>
            </div>
        </div>

        <?php
            $sql = "SELECT * FROM subtasks WHERE task_id = $task_id";
            $result = $conn->query($sql);
                    
            // Afficher les résultats
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo $row["name"];
                }
            } 
            else {
                echo "Aucune tâche liée à ce projet.";
            }
        ?>

        <p>Tâches</p>
    </body>
</html>