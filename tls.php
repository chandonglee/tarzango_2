<?php 
error_reporting(E_ALL);
 $fp = fsockopen("www.google.com", 80, $errno, $errstr, 10);
    if (!$fp)
        echo "www.google.com -  $errstr   ($errno)<br>\n";
    else
        echo "www.google.com -  ok<br>\n";


?>