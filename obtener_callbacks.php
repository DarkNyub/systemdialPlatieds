<?php

$version = '2.14-175';
$build = '221108-1849';
$php_script='non_agent_api.php';
$api_url_log = 0;

$startMS = microtime();

require("dbconnect_mysqli.php");
require("functions.php");


header ("Content-type: text/json; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");        

$stmt = "SELECT * from vicidial_callbacks where recipient='USERONLY' and user='".$_GET['agent']."' and campaign_id = '".$_GET['campaign']."' and status NOT IN('INACTIVE','DEAD') order by callback_time";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {echo "$stmt\n";}
$results = mysqli_num_rows($rslt);
$i = 0;
if($results > 0){
    $jsontext = "[";
    while($i < $results){
        $jsontext .= "{";
        $rowrow = array();
        $row = mysqli_fetch_object($rslt);
        foreach($row as $key => $value) {
            $jsontext .= "'".addslashes($key)."':'".addslashes($value)."',";
        }
        $jsontext = substr_replace($jsontext, '', -1); // to get rid of extra comma
        $jsontext .= "}";
        $i++;
    }
    $jsontext .= "]";
    echo $jsontext;
}
else
    echo "No callbacks";
?>