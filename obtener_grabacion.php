<?php

$version = '2.14-175';
$build = '221108-1849';
$php_script='non_agent_api.php';
$api_url_log = 0;

$startMS = microtime();

require("dbconnect_mysqli.php");
require("functions.php");


header ("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");        

$stmt = "SELECT * FROM recording_log  rl JOIN vicidial_log_extended vle ON vle.uniqueid = rl.vicidial_id WHERE vle.caller_code ='".$_GET['call_id']."'";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {echo "$stmt\n";}
$results = mysqli_num_rows($rslt);
if($results > 0){
    $row = mysqli_fetch_row($rslt);
    $row = str_replace("10.10.45.11","systemdial10.xolit.com/", $row[11]);
    header("Location: ".$row);
}
else
    echo "No file";
?>