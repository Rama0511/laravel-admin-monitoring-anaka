@extends('layouts.app')

@section('title', 'Daftar Konsultasi')

@section('content')
    <h2 class="mt-5 text-center"><i class="fa-solid fa-notes-medical" style="color: #d5006d;"></i> Daftar Konsultasi</h2>
    <p class="text-center">Informasi tentang konsultasi anak-anak.</p>

    <!-- Form untuk memilih pengguna -->
    <form action="{{ route('consultation.index') }}" method="GET" class="mb-4">
        <div class="form-group">
            <label for="user_email">Pilih Pengguna:</label>
            <select name="user_email" id="user_email" class="form-control" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user['fields']['email']['stringValue'] }}">{{ $user['fields']['email']['stringValue'] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tampilkan Konsultasi</button>
    </form>

    <!-- Menampilkan konsultasi jika ada -->
    @if(isset($consultations) && count($consultations) > 0)
        <h2>Konsultasi untuk {{ $selectedUser   }}</h2>
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
                @foreach($consultations as $consultation)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                        <td>{{ $consultation['fields']['catatan']['stringValue'] }}</td>
                        <td>{{ $consultation['fields']['status']['stringValue'] }}</td>
                        <td>
                            @if($consultation['fields']['status']['stringValue'] == 'Belum Dilakukan')
                                <form action="{{ route('consultation.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $selectedUser   }}">
                                    <input type="hidden" name="consultation_id" value="{{ $consultation['name'] }}">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-2">Lakukan Konsultasi</button>
                                </form>
                            @else
                                <form action="{{ route('consultation.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $selectedUser   }}">
                                    <input type="hidden" name="consultation_id" value="{{ $consultation['name'] }}">
                                    <div class="form-group">
                                        <label for="catatan">Catatan Tambahan:</label>
                                        <input type="text" name="catatan" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-warning mt-2">Edit Catatan Konsultasi</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning mt-3" role="alert">
            Tidak ada konsultasi yang tersedia untuk pengguna yang dipilih.
        </div>
    @endif

    <a href="{{ url('/dashboard') }}" class="btn btn-primary mt-4"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
@endsection