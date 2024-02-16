/* -------------------------------------------------------------------------- */
/*                                Requete AJAX                                */
/* -------------------------------------------------------------------------- */

jQuery(document).ready(function ($) {
  let offset = 0; // commence à partir du premier élément
  let limit = 8; // nombre d'images à charger à chaque fois
  let args = {}; // Définir les arguments initiaux comme un objet vide

  // fonction pour charger les images via AJAX
  function loadMoreImages() {
    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "load_more_images",
        offset: offset, // envoie l'offset actuel
        limit: limit,
        args: args, // envoie l'arguments de filtre avec la requête AJAX
      },
      success: function (response) {
        $("#image-container").append(response); // ajoute les nouvelles images à l'élément avec l'ID 'image-container'
        offset += limit; // met à jour l'offset pour les prochaines requêtes
        console.log(offset);
      },
    });
  }
  loadMoreImages();

  // attache un gestionnaire d'événement au clic sur le bouton
  $(".photo-list__button").on("click", function () {
    loadMoreImages();
  });

  // attache un gestionnaire d'événement au changement de sélection
  $("#ordre").on("change", function () {
    const selectedOption = this.value;
    if (selectedOption === "plus-recentes") {
      args = localized_data.argsCroissant;
      console.log(args);
    } else if (selectedOption === "plus-anciennes") {
      args = localized_data.argsDecroissant;
      console.log(args);
    }
    // Réinitialise l'offset à 0 et charger les nouvelles images
    offset = 0;
    $("#image-container").empty(); // vide la place d'images existant
    loadMoreImages();
  });
});
