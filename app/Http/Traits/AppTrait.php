<?php

namespace App\Http\Traits;

use App\Http\Controllers\FunctionController;
use App\Models\Model;

trait AppTrait
{
    /**
     * Проверить изображение перед загрузкой
     * @return int - количество ошибок
     */
    public static function checkImageToUpload(): int
    {
        $errors = 0;

        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        list($width, $height) = getimagesize($_FILES["image"]["tmp_name"]);

        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['form-sessions']['image-error'] =
                "Разрешены изображения c расширением 'jpg', 'jpeg', 'png'.";
            $errors++;
        } elseif ($_FILES["image"]["size"] > 100000) {
            $_SESSION['form-sessions']['image-error'] =
                "Размер изображения должен быть не более 100kб.";
            $errors++;
        } elseif ($width / $height !== 3 / 2) {
            $_SESSION['form-sessions']['image-error'] =
                "Соотношение сторон изображения должно быть 3:2. Например: 450x300px.";
            $errors++;
        }

        return $errors;
    }

    /**
     * Проверить значения из полей ввода
     * @return int - количество ошибок
     */
    public static function checkInputFieldsValues(): int
    {
        $errors = 0;

        $fields = [
            'Слоган' => ['slug', 50, self::$slugPattern],
            'Заголовок' => ['title', 50, self::$textPattern],
            'Краткое содержание' => ['excerpt', 150, self::$textPattern],
            'Текст' => ['body', 1000, self::$textPattern]
        ];

        foreach ($fields as $key => $field) {

            $trimmedValue = trim($_POST[$field[0]]);
            $_SESSION['form-sessions'][$field[0]] = $trimmedValue;

            if (!self::checkInput($field[2], $trimmedValue) || empty($trimmedValue)) {
                $_SESSION['form-sessions'][$field[0] . '-error'] =
                    "Поле '$key' пустое или содержит 'плохие символы'.";
                $errors++;
            } elseif (mb_strlen($trimmedValue) > $field[1]) {
                $_SESSION['form-sessions'][$field[0] . '-error'] =
                    "Поле '$key' должно быть не более $field[1] символов.";
                $errors++;
            } elseif (isset($_SESSION['form-sessions'][$field[0] . '-error'])) {
                unset($_SESSION['form-sessions'][$field[0] . '-error']);
            }
        }

        return $errors;
    }

    /**
     * Сохранить выбранное изображение для публикации
     * @param $newPostId
     * @return string $newFileName
     */
    public static function uploadPostImage($newPostId): string
    {
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/blog/" . $newPostId . "/";

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        } else {
            // Если '$targetDir' существует, удалить все существующие в ней файлы
            $files = scandir($targetDir);
            foreach($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    unlink($targetDir . $file);
                }
            }
        }

        // Создать случайную строку из 6 символов
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

        // Получить исходное расширение файла
        $fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Создать новое имя файла со случайной строкой
        $newFileName = $randomString . '.' . $fileExtension;

        // Сохранить новое изображение с новым именем файла.
        $targetFile = $targetDir . $newFileName;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

        return $newFileName;
    }

    /**
     * Сохранить путь к загруженному ранее изображению
     * @param $newFileName
     * @param $newPostId
     * @return void
     */
    public static function updateImagePath($newFileName, $newPostId): void
    {
        (new Model())->update("
            UPDATE posts SET img_path = ? WHERE id = ?", [$newFileName, $newPostId]);
    }

    /**
     * Проверить новое сообщение из '/contact'
     * @param $ip
     * @return int
     */
    public static function checkNewContactMessage($ip): int
    {
        $errors = 0;

        // Проверить количество отправленных сообщений с данного 'ip'
        $messagesAmount = (new Model())->select("
            SELECT count(id) as amount FROM contacts WHERE ip = ?", [$ip]);

        if ( $messagesAmount[0]->amount >= AMOUNT_OF_ALLOWED_CONTACT_MESSAGES ) {
            $_SESSION['form-message'] = "Вы отправили слишком много сообщений.";
            FunctionController::redirect('/form-message');
        }

        // Проверить значения из полей ввода ---------------------------------
        $fields = [
            'Имя' => ['name', 10, self::$namePattern],
            'Email' => ['email', 50, self::$emailPattern],
            'Сообщение' => ['message', 300, self::$textPattern]
        ];

        foreach ($fields as $key => $field) {

            $trimmedValue = trim($_POST[$field[0]]);
            $_SESSION['form-sessions'][$field[0]] = $trimmedValue;

            if (!self::checkInput($field[2], $trimmedValue) || empty($trimmedValue)) {
                if ( $field[0] === 'email' ) {
                    $_SESSION['form-sessions'][$field[0] . '-error'] =
                        "Поле '$key' пустое, содержит 'плохие символы' или не соответствует формату email.";
                    $errors++;
                } else {
                    $_SESSION['form-sessions'][$field[0] . '-error'] =
                        "Поле '$key' пустое или содержит 'плохие символы'.";
                    $errors++;
                }
            } elseif (mb_strlen($trimmedValue) > $field[1]) {
                $_SESSION['form-sessions'][$field[0] . '-error'] =
                    "Поле '$key' должно быть не более $field[1] символов.";
                $errors++;
            } elseif (isset($_SESSION['form-sessions'][$field[0] . '-error'])) {
                unset($_SESSION['form-sessions'][$field[0] . '-error']);
            }
        }

        return $errors;
    }
}