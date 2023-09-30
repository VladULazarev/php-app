<?php

namespace App\Core;

use App\Http\Controllers\FunctionController;
use PDO;
use PDOException;

class DbConnection
{
    protected PDO $handler;

    public function __construct()
    {
        $localhost = 'localhost';
        $dbname = 'php_app';
        $username = '';
        $password = '';

        try {
            $this->handler = new PDO("mysql:host=$localhost;charset=utf8mb4;dbname=$dbname", $username, $password);
            $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $_SESSION['form-message'] = "К сожалению, произошла ошибка при подключении к базе данных.";
            FunctionController::log("Error: {$e->getMessage()}. Oшибка при подключении к базе данных.");
            FunctionController::redirect('/form-message');
        }

        return $this->handler;
    }
}
