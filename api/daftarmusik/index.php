<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, DELETE");


  include("../../connect.php");
  include("helper.php");

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    http_response_code(200);
    exit();
  }

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $read = $connect->query("SELECT * FROM daftarmusik");
    $daftarmusik = $read->fetch_all(MYSQLI_ASSOC);

    $array_api = response_json(200, 'berhasil mengambil data daftarmusik', $daftarmusik);
 }
 else{
   $array_api = response_json(405, 'method tidak diizinkan');
 }

 echo json_encode($array_api);
?>