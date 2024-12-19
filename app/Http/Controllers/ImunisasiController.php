<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ImunisasiController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index(Request $request)
    {
        $users = $this->getUsers();
        $imunisasis = [];
        $selectedUser  = null;

        if ($request->has('user_email')) {
            $selectedUser  = $request->input('user_email');
            $imunisasis = $this->getimunisasis($selectedUser );
        }

        return view('imunisasi.index', compact('users', 'imunisasis', 'selectedUser'));
    }
    public function edit($email, $imunisasiId)
    {
        // Ambil data imunisas berdasarkan imunisasiId
        $response = $this->client->get($imunisasiId);
        $imunisasi = json_decode($response->getBody()->getContents(), true);

        return view('imunisasi.edit', compact('imunisasi', 'email'));
    }

    public function update(Request $request, $email, $imunisasiId)
    {
        $catatan = $request->input('catatan');

        // Logika untuk memperbarui catatan imunisas
        $this->client->patch($imunisasiId, [
            'json' => [
                'fields' => [
                    'catatan' => ['stringValue' => $catatan]
                ]
            ]
        ]);

        return redirect()->route('imunisasi.index')->with('success', 'Imunisas berhasil diperbarui.');
    }

    private function getUsers()
    {
        $response = $this->client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/users');
        return json_decode($response->getBody()->getContents(), true)['documents'];
    }

    
    private function getimunisasis($email)
    {
        $imunisasis = [];
        for ($i = 1; $i <= 6; $i++) {
            $response = $this->client->get("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/jadwal_imunisasi_$i");
            $data = json_decode($response->getBody()->getContents(), true)['documents'];

            // Mencari imunisas berdasarkan email
            $found = false; // Flag untuk menandai apakah imunisas ditemukan
            foreach ($data as $imunisasi) {
                if (isset($imunisasi['fields']) && $imunisasi['fields']['userId']['stringValue'] === $email) {
                    $imunisasis[] = $imunisasi;
                    $found = true; // Tandai bahwa imunisas ditemukan
                }
            }

            // Jika tidak ada imunisas untuk email, buat entri baru
            if (!$found) {
                $imunisasis[] = [
                    'name' => "projects/fir-series-bf059/databases/(default)/documents/jadwal_imunisasi_$i/$email",
                    'fields' => [
                        'catatan' => ['stringValue' => 'Imunisas ke-' . $i],
                        'userId' => ['stringValue' => $email],
                        'status' => ['stringValue' => 'Belum Dilakukan']
                    ]
                ];
            }
        }
        return $imunisasis;
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'email' => 'required|email',
            'catatan' => 'required|string',
            'imunisasi_id' => 'required|string',
            'id_catatan' => 'required|string',
            'catatan_jd' => 'required|string',
        ]);

        // Membuat instance Guzzle Client
        $client = new Client();
        $client1 = new Client();

        // Menentukan nama dokumen berdasarkan email
        $documentName = $request->email;
        $imunisasi_id = $request->imunisasi_id;

        // URL untuk mengupdate dokumen
        $url = "https://firestore.googleapis.com/v1/{$imunisasi_id}";
        
        // Mengirim data ke API Firestore
        try {
            $response = $client->patch($url, [
                'json' => [
                    'fields' => [
                        'catatan' => ['stringValue' => $request->catatan],
                        'userId' => ['stringValue' => $request->email],
                        'status' => ['stringValue' => 'Sudah Konsultasi']
                    ]
                ]
            ]);


            // Memeriksa apakah permintaan berhasil
            if ($response->getStatusCode() == 200) {
                return redirect()->route('imunisasi.index')->with('success', 'Data konsultasi berhasil disimpan!');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return redirect()->back()->with('error', 'Gagal menghubungi API: ' . $e->getMessage());
        }
    }

    private function updateimunisasiStatus($imunisasiId, $status, $catatan)
    {
        $this->client->patch($imunisasiId, [
            'json' => [
                'fields' => [
                    'status' => ['stringValue' => $status],
                    'catatan' => ['stringValue' => $catatan]
                ]
            ]
        ]);
    }
}
