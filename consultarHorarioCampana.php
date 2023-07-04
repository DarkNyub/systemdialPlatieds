#!/usr/bin/php -q
<?php
set_time_limit(60);
error_reporting(E_ALL);
  
$url ="https://app-syspluscol-bk-contactoivr-des-001.azurewebsites.net/V1/IvrNplWS/Rest/Horario/ValidaHorario?contenedor=SystemDial-NPL-Colombia";
$ch = curl_init($url);

$headers= 
[
'tranfer-encoding: chunked',
'Content-Type: application/text',
'User-Agent: cUrl Testing'
];
 $c=1;
 
#curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$contentCurl = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);
exit;
?>