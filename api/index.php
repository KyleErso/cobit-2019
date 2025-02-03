<?php
// Mengatur header respon agar berupa JSON
header('Content-Type: application/json');

// Mengambil metode request (GET, POST, PUT, DELETE, dll.)
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Fungsi untuk mengirim respon dalam format JSON
function sendResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

// Tangkap data input (jika ada) dari body request
$inputData = json_decode(file_get_contents("php://input"), true);

// Routing sederhana berdasarkan metode request
switch ($requestMethod) {
    case 'GET':
        // Contoh endpoint GET: Mengembalikan pesan sederhana atau data
        sendResponse([
            "status"  => "success",
            "message" => "Hello, World! Ini adalah respon GET."
        ]);
        break;

    case 'POST':
        // Contoh endpoint POST: Menerima data dan mengembalikan respon
        sendResponse([
            "status"  => "success",
            "message" => "Data telah diterima via POST.",
            "data"    => $inputData
        ]);
        break;

    case 'PUT':
        // Contoh endpoint PUT: Menerima data dan mengembalikan respon
        sendResponse([
            "status"  => "success",
            "message" => "Data telah diperbarui via PUT.",
            "data"    => $inputData
        ]);
        break;

    case 'DELETE':
        // Contoh endpoint DELETE: Mengembalikan respon penghapusan data
        sendResponse([
            "status"  => "success",
            "message" => "Data telah dihapus via DELETE."
        ]);
        break;

    default:
        // Jika request method tidak diizinkan
        sendResponse([
            "status"  => "error",
            "message" => "Method tidak diizinkan."
        ], 405);
        break;
}
