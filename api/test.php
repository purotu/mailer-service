<?php 
// Looing for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrive env variable
$userName = $_ENV['SMTP_USER'];

echo $userName; //jfBiswajit