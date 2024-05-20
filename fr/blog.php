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
    <link rel="icon" type="image/png" href="../images/octi_icon.png" />
    <link rel="stylesheet" href="../selina.css">
    <link rel="stylesheet" href="../style.css">

    <style>
        /* Ajout des styles pour la grille */
        body {
            margin: 0;
            cursor: url("./images/cursor.png"), auto;
        }

        a:hover {
            cursor: url("./images/pointer.png"), pointer;
        }
        .articles-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Espace entre les articles */
            flex-direction: row;
            padding: 5% 15%;
            border-bottom: solid black 0.5rem;
            background-color: #B59AD8;
        }
        .article-item {
            flex: 1 1 350px; /* Deux articles par ligne avec espace */
            box-sizing: border-box;
            margin: 10px; 
            border:solid black 0.5rem;
            max-width: 350px;
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
            font-family:Josefin Sans;
        }

        .article-info {
            border-top: solid black 0.5rem;
            padding: 0 2%;
        }

        .limit{
            font-family: Pixcon;
            background-color:#fff;
            padding-bottom: 1%;
            border-bottom: solid black 0.5rem;
            text-align: center;
            padding-top: 1%;
            Font
        }
    </style>
</head>
<body>
    <img
      id="octi-basic"
      src="../images/octi-basic.png"
      alt="Poulpe de l'agence d'infographie varoise OCTI Studio"
    />    
     <header id="home-header">
        <div class="website_container">
          <!------------------------------------------------------HEADER------------------------------------------------------>

          <button id="menu_button" class="header_button" type="button">
            <div class="burger">
              <div class="bar1"></div>
              <div class="bar2"></div>
              <div class="bar3"></div>
            </div>

            <p>Menu</p>
          </button>

          <img
            id="logo"
            src="../images/logo.png"
            alt="Logo de l'agence d'infographie varoise OCTI Studio"
          />

          <button id="registration_button" class="header_button" type="button">
            <img
              src="../images/member_icon.png"
              alt="Icône de membre de l'agence d'infographie varoise OCTI Studio"
            />
            <p>Connexion</p>
          </button>

          <section id="registration" class="registration_hidden">
            <!-------------------------------REGISTRATION------------------------------->

            <button id="registration_return">
              <img src="../images/return.png" />
            </button>

            <div id="registration_box">
              <form
                id="registration_form"
                action="../create_member.php"
                method="POST"
              >
                <legend>Inscription</legend>

                <div>
                  <label for="last_name">Nom</label>
                  <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    placeholder="Doe"
                    required
                  />
                </div>

                <div>
                  <label for="first_name">Prénom</label>
                  <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    placeholder="John"
                    required
                  />
                </div>

                <div>
                  <label for="email">Adresse-mail</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="johndoe@octistudio.fr"
                    required
                  />
                </div>

                <div>
                  <label for="password">Mot de passe</label>
                  <input
                    type="password"
                    id="registration_password"
                    name="password"
                    minlength="8"
                    required
                  />
                </div>

                <div>
                  <label for="confirm_password"
                    >Confirmation du mot de passe</label
                  >
                  <input
                    type="password"
                    id="confirm-password"
                    name="confirm-password"
                  />
                </div>

                <input type="hidden" name="status" value="pending" />

                <input type="hidden" name="origin" value="fr_registration" />

                <button id="registration-submit-button" type="submit">
                  S'inscrire
                </button>

                <p>
                  Vous avez déjà un compte ?
                  <a id="show_login" href="#">Cliquez ici.</a>
                </p>
              </form>

              <!----------------------------------LOGIN----------------------------------->

              <form id="login_form" method="POST" style="display: none">
                <legend>Connexion</legend>

                <div>
                  <label for="email">Adresse-mail</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="johndoe@octistudio.fr"
                    required
                  />
                </div>

                <div>
                  <label for="password">Mot de passe</label>
                  <input
                    type="password"
                    id="password"
                    name="password"
                    required
                  />
                </div>

                <button type="submit">Se connecter</button>

                <p>
                  Vous n'avez pas encore de compte ?
                  <a id="show_registration" href="#">Cliquez ici.</a>
                </p>
              </form>
            </div>
          </section>

          <section id="menu" class="menu_hidden">
            <!-------------------------------MENU------------------------------->

            <button id="menu_return">
              <img src="../images/return.png" />
            </button>

            <div id="menu_box" class="menu_hidden">
              <h2>Menu</h2>

              <nav>
                <ul>
                  <li><a href="accueil.php">Accueil</a></li>
                  <li>-</li>
                  <li><a href="services.html">Nos services</a></li>
                  <li>-</li>
                  <li><a href="blog.php">Blog</a></li>
                  <li>-</li>
                  <li><a href="contact.html">Contact</a></li>
                </ul>
              </nav>

              <div class="change_language">
                <a href="../en/home.php">
                  <p>Change language :</p>
                  <div class="language_choice">
                    <img src="../images/usa.png" />
                    <p>ENGLISH</p>
                  </div>
                </a>
              </div>
            </div>
          </section>
        </div>
      </header>

      <div id="notification" class="notification">
        <div class="notification-content">
          <div class="congrats-box">
            <img
              src="../images/octi-happi.png"
              alt="Poulpe heureux du logo de l'agence d'infographie varoise OCTI Studio"
            />
            <p class="congrats">Félicitations !</p>
          </div>
          <p>
            Votre demande d'inscription a bien été prise en compte, veuillez
            attendre la validation d'un administrateur.
          </p>
          <img
            class="arrow"
            src="../images/arrow.png"
            alt="Symbole de flèche"
          />
        </div>
      </div>

      <div class="notification_wrong_id">
        <div class="notification-content">
          <div class="congrats-box">
            <img
              src="../images/octi-basic.png"
              alt="Poulpe heureux du logo de l'agence d'infographie varoise OCTI Studio"
            />
            <p class="congrats">Mince !</p>
          </div>
          <p>Vos identifiants ne correspondent à aucun compte.</p>
          <img
            class="arrow"
            src="../images/arrow.png"
            alt="Symbole de flèche"
          />
        </div>
      </div>


<!------------------------------------------------------ANNOUNCEMENT------------------------------------------------------>

      <section id="announcement">
        <div class="website_container">
          <div class="marquee_right-to-left">
            <p>
              ASSISTEZ À UN ÉVÉNEMENT EXCEPTIONNEL AUTOUR DE LA "TRUFFE DU
              CANADA" LE 23 MAI PAR OCTISTUDIO -
            </p>
            <p>
              ASSISTEZ À UN ÉVÉNEMENT EXCEPTIONNEL AUTOUR DE LA "TRUFFE DU
              CANADA" LE 23 MAI PAR OCTISTUDIO -
            </p>
            <p>
              ASSISTEZ À UN ÉVÉNEMENT EXCEPTIONNEL AUTOUR DE LA "TRUFFE DU
              CANADA" LE 23 MAI PAR OCTISTUDIO -
            </p>
          </div>
        </div>
      </section>



    <!-------------------------SLIDE BANNIERE-------------------->
    <div class="bod">
        <div class="img-slider">
            <!-------------------------PREMIERE IMAGE-------------------->
            <div class="slide active">
                <div class="row-slide">
                    <div class="col50">
                        <div class="inf">
                            <h2>PAGE BLOG</h2>
                            <p>
                                Bienvenue sur notre page blog dédiée à OCTI Studio ! Ici, vous trouverez un mélange d'informations sur notre agence.
                                <br>
                                Explorez nos récents projets, plongez dans les coulisses de notre processus créatif, et familiarisez-vous avec les visages derrière nos créations exceptionnelles. Mais ce n'est pas tout ! Nous partageons également des anecdotes, des astuces et des inspirations provenant du vaste monde du design graphique.
                                <br>
                                Que vous soyez un amateur passionné ou un professionnel aguerri, nos posts Instagram vous offriront une dose régulière d'informations et d'inspiration. Rejoignez-nous dans cette aventure visuelle et explorez l'univers de OCTI Studio et au-delà !
                            </p>
                        </div>
                    </div>
                    <div class="col50 blog_img">
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


<!------------------------------------------------------INSTAGRAM------------------------------------------------------>

            <section id="instagram">
                <div class="website_container">
                    <div class="instagram_text">
                        <h2>Suivez-nous sur Instagram</h2>

                        <p>Du nouveau contenu régulièrement !</p>

                        <form action="https://www.instagram.com/octistudio/" target="_blank">
                            <button>
                                <img src="../images/instagram.png" alt="Logo d'Instagram vers le compte de l'agence d'infographie varoise OCTI Studio">
                                <p>INSTAGRAM</p>
                            </button>
                        </form>
                    </div>

                    <img src="../images/white_task_1.png" class="white_task white_task_1 hidden_task" alt="Tâche d'encre du poulpe de l'agence d'infographie varoise OCTI Studio">
                    <img src="../images/white_task_2.png" class="white_task white_task_2 hidden_task" alt="Tâche d'encre du poulpe de l'agence d'infographie varoise OCTI Studio">
                    <img src="../images/white_task_3.png" class="white_task white_task_3 hidden_task" alt="Tâche d'encre du poulpe de l'agence d'infographie varoise OCTI Studio">

                    <div class="instagram_columns">
                        <div class="instagram_col-1 vertical-scrolling">
                            <?php
                                $path = "../instagram";
                                $posts = array();

                                $dir = opendir($path);
                                while($entry = readdir($dir)) {
                                    if (file_exists($path."/".$entry) && $entry != "." && $entry != "..") {
                                        $posts[] = $path."/".$entry;
                                    }
                                }

                                usort($posts, function($a, $b) {
                                    return strnatcmp($a, $b);
                                });

                                foreach($posts as $entry) {
                                    echo "<div class='instagram-post'>";
                                        echo "<img src='$entry' alt='Post Instagram du compte de l&apos;agence d&apos;infographie varoise OCTI Studio'>";
                                    echo "</div>";
                                }

                                closedir($dir);
                            ?>
                        </div>

                        <div class="instagram_col-2 reverse-vertical-scrolling">
                            <?php
                                $path = "../instagram";
                                $posts = array();

                                $dir = opendir($path);
                                while($entry = readdir($dir)) {
                                    if (file_exists($path."/".$entry) && $entry != "." && $entry != "..") {
                                        $posts[] = $path."/".$entry;
                                    }
                                }

                                usort($posts, function($a, $b) {
                                    return strnatcmp($a, $b);
                                });

                                foreach($posts as $entry) {
                                    echo "<div class='instagram-post'>";
                                        echo "<img src='$entry' alt='Post Instagram du compte de l&apos;agence d&apos;infographie varoise OCTI Studio'>";
                                    echo "</div>";
                                }

                                closedir($dir);
                            ?>
                        </div>
                    </div>
                </div>
            </section>



    
 <!-------------------------Footer-------------------->
   <section class="footer">
    <div class="row-footer">

     <div class="footer-col">
        <ul>
            <h6>Menu</h6>
            <li><a href="accueil.html" target="_blank">Accueil</a></li>
            <li><a href="services.html" target="_blank">Nos services</a></li>
            <li><a href="contact.html" target="_blank">Contact</a></li>
            <li><a href="blog.php" target="_blank">Blog</a></li>
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
        <a href="accueil.html" target="_blank"><img src="../images/logo.png" alt=""></a>
     </div>
    </div>
    <div class="droit">
    <p>@SAEMMITLN | Tous droits réservés</p>
</div>
   </section>

   <script>  const overlay = document.getElementById("overlay");

        const menu = document.getElementById("menu");
        const menuButton = document.getElementById("menu_button");
        const menuReturn = document.getElementById("menu_return");

        menuButton.addEventListener("click", () => {
          menu.classList.add("menu_revealed");
          menu.classList.remove("menu_hidden");
          overlay.classList.add("darken_overlay");
          overlay.classList.remove("border_overlay");
        });

        menuReturn.addEventListener("click", () => {
          menu.classList.add("menu_hidden");
          menu.classList.remove("menu_revealed");
          overlay.classList.add("border_overlay");
          overlay.classList.remove("darken_overlay");
        });

        // Apparition et disparition du formulaire d'inscription

        const registration = document.getElementById("registration");
        const registrationButton = document.getElementById(
          "registration_button"
        );
        const registrationReturn = document.getElementById(
          "registration_return"
        );

        registrationButton.addEventListener("click", () => {
          registration.classList.add("registration_revealed");
          registration.classList.remove("registration_hidden");
          overlay.classList.add("darken_overlay");
          overlay.classList.remove("border_overlay");
        });

        registrationReturn.addEventListener("click", () => {
          registration.classList.add("registration_hidden");
          registration.classList.remove("registration_revealed");
          overlay.classList.add("border_overlay");
          overlay.classList.remove("darken_overlay");
        });

        document.addEventListener("click", (event) => {
          const isClickInsideMenu = menu.contains(event.target);
          const isClickInsideMenuButton = menuButton.contains(event.target);
          const isClickInsideRegistration = registration.contains(event.target);
          const isClickInsideRegistrationButton = registrationButton.contains(
            event.target
          );

          if (
            !isClickInsideMenu &&
            !isClickInsideMenuButton &&
            !isClickInsideRegistration &&
            !isClickInsideRegistrationButton
          ) {
            menu.classList.add("menu_hidden");
            menu.classList.remove("menu_revealed");
            registration.classList.add("registration_hidden");
            registration.classList.remove("registration_revealed");
            overlay.classList.add("border_overlay");
            overlay.classList.remove("darken_overlay");
          }
        });

        // Switch entre formulaire d'inscription et formulaire de connexion

        const registrationForm = document.getElementById("registration_form");
        const loginForm = document.getElementById("login_form");

        if (registrationForm && loginForm) {
          document
            .getElementById("show_login")
            .addEventListener("click", function (event) {
              registrationForm.style.display = "none";
              loginForm.style.display = "flex";
            });

          document
            .getElementById("show_registration")
            .addEventListener("click", function (event) {
              loginForm.style.display = "none";
              registrationForm.style.display = "flex";
            });
        }

        // Vérification de la confirmation du mot de passe

        const passwordInput = document.getElementById("registration_password");
        const confirmPasswordInput =
          document.getElementById("confirm-password");
        const submitButton = document.getElementById(
          "registration-submit-button"
        );

        submitButton.addEventListener("click", function (event) {
          if (passwordInput.value !== confirmPasswordInput.value) {
            alert("Les mots de passe ne correspondent pas.");
            event.preventDefault();
          }
        });

        // Affichage de la notification d'inscription

        const submittedParams = new URLSearchParams(window.location.search);
        const notification = document.querySelector(".notification");

        if (submittedParams.has("submitted")) {
          const isSubmitted = submittedParams.get("submitted");

          if (isSubmitted === "true") {
            notification.classList.add("notification-show");

            setTimeout(() => {
              notification.classList.add("notification-hidden");
            }, 10000);
          }
        }

        notification.addEventListener("click", () => {
          notification.classList.add("notification-hidden-fast");
        });

        var image = document.getElementById("octi-basic");

        var buttons = document.querySelectorAll("button");

        buttons.forEach(function (button) {
          button.addEventListener("mouseover", function () {
            octiLove(image);
          });
          button.addEventListener("mouseout", function () {
            octiBasic(image);
          });
        });

        // Affichage de la notification d'erreur de connexion

        const wrongIdParams = new URLSearchParams(window.location.search);
        const wrongIdNotification = document.querySelector(
          ".notification_wrong_id"
        );

        if (wrongIdParams.has("wrong_id")) {
          const isWrongId = wrongIdParams.get("wrong_id");

          if (isWrongId === "true") {
            wrongIdNotification.classList.add("notification-show");

            setTimeout(() => {
              wrongIdNotification.classList.add("notification-hidden");
            }, 10000);
          }
        }

        if (wrongIdNotification.classList.contains("notification-show")) {
          wrongIdNotification.addEventListener("click", () => {
            wrongIdNotification.classList.add("notification-hidden-fast");
          });

          buttons.forEach(function (button) {
            button.addEventListener("mouseover", function () {
              octiLove(image);
            });
            button.addEventListener("mouseout", function () {
              octiBasic(image);
            });
          });
        }



        // Suivi du poulpe et changement d'émotions
         var image = document.getElementById("octi-basic");

        var buttons = document.querySelectorAll("button");

        buttons.forEach(function (button) {
          button.addEventListener("mouseover", function () {
            octiLove(image);
          });
          button.addEventListener("mouseout", function () {
            octiBasic(image);
          });
        });
        // Suivi du poulpe et changement d'émotions

        var isTouchDevice =
          "ontouchstart" in window || navigator.maxTouchPoints > 0;

        var octi = document.querySelector("#octi-basic");
        octi.style.display = "none";

        // if (!isTouchDevice) {
        document.addEventListener("mousemove", function () {
          if (octi.style.display === "none") {
            octi.style.display = "block";
            octiBasic(octi);
          }
        });

        function octiBasic() {
          octi.src = "../images/octi-basic.png";
        }

        function octiLove() {
          octi.src = "../images/octi-love.png";
        }

        function octiStar() {
          octi.src = "../images/octi-star.png";
        }

        var targetX = 0;
        var targetY = 0;
        var offsetX = 40;
        var offsetY = -40;
        var speed = 0.2;

        document.addEventListener("mousemove", function (event) {
          targetX = event.clientX + offsetX;
          targetY = event.clientY + offsetY;
        });

        window.addEventListener("scroll", function () {
          octi.style.position = "fixed";
        });

        function follow() {
          octi.style.left =
            octi.offsetLeft + (targetX - octi.offsetLeft) * speed + "px";
          octi.style.top =
            octi.offsetTop + (targetY - octi.offsetTop) * speed + "px";
          requestAnimationFrame(follow);
        }

        follow();

        // }

</script>


</body>
</html>
