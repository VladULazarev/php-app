<?php

namespace App\Models;

use App\Http\Controllers\FunctionController;
use App\Http\Traits\ValidatorTrait;
use App\Mail\AdminEmail;
use JetBrains\PhpStorm\NoReturn;

class User extends Model
{
    use ValidatorTrait;

    /**
     * Сохранить нового пользователя
     * @return void
     */
    #[NoReturn] public static function store(): void
    {
        if (! isset($_POST['register'])) {
            FunctionController::redirect('/register');
        } else {

            $trimmedName = trim($_POST['name']);
            $trimmedPassword = trim($_POST['password']);
            $trimmedConfirmPassword = trim($_POST['confirm-password']);

            // Проверить значение из поля 'name'
            if (! self::checkInput(self::$namePattern, $trimmedName) || empty($trimmedName)) {

                $_SESSION['form-sessions']['register-error'] =
                    "Login должен быть длинною от 2 до 10 символов. Разрешенные символы: A-zА-я0-9 -";
                FunctionController::redirect('/register');

            // Проверить значение из поля 'password'
            } elseif (! self::checkInput(self::$passwordPattern, $trimmedPassword)
                || empty($trimmedPassword)) {

                $_SESSION['form-sessions']['register-error'] =
                    "Пароль должен быть длинною от 4 до 8 символов. Разрешенные символы: A-z0-9_";
                FunctionController::redirect('/register');

            // Проверить совпадают пароли или нет
            } elseif ($trimmedPassword !== $trimmedConfirmPassword) {

                $_SESSION['form-sessions']['register-error'] =
                    "Пароли НЕ совпадают!";
                FunctionController::redirect('/register');

            // Проверить есть ли уже такой пароль
            } else {

                $newPassword = hash('ripemd160', $trimmedPassword);

                $existingPassword = (new Model())->select("
                    SELECT password FROM users WHERE password = ?",
                    [$newPassword]);

                $name = $trimmedName;
                $ip = FunctionController::getUserIpAddr();

                if (! $existingPassword) {
                    $newUserId = (new Model())->insert("
                        INSERT INTO users (name, password, ip) 
                        VALUES (?, ?, ?)",
                        [$name, $newPassword, $ip]
                    );

                    unset($_SESSION['form-sessions']);

                    $_SESSION['user_id'] = $newUserId;
                    $_SESSION['user_name'] = $name;

                    (new AdminEmail())->sendEmail($name);

                    FunctionController::log("Success: Успешная регистрация нового пользователя.");

                    FunctionController::redirect('/');

                } else {

                    $_SESSION['form-sessions']['register-error'] =
                        "Такой пароль уже существует.";
                    FunctionController::redirect('/register');
                }
            }
        }
    }

    /**
     * Проверить пользователя при входе
     * @return void
     */
    #[NoReturn] public static function login(): void
    {
        if (! isset($_POST['login'])) {
            FunctionController::redirect('/log-in');
        } else {

            $trimmedPassword = trim($_POST['password']);

            if (! self::checkInput(self::$passwordPattern, $trimmedPassword) || empty($trimmedPassword)) {

                $_SESSION['form-sessions']['login-error'] =
                    "Пользователь с таким паролем не существует.";
                FunctionController::redirect('/log-in');

            } else {

                $loginPassword = hash('ripemd160', $trimmedPassword);

                $existingUser = (new Model())->select("
                    SELECT id, name FROM users WHERE password = ?",
                    [$loginPassword]);

                if ($existingUser) {

                    unset($_SESSION['form-sessions']);

                    $_SESSION['user_id'] = $existingUser[0]->id;
                    $_SESSION['user_name'] = $existingUser[0]->name;

                    // $_SESSION['get-back-uri'] смотри 'resources/views/auth/log-in.php'
                    if (isset($_SESSION['get-back-uri'])) {
                        FunctionController::redirect($_SESSION['get-back-uri']);
                    }

                    FunctionController::redirect('/');

                } else {

                    $_SESSION['form-sessions']['login-error'] =
                        "Пользователь с таким паролем не существует.";
                    FunctionController::redirect('/log-in');
                }
            }
        }
    }

    /**
     * Удалить сессию пользователя при выходе и перенаправить на главную страницу
     * @return void
     */
    #[NoReturn] public static function logOut(): void
    {
        session_destroy();
        FunctionController::redirect('/');
    }
}

