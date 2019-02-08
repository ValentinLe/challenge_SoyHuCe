<?php

$host = "localhost";
$dbname = "favoris_itunes";
$userSQL = "postgres";
$passwordSQL = "admin";

$pg = new PDO("pgsql:host=$host; dbname=$dbname", $userSQL, $passwordSQL);
