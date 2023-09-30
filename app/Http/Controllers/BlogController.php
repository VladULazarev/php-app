<?php

namespace App\Http\Controllers;

use App\Core\View;
use App\Http\Traits\ValidatorTrait;
use App\Http\Traits\AppTrait;
use App\Models\Blog;
use JetBrains\PhpStorm\NoReturn;

class BlogController extends Controller
{
    use ValidatorTrait;
    use AppTrait;

    /**
     * Показать все публикации
     * @return void
     */
    public static function index(): void
    {
        $posts = Blog::index();
        View::render('blog/index', [ 'posts' => $posts ]);
    }

    /**
     * Показать форму для создания публикации
     * @return void
     */
    public static function create(): void
    {
        FunctionController::isAuthenticated() ?? FunctionController::redirect('/log-in');
        View::render('blog/create');
    }

    /**
     * Сохранить новый 'post'
     * @return void
     */
    #[NoReturn] public static function store(): void
    {
        if (! isset($_POST['create-post']) ) {
            FunctionController::redirect('/blog/create');
        }

        $newPostId = Blog::store();
        $newFileName = self::uploadPostImage($newPostId);
        self::updateImagePath($newFileName, $newPostId);

        unset($_SESSION['form-sessions']);
        FunctionController::redirect('/blog/' . trim($_POST['slug']));
    }

    /**
     * Показать выбранный 'post'
     * @param $slug
     * @return void
     */
    public static function show($slug): void
    {
        if ( !self::checkInput(self::$slugPattern, $slug )) {
            ErrorController::notFound();
        }

        $post = Blog::show($slug);

        if (! $post) { ErrorController::notFound(); }

        $lastPosts = Blog::getLastPosts();

        View::render('blog/show', [
            'post' => $post,
            'lastPosts' => $lastPosts
        ]);
    }

    /**
     * Показать форму для редактирования публикации
     * @param $id
     * @return void
     */
    public static function edit($id): void
    {
        FunctionController::isAuthenticated() ?? FunctionController::redirect('/log-in');

        if ( !self::checkInput(self::$idPattern, $id)) {
            ErrorController::notFound();
        }

        $post = BLog::getPostToBeUpdated($id);

        // Поместить данные выбранной публикации в сессии для показа в форме редактирования
        foreach ($post[0] as $key => $field) {
            $_SESSION['form-sessions'][$key] = $field;
        }

        View::render('blog/edit');
    }

    /**
     * Сохранить обновленный 'post'
     * @return void
     */
    #[NoReturn] public static function update(): void
    {
        if (! isset($_POST['update-post']) ) {
            FunctionController::redirect('/');
        }

        Blog::updatePost();

        // Если изображение тоже обновляется
        if ( $_FILES["image"]['name'] ) {

            $postId = intval($_SESSION['form-sessions']['id']);
            $newFileName = self::uploadPostImage($postId);
            self::updateImagePath($newFileName, $postId);
        }

        unset($_SESSION['form-sessions']);
        FunctionController::redirect('/blog/' . trim($_POST['slug']));
    }
}