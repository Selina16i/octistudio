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

    $sql = "SELECT name FROM projects p WHERE project_id = $project_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $project_name = $row["name"];
    }
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $project_name ?></title>
    </head>

    <body>
        <p>Tâches</p>

        <div id="create_task">
            <button id="new_project_button" type="button">Nouvelle tâche</button>

            <div id="new_task">
                <form id="new_task_form" action="../../create_task.php?project_id=<?php echo $project_id ?>" method="POST">
                    <div>
                        <input type="hidden" name="project_name" value="<?php echo $project_name ?>">

                        <label for="new_task_name">Nom de la tâche</label>
                        <input type="text" id="new_task_name" name="new_task_name" required>
                    </div>

                    <button type="submit">Créer la tâche</button>
                </form>
            </div>
        </div>

        <?php
            $sql = "SELECT * FROM tasks WHERE project_id = $project_id";
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