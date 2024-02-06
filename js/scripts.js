const modal = document.getElementById("contactModal");
const overlay = document.getElementById("menu-overlay");
const menuItems = document.querySelectorAll(".menu-item-29 a, .contact-btn");

// Fonction pour ouvrir le menu
function openMenu() {
  modal.classList.remove("hidden-modal");
  modal.classList.add("show-modal");
  overlay.style.display = "block";
}

// Fonction pour fermer le menu
function closeMenu() {
  modal.classList.remove("show-modal");
  modal.classList.add("hidden-modal");
  overlay.style.display = "none";
}

// Ajoute un gestionnaire d'événements le lien du menu
menuItems.forEach((link) => {
  link.addEventListener("click", (event) => {
    event.stopPropagation();
    openMenu();
  });
});

// Ajoute un gestionnaire d'événements pour le clic sur le body
document.body.addEventListener("click", (event) => {
  const isClickInsideMenu = modal.contains(event.target);

  if (!isClickInsideMenu) {
    closeMenu();
  }
});

// Ferme le menu lorsqu'on clique sur l'overlay
overlay.addEventListener("click", () => {
  closeMenu();
});

/*********************************************************** */

const prev = document.querySelector(".prev-btn");
const next = document.querySelector(".next-btn");

const prevImage = document.querySelector(".photo-contact__images .prev-img");
const nextImage = document.querySelector(".photo-contact__images .next-img");

prev.addEventListener("mouseover", (event) => {
  prevImage.classList.remove("prev-img");
});

prev.addEventListener("mouseleave", (event) => {
  prevImage.classList.add("prev-img");
});

next.addEventListener("mouseover", (event) => {
  nextImage.classList.remove("next-img");
});

next.addEventListener("mouseleave", (event) => {
  nextImage.classList.add("next-img");
});
