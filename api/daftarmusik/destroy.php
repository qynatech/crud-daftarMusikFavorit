<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, OPTIONS"); 
header("Access-Control-Allow-Headers *");        


include("helper.php");

if($_SERVER["REQUEST_METHOD"] == 'OPTIONS'){
    http_response_code(200);
    exit();
}
 $array_api = response_json(400, 'Request tidak valid');
if($_SERVER["REQUEST_METHOD"] == 'DELETE') {
    include("../../connect.php");

    $data = json_decode(file_get_contents("php://input"), true);

    if(isset($_GET['id'])){
        if($_GET['id'] != ""){
            $id = $_GET['id'];

            $search_id = $connect->query("SELECT * FROM daftarmusik WHERE id='$id'");
            $daftarmusik = $search_id->fetch_assoc();

            if($daftarmusik != NULL){
                $delete = $connect->query("DELETE FROM daftarmusik WHERE id='$id'");

                $array_api = response_json(200, 'berhasil menghapus daftar');
            }
            else{
                $array_api = response_json(404, 'gagal menghapus. ID tidak boleh kosong');
            }
        }
        else{
            $array_api = response_json(400, 'gagal menghapus data daftar musik, ID belum dimasukkan');
        }
    }
    else{
        $array_api = response_json(405, 'metode tidak diizinkan');
    }
}
echo json_encode($array_api);
?>