<?php

header('Content-Type: application/json');

if($_SERVER["REQUEST_METHOD"] == 'DELETE') {
    include("../connect.php");

    if(isset($_GET['id'])){
        if($_GET['id'] != ""){
            $id = $_GET['id'];

            $search_id = $connect->query("SELECT * FROM daftarmusik WHERE id='$id'");
            $user = $search_id->fetch_assoc();

            if($user != NULL){
                $delete = $connect->query("DELETE FROM daftarmusik id='$id'");

                $array_api = response_json(200, 'berhasil menghapus daftar');
            }
            else{
                $array_api = response_json(404, 'gagal menghapus. ID tidak boleh kosong');
            }
        }
        else{
            $array_api = response_json(400, 'gagal menghapus data user, ID belum dimasukkan');
        }
    }
    else{
        $array_api = response_json(405, 'metode tidak diizinkan');
    }
}
echo json_encode($array_api);
?>