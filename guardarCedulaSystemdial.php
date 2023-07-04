#!/usr/bin/php -q
<?php
set_time_limit(60);
error_reporting(E_ALL);
  
$url ="https://systemdial11.xolit.com/vicidial/non_agent_api.php?source=test&user=api&pass=4Su7w6l3soMv8X6ZnBfJ&function=agent_status&phone=".$argv[1]."&identificationType=".$argv[2]."&identificationNumber=".$argv[3]."";
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