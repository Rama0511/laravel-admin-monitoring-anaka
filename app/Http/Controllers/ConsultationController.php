<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ConsultationController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function index(Request $request)
    {
        $users = $this->getUsers();
        $consultations = [];
        $selectedUser  = null;

        if ($request->has('user_email')) {
            $selectedUser  = $request->input('user_email');
            $consultations = $this->getConsultations($selectedUser );
        }

        return view('consultation.index', compact('users', 'consultations', 'selectedUser'));
    }
    public function edit($email, $consultationId)
    {
        // Ambil data konsultasi berdasarkan consultationId
        $response = $this->client->get($consultationId);
        $consultation = json_decode($response->getBody()->getContents(), true);

        return view('consultation.edit', compact('consultation', 'email'));
    }

    public function update(Request $request, $email, $consultationId)
    {
        $catatan = $request->input('catatan');

        // Logika untuk memperbarui catatan konsultasi
        $this->client->patch($consultationId, [
            'json' => [
                'fields' => [
                    'catatan' => ['stringValue' => $catatan]
                ]
            ]
        ]);

        return redirect()->route('consultation.index')->with('success', 'Konsultasi berhasil diperbarui.');
    }

    private function getUsers()
    {
        $response = $this->client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/users');
        return json_decode($response->getBody()->getContents(), true)['documents'];
    }

    
    private function getConsultations($email)
    {
        $consultations = [];
        for ($i = 1; $i <= 6; $i++) {
            $response = $this->client->get("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/konsultasi_$i");
            $data = json_decode($response->getBody()->getContents(), true)['documents'];

            // Mencari konsultasi berdasarkan email
            $found = false; // Flag untuk menandai apakah konsultasi ditemukan
            foreach ($data as $consultation) {
                if (isset($consultation['fields']) && $consultation['fields']['userId']['stringValue'] === $email) {
                    $consultations[] = $consultation;
                    $found = true; // Tandai bahwa konsultasi ditemukan
                }
            }

            // Jika tidak ada konsultasi untuk email, buat entri baru
            if (!$found) {
                $consultations[] = [
                    'name' => "projects/fir-series-bf059/databases/(default)/documents/konsultasi_$i/$email",
                    'fields' => [
                        'catatan' => ['stringValue' => 'Konsultasi ke-' . $i],
                        'userId' => ['stringValue' => $email],
                        'status' => ['stringValue' => 'Belum Dilakukan']
                    ]
                ];
            }
        }
        return $consultations;
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'email' => 'required|email',
            'catatan' => 'required|string',
            'consultation_id' => 'required|string',
        ]);

        // Membuat instance Guzzle Client
        $client = new Client();

        // Menentukan nama dokumen berdasarkan email
        $documentName = $request->email;
        $consultation_id = $request->consultation_id;

        // URL untuk mengupdate dokumen
        $url = "https://firestore.googleapis.com/v1/{$consultation_id}";

        // Cek apakah dokumen sudah ada
        
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
                return redirect()->route('consultation.index')->with('success', 'Data konsultasi berhasil disimpan!');
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return redirect()->back()->with('error', 'Gagal menghubungi API: ' . $e->getMessage());
        }
    }

    private function updateConsultationStatus($consultationId, $status, $catatan)
    {
        $this->client->patch($consultationId, [
            'json' => [
                'fields' => [
                    'status' => ['stringValue' => $status],
                    'catatan' => ['stringValue' => $catatan]
                ]
            ]
        ]);
    }
}
