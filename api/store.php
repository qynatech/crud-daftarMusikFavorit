<?php

header('Content-Type: application/json');
header('Acces-Control-Allow-Methods: POST');

include("helper.php");

$form_daftarmusik = json_decode(file_get_contents("php://input"));

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include("../../connect.php");

    if ($form_daftarmusik != NULL){
        if($form_daftarmusik->username != "" && $form_daftarmusik->penyanyi != "" && $form_daftarmusik->judulLagu != ""){
            $username = $form_daftarmusik->username;
            $penyanyi = $form_daftarmusik->penyanyi;
            $judulLagu = $form_daftarmusik->judulLagu;

            $store = $connect->query("INSERT INTO daftarmusik (username, penyanyi, judulLagu) VALUES ('$username', '$penyanyi', '$judulLagu')");

            echo json_encode (response_json(201, 'sukses menambahkan daftar favorit'));
         }
         else{
            echo json_encode (response_json(400, 'daftar favorit harus diisi'));
         }
    } else {
        echo json_encode(response_json(400, 'json tidak terbaca'));
    }
}
?>