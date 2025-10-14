<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Selamat Datang | Booksales</title>
</head>

<body>
    <h1>Hello World</h1>
    <p>Selamat Datang di Toko Booksales</p>

    @foreach ($books as $book)
        <ul>
            <li>{{ $book['title'] }}</li>
            <li>{{ $book['description'] }}</li>
            <li>{{ $book['price'] }}</li>
            <li>{{ $book['stock'] }}</li>
        </ul>
    @endforeach

</body>

</html>
