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
  function getOrderByArguments(selectedOption) {
    if (selectedOption === "plus-recentes") {
      return localized_data.argsCroissant;
    } else if (selectedOption === "plus-anciennes") {
      return localized_data.argsDecroissant;
    } else {
      return {};
    }
  }

  function getTypeArguments(selectedOption) {
    if (selectedOption === "argentique") {
      return localized_data.argsTypeArgentique;
    } else if (selectedOption === "numerique") {
      return localized_data.argsTypeNumerique;
    } else {
      return {};
    }
  }

  function getCategoriesArguments(selectedOption) {
    if (selectedOption === "reception") {
      return localized_data.argsReception;
    } else if (selectedOption === "television") {
      return localized_data.argsTelevision;
    } else if (selectedOption === "concert") {
      return localized_data.argsConcert;
    } else if (selectedOption === "mariage") {
      return localized_data.argsMariage;
    } else {
      return {};
    }
  }

  // Gére le changement de sélection pour les filtres d'ordre et de type
  $("#ordre, #type, #categories").on("change", function () {
    const selectedOrdre = $("#ordre").val();
    const selectedType = $("#type").val();
    const selectedCategories = $("#categories").val();

    // Obtient les arguments pour l'ordre et le type
    const orderByArgs = getOrderByArguments(selectedOrdre);
    const typeArgs = getTypeArguments(selectedType);
    const categoriesArgs = getCategoriesArguments(selectedCategories);

    // Fusionne les arguments pour l'ordre et le type
    args = Object.assign({}, orderByArgs, typeArgs, categoriesArgs);

    // Réinitialise l'offset à 0 et charge les nouvelles images
    offset = 0;
    $("#image-container").empty(); // Vide le conteneur d'images existant
    loadMoreImages();
  });
});

/*
$("#ordre, #type").on("change", function () {
    const selectedOption = this.value;
    if (selectedOption === "plus-recentes") {
      args = localized_data.argsCroissant;
      console.log(args);
      console.log("plus-recentes");
    } else if (selectedOption === "plus-anciennes") {
      args = localized_data.argsDecroissant;
      console.log(args);
      console.log("plus-anciennes");
    } else if (selectedOption === "argentique") {
      args = localized_data.argsTypeArgentique;
      console.log(args);
      console.log("argentique");
    } else if (selectedOption === "numerique") {
      args = localized_data.argsTypeNumerique;
      console.log(args);
      console.log("numerique");
    }
    // Réinitialise l'offset à 0 et charger les nouvelles images
    offset = 0;
    $("#image-container").empty(); // vide la place d'images existant
    loadMoreImages();
  });
});
*/
