
<!doctype html>
<html class="no-js" lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Lille Immo</title>
  <meta name="description" content="Bienvenue chez Lille Immo, forts de nos 15 ans d'expérience nous nous assurons de trouver LE bien qui vous convient">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="icon" type="image/ico" href="favicon.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Prompt%7cOpen+Sans%7cReem+Kufi" rel="stylesheet">
  <script src="https://use.fontawesome.com/c6f237cddf.js"></script>
  <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>
<body>
  <!--[if lt IE 8]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <!--

  ~~~~~~~~~Start of the top head content~~~~~~~~~~~~~

-->

<!-- Start of the header -->
<header id="#top">

  <!-- Back to top button -->
  <a href="#top" class="m-b-1"><i class="fa fa-arrow-up fa-lg hidden-sm-up pull-xs-right" aria-hidden="true"></i></a>
  <a href="#top" class="m-b-1 m-r-1"><i class="fa fa-arrow-up fa-2x hidden-sm-down pull-sm-right" aria-hidden="true"></i></a>

  <!-- Boxed layout inside the header -->
  <div class="container">
    <div class="row">
      <!-- Left logo -->
      <figure class="col-xs-5">
        <img src="img/logo_immo_large.jpg" alt="logo lille immo" class="img-fluid hidden-md-down">
        <img src="img/logo_immo_medium.jpg" alt="logo lille immo" class="img-fluid hidden-xs-down hidden-lg-up">
        <img src="img/logo_immo_small.jpg" alt="logo lille immo" class="img-fluid hidden-sm-up">
      </figure>
      <!-- Main title on the right -->
      <aside class="col-xs-7 text-xs-center">
        <h1>Des experts à votre service</h1>
      </aside>
    </div>
  </div>

</header>
<!-- end of the header -->

<!-- Start of the navigation -->
<nav>

  <!-- Personnal space icon -->
  <a href="#">
    <aside class="pull-xs-right m-r-2" id="personal_space">
      <i class="fa fa-user fa-3x m-r-1 hidden-xs-down" aria-hidden="true"></i>
      <i class="fa fa-user fa-2x m-r-1 hidden-sm-up" id="small_user" aria-hidden="true"></i>
      <span>Espace<br>personnel</span>
    </aside>
  </a>
  <!-- Navigation -->
  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
    &#9776;
  </button>
  <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
    <ul class="nav navbar-nav">
      <li class="nav-item m-x-1 on">
        <a class="nav-link" href="index.html">Accueil<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item m-x-1">
        <a class="nav-link" href="achat.html">Achat</a>
      </li>
      <li class="nav-item m-x-1">
        <a class="nav-link" href="location.html">Location</a>
      </li>
      <li class="nav-item m-x-1">
        <a class="nav-link" href="presentation.html">Présentation</a>
      </li>
      @if (Route::has('login'))
    @auth
        @if (auth()->user()->status == 'active')
            <li class="nav-item m-x-1">
                <form action="{{ route('logout') }}" method="post">
                    @csrf 
                    <button type="submit" class="btn btn-warning">Deconnexion</button>
                </form>
            </li>
        @else
            <li class="nav-item m-x-1">
                <div class="alert alert-danger">
                    Votre compte est désactivé. Veuillez contacter Naruto 7emeDuNom Email: Uzumaki@gmail.com.
                </div>
            </li>
        @endif
    @else
        @if (isset($userInactive) && $userInactive == 'inactive')
            <li class="nav-item m-x-1">
                <div class="alert alert-danger">
                    Votre compte est désactivé. Veuillez contacter Naruto 7emeDuNom Email: Uzumaki@gmail.com.
                </div>
            </li>
        @else
            <li class="nav-item m-x-1">
                <button class="btn btn-primary"> <a style="color: white;" href="{{ route('register') }}">Inscription</a></button>
            </li>
            <li class="nav-item m-x-1">
                <button class="btn btn-danger"> <a style="color: white;" href="{{ route('login') }}">Connexion</a></button>
            </li>
        @endif
    @endauth
@endif
    </ul>
  </div>

</nav>
<!-- End of the navigation -->

<!-- Start of the jumbotron with main image -->
<div class="jumbotron p-t-1 text-xs-center">
  <span class="pull-xs-right appeal landing">Vous aussi trouvez votre place !</span>
</div>
<!-- End of the jumbotron with main image -->

<!--

~~~~~~~~~End of the top head content~~~~~~~~~~~~~

-->

<!--

~~~~~~~~~Start of the main content~~~~~~~~~~~~~

-->

<!-- Boxed layout for the main content -->
<section class="container">

<h2 class="m-b-1">Nos coups de coeur !</h2>
  <!-- First section with the carousel and the search form -->
  <div class="row">

    <!-- Carousel -->
    <figure class="col-sm-12 col-lg-9 hidden-sm-down p-x-0">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3500">
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img src="img/salon_large.jpg" alt="salon d'un appartement en vente">
            <div class="carousel-caption">
              <h3>T2 Wambrechies</h3>
              <p>Beaux volumes, moderne, à ne pas manquer</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/interieur_large.jpg" alt="canapés dans un salon">
            <div class="carousel-caption">
              <h3>Maison flamande</h3>
              <p>Un bien d'exception au coeur de Lille</p>
            </div>
          </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="icon-prev" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="icon-next" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </figure>
  
    <!-- Aside with the search form -->
    <aside class="col-xs-12 col-lg-3 p-y-2" id="search_form">
    <h3 class="m-b-1 text-xs-center"><i class="fa fa-search-plus" aria-hidden="true"></i>Vous recherchez</h3>
  
    <form action="{{ route('search') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="nom_bien">Nom du Bien</label>
            <input class="form-control" type="text" name="nom_bien" placeholder="Nom du Bien">
        </div>
       
        <div class="form-group">
            <label for="ville">Ville(s)</label>
            <input class="form-control" type="text" name="addresse" placeholder="Ville(s)">
        </div>
        <button type="submit" class="btn" id="find_button">Trouver mon bien</button>
 
    </form>
</aside>

  </div>

</section>

<!-- Second boxed section -->

<section class="container m-t-2">

  <h3 class="m-b-2">Annonces à la une</h3>

<!-- Start the card content -->
  <div class="row">
@foreach($biens as $bien)
    <div class="col-xs-12 col-sm-6 col-md-4">
      <article class="card">
        <div class="card-block text-xs-center head">
          <h4 class="card-title">Bien: {{$bien->nom}}</h4>
          <h6 class="card-subtitle">Address: {{$bien->addresse}}</h6>
        </div>
        <figure>
        <img src="{{ asset('product/' . basename($bien->image)) }}" class="img-fluid hidden-sm-up" alt="maison bleu à vendre">
<img src="{{ asset('product/' . basename($bien->image)) }}" class="img-fluid hidden-xs-down hidden-lg-up" alt="maison bleue à vendre">
<img src="{{ asset('product/' . basename($bien->image)) }}" class="img-fluid hidden-md-down" alt="maison bleu à vendre">

</figure>
        <div class="card-block text-xs-center">
          <p class="card-text">{{$bien->description}}</p>
          <figure class="description">
            <span><i class="fa fa-bed" aria-hidden="true"></i>{{$bien->categorie}}</span>
            <span><i class="fa fa-tree" aria-hidden="true"></i> {{$bien->dimension_bien}} m²</span>
       
            <span><i class="fa fa-tint" aria-hidden="true"></i>Publie par:  {{ $bien->user->name }}</span>
          </figure>
          <a href="{{ route('frontend.Ajoutcommentaire', $bien->id) }}" class="card-link"><i class="fa fa-eye m-r-1" aria-hidden="true"></i>Voir</a>

        </div>
      </article>
    </div>
@endforeach
   

   

  </div>

</section>
<!-- Second boxed section -->
<section class="container m-t-2">
    <h3 class="m-b-2">Résultats de la recherche</h3>
    <!-- Start the card content -->
    <div class="row">
        @if(isset($results) && count($results) > 0)
            @foreach($results as $result)
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <article class="card">
                        <div class="card-block text-xs-center head">
                            <h4 class="card-title">Bien: {{ $result->nom }}</h4>
                            <h6 class="card-subtitle">Address: {{ $result->addresse }}</h6>
                        </div>
                        <figure>
                            <img src="product/{{ $result->image }}" class="img-fluid hidden-sm-up" alt="maison bleu à vendre">
                            <img src="product/{{ $result->image }}" class="img-fluid hidden-xs-down hidden-lg-up" alt="maison bleue à vendre">
                            <img src="product/{{ $result->image }}" class="img-fluid hidden-md-down" alt="maison bleu à vendre">
                        </figure>
                        <div class="card-block text-xs-center">
                            <p class="card-text">{{ $result->description }}</p>
                            <figure class="description">
                                <span><i class="fa fa-bed" aria-hidden="true"></i>{{ $result->categorie }}</span>
                                <!-- Ajoutez d'autres informations selon votre modèle -->
                            </figure>
                            <a href="#" class="card-link"><i class="fa fa-eye m-r-1" aria-hidden="true"></i>Voir</a>
                        </div>
                    </article>
                </div>
            @endforeach
        @else
            <div class="col-xs-12">
                <p>Aucun résultat trouvé.</p>
            </div>
        @endif
    </div>
</section>


<!--

~~~~~~~~~End of the main content~~~~~~~~~~~~~

-->

<!--

~~~~~~~~~Start of the footer~~~~~~~~~~~~~

-->

<footer class="m-t-3">

  <!-- Start of the section -->
  <section class="container p-t-1 p-x-1 text-xs-center">
    <h4>SamaImmo en bref</h4>
    <p>SamaImmo c'est 5 agences réparties au travers de la métropole et toujours à votre service. Vous pouvez contacter l'agence la plus proche de chez vous via la rubrique nos agences ou contacter notre siège au 03 20 ## ## ##</p>
    <!-- Footer navigation -->
    
    <!-- Copyright paragraphe -->
    <p>SamaImmo 2023. &copy;Une réalisation <a href="https://thomgo.github.io/portfolio/" target="_blank">Team Bassen</a></p>
  </section>

</footer>

<!--

~~~~~~~~~End of the footer~~~~~~~~~~~~~

-->

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery-1.12.0.min.js')}}"><\/script>')</script>
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/vendor/jquery-1.12.0.min.js')}}"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
  (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js" integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD" crossorigin="anonymous"></script>
</body>
</html>
