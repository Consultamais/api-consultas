<?php
$curl = curl_init();

$tipoRequisicao = "GET";

$idConsulta = 00;
$documento = 00000000000;
$url = "https://api.consultamais.dev/consulta/id/{$idConsulta}/documento/{$documento}";

$tipoAutenticacao = "Bearer";
$token = "000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000";

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => $tipoRequisicao,
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
        "authorization: {$tipoAutenticacao} {$token}"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
