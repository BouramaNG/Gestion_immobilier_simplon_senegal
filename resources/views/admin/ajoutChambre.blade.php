<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SamaImmo</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.mi') }}n.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />
    <style>
        .titre {
            text-align: center;
        }

        .center {
            text-align: center;
            margin: auto;
            width: 50%;
            margin-top: 40px;
            border: 3px solid green;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        input {
            gap: 10px;
        }

        .designe {
            padding-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-panel">
            <div class="content-wrapper">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <div class="titre">
                        <h1>Ajouter une chambre</h1>
                        <form action="ajout_chambre" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div id="chambres">
                                <input type="hidden" value="{{ $nombre_chambre }}">
                                @if ($nombre_chambre >= 1)
                                <input type="number" name="dimension_chambre" placeholder="dimension ici">
                                <input type="file" name="multi_image " placeholder="images ici" multiple>
                                <br>
                                @for ($i = 2; $i <= $nombre_chambre; $i++)
                                    <input type="number" name="dimension_chambre{{ $i }}" placeholder="dimension ici {{ $i }}">
                                    <input type="file" name="multi_image {{ $i }}" placeholder="images ici {{ $i }}" multiple>
                                    <br>
                                @endfor
                                @endif
                    </div>
                </div>
</body>

</html>
