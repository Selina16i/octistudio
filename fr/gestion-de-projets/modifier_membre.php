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

    $member_id = $_GET['member_id'];

    $sql = "SELECT * FROM members WHERE member_id = $member_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Membres</title>
    </head>

    <body>
        <form id="registration_form" action="update_member.php" method="POST">
            <div>
                <input type="text" id="new_last_name" name="new_last_name" value="<?php echo $row['last_name'] ?>" required>
            </div>

            <div>
                <input type="text" name="new_last_name" value="<?php echo $row['first_name'] ?>" required>
            </div>

            <fieldset>
                <legend>Identifiants de connexion</legend>

                <div>
                    <label for="new_email">Adresse-mail</label>
                    <input type="text" id="new_email" name="new_email" value="<?php echo $row['email'] ?>" required>
                </div>

                <div>
                    <label for="new_password">Mot de passe</label>
                    <input type="password" id="new_password" name="new_password" value="<?php echo $row['password'] ?>" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Gestion de projets</legend>

                <div>
                    <label for="new_role">Rôle</label>
                    <input type="text" id="new_role" name="new_role" value="<?php echo $row['role'] ?>" required>
                </div>

                <div>
                    <label for="new_job">Métier</label>
                    <input type="text" id="new_job" name="new_job" value="<?php echo $row['job'] ?>">
                </div>
            </fieldset>
        
            <div>
                <label for="new_photo">Photo</label>
                <input type="text" id="new_photo" name="new_photo" value="<?php echo $row['photo'] ?>">
            </div>

            <!--
            <div>
                <label for="new_first_name">Nom</label>
                <input type="text" name="new_last_name" value="" required>
            </div>

                $new_password = $_GET['new_password'];
            
                $sql = "UPDATE members SET password = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $new_password, $member_id);
            
                if ($stmt->execute()) {
                    echo "Update succeed.";
                } else {
                    echo "Error: ".$stmt->error;
                }
            
                $stmt->close();
            -->          