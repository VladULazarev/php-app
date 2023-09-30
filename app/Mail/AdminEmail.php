<?php

namespace App\Mail;

use App\Http\Controllers\FunctionController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class AdminEmail
{
    /**
     * Отправить email админу при регистрации нового пользователя
     * @param $userName
     * @return void
     */
    public function sendEmail($userName): void
    {
        $transport = Transport::fromDsn('smtp://noreply@domain.com:password@domain.com:465');
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from(APP_NO_REPLY_EMAIL)
            ->to(ADMIN_EMAIL)
            ->subject('Регистрация нового пользователя')
            ->html("
<div style='width: 100%;'>
    <div style='max-width: 500px; margin: 0 auto 0 auto;padding: 1em 0.5em 0 0.5em;background: #fff;'>

        <div>
            <img style='width: 100%; height:auto;' src='https://domain.com/public/twitter-card.jpg'>
        </div>

        <h1 style='text-align: center; color: #1d1743; font-size: 1.8em; margin: 2em 1em 2em 1em; border-bottom: 1px solid #e5e5e5; padding: 0 0 0.5em 0;'>
            <span style='color:#4285f4;'>P</span><span style='color:#ea4335;'>H</span><span style='color:#fbbc05;'>P</span><span style='color:#34a853;'> A</span>pp <span style='color:#34a853;'> D</span>evelopment
        </h1>

        <p style='color: #1d1743; margin: 0 0 1em 1em; line-height: 1.7; font-size: 16px;'>
        Регистрация нового пользователя.
        </p>

        <p style='color: #404a58;font-size: 16px; margin: 0 0 4em 1em; line-height: 1.7;'>
        Имя: <span style='font-weight: bolder; letter-spacing: 1px;'>$userName</span>
        </p>

        <div style='margin: 0 0 3em 0; line-height: 1.7; text-align: center'>
            <a href='https://domain.com/'
               style='display: block; border-radius: 5px; text-decoration:none;
               color: #fff;font-size: 16px; padding: 0.5em 2em; background: #0e5386;'>Перейти на сайт</a>
        </div>

    </div>
</div>
            ");

        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            FunctionController::log("Error: Регистрация нового пользователя прошла успешно, но при отправке email админу произошла ошибка. Текст ошибки: " . $e->getMessage());
        }
    }
}