<?php
    $servername = "localhost";
    $db_name = "octistudio";
    $db_username = "root";
    $db_password = "";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name); // Connexion à la base de données

    // Vérifie la connexion
    if ($conn->connect_error) {
        exit("Connexion échouée :".$conn->connect_error);
    }

    // Mise à jour du nom de famille
    if (isset($_GET['member_id']) && isset($_GET['new_last_name'])) {
        $member_id = $_GET['member_id'];
        $new_last_name = $_GET['new_last_name'];

        $sql = "UPDATE members SET last_name = ? WHERE member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_last_name, $member_id);

        if ($stmt->execute()) {
            echo "Update succeed.";
        } else {
            echo "Error: ".$stmt->error;
        }

        $stmt->close();
    }

    // Mise à jour du prénom
    if (isset($_GET['member_id']) && isset($_GET['new_first_name'])) {
        $member_id = $_GET['member_id'];
        $new_first_name = $_GET['new_first_name'];

        $sql = "UPDATE members SET first_name = ? WHERE member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_first_name, $member_id);

        if ($stmt->execute()) {
            echo "Update succeed.";
        } else {
            echo "Error: ".$stmt->error;
        }

        $stmt->close();
    }

    // Mise à jour du rôle
    if (isset($_GET['member_id']) && isset($_GET['new_role'])) {
        $member_id = $_GET['member_id'];
        $new_role = $_GET['new_role'];

        $sql = "UPDATE members SET role = ? WHERE member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_role, $member_id);

        if ($stmt->execute()) {
            echo "Update succeed.";
        } else {
            echo "Error: ".$stmt->error;
        }

        $stmt->close();
    }

    // Mise à jour du métier
    if (isset($_GET['member_id']) && isset($_GET['new_job'])) {
        $member_id = $_GET['member_id'];
        $new_job = $_GET['new_job'];

        $sql = "UPDATE members SET job = ? WHERE member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_job, $member_id);

        if ($stmt->execute()) {
            echo "Update succeed.";
        } else {
            echo "Error: ".$stmt->error;
        }

        $stmt->close();
    }

    // Mise à jour de l'adresse-mail
    if (isset($_GET['member_id']) && isset($_GET['new_email'])) {
        $member_id = $_GET['member_id'];
        $new_email = $_GET['new_email'];

        $sql = "UPDATE members SET email = ? WHERE member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_email, $member_id);

        if ($stmt->execute()) {
            echo "Update succeed.";
        } else {
            echo "Error: ".$stmt->error;
        }

        $stmt->close();
    }

    // Mise à jour du mot de passe
    if (isset($_GET['member_id']) && isset($_GET['new_password'])) {
        $member_id = $_GET['member_id'];
        $new_password = $_GET['new_password'];

        $sql = "UPDATE members SET password = ? WHERE member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_password, $member_id);

        if ($stmt->execute()) {
            echo "Update succeed.";
        } else {
            echo "Error: ".$stmt->error;
        }

        $stmt->close();
    }

    // Mise à jour du statut
    if (isset($_GET['member_id']) && isset($_GET['new_status'])) {
        $member_id = $_GET['member_id'];
        $new_status = $_GET['new_status'];
    
        if ($new_status == "rejected") {
            $sql = "DELETE FROM members WHERE member_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $member_id);
    
            if ($stmt->execute()) {
                echo "Membre supprimé avec succès.";
            } else {
                echo "Erreur lors de la suppression du membre : " . $stmt->error;
            }
    
            $stmt->close();
        }
        else {
            $sql = "UPDATE members SET status = ? WHERE member_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_status, $member_id);
    
            if ($stmt->execute()) {
                echo "Mise à jour du statut réussie.";
            } else {
                echo "Erreur lors de la mise à jour du statut : " . $stmt->error;
            }
    
            $stmt->close();
        }
    
        $conn->close();
    }