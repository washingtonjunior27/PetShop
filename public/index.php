<?php

require_once __DIR__ . "/../vendor/autoload.php";

define("BASE_URL", "/Petshop");

$route = $_GET['route'] ?? "Login";
