setInterval(function() {
    // Envoyer une requête AJAX pour récupérer le nombre de produits dans le panier
    $.ajax({
        url: '/cart/count', // L'URL de votre route Laravel pour récupérer le nombre de produits dans le panier
        method: 'GET',
        success: function(response) {
            // Mettre à jour le nombre de produits dans le panier
            $('#cartCount').text(response.count);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}, 5000); // Exécuter toutes les 5 secondes (5000 millisecondes)
