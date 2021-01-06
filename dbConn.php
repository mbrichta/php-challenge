<?php
$db = mysqli_connect("localhost","root","","sportradar");

if(!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "Connected";
}
?>