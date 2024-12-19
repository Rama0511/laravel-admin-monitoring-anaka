<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Konsultasi</title>
</head>
<body>
    <h1>Edit Konsultasi untuk {{ $email }}</h1>
    <form action="{{ route('consultation.update', ['email' => $email, 'consultationId' => $consultation['name']]) }}" method="POST">
        @csrf
        <label for="catatan">Catatan:</label>
        <textarea name="cat atan" id="catatan" required>{{ $consultation['fields']['catatan']['stringValue'] }}</textarea>
        <button type="submit">Konfirmasi Edit</button>
    </form>
</body>
</html>