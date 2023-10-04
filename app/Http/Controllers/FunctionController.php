<?php

namespace App\Http\Controllers;

use JetBrains\PhpStorm\NoReturn;

class FunctionController extends Controller
{
    /**
     * Показать предыдущее значение поля 'input'
     * @param $sessionValue
     * @return mixed|string
     */
    public static function oldInput($sessionValue): mixed
    {
        return $_SESSION['form-sessions'][$sessionValue] ?? '';
    }

    /**
     * Проверить авторизацию пользователя
     * @return ?bool
     */
    public static function isAuthenticated(): ?bool
    {
        if (!isset($_SESSION['user_id'])) {
            return NULL;
        } else {
            return TRUE;
        }
    }

    /**
     * Перенаправить пользователя на указанный 'uri'
     * @param $uri
     * @return void
     */
    #[NoReturn] public static function redirect($uri): void
    {
        if (isset($_SESSION['get-back-uri'])) {unset($_SESSION['get-back-uri']);}
        echo "<script>window.location.href = '$uri'</script>";
        exit;
    }

    /**
     * Получить 'ip' текущего пользователя
     * @return string
     */
    public static function getUserIpAddr(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /**
     * Удалить указанную директорию и всё её содержимое
     * @param $dir
     * @return bool
     */
    public static function deleteDirectory($dir): bool
    {
        if (!is_dir($dir)) {
            self::log("Error: Попытка удаления несуществующей директории: '$dir'.");
            return false;
        }

        $files = array_diff(scandir($dir), array('.', '..'));

        foreach ($files as $file) {
            $path = $dir . '/' . $file;
            is_dir($path) ? self::deleteDirectory($path) : unlink($path);
        }

        if (rmdir($dir)) {
            self::log("Success: Директория '$dir' и всё её содержимое были успешно удалены.");
            return true;
        } else {
            self::log("Error: Не удалось удалить директорию: '$dir'.");
            return false;
        }
    }

    /**
     * Записать сообщение в 'лог' файл
     * @param $message
     * @return void
     */
    public static function log($message): void
    {
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
            $userInfo = " ID пользователя: " . $_SESSION['user_id'] . " Login пользователя: " . $_SESSION['user_name'] . ". ";
        } else {
            $userInfo = " Неизвестный пользователь.";
        }

        $logMessage = $message . $userInfo;

        // 'Log' файл
        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/store/log/app.log";

        $timestamp = date('d-m-Y H:i:s');
        $logMessage = "[$timestamp] $logMessage" . PHP_EOL;
        file_put_contents($filePath, $logMessage, FILE_APPEND);
    }
}