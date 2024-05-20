<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="../images/octi_icon.png">
        <link href="../style.css" rel="stylesheet">
        <title>Accueil</title>
    </head>

    <body>
        <?php
            $servername = "localhost";
            $db_name = "u575965221_octistudio";
            $db_username = "u575965221_octistudio";
            $db_password = "#7DD2>bt*hW";
        
            /*$servername = "localhost";
            $db_name = "octistudio";
            $db_username = "root";
            $db_password = "";*/
        
            $conn = new mysqli($servername, $db_username, $db_password, $db_name); // Connexion à la base de données

            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = $conn->prepare("SELECT * FROM members WHERE email = ? AND password = ?");
                $sql->bind_param("ss", $email, $password);
                $sql->execute();
                $result = $sql->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $connected_member_id = $row['member_id'];

                    setcookie("connected_member_id", $connected_member_id, time() + 3600);
                    setcookie("email", $email, time() + 3600);
                    setcookie("password", $password, time() + 3600);

                    header("Location: /fr/gestion-de-projets/tableau_de_bord.php");
                    exit();
                } else {
                    header("Location: /fr/accueil.php?wrong_id=true");
                }
            }
        ?>

        <img id="octi-basic" src="../images/octi-basic.png" alt="Poulpe de l'agence d'infographie varoise OCTI Studio">

        <div id="body_content">
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

                    <img id="logo" src="../images/logo.png" alt="Logo de l'agence d'infographie varoise OCTI Studio">

                    <button id="registration_button" class="header_button" type="button">
                            <img src="../images/member_icon.png" alt="Icône de membre de l'agence d'infographie varoise OCTI Studio">
                            <p>Connexion</p>
                    </button>

                    <section id="registration" class="registration_hidden">

                    <!-------------------------------REGISTRATION------------------------------->

                        <button id="registration_return">
                            <p>Retour</p>
                        </button>

                        <div id="registration_box">
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
                                        <input type="password" id="registration_password" name="password" minlength="8" required>
                                    </div>

                                    <div>
                                        <label for="confirm_password">Confirmation du mot de passe</label>
                                        <input type="password" id="confirm-password" name="confirm-password">
                                    </div>

                                    <input type="hidden" name="status" value="pending">

                                    <input type="hidden" name="origin" value="fr_registration">
                                
                                    <button id="registration-submit-button" type="submit">S'inscrire</button>

                                    <p>Vous avez déjà un compte ? <a id="show_login" href="#">Cliquez ici.</a></p>
                            </form>

                        <!----------------------------------LOGIN----------------------------------->

                            <form id="login_form" method="POST" style="display:none" >
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
                        </div>
                    </section>
                </div>
            </header>

            <div id="notification" class="notification">
                <div class="notification-content">
                    <div class="congrats-box">
                        <img src="../images/octi-happi.png" alt="Poulpe heureux du logo de l'agence d'infographie varoise OCTI Studio">
                        <p class="congrats">Félicitations !</p>
                    </div> 
                        <p>Votre demande d'inscription a bien été prise en compte, veuillez attendre la validation d'un administrateur.</p>
                        <img class="arrow" src="../images/arrow.png" alt="Symbole de flèche">
                </div>   
            </div>

            <div class="notification_wrong_id">
                <div class="notification-content">
                    <div class="congrats-box">
                        <img src="../images/octi-basic.png" alt="Poulpe heureux du logo de l'agence d'infographie varoise OCTI Studio">
                        <p class="congrats">Mince !</p>
                    </div> 
                        <p>Vos identifiants ne correspondent à aucun compte.</p>
                        <img class="arrow" src="../images/arrow.png" alt="Symbole de flèche">
                </div>   
            </div>

<!------------------------------------------------------ANNOUNCEMENT------------------------------------------------------>

            <section id="announcement">
                <div class="website_container">
                    <div class="marquee_right-to-left">
                        <p>ASSISTEZ À UN ÉVÉNEMENT EXCEPTIONNEL AUTOUR DE LA "TRUFFE DU CANADA" LE 23 MAI PAR OCTISTUDIO -</p>
                        <p>ASSISTEZ À UN ÉVÉNEMENT EXCEPTIONNEL AUTOUR DE LA "TRUFFE DU CANADA" LE 23 MAI PAR OCTISTUDIO -</p>
                        <p>ASSISTEZ À UN ÉVÉNEMENT EXCEPTIONNEL AUTOUR DE LA "TRUFFE DU CANADA" LE 23 MAI PAR OCTISTUDIO -</p>
                    </div>
                </div>
            </section>

<!------------------------------------------------------TEASER------------------------------------------------------>

            <section id="teaser">
                <video autoplay playsinline loop muted poster="../images/teaser_poster.png"><source src="../videos/teaser.mp4" type="video/mp4"/></video>

                <div class="website_container">
                    <div id="presentation">
                        <h1>L'AGENCE CRÉATIVE</h1>

                        <p>OCTI Studio, une agence d'infographie varoise passionnée et spécialisée, prête à vous accompagner dans tous vos projets : logo, charte graphique, print, typographie...</p>

                        <button class="teaser_button" type="button">
                            <img src="../images/play.png" alt="Bouton de lecture pour le tease de l'agence d'infographie varoise OCTI Studio">
                            <p>Teaser</p>
                        </button>
                    </div>
                </div>
            </section>

<!-------------------------------------------------------SLOGAN------------------------------------------------------->

            <section id="slogan">
                <div class="website_container">
                    <p>OCTOPUS</p>
                    <p>CREATES</p>
                    <p>THOUSAND</p>
                    <p>IMAGES</p>
                </div>
            </section>

<!-------------------------------------------------------VALUES------------------------------------------------------->

            <section id="values">
                <div class="website_container">
                    <h2>NOS VALEURS</h2>

                    <p>Chez OCTI Studio, notre équipe se consacre à vous offrir une expérience éducative et bienveillante.</p>

                    <div class="values-boxes">
                        <p>ACCESSIBILITÉ</p>
                        <p>QUALITÉ</p>
                        <p>TRANSPARENCE</p>
                    </div>
                </div>
            </section>

<!--------------------------------------------------------TEAM-------------------------------------------------------->

            <section id="team">
                <div class="carousel-buttons">
                    <div class="left-button">
                        <img src="../images/carousel-arrow.png" alt="Bouton de défilement vers la droite du carousel de l'équipe d'infographie OCTI Studio">
                    </div>

                    <div class="right-button">
                        <img src="../images/carousel-arrow.png" alt="Bouton de défilement vers la gauche du carousel de l'équipe d'infographie OCTI Studio">
                    </div>
                </div>

                <div id="carousel"> 
                    <?php 
                        $result = $conn->query("SELECT * FROM members WHERE rights = 'admin' OR rights = 'member' ORDER BY rights ASC");

                        $i = 0;

                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='member";
                                if ($i != 0) {
                                    echo " border-left-0";
                                } 
                            echo "'>";
                                echo "<div class='member_bio'>";
                                    echo '<p>" '.$row["bio"].' "</p>';
                                echo "</div>";

                                echo "<div class='member_photo'>";
                                    if ($row["photo"] != "") {
                                        echo "<img src='.".$row["photo"]."' alt='Photo d&apos;un membre de l&apos;agence d&apos;infographie varoise OCTI Studio'>";
                                    } else {
                                        echo "<img src='../images/nobody.png' alt='Photo absente d&apos;un membre de l&apos;agence d&apos;infographie varoise OCTI Studio'>";
                                    }
                                echo "</div>";
                                
                                echo "<div class='member_text'>";
                                    echo "<div class='member_text_content'>";
                                        echo "<p class='member_name'>".$row["first_name"]." ".$row["last_name"]."</p>";
                                
                                        $sql = "SELECT role FROM assignments WHERE member_id = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("i", $row['member_id']);
                                        $stmt->execute();
                                        $stmt->bind_result($member_role);
                                        $stmt->fetch();
                                        $stmt->close();
                                
                                        if ($member_role != "") {
                                            echo "<p class='member_role'>".$member_role."</p>";
                                        } else {
                                            echo "<p class='member_role'>-</p>";
                                        }
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";

                            $i = $i + 1;
                        }
                    ?>
                </div>
            </section>

<!------------------------------------------------------SERVICES------------------------------------------------------>

            <section id="services">
                <img src="../images/dedale_posters.jpg" alt="Photo d'un membre de l'agence d'infographie varoise OCTI Studio">

                <div class="website_container">
                    <form action="">
                        <button>NOS SERVICES</button>
                    </form>
                </div>
            </section>

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

<!------------------------------------------------------EVENT------------------------------------------------------>

            <section id="event">
                <div class="top-banner">
                    <div class="marquee_right-to-left">
                        <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                        <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                        <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                    </div>
                </div>

                <div class="vertical-banners">
                    <div class="left-banner">
                        <div class="marquee_down-to-up">
                            <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                            <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                            <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                        </div>
                    </div>

                    <div class="event-content">
                            <img src="../images/iut_toulon.jpg" alt="Photographie de l'IUT de Toulon dans le Var">

                            <div class="event-text">
                                <h2>Événement</h2>

                                <p>Préparez-vous à une chasse au trésor épique au sein de l'IUT MMI de Toulon. Des lots exceptionnels et un moment convivial entre professeurs et étudiants de la formation MMI !</p>
                            </div>

                            <form action="https://www.twitch.tv/octistudio" target="_blank">
                                <button>
                                    <img src="../images/twitch.png" class="twitch-logo" alt="Logo Twitch vers le compte de l'agence d'infographie varoise OCTI Studio">
                                    <p>TWITCH</p>
                                </button>
                            </form>
                    </div>

                    <div class="right-banner">
                        <div class="marquee_down-to-up">
                            <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                            <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                            <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                        </div>
                    </div>
                </div>

                <div class="bottom-banner">
                    <div class="marquee_right-to-left">
                        <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                        <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                        <p>NOTRE ÉVÉNEMENT ARRIVE TRÈS PROCHAINEMENT - ON AIME BEAUCOUP LA TRUFFE DU CANADA - SUIVEZ-NOUS SUR TWITCH.TV - BEAUCOUP DE CADEAUX À REMPORTER -</p>
                    </div>
                </div>
            </section>

            <section id="home_anchor">
                <div class="website_container">
                    <p>Tu veux qu'on t'aide à remonter ?</p>

                    <a href="#home-header">
                       <button>AVEC PLAISIR !</button>
                    </a>
                </div>
            </section>

            <!--
            <section id="sponsors">
                        
            </section>
                        
            <footer>
                        
            </footer>
            -->
    
        </div>

        <div id="overlay" class="border_overlay"></div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>
            const menuButton = document.querySelector('#menu_button');
            const burger = document.querySelector('.burger');

            menuButton.addEventListener('click', () => {
                burger.classList.toggle('open');
            });

            // Apparition et disparition du formulaire d'inscription

            const overlay = document.getElementById('overlay');

            const registration = document.getElementById('registration');
            const registrationButton = document.getElementById('registration_button');
            const registrationReturn = document.getElementById('registration_return');

            registrationButton.addEventListener('click', () => {
              registration.classList.add('registration_revealed');
              registration.classList.remove('registration_hidden');
              overlay.classList.add('darken_overlay');
              overlay.classList.remove('border_overlay');
            });

            registrationReturn.addEventListener('click', () => {
              registration.classList.add('registration_hidden');
              registration.classList.remove('registration_revealed');
              overlay.classList.add('border_overlay');
              overlay.classList.remove('darken_overlay');
            });

            // Switch entre formulaire d'inscription et formulaire de connexion

            const registrationForm = document.getElementById('registration_form');
            const loginForm = document.getElementById('login_form');

            if (registrationForm && loginForm) {
                document.getElementById('show_login').addEventListener('click', function(event) {
                    registrationForm.style.display='none';
                    loginForm.style.display='flex';
                });
            
                document.getElementById('show_registration').addEventListener('click', function(event) {
                    loginForm.style.display='none';
                    registrationForm.style.display='flex';
                });
            }

            // Vérification de la confirmation du mot de passe

            const passwordInput = document.getElementById('registration_password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const submitButton = document.getElementById('registration-submit-button');

            submitButton.addEventListener('click', function(event) {
              if (passwordInput.value !== confirmPasswordInput.value) {
                alert("Les mots de passe ne correspondent pas.");
                event.preventDefault();
              }
            });

            // Affichage de la notification d'inscription

            const submittedParams = new URLSearchParams(window.location.search);
            const notification = document.querySelector('.notification');

            if (submittedParams.has('submitted')) {
                const isSubmitted = submittedParams.get('submitted');
            
                if (isSubmitted === 'true') {
                    notification.classList.add('notification-show');
            
                    setTimeout(() => {
                        notification.classList.add('notification-hidden');
                    }, 10000);
                }
            }

            notification.addEventListener('click', () => {
                notification.classList.add('notification-hidden-fast');
            });

            var image = document.getElementById('octi-basic');

            var buttons = document.querySelectorAll('button');

            buttons.forEach(function(button) {
                button.addEventListener('mouseover', function() {
                    octiLove(image);
                });
                button.addEventListener('mouseout', function() {
                    octiBasic(image);
                });
            });

            // Affichage de la notification d'erreur de connexion

            const wrongIdParams = new URLSearchParams(window.location.search);
            const wrongIdNotification = document.querySelector('.notification_wrong_id');

            if (wrongIdParams.has('wrong_id')) {
                const isWrongId = wrongIdParams.get('wrong_id');
            
                if (isWrongId === 'true') {
                    wrongIdNotification.classList.add('notification-show');
            
                    setTimeout(() => {
                        wrongIdNotification.classList.add('notification-hidden');
                    }, 10000);
                }
            }

            wrongIdNotification.addEventListener('click', () => {
                wrongIdNotification.classList.add('notification-hidden-fast');
            });

            var image = document.getElementById('octi-basic');

            var buttons = document.querySelectorAll('button');

            buttons.forEach(function(button) {
                button.addEventListener('mouseover', function() {
                    octiLove(image);
                });
                button.addEventListener('mouseout', function() {
                    octiBasic(image);
                });
            });

            // Défilement du carrousel des membres de l'équipe

            const carousel = document.querySelector('#carousel');
            const rightButton = document.querySelector('.right-button');
            const leftButton = document.querySelector('.left-button');
            const memberBox = document.querySelectorAll('.member');
            const scrollAmount = memberBox[0].offsetWidth;
            console.log(scrollAmount);
            let currentTranslation = 0;
            const memberBoxWidths = Array.from(memberBox).reduce((sum, box) => sum + box.offsetWidth, 0);
            const maxTranslation = memberBoxWidths - carousel.offsetWidth;
                    
            leftButton.style.display = 'none';
                    
            rightButton.addEventListener('click', () => {
              const remainingTranslation = maxTranslation - currentTranslation;
              const actualTranslation = Math.min(remainingTranslation, scrollAmount);
            
              currentTranslation += actualTranslation;
              carousel.style.transform = `translateX(-${currentTranslation}px)`;
              carousel.style.transition = 'transform 0.5s ease';
            
              leftButton.style.display = 'block';
            
              if (currentTranslation === maxTranslation) {
                rightButton.style.display = 'none';
              } else {
                rightButton.style.display = 'block';
              }
            });
            
            leftButton.addEventListener('click', () => {
              if (currentTranslation > 0) {
                const actualTranslation = Math.min(currentTranslation, scrollAmount);
                currentTranslation -= actualTranslation;
                carousel.style.transform = `translateX(-${currentTranslation}px)`;
                carousel.style.transition = 'transform 0.5s ease';
                rightButton.style.display = 'block';
              }
          
              if (currentTranslation === 0) {
                leftButton.style.display = 'none';
              } else {
                leftButton.style.display = 'block';
              }
            });

            // Apparition des tâches d'encre

            $(window).scroll(function() {
              var scrollTop = $(this).scrollTop();

              if (scrollTop > 3900) {
                $(".white_task_1").removeClass("hidden_task");
              } else {
                $(".white_task_1").addClass("hidden_task");
              }

              if (scrollTop > 4200) {
                $(".white_task_2").removeClass("hidden_task");
              } else {
                $(".white_task_2").addClass("hidden_task");
              }

              if (scrollTop > 3600) {
                $(".white_task_3").removeClass("hidden_task");
              } else {
                $(".white_task_3").addClass("hidden_task");
              }
            });

            // Suivi du poulpe et changement d'émotions

            var isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

            var octi = document.querySelector('#octi-basic');
            octi.style.display = 'none';

            if (!isTouchDevice) {
                document.addEventListener('mousemove', function() {
                    if (octi.style.display === 'none') {
                        octi.style.display = 'block';
                        octiBasic(octi);
                    }
                });

                var members = document.querySelectorAll('.member');

                members.forEach(function(member) {
                  member.addEventListener('mouseover', function() {
                    octiStar(octi);
                    octi.style.display = 'block';
                  });
                  member.addEventListener('mouseout', function() {
                    octiBasic(octi);
                  });
                });

                function octiBasic() {
                    octi.src = '../images/octi-basic.png';
                }

                function octiLove() {
                    octi.src = '../images/octi-love.png';
                }

                function octiStar() {
                    octi.src = '../images/octi-star.png';
                }

                var targetX = 0;
                var targetY = 0;
                var offsetX = 40;
                var offsetY = -40; 
                var speed = 0.2;

                document.addEventListener('mousemove', function(event) {
                  targetX = event.clientX + offsetX;
                  targetY = event.clientY + offsetY;
                });

                window.addEventListener('scroll', function() {
                    octi.style.position = 'fixed';
                });

                function follow() {
                    octi.style.left = octi.offsetLeft + (targetX - octi.offsetLeft) * speed + 'px';
                    octi.style.top = octi.offsetTop + (targetY - octi.offsetTop) * speed + 'px';
                  requestAnimationFrame(follow);
                }

                follow();
            }
        </script>

    </body>
</html>