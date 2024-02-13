/* -------------------------------------------------------------------------- */
/*                                Requete AJAX                                */
/* -------------------------------------------------------------------------- */

jQuery(document).ready(function ($) {
  var offset = 0; // commence à partir du premier élément
  var limit = 8; // nombre d'images à charger à chaque fois

  // fonction pour charger les images via AJAX
  function loadMoreImages() {
    $.ajax({
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "load_more_images",
        offset: offset, // envoie l'offset actuel
        limit: limit,
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
});
