<?php

namespace App\Models;

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\FunctionController;
use App\Http\Traits\ValidatorTrait;
use App\Http\Traits\AppTrait;

class Blog extends Model
{
    use ValidatorTrait;
    use AppTrait;

    /**
     * Получить все публикации
     * @return array
     */
    public static function index(): array
    {
        return (new Model())->select("SELECT * FROM posts ORDER BY created_at DESC", []);
    }

    /**
     * Получить выбранный 'post'
     * @param $slug
     * @return bool|array
     */
    public static function show($slug): bool|array
    {
        return (new Model())->select("
            SELECT * FROM posts WHERE slug = ?", [ $slug ]);
    }

    /**
     * Сохранить новую публикацию
     * @return bool|string|null
     */
    public static function store(): bool|string|null
    {
        $imgErrors = self::checkImageToUpload();

        $fieldsErrors = self::checkInputFieldsValues();

        // Проверить уникальность поля 'Слоган'
        $existingSlug = (new Model())->select("
            SELECT slug FROM posts WHERE slug = ?", [ trim($_POST['slug']) ]);

        if ( $existingSlug ) {
            $_SESSION['form-sessions']['slug-error'] = "Такой 'Слоган' уже существует.";
            FunctionController::redirect('/blog/create');
        }

        if ( ($imgErrors + $fieldsErrors) ) {
            FunctionController::redirect('/blog/create');
        }

        // Если ошибок нет
        $user_id = intval($_SESSION['user_id']);
        $slug = strtolower($_SESSION['form-sessions']['slug']);
        $title = $_SESSION['form-sessions']['title'];
        $excerpt = $_SESSION['form-sessions']['excerpt'];
        $body = $_SESSION['form-sessions']['body'];

        return (new Model())->insert("
            INSERT INTO posts (user_id, slug, title, excerpt, body) 
            VALUES (?, ?, ?, ?, ?)", [
            $user_id, $slug, $title, $excerpt, $body
        ]);
    }

    /**
     * Обновить публикацию
     * @return void
     */
    public static function updatePost(): void
    {
        $imgErrors = 0;

        if ( $_FILES["image"]['name'] ) {
            $imgErrors = self::checkImageToUpload();
        }

        $fieldsErrors = self::checkInputFieldsValues();

        if ( ($imgErrors + $fieldsErrors) ) {
            FunctionController::redirect("/blog/" . $_SESSION['form-sessions']['id'] . "/edit");
        }

        // Если ошибок нет ---------------------------------------------------
        $id = $_SESSION['form-sessions']['id'];
        $title = $_SESSION['form-sessions']['title'];
        $excerpt = $_SESSION['form-sessions']['excerpt'];
        $body = $_SESSION['form-sessions']['body'];

        (new Model())->update("
            UPDATE posts SET  
            title = ?, excerpt = ?, body = ?, updated_at = NOW() WHERE id = ?", [
            $title, $excerpt, $body, $id
        ]);
    }

    /**
     * Удалить выбранный 'post'
     * @param $id
     * @return void
     */
    public static function destroy($id): void
    {
        FunctionController::isAuthenticated() ?? FunctionController::redirect('/log-in');

        if (! self::checkInput(self::$idPattern, $id)) {
           ErrorController::notFound();
        }

        // Можно удалить только свои публикации ($_SESSION['post-user-id'] is set in show.php)
        elseif ( !isset($_SESSION['post-user-id']) || (intval($_SESSION['post-user-id']) !== intval($_SESSION['user_id'])) ) {
           ErrorController::notFound();
        }

        elseif ( (new Model())->delete("DELETE FROM posts WHERE id = ?", [$id]) ) {

            unset($_SESSION['post-user-id']);

            $directoryToDelete =  $_SERVER['DOCUMENT_ROOT'] . "/public/uploads/blog/" . $id . "/";
            FunctionController::deleteDirectory($directoryToDelete);

            FunctionController::redirect('/blog');
        } else {
            ErrorController::notFound();
        }
    }

    /**
     * Получить указанное количество последних публикаций
     * @return bool|array|null
     */
    public static function getLastPosts(): bool|array|null
    {
        return (new Model())->select("
            SELECT slug, title FROM posts ORDER BY created_at DESC LIMIT " .  AMOUNT_OF_LAST_POSTS , []);
    }

    /**
     * Получить выбранный для редактирования 'post' по 'id'
     * @param $id
     * @return bool|array
     */
    public static function getPostToBeUpdated($id): bool|array
    {
        return (new Model())->select("
            SELECT * FROM posts WHERE id = ?", [ $id ]);
    }
}