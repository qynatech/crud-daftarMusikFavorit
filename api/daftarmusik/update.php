<?php
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

include('helper.php');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $daftarmusik = json_decode(file_get_contents("php://input"), true);
    include("../../connect.php");

    $form_daftarmusik = json_decode(file_get_contents("php://input"));

    if (isset($_GET['id'])) {

        if ($_GET['id'] != "") {
            $id = $_GET['id'];

            $search_id = $connect->query("SELECT * FROM daftarmusik WHERE id='$id'");
            $daftarmusik = $search_id->fetch_assoc();

            if ($daftarmusik != NULL) {
                $form_daftarmusik = json_decode(file_get_contents("php://input"));
        
                if ($form_daftarmusik->username != "" && $form_daftarmusik->penyanyi != "" && $form_daftarmusik->judulLagu != "") {
                    $username = $form_daftarmusik->username;
                    $penyanyi = $form_daftarmusik->penyanyi;
                    $judulLagu = $form_daftarmusik->judulLagu;

                    $update = $connect->query("UPDATE daftarmusik SET username = '$username', penyanyi = '$penyanyi', judulLagu = '$judulLagu' WHERE id = '$id'");
 
                    $array_api = response_json(200, 'berhasil mengupdate daftar musik');
                } else {
                    $array_api = response_json(400, 'gagal mengupdate daftar musik, formulir tidak lengkap.');
                }
            } else {
                $array_api = response_json(404, 'gagal mengupdate daftar musik, user tidak ditemukan.');
            }
        } else {
            $array_api = response_json(400, 'gagal mengupdate daftar musik, id tidak boleh kosong.');
        }
    } else {
        $array_api = response_json(400, 'gagal mengupdate daftar musik, id belum dimasukkan.');
    }
} else {
    $array_api = response_json(405, 'metode tidak diizinkan.');
}

echo json_encode($array_api);

?>