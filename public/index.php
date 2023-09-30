<?php session_start();

// Текущий и предыдущий 'uri'
$previousUri = $_SESSION['current_uri'] ?? '';
$currentUri = $_SERVER['REQUEST_URI'];
$_SESSION['current_uri'] = $currentUri;
$_SESSION['previous_uri'] = $previousUri;

require_once "../vendor/autoload.php";

Carbon\Carbon::setLocale('ru');

require_once "../resources/includes/constants.php";

require_once "../resources/views/layouts/app.php";
