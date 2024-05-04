<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../style.css" rel="stylesheet"/>
        <title>Gestion des membres</title>
    </head>

    <body id="back-office">
        <div class=border>
            <?php
                $servername = "localhost";
                $db_name = "octistudio";
                $db_username = "root";
                $db_password = "";
    
                $conn = new mysqli($servername, $db_username, $db_password, $db_name); // Connexion à la base de données
    
                if ($conn->connect_error) {
                    exit("Connexion échouée :".$conn->connect_error);
                }
            ?>
    
            <section class="left-panel">

<!---------------------------------------------------ARBORESCENCE--------------------------------------------------->

                <?php
                    // Fonction récursive pour construire l'arborescence
                    function buildTree($data, $parent_id = 0) {
                        $tree = array();
                        foreach ($data as $item) {
                            if ($item['parent_id'] == $parent_id) {
                                $children = buildTree($data, $item['id']);
                                if (!empty($children)) {
                                    $item['children'] = $children;
                                }
                                $tree[] = $item;
                            }
                        }
                        return $tree;
                    }

                    // Requête SQL pour récupérer les données
                    $sql = "SELECT 
                                p.project_id AS id, 
                                p.name AS name, 
                                NULL AS parent_id, 
                                NULL AS parent_name,
                                NULL AS grandparent_id, 
                                NULL AS grandparent_name, 
                                'project' AS type 
                            FROM projects p
                            UNION
                            SELECT 
                                t.task_id AS id, 
                                t.name AS name, 
                                t.project_id AS parent_id, 
                                (SELECT p.name FROM projects p WHERE t.project_id = p.project_id) AS parent_name, 
                                NULL AS grandparent_id, 
                                NULL AS grandparent_name, 
                                'task' AS type 
                            FROM tasks t
                            UNION
                            SELECT 
                                s.subtask_id AS id, 
                                s.name AS name, 
                                s.task_id AS parent_id, 
                                (SELECT t.name FROM tasks t WHERE s.task_id = t.task_id) AS parent_name, 
                                s.project_id AS grandparent_id, 
                                (SELECT p.name FROM projects p WHERE s.project_id = p.project_id) AS grandparent_name,
                                'subtask' AS type 
                            FROM subtasks s
                            ";

                    $result = $conn->query($sql);

                    $data = array();
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $data[] = $row;
                        }
                    }

                    $tree = buildTree($data);

                    // Afficher l'arborescence
                    function printTree($tree, $level = 0) {
                ?>
                        <div id="tree">      
                <?php
                            foreach ($tree as $item) {
                                if ($item['type'] == 'project') {
                ?>
                                    <div id="level" class="level-1">
                <?php
                                      echo "<a href='projet.php?project_id=".$item['id']."&project_name=".$item['name']."'>".$item['name']."</a>";
                ?>
                                    </div>
                <?php
                                } else if ($item['type'] == 'task') {
                ?>
                                    <div id="level" class="level-2">
                <?php
                                        echo "<a href='tache.php?project_id=".$item['parent_id']."&project_name=".$item['parent_name']."&task_id=".$item['id']."&task_name=".$item['name']."'>". $item['name']."</a>";
                ?>
                                    </div>
                <?php
                                } else if ($item['type'] == 'subtask') {
                ?>
                                    <div id="level" class="level-3">
                <?php
                                        echo "<a href='soustache.php?project_id=".$item['grandparent_id']."&project_name=".$item['grandparent_name']."&task_id=".$item['parent_id']."&task_name=".$item['parent_name']."&subtask_id=".$item['id']."&subtask_name=".$item['name']."'>".$item['name']."</a>";
                ?>
                                    </div>
                <?php
                                }

                                if (isset($item['children'])) {
                                printTree($item['children'], $level + 1);
                                }
                            }
                ?>
                        </div>    
                <?php
                    }

                    printTree($tree);
                ?>
            </section>

            <section class="right-panel">

<!------------------------------------------------------TITRE------------------------------------------------------>

                    <section id="back-office_title">
                        <div class="container">
                            <h1>Gestion des membres</h1>
                        </div>
                    </section>

<!-----------------------------------------------DEMANDES EN ATTENTE----------------------------------------------->

                    <div class="container">
                        <section id="pending_members">
                                <h2>Demandes en attente</h2>
                                    <?php
                                        $sql = "SELECT * FROM members WHERE status = 'pending'";
                                        $result = $conn->query($sql);

                                        // Afficher les résultats
                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<div class='pending_members_grid'>";
                                                        echo '<div class="pending_members_box">';
                                                            echo $row["last_name"];
                                                            echo $row["first_name"];
                                                            echo $row["date"];
                                                        echo '</div>';

                                                        echo "<a href='../../update_member.php?member_id=".$row["member_id"]."&new_status=approved'><button class='approve_button'>Approuver</button></a>";

                                                        echo "<a href='../../update_member.php?member_id=".$row["member_id"]."&new_status=rejected'><button class='reject_button'>Rejeter</button></a>";
                                                echo '</div>';
                                            }
                                        } 
                                        else {
                                            echo "<p>Aucune inscription en attente.</p>";
                                        }
                                    ?>

                        </section>

<!------------------------------------------------------MEMBRES------------------------------------------------------>

                    <section id="members">                         
                            <h2>Membres</h2>

                            <?php
                                $sql = "SELECT * FROM members WHERE status = 'approved'";
                                $result = $conn->query($sql);

                                // Afficher les résultats
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<div class='members_grid'>";
                                            echo "<div class='members_box'>";
                                                echo "<div class='members_head_box'>";
                                                    echo "<div class='members_names'>";
                                                        echo $row["last_name"];
                                                        echo $row["first_name"];
                                                    echo "</div>";

                                                    echo "<div class='members_role'>";
                                                        if ($row["role"]=="client") {
                                                            echo "client.e";
                                                        } else {
                                                            echo $row["role"];
                                                        }
                                                    echo "</div>";
                                                echo "</div>";

                                                echo "<div class='members_informations_box' style='display: none;'>";
                                                        echo "<p>Date d'inscription : ".$row["date"]."</p>";
                                                        echo "<p>Adresse-mail : ".$row["email"]."</p>";
                                                        echo "<p>Métier : ".$row["job"]."</p>";
                                                echo "</div>";
                                            echo "</div>";

                                            echo "<a href='modifier_membre.php?member_id=".$row["member_id"]."'><button class='modify_button'>Modifier</button></a>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<p>Aucun membre inscrit.</p>";
                                }

                                $conn->close();
                            ?>
                    </section>
                    </div>

                    <!--AJOUTER UN MEMBRE
                    <div id="create_member">
                        <form id="create_member" action="../../create_member.php" method="POST">
                                <legend>Ajouter un membre</legend>

                                <div>
                                    <label for="last_name">Nom</label>
                                    <input type="text" id="last_name" name="last_name" placeholder="Doe" required>
                                </div>

                                <div>
                                    <label for="first_name">Prénom</label>
                                    <input type="text" id="first_name" name="first_name" placeholder="John" required>
                                </div>

                                <div>
                                    <label for="email">Adresse-mail</label>
                                    <input type="email" id="email" name="email" placeholder="johndoe@octistudio.fr" required>
                                </div>

                                <div>
                                    <label for="password">Mot de passe</label>
                                    <input type="password" id="password" name="password" required>
                                </div>

                                <div>
                                    <label for="confirm_password">Confirmation du mot de passe</label>
                                    <input type="password" id="confirm_password" name="confirm_password">
                                </div>

                                <div>
                                    <label for="role">Rôle</label>
                                </div>

                                <div>
                                    <label for="job">Métier</label>
                                </div>

                                <div>
                                    <label for="projects">Projets</label>
                                </div>

                                <input type="hidden" name="status" value="approved">

                                <button type="submit">Ajouter</button>
                        </form>
                    </div>
                    -->
                </section>
            </section>
        </div>
        <script src="../../script.js"></script>
    </body>
</html>
