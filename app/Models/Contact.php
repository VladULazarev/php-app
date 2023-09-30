<?php

namespace App\Models;

use App\Http\Controllers\FunctionController;
use App\Http\Traits\ValidatorTrait;
use App\Mail\ContactEmail;
use App\Http\Traits\AppTrait;
use JetBrains\PhpStorm\NoReturn;

class Contact extends Model
{
    use ValidatorTrait;
    use AppTrait;

    /**
     * Сохранить новое сообщение
     * @return void
     */
    #[NoReturn] public static function store(): void
    {
        if (! $_POST['create-message']) { FunctionController::redirect('/'); }

        $ip = FunctionController::getUserIpAddr();

        if ( self::checkNewContactMessage($ip) ) {
            FunctionController::redirect('/contact');
        }

        // Если ошибок нет ---------------------------------------------------

        // '$user_id' текущего пользователя
        if ( isset($_SESSION['user_id']) ) {
            $user_id = intval($_SESSION['user_id']);
        } else {
            $user_id = null;
        }

        $name = $_SESSION['form-sessions']['name'];
        $email = $_SESSION['form-sessions']['email'];
        $message = $_SESSION['form-sessions']['message'];

        (new Model())->insert("
            INSERT INTO contacts (user_id, name, email, message, ip) 
            VALUES (?, ?, ?, ?, ?)", [
            $user_id, $name, $email, $message, $ip
        ]);

        $_SESSION['form-message'] = "Мы получили ваше сообщение. Спасибо.";
        unset($_SESSION['form-sessions']);

        (new ContactEmail())->sendEmail($name, $email, $message );

        FunctionController::redirect('/form-message');
    }
}