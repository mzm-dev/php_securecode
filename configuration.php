<?php

$DB_HOST = "127.0.0.1";
$DB_NAME = "securecrud";
$DB_USER = "root";
$DB_PASS = "password"; 

$connect = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;",$DB_USER, $DB_PASS);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$random_value = bin2hex(random_bytes(32));
