<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PerkembanganController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'bulan' => 'required|integer',
            'deskripsi' => 'required|string',
            'berat' => 'required|string',
            'tinggi' => 'required|string',
            'lingkar_kepala' => 'required|string',
            'vaksin_info' => 'nullable|string',
            'mom_notes' => 'nullable|array',
            'mom_notes.*' => 'string',
        ]);

        // Membuat instance Guzzle Client
        $client = new Client();

        // Menyiapkan data untuk dikirim
        $fields = [
            'bulan' => ['integerValue' => $request->bulan],
            'deskripsi' => ['stringValue' => $request->deskripsi],
            'berat' => ['stringValue' => $request->berat],
            'tinggi' => ['stringValue' => $request->tinggi],
            'lingkar_kepala' => ['stringValue' => $request->lingkar_kepala],
            'vaksin_info' => ['stringValue' => $request->vaksin_info ?? ''],
        ];

        // Hanya tambahkan mom_notes jika ada nilai yang diisi
        if ($request->has('mom_notes') && !empty(array_filter($request->mom_notes))) {
            $fields['mom_notes'] = [
                'arrayValue' => [
                    'values' => array_map(function ($note) {
                        return ['stringValue' => $note];
                    }, array_filter($request->mom_notes))
                ]
            ];
        }

        // Kirim permintaan ke API untuk memperbarui data
        $response = $client->patch("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/perkembangan_anak_bulanan/{$id}", [
            'json' => [
                'fields' => $fields,
            ],
        ]);

        // Tangani respons dan kembalikan ke halaman yang sesuai
        return redirect()->route('perkembangan.create')->with('success', 'Data berhasil diperbarui.');
    }

    public function edit($id)
    {
        // Membuat instance Guzzle Client
        $client = new Client();

        // Mengambil data dari API Firestore berdasarkan ID
        $response = $client->get("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/perkembangan_anak_bulanan/{$id}");
        
        // Memeriksa apakah permintaan berhasil
        if ($response->getStatusCode() == 200) {
            $document = json_decode($response->getBody(), true);
            return view('perkembangan.edit', ['document' => $document]);
        }

        return redirect()->route('perkembangan.create')->with('error', 'Data tidak ditemukan.');
    }

    public function destroy($id)
    {
        // Membuat instance Guzzle Client
        $client = new Client();

        // Menghapus data dari API Firestore
        $response = $client->delete("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/perkembangan_anak_bulanan/{$id}");

        // Memeriksa apakah permintaan berhasil
        if ($response->getStatusCode() == 200) {
            return redirect()->route('perkembangan.create')->with('success', 'Data berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
    public function create()
    {
        // Membuat instance Guzzle Client
        $client = new Client();

        // Mengambil data dari API Firestore
        $response = $client->get("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/perkembangan_anak_bulanan");
        
        // Memeriksa apakah permintaan berhasil
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            return view('perkembangan.create', ['documents' => $data['documents']]);
        }

        return view('perkembangan.create', ['documents' => []]);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'bulan' => 'required|integer',
            'deskripsi' => 'required|string',
            'berat' => 'required|string',
            'tinggi' => 'required|string',
            'lingkar_kepala' => 'required|string',
            'vaksin_info' => 'nullable|string',
            'mom_notes' => 'nullable|array',
            'mom_notes.*' => 'string',
        ]);

        // Membuat instance Guzzle Client
        $client = new Client();

        // Menentukan nama dokumen berdasarkan bulan
        $documentName = "bulan" . $request->bulan;

        // Mengirim data ke API Firestore dengan nama dokumen yang ditentukan
        $response = $client->patch("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/perkembangan_anak_bulanan/{$documentName}", [
            'json' => [
                'fields' => [
                    'bulan' => ['integerValue' => $request->bulan],
                    'deskripsi' => ['stringValue' => $request->deskripsi],
                    'berat' => ['stringValue' => $request->berat],
                    'tinggi' => ['stringValue' => $request->tinggi],
                    'lingkar_kepala' => ['stringValue' => $request->lingkar_kepala],
                    'vaksin_info' => ['stringValue' => $request->vaksin_info],
                    'mom_notes' => [
                        'arrayValue' => [
                            'values' => array_map(function ($note) {
                                return ['stringValue' => $note];
                            }, $request->mom_notes ?? [])
                        ]
                    ],
                ]
            ]
        ]);

        // Memeriksa apakah permintaan berhasil
        if ($response->getStatusCode() == 200) {
            return redirect()->route('perkembangan.create')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}