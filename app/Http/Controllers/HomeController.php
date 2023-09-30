<?php

namespace App\Http\Controllers;

use App\Core\View;

class HomeController extends Controller
{
    /**
     * Показать главную страницу
     * @return void
     */
    public static function index(): void
    {
        View::render('layouts/home');
    }
}