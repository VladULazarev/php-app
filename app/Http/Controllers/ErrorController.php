<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    /**
     * Перенаправить на станицу '404.php'
     * @return void
     */
    public static function notFound(): void
    {
        echo "<script>window.location.href = '/404.php'</script>";
    }
}