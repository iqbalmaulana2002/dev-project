<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kirim Email</title>
</head>
<body>
    <h1>Hallo {{ $emailUser }}, Maaf!!! barang yang anda pinjam sudah terlalu lama dalam jangka waktu, segera kembalikan barang anda, terima kasih telah menggunakan layanan Kami.</h1>
    <span>Untuk informasi lebih jelas, silahkan hubungi admin kami.</span>
    <span>{{ $emailAdmin }}</span>
</body>
</html>