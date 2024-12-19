@extends('layouts.app')

@section('title', 'Daftar Imunisas')

@section('content')
    <h2 class="mt-5 text-center"><i class="fa-solid fa-syringe" style="color: #d5006d;"></i> Daftar Imunisasi</h2>
    <p class="text-center">Informasi tentang imunisasi anak-anak.</p>


    <form action="{{ route('imunisasi.index') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="user_email">Pilih Pengguna:</label>
            <select name="user_email" id="user_email" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user['fields']['email']['stringValue'] }}">{{ $user['fields']['email']['stringValue'] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan Imunisasi</button>
    </form>

    @if(isset($imunisasis) && count($imunisasis) > 0)
        <h2>Imunisasi untuk {{ $selectedUser   }}</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($imunisasis as $imunisasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td> 
                        <td>{{ $imunisasi['fields']['catatan']['stringValue'] }}</td>
                        <td>{{ $imunisasi['fields']['status']['stringValue'] }}</td>
                        <td>
                            @if($imunisasi['fields']['status']['stringValue'] == 'Belum Dilakukan')
                                <form action="{{ route('imunisasi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $selectedUser   }}">
                                    <input type="hidden" name="imunisasi_id" value="{{ $imunisasi['name'] }}">
                                    <input type="hidden" name="catatan_jd" value="{{ $imunisasi['fields']['catatan']['stringValue'] }}">
                                    <input type="hidden" name="id_catatan" value="{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-2">Lakukan Imunisasi</button>
                                </form>
                            @else
                                <form action="{{ route('imunisasi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $selectedUser   }}">
                                    <input type="hidden" name="imunisasi_id" value="{{ $imunisasi['name'] }}">
                                    <input type="hidden" name="catatan_jd" value="{{ $imunisasi['fields']['catatan']['stringValue'] }}">
                                    <input type="hidden" name="id_catatan" value="{{ $loop->iteration }}">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-2">Edit catatan Imunisasi</button>
                                </form> 
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning mt-3" role="alert">
            Tidak ada imunisasi yang tersedia untuk pengguna yang dipilih.
        </div>
    @endif

    <a href="{{ url('/dashboard') }}" class="btn btn-primary mt-4"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
@endsection