<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product Notification</title>
</head>
<body>
    <h1>New Product Added!</h1>
    <p>A new product has been added to the site. Check it out!</p>
    <p>Product Details:</p>
    <ul>
        <li>Name: {{ $propertie->nom }}</li>
        <li>Category: {{ $propertie->categorie }}</li>
        <!-- Add more details as needed -->
    </ul>
</body>
</html>
