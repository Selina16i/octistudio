const overlay = document.getElementById("overlay");

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
const registrationButton = document.getElementById("registration_button");
const registrationReturn = document.getElementById("registration_return");

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
const confirmPasswordInput = document.getElementById("confirm-password");
const submitButton = document.getElementById("registration-submit-button");

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
const wrongIdNotification = document.querySelector(".notification_wrong_id");

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

//-----------------js pour page service changement de contenu
var slides = document.querySelectorAll(".slide"); //Sélectionne tous les éléments HTML avec la classe slide et les stocke dans la variable slides.//
var btns = document.querySelectorAll(".btn");
let currentSlide = 1;

// Javascript for image slider manual navigation
var manualNav = function (manual) {
  slides.forEach((slide) => {
    slide.classList.remove("active");

    btns.forEach((btn) => {
      btn.classList.remove("active");
    });
  });

  slides[manual].classList.add("active");
  btns[manual].classList.add("active");
};

btns.forEach((btn, i) => {
  btn.addEventListener("click", () => {
    manualNav(i);
    currentSlide = i;
  });
});

// Javascript for send an alert when the contact form is submitted
document
  .getElementById("contact_form")
  .addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the form from being submitted to the server
    swal("Succès!", "Le formulaire a bien été envoyé", "success");
  });

document.getElementById("ok_button").addEventListener("click", function (e) {
  e.preventDefault(); // Prevent the default action of the link
  var form = document.getElementById("contact_form");
  form.style.display = "flex"; // Show the form

  // Animate the form
  anime({
    targets: form,
    translateY: ["-100%", 0], // Change the Y position from -100% to 0
    opacity: [0, 1], // Change the opacity from 0 to 1
    begin: function () {
      form.style.zIndex = "1"; // Bring the form to the front
    },
    duration: 1500,
  });
});
