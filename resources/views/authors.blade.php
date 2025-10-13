<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authors | Booksales</title>
</head>

<body>
    <h1>Ini Halaman Genre dari Buku</h1>
    <h1>Authors</h1>

    @foreach ($authors as $author)
        <ul>
            <li>{{ $author['name'] }}</li>
            <li>{{ $author['bio'] }}</li>
            <li><img src="{{ asset('images/authors/' . $author['photo']) }}" alt="{{ $author['name'] }}" /></li>
        </ul>
    @endforeach

</body>

</html>
