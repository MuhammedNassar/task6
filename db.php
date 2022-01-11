<?php

$server="localhost";
$dbname="blog";
$dbuser="root";
$dbpsw="";

$con = mysqli_connect($server,$dbuser,$dbpsw,$dbname);
if (!$con) {
    die('Eror') . mysqli_connect_error($con) ;
}
?>