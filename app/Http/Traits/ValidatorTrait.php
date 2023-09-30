<?php

namespace App\Http\Traits;

trait ValidatorTrait {

    /**
     * Разрешенные символы для поля 'id'
     * @var string
     */
    private static string $idPattern = '/^[0-9]+$/';

    /**
     * Разрешенные символы для поля 'slug'
     * @var string|int
     */
    private static string|int $slugPattern = '/^[A-z0-9\-]+$/';

    /**
     * Разрешенные символы для поля 'name'
     * @var string
     */
    private static string $namePattern = '/^[\w. \-]{2,10}$/u';

    /**
     * Разрешенные символы для поля 'email'
     * @var string
     */
    private static string $emailPattern = '/^[\w.\-]+@[\w.\-]+\.[A-Za-z]{2,8}$/';

    /**
     * Разрешенные символы для полей 'text, body, title, excerpt'
     * @var string
     */
    private static string $textPattern = '/^[\w.!?\, \;\:\"\-\'\/\n\s]+$/u';

    /**
     * Разрешенные символы для поля 'password'
     * @var string
     */
    private static string $passwordPattern = '/^[\w]{4,8}$/';

    /**
     * Проверить int|string на наличие 'плохих символов'
     * @param $pattern
     * @param int|string $string
     * @return int '0' - если есть ошибки, '1' - если OK
     */
    public static function checkInput($pattern, int|string $string): int
    {
        return preg_match($pattern, trim($string));
    }
}
