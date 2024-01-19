/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
/* -------------------------------------------------------------------------- */
/*                                 Burger-menu                                */
/* -------------------------------------------------------------------------- */

console.log("navigation.js");
const image = document.getElementById("burgerImage");
const menu = document.getElementById("menu");
const menuOverlay = document.getElementById("menu-overlay");

document.querySelector(".burger-menu").addEventListener("click", function () {
  if (menu.classList.contains("active")) {
    menu.classList.remove("active");
    menu.classList.add("inactive");
    menuOverlay.style.display = "none"; // Masque l'overlay
  } else {
    menu.classList.remove("inactive");
    menu.classList.add("active");
    menuOverlay.style.display = "block"; // Affiche l'overlay
  }

  // Vérifie quelle image est actuellement affichée et bascule vers l'autre
  if (image.src.includes("menu-open.svg")) {
    image.src =
      "http://localhost:10155/wp-content/themes/motaphoto/assets/images/menu-close.svg";
  } else {
    image.src =
      "http://localhost:10155/wp-content/themes/motaphoto/assets/images/menu-open.svg";
  }
});
