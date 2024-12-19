<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showDetail($email)
    {
        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }


        $client = new Client();
        $response = $client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/users');
        $data = json_decode($response->getBody(), true);

        $detail = array_filter($data['documents'], function ($child) use ($email) {
            return $child['fields']['email']['stringValue'] == $email;
        });

        return view('detail', compact('detail'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $client = new Client();
        $response = $client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/login');

        $data = json_decode($response->getBody(), true);
        $admin = $data['documents'][0]['fields'];

        if ($request->username === $admin['username']['stringValue'] && $request->password === $admin['password']['stringValue']) {

            Session::put('user', $request->username);
            return redirect('/dashboard');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function dashboard()
    {

        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }


        $client = new Client();
        $response = $client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/users');
        $data = json_decode($response->getBody(), true);

        $users = $data['documents'];

        return view('dashboard', compact('users'));
    }

    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }

    public function showChildren($email)
    {
        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }

        $client = new Client();
        try {
            $response = $client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/data_anak');
            $data = json_decode($response->getBody(), true);

            $children = array_filter($data['documents'], function ($child) use ($email) {
                return $child['fields']['email']['stringValue'] == $email;
            });

            return view('children', compact('children', 'email'));
        } catch (\Exception $e) {
            return back()->withErrors(['api' => 'Gagal mengambil data dari API: ' . $e->getMessage()]);
        }
    }

    public function perkembangan1($email)
    {
        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }

        $client = new Client();
        try {
            $response = $client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/data_anak');
            $data = json_decode($response->getBody(), true);

            $perkembangan1 = array_filter($data['documents'], function ($child) use ($email) {
                return $child['fields']['email']['stringValue'] == $email;
            });

            return view('perkembangan1', compact('perkembangan1', 'email'));
        } catch (\Exception $e) {
            return back()->withErrors(['api' => 'Gagal mengambil data dari API: ' . $e->getMessage()]);
        }
    }
    public function perkembangan2($bulan, $nama)
    {

        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }


        $client = new Client();

        if ($bulan > 19){
            return view('not_found', ['bulan' => $bulan]);
        }
        $response = $client->get("https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/perkembangan_anak_bulanan/bulan{$bulan}");
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);

            // Memeriksa apakah data bulan ada
            if (empty($data) || !isset($data['fields'])) {
                return view('not_found', ['bulan' => $bulan]);
            }

            return view('perkembangan2', compact('data','nama'));
        }
        
    }
    public function showTwins($email)
    {
        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }

        $client = new Client();
        try {
            $response = $client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/anak_kembar');
            $data = json_decode($response->getBody(), true);

            $twins = array_filter($data['documents'], function ($child) use ($email) {
                return $child['fields']['email']['stringValue'] == $email;
            });

            return view('twins', compact('twins', 'email'));
        } catch (\Exception $e) {
            return back()->withErrors(['api' => 'Gagal mengambil data dari API: ' . $e->getMessage()]);
        }
    }

    public function Perkiraan_kelahiran($email)
    {
        if (!Session::has('user')) {
            return redirect('/login')->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }


        $client = new Client();
        $response = $client->get('https://firestore.googleapis.com/v1/projects/fir-series-bf059/databases/(default)/documents/perkiraan_kelahiran');
        $data = json_decode($response->getBody(), true);

        $perkiraan = array_filter($data['documents'], function ($child) use ($email) {
            return $child['fields']['email']['stringValue'] == $email;
        });

        return view('perkiraan', compact('perkiraan'));
    }
}