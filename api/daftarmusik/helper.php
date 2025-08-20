<?php

function response_json($status, $message, $daftarmusik = ""){
    http_response_code($status);

    $array_api = [
        'status' => $status,
        'message' => $message,
    ];

    if ($daftarmusik != ""){
        $array_api['daftarmusik'] = $daftarmusik;
    }
    return $array_api;
}
?>