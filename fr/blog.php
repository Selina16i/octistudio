<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Requête pour récupérer les articles
$articles = $bdd->query('SELECT * FROM articles ORDER BY date_time_post DESC LIMIT 0,25');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Ajout des styles pour la grille */
        .articles-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espace entre les articles */
            flex-direction: row;
            padding: 5% 10%;
            border-bottom: solid black 0.5rem;
        }
        .article-item {
            flex: 1 1 400px; /* Deux articles par ligne avec espace */
            box-sizing: border-box;
            margin: 10px; 
            border:solid black 0.5rem;
            max-width: 400px;
            background-color: #ff8243;
        }
        .article-item img {
            width: 100%;
            display: block;
            margin: auto; 
        }
        .article-info h3{
            font-family:Pixcon;
        }
        .article-info p{
            font-family:JosefinSans;
        }

        .article-info {
            border-top: solid black 0.5rem;
        }

        .limit{
            font-family: Pixcon;
            background-color:#039cbd;
            padding-bottom: 1%;
            border-bottom: solid black 0.5rem;
            text-align: center;
            padding-top: 1%;
            Font
        }
    </style>
</head>
<body>
    <script src="../script.js"></script>
     <header>
        <div class="container">
                <button class="header_button" type="button"><img src="../images/burger.png" alt="">Menu</button>

            <img id="logo" src="../images/logo.png">

            <button id="registration_button" class="header_button" type="button">Connexion</button>

            <section id="registration" class="hidden">
                <button id="registration_return">Retour</button>

                <form id="registration_form" action="../create_member.php" method="POST">
                    <legend>Inscription</legend>

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

                    <input type="hidden" name="status" value="pending">

                    <button type="submit">S'inscrire</button>

                    <p>Vous avez déjà un compte ? <a id="show_login" href="#">Cliquez ici.</a></p>
                </form>

                <div id="registration_message"></div>

                <form id="login_form" style="display:none" method="POST">
                    <legend>Connexion</legend>

                    <div>
                        <label for="email">Adresse-mail</label>
                        <input type="email" id="email" name="email" placeholder="johndoe@octistudio.fr" required>
                    </div>

                    <div>
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit">Se connecter</button>

                    <p>Vous n'avez pas encore de compte ? <a id="show_registration" href="#">Cliquez ici.</a></p>
                </form>
            </section>
        </div>
    </header>

    <!-------------------------SLIDE BANNIERE-------------------->
    <div class="bod">
        <div class="img-slider">
            <!-------------------------PREMIERE IMAGE-------------------->
            <div class="slide active">
                <div class="row-slide">
                    <div class="col50">
                        <div class="inf">
                            <h2>GRAPHISME</h2>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa
                                assumenda molestiae illo odio est tempora quasi ex neque ab,
                                blanditiis iusto sit, inventore perferendis obcaecati,
                                quibusdam modi ut nostrum dolorem.Lorem ipsum dolor sit amet
                                consectetur adipisicing elit. Ipsa assumenda molestiae illo
                                odio est tempora quasi ex neque ab, blanditiis iusto sit,
                                inventore perferendis obcaecati, quibusdam modi ut nostrum
                                dolorem.
                            </p>
                        </div>
                    </div>
                    <div class="col50">
                        <img src="../images/stylo_octi.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-------------------------DELIMITATION-------------------->
<div class='limit'> 
    <h2>Nos articles </h2> 
</div>

    <!-------------------------ARTICLES-------------------->
    <div class="articles-container">
        <?php
        // Boucle pour afficher les articles
        foreach ($articles as $article) {
            // Récupération de l'image BLOB
            $imageBlob = $article['miniature'];
            // Conversion de l'image BLOB en base64
            $imageBase64 = base64_encode($imageBlob);
            // Création de l'URL de données pour l'image
            $imageSrc = "data:image/jpeg;base64," . $imageBase64;

            echo "
            <div class='article-item'>
                <img src='{$imageSrc}' alt='Image de l'article'>
                <div class='article-info'>
                    <h3>{$article['titre']}</h3>
                    <p>{$article['contenu']}</p>
                </div>
            </div>
            ";
        }
        ?>
    </div>

   <!-------------------------Footer-------------------->
    <section class="footer">
        <div class="row-footer">

            <div class="footer-col">
                <ul>
                    <h6>Menu</h6>
                    <li><a href="">Accueil</a></li>
                    <li><a href="">Nos services</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="">Blog</a></li>
                </ul>

            </div>

            <div class="footer-col">
                <ul>
                    <h6>Information</h6>
                    <li><a href="">Confidentialités</a></li>
                    <li><a href="">Mentions légales</a></li>
                    <li><a href="">Plan du site</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h6>Nous contacter</h6>
                <p>70 Avenue Roger Devoucoux <br>83000 TOULON <br>04 94 00 00 00 <br>octistudio@proton.me</p>
            </div>

            <div class="footer-col">
                <img src="../images/logo.png" alt="">
            </div>
        </div>
        <div class="droit">
            <p>@SAEMMITLN | Tous droits réservés</p>
        </div>
    </section>
</body>
</html>
