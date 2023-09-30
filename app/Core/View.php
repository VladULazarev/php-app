<?php

namespace App\Core;

use App\Http\Controllers\ErrorController;

class View
{
    /**
     * Отобразить указанный 'view'
     * @param $path
     * @param $data
     * @return void
     */
    public static function render($path, $data = null): void
    {
        if(! file_exists($_SERVER['DOCUMENT_ROOT'] . "/resources/views/" . $path . ".php")) {
            ErrorController::notFound();
        }
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/" . $path . ".php";
    }
}