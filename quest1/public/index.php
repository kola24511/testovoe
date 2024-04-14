<?php

require_once("../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable('./..');
$dotenv->load();

$tokenTelegram = $_ENV["tokenTelegram"];
$tokenLeads = $_ENV["tokenLeads"];

$telegramBot = new \App\TelegramBot($tokenTelegram, $tokenLeads);
$telegramBot->handleRequest();
