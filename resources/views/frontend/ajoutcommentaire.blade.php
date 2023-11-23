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
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
                bootstrapdash.com 2020</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a
                    href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap
                    admin templates</a> from Bootstrapdash.com</span>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- En-tête -->
    <header>
        <h1>{{ $bien->nom}}</h1>
    </header>
    <style>
        /* Réinitialisation des styles par défaut du navigateur */
        body,
        h1,
        h2,
        h3,
        p,
        textarea,
        button {
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
        .card{
        float: left;
        margin-top: 40px;

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

        .image {
            border-radius: 10px;
    width: 200px;
    height: 200px;
        }

        .card {
            margin-right: 20px;
            text-align: center;
        }

        .post {
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
                        <div></div>
                        <img class="image" src="{{ asset('storage/' . $bien->image) }}" style="width: 1500px; height: 700px">
                        <h3>Nom Bien : {{ $bien->nom }}</h3>
                        <h3>Categorie : {{ $bien->categorie }}</h3>
                        <h3>Description : {{ $bien->description }}</h3>

                        <!-- Ajouter les champs du formulaire -->
                        @if ($isConnected)
                            <div class="form-group">
                                <label for="commentaire">Commentaire :</label>
                                <textarea style="width: 446px" name="commentaire" id="commentaire" cols="30" rows="3"></textarea>
                            </div>
                            <button type="submit">Commenter</button>
                        @else
                            <p>veiller vous connecter d'abord</p>
                            <p>
                                <button class="btn btn-danger"> <a style="color: white;"
                                        href="{{ route('login') }}">Connexion</a></button>
                            </p>
                        @endif
                    </form>
                </div>



            {{-- </div> --}}
            {{-- <div class="main-panel">
                <div class="content-wrapper ">
                    <div class="col-12 m-4 p-4 ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Nom</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comment as $comments)
                                    <tr>
                                        <td>{{ $comments->user->name }}</td>
                                        <td>{{ $comments->content }}</td>
                                        <td>{{ $comments->id }}</td>
                                        <td> --}}
                                            {{-- <form action="{{ route('bien.delete', ['id' => $produit->id]) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i> Supprimer
                                                </button>
                                                <a href="/modifier/{{ $produit->id }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i> Modifier
                                                </a>
                                            </form> --}}
                                        {{-- </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}





                <div class="card">
                    <h1>Les commentaire</h1>
                    @foreach ($comment as $comments)
                        <p class="post">Nom Utilisateur: {{ $comments->user->name }} Commentaire: {{ $comments->content }}</p>
                        <button class="sucess"><a href="delete_comment/{{ $comments->id }}">Supprimer</a></button>
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
    {{-- <footer>
        <!-- Ajoutez ici le contenu de votre pied de page -->
    </footer> --}}


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
</body>

</html>
