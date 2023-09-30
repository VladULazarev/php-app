<?php

namespace App\Core;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\User;

class Route
{
    /**
     * @param array $uri current 'uri'
     * @return void
     */
    public static function get(array $uri): void
    {
        if (!$uri[1]) { HomeController::index();                    // '/'

        // Contact -----------------------------------------------------------
        } elseif ($uri[1] === 'contact' && !isset($uri[2])) {        // '/contact'
            View::render('contact/create');
        } elseif ($uri[1] === 'create-contact' && !isset($uri[2])) { // '/create-contact' (form request)
            Contact::store();

        // User --------------------------------------------------------------
        } elseif ($uri[1] === 'log-in' && !isset($uri[2])) {        // '/log-in'
            View::render('auth/log-in');
        } elseif ($uri[1] === 'login-user' && !isset($uri[2])) {    // '/login-user' (form request)
            User::login();
        } elseif ($uri[1] === 'log-out' && !isset($uri[2])) {       // '/log-out'
            User::logOut();
        } elseif ($uri[1] === 'register' && !isset($uri[2])) {      // '/register'
            View::render('auth/register');
        } elseif ($uri[1] === 'register-user' && !isset($uri[2])) { // '/register-user' (form request)
            User::store();

        // Blog --------------------------------------------------------------
        } elseif ($uri[1] === 'blog' && !isset($uri[2])) {                          // '/blog'
            BlogController::index();
        } elseif ($uri[1] === 'blog' && $uri[2] === 'create' && !isset($uri[3])) {  // '/blog/create'
            BlogController::create();
        } elseif ($uri[1] === 'blog' && isset($uri[2]) && !isset($uri[3])) {        // '/blog/post_slug'
            BlogController::show($uri[2]);
        } elseif ($uri[1] === 'create-post' && !isset($uri[2])) {                   // '/create-post' (form request)
            BlogController::store();
        } elseif ($uri[1] === 'blog' && isset($uri[2]) && $uri[3] === 'edit' && !isset($uri[4])) {  // '/blog/post_id/edit'
            BlogController::edit($uri[2]);
        } elseif ($uri[1] === 'update-post' && !isset($uri[2])) {                   // '/update-post' (form request)
            BlogController::update();
        } elseif ($uri[1] === 'blog' && $uri[2] === 'delete' && isset($uri[3]) && !isset($uri[4])) { // '/blog/delete/post_id'
            Blog::destroy($uri[3]);
        }

        // Сообщения
        elseif ($uri[1] === 'form-message' && !isset($uri[2])) {
            View::render('messages/form-message');

        } else {
            ErrorController::notFound();
        }
    }
}