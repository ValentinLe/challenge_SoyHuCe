<?php

$host = "localhost";
$dbname = "favoris_itunes";
$user = "postgres";
$password = "admin";

$pg = new PDO("pgsql:host=$host; dbname=$dbname", $user, $password);
