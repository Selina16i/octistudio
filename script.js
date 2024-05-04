/* Animation slide du formulaire d'inscription */
document.addEventListener("DOMContentLoaded", function() {

  const registration = document.getElementById('registration');
  registration_button = document.getElementById('registration_button');
  registration_return = document.getElementById('registration_return');

  if (registration_button) {
    registration_button.addEventListener('click', () => {
      registration.classList.toggle('hidden');
      registration.style.right = registration.classList.contains('hidden') ? '-25vw':'0';
    });
  }

  if (registration_return) {
    registration_return.addEventListener('click', () => {
      registration.classList.toggle('hidden');
      registration.style.right = registration.classList.contains('hidden') ? '0':'-25vw';
    });
  }

/* Switch entre formulaire d'inscription et formulaire de connexion */

  const registration_form = document.getElementById('registration_form');
  const login_form = document.getElementById('login_form');

  if (registration_form && login_form) {
    document.getElementById('show_login').addEventListener('click', function(event) {
      registration_form.style.display='none'; // Masque le formulaire d'inscription
      login_form.style.display='flex'; // Affiche le formulaire de connexion
    });

    document.getElementById('show_registration').addEventListener('click', function(event) {
      login_form.style.display='none'; // Masque le formulaire de connexion
      registration_form.style.display='flex'; // Affiche le formulaire d'inscription
    });
  }

// ---------------------------------- //

  const registration_message = document.getElementById('registration_message');

  if (registration_message) {
    // Écoute l'événement de soumission du formulaire
    registration_form.addEventListener('submit', function(event) {
      event.preventDefault(); // Empêcher le rechargement de la page
    
      // Récupère les données du formulaire
      const formData = new FormData(registration_form);
    
      // Envoie les données au serveur en utilisant AJAX
      fetch('/create_member.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (response.ok) {
          document.getElementById('registration_form').style.display = 'none'; // Cache le formulaire d'inscription
          registration_message.textContent = "Félicitations, vous serez bientôt inscrit ! Veuillez patienter jusqu'à la validation d'un administrateur."; // Affiche un message de succès
          registration_message.classList.add('success');
        } else {
          document.getElementById('registration_form').style.display = 'none'; // Cache le formulaire d'inscription
          registration_message.textContent = "Nous sommes désolés, une erreur est survenue. Veuillez réessayer ultérieurement."; // Affiche un message d'erreur
        } 
        registration_form.reset(); // Vide le contenu du formulaire
      })
    });
  }

// ---------------------------------- //

  var memberBox = document.querySelectorAll(".members_box");
  
  memberBox.forEach(function(box) {
    var informationsBox = box.querySelector(".members_informations_box");
    box.addEventListener("click", function() {
      if (informationsBox.style.display === "none") {
        box.classList.add("members_box_expanded");
        informationsBox.style.display = "flex";
      } else {
        box.classList.remove("members_box_expanded");
        informationsBox.style.display = "none";
      }
    });
  });
});


//-----------------js pour page service changement de contenu
var slides = document.querySelectorAll('.slide'); //Sélectionne tous les éléments HTML avec la classe slide et les stocke dans la variable slides.//
var btns = document.querySelectorAll('.btn');
let currentSlide = 1;

// Javascript for image slider manual navigation
var manualNav = function(manual){
  slides.forEach((slide)=> {
    slide.classList.remove('active');

    btns.forEach((btn) => {
      btn.classList.remove('active');
    });
  });

  slides[manual].classList.add('active');
  btns[manual].classList.add('active');
}

btns.forEach((btn, i) => {
  btn.addEventListener("click", () => {
    manualNav(i);
    currentSlide = i;
  });
});




