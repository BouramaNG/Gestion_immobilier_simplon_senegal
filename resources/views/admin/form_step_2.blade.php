<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.form-container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
}

input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>

<div class="form-container">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <h1>Ajouter les détails des chambres</h1>
    <form action="{{ route('storeStep2') }}" method="POST" enctype="multipart/form-data">
        @csrf

     
        @for ($i = 1; $i <= $nombreChambres; $i++)
            <div class="form-group">
                <label for="dimension_chambre_{{ $i }}">Dimension de la chambre {{ $i }}</label>
                <input name="dimension_chambre[]" id="dimension_chambre_{{ $i }}" type="number" class="form-control">
            </div>

            <div class="form-group">
                <label for="image_chambre_{{ $i }}">Image de la chambre {{ $i }}</label>
                <input name="image_chambre[]" id="image_chambre_{{ $i }}" type="file" class="form-control" multiple>
            </div>
        @endfor

     

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Enregistrer</button>
        </div>
    </form>
</div>
