<?php

$host = "localhost";
$dbname = "favoris_itunes";
$userSQL = "postgres";
$passwordSQL = "admin";
$typeBD = "pgsql";

$pg = new PDO("$typeBD:host=$host; dbname=$dbname", $userSQL, $passwordSQL);
