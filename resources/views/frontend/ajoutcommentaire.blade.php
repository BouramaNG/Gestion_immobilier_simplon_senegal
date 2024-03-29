



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Détails de l'annonce</title>
    <!-- Incluez ici les balises meta, les liens vers les styles, etc. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.3/sweetalert2.min.css"
            integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Inclure la bibliothèque Slick -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</head>

<body>

    <!-- En-tête -->
    <header>
        <h1>Détails de l'annonce</h1>
    </header>
    <style>
        /* Réinitialisation des styles par défaut du navigateur */
body, h1, h2, h3, p, textarea, button {
    margin: 0;
    padding: 0;
}

/* Style de base */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
}

.container {
    width: 80%;
    margin: 0 auto;
    justify-content: center;
}

/* En-tête */
header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

/* Contenu principal */
main {
    margin-top: 20px;
}

/* Formulaire de commentaire */
form {
    margin-top: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #333;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #555;
}

/* Pied de page */
footer {
    margin-top: 20px;
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}
.image{
    border-radius: 10px;
    width: 200px;
    height: 200px;
}
.card
{
    margin-right: 20px;
    text-align: center;
}
.post
{
    font-size: 20px;
}
    </style>

    <!-- Contenu principal -->

    <main>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <h3>Commentaires</h3>
                <form action="{{ route('frontend.Ajoutercommentaire', ['id' => $bien->id]) }}" method="post">
                    @csrf

                    <img class="image" src="{{ asset('product/' . basename($bien->image)) }}" alt="">
                    <h3>Nom Bien : {{ $bien->nom }}</h3>
                    <h3>Categorie : {{ $bien->categorie }}</h3>
                    <h3>Description : {{ $bien->description }}</h3>
                    <h3>Dimention Bien : {{ $bien->dimension_bien }} m²</h3>
                    <h3>Nombres Chambres : {{ $bien->nombre_chambre }}</h3>
                    <h3>Nombres Toillette: {{ $bien->nombre_toillette }}</h3>
                    <h3>Nombres Balcon : {{ $bien->balcons }}</h3>
                    <h3>Status Bien : {{ $bien->status }}</h3>
                    <h3>Proprietaire : {{ $bien->user->name }}</h3>

                    <!-- Ajouter les champs du formulaire -->
                    @if($isConnected)
                    <div class="form-group">
                        <label for="commentaire">Commentaire :</label>
                        <textarea name="commentaire" id="commentaire" cols="30" rows="5"></textarea>
                    </div>

                    <button type="submit">Commenter</button>
                    @else
                    <p>veuillez vous connecter d'abord</p>
                    <p>
                        <button class="btn btn-danger"> <a style="color: white;" href="{{ route('login') }}">Connexion</a></button>
                    </p>
                    @endif
                </form>
            </div>

            <div class="slider-container">
                @foreach ($bien->chambres as $chambre)
                    <h3>Dimension chambre : {{ $chambre->dimension_chambre }} m²</h3>

                    @if ($chambre->images->isNotEmpty())
                        @foreach ($chambre->images as $image)
                            <div>
                                <img style="width: 200px; height: 200px;" src="{{ asset($image->photo_name) }}" alt="Chambre Image">
                            </div>
                        @endforeach
                    @else
                        <p>Aucune image trouvée pour cette chambre.</p>
                    @endif
                @endforeach
            </div>

        </div>
    </div>
</main>
<div class="card">
<h1>Les commentaire</h1>
@foreach($comment as $comments)
<div>
<p class="post">Nom Utilisateur: {{$comments->user->name}} Commentaire:  {{$comments->content}}</p>
<button class="sucess"><a href="delete_comment/{{$comments->id}}">Supprimer</a></button>
</div>
@endforeach
</div>
    <!-- Pied de page -->
    <footer>
        <!-- Ajoutez ici le contenu de votre pied de page -->
    </footer>

    
<script>
        document.addEventListener('DOMContentLoaded', () => {
            'use strict';
            // console.log('Alert');
            @if (count($errors))
                setTimeout(() => {
                    Swal.fire({
                        title: 'Erreur...',
                        text: 'Les données renseignées sont invalides.',
                        icon: 'error',
                        confirmButtonText: 'Corriger',
                        allowOutsideClick: false
                    })
                }, 1200);
            @endif

            @if (session('message'))
                setTimeout(() => {
                    Swal.fire({
                        title: 'Votre demande est bien enregistrée', //Votre demande a bien été
                        text: 'Une confirmation vous sera envoyée par email', //{{ Session::get('message') }}
                        icon: 'success',
                        confirmButtonText: 'Terminer',
                        allowOutsideClick: false
                    })
                }, 1200);
            @endif
        })
    </script>
    <script>
    $(document).ready(function(){
        $('.slider-container').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
            centerMode: true,
            focusOnSelect: true,
        });
    });
</script>

</body>
</html>