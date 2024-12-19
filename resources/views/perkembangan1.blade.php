<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="baby-carriage-solid.svg" type="x-icon">
        <title>Informasi Perkembangan Anak</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet"></body>
    </head>
    <body>
        <div class="container">
            <h2 class="mt-5 text-center"><i class="fas fa-child" style="color: #d5006d;"></i> Data Anak Dan Perkebangan Anak</h2>
            <p class="text-center">Informasi tentang anak-anak dan perkebangan anak.</p>

            <table class="table table-bordered mt-3" id="childrenTable">
                <thead>
                    <tr>
                        <th>Nama Anak</th>
                        <th>Jenis Kelamin</th>
                        <th>Tinggi Badan</th>
                        <th>Berat Badan</th>
                        <th>Status Gizi</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($perkembangan1) && count($perkembangan1) > 0)
                        @foreach ($perkembangan1 as $child)
                            <tr>
                                <td>{{ $child['fields']['name']['stringValue'] }}</td>
                                <td>{{ $child['fields']['gender']['stringValue'] }}</td>
                                <td>{{ $child['fields']['height']['integerValue'] }}</td>
                                <td>{{ $child['fields']['weight']['integerValue'] }}</td>
                                <td>{{ $child['fields']['nutritionStatus']['stringValue'] }}</td>
                                <td>{{ (new \DateTime($child['fields']['birthDate']['stringValue']))->format('d F Y') }}</td>
                                <td>
                                    @php
                                        $birthDate = new \Carbon\Carbon($child['fields']['birthDate']['stringValue']);
                                        $ageInMonths = $birthDate->diffInMonths(now());
                                    
                                        echo floor($ageInMonths).' bulan';
                                    @endphp
                                </td>
                                <td>
                                    <a href="{{ route('perkembangan2', ['bulan' => floor($ageInMonths), 'nama' => $child['fields']['name']['stringValue']]) }}" class="btn btn-info">
                                        <i class="fas fa-child"></i> Lihat Perkembangan Anak
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">
                                <button class="btn btn-warning" data-toggle="modal" data-target="#noDataModal">Data Anak Kosong</button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali ke ke Dashboard</a>
        </div>
    </body>
</html>



