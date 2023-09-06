<?php
require 'vendor/autoload.php';

use System\Database\DB;
use Dotenv\Dotenv;
use System\Gateways\Person;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db = new DB();
$dbConnection = $db->getConnection();

$person = new Person($dbConnection);
