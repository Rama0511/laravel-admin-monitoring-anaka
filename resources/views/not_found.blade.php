<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tidak Tersedia</title>
    <link rel="icon" href="baby-carriage-solid.svg" type="x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet"></body></div>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Data Tidak Tersedia</h2>
        <p class="text-center">Maaf, data perkembangan anak untuk bulan <strong>{{ $bulan }}</strong> tidak tersedia.</p>
        <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
    </div>
</body>
</html>