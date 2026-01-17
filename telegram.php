<?php

function enviarTelegram($mensaje) {
    $token = "8286894428:AAERM6KRC_OFeuoNFcffL9tsamhauqmqCf8";
    $chat_id = "6726478431";

    $url = "https://api.telegram.org/bot$token/sendMessage";

    $data = [
        'chat_id' => $chat_id,
        'text' => $mensaje,
        'parse_mode' => 'HTML'
    ];

    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => "Content-Type:application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data),
        )
    );

    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);
}
