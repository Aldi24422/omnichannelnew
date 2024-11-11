<?php
// Mendapatkan halaman dari parameter GET (default halaman 1).
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Jumlah data per halaman.
$limit = 10;

// Menghitung offset berdasarkan halaman.
$offset = ($page - 1) * $limit;

// URL API untuk mengambil data dengan parameter limit dan offset.
$apiUrl = "http://localhost:3001/get_all_contact/admin2/{$limit}/{$offset}";

// Menginisialisasi cURL.
$ch = curl_init();

// Mengatur opsi cURL.
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Mengeksekusi cURL dan mendapatkan respons dari API.
$response = curl_exec($ch);

// Mengecek apakah terjadi error pada cURL.
if ($response === false) {
    // Menampilkan pesan error jika gagal mengakses API.
    echo json_encode([
        'error' => 'Failed to retrieve data from API',
        'details' => curl_error($ch)
    ]);
} else {
    // Decode respons dari API.
    $apiResponse = json_decode($response, true);

    // Mendapatkan totalData dari respons API.
    $totalData = isset($apiResponse['totalData']) ? (int) $apiResponse['totalData'] : 0;

    // Menghitung total halaman berdasarkan totalData dari API.
    $totalPages = ceil($totalData / $limit);

    // Menyusun respons yang akan dikirim ke front-end.
    $response = [
        'contacts' => $apiResponse['data'], // Mengirim data kontak yang diterima dari API.
        'totalPages' => $totalPages, // Total halaman berdasarkan totalData dari API.
        'currentPage' => $page // Halaman saat ini.
    ];

    // Menampilkan respons dalam format JSON.
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Menutup sesi cURL.
curl_close($ch);
