<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="baby-carriage-solid.svg" type="x-icon">
    <title>Edit Data Perkembangan Anak</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8d7da;
            font-family: "Funnel Display", sans-serif; 
        }
        .container {
            background-color: #ffffff; 
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #d63384; 
        }
        .alert {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #d63384; 
            border: none;
        }
        .btn-primary:hover {
            background-color: #c8237a; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Perkembangan Anak</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('perkembangan.update', ['id' => basename($document['name'])]) }}" method="POST">
            @csrf
            @method('PATCH') 
            <div class="form-group">
                <label for="bulan">Bulan</label>
                <input type="number" class="form-control" id="bulan" name="bulan" value="{{ $document['fields']['bulan']['stringValue'] ?? $document['fields']['bulan']['integerValue'] }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $document['fields']['deskripsi']['stringValue'] }}</textarea>
            </div>
            <div class="form-group">
                <label for="berat">Berat</label>
                <input type="text" class="form-control" id="berat" name="berat" value="{{ $document['fields']['berat']['stringValue'] }}" required>
            </div>
            <div class="form-group">
                <label for="tinggi">Tinggi</label>
                <input type="text" class="form-control" id="tinggi" name="tinggi" value="{{ $document['fields']['tinggi']['stringValue'] }}" required>
            </div>
            <div class="form-group">
                <label for="lingkar_kepala">Lingkar Kepala</label>
                <input type="text" class="form-control" id="lingkar_kepala" name="lingkar_kepala" value="{{ $document['fields']['lingkar_kepala']['stringValue'] }}" required>
            </div>
            <div class="form-group">
                <label for="vaksin_info">Informasi Vaksin</label>
                <input type="text" class="form-control" id="vaksin_info" name="vaksin_info" value="{{ $document['fields']['vaksin_info']['stringValue'] ?? '' }}">
            </div>
            <div class="form-group">
                <label for="mom_notes">Catatan Ibu</label>
                <textarea class="form-control" id="mom_notes" name="mom_notes[]" rows="3">{{ implode("\n", array_column($document['fields']['mom_notes']['arrayValue']['values'] ?? [], 'stringValue')) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Data</button>
        </form>
    </div>
</body>
</html>