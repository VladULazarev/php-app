<?php

namespace App\Models;

use App\Core\DbConnection;
use App\Http\Controllers\FunctionController;
use PDO;
use PDOException;

class Model extends DbConnection
{
    /** Получить указанные данные из указанной таблицы
     * @param $query
     * @param array $params
     * @return array|false|void
     */
    public function select($query, array $params = [])
    {
        try {
            $stmt = $this->handler->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $_SESSION['form-message'] = "К сожалению, при получении данных произошла ошибка.";
            FunctionController::log("Error: {$e->getMessage()}. Oшибка при получении данных.");
            FunctionController::redirect('/form-message');
        }
    }

    /**
     * Сохранить новые данные в указанной таблице
     * @param $query
     * @param array $params
     * @return false|string|void
     */
    public function insert($query, array $params = [])
    {
        try {
            $stmt = $this->handler->prepare($query);
            $stmt->execute($params);
            return $this->handler->lastInsertId();
        } catch (PDOException $e) {
            $_SESSION['form-message'] = "К сожалению, произошла ошибка при сохранении данных.";
            FunctionController::log("Error: {$e->getMessage()}. Oшибка при сохранении данных.");
            FunctionController::redirect('/form-message');
        }
    }

    /**
     * Обновить данные в указанной таблице
     * @param $query
     * @param array $params
     * @return int|void
     */
    public function update($query, array $params = [])
    {
        try {
            $stmt = $this->handler->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $_SESSION['form-message'] = "К сожалению, произошла ошибка при обновлении данных.";
            FunctionController::log("Error: {$e->getMessage()}. Oшибка при обновлении данных.");
            FunctionController::redirect('/form-message');
        }
    }

    /**
     * Удалить данные в указанной таблице
     * @param $query
     * @param array $params
     * @return int|void
     */
    public function delete($query, array $params = [])
    {
        try {
            $stmt = $this->handler->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $_SESSION['form-message'] = "К сожалению, произошла ошибка при удалении данных.";
            FunctionController::log("Error: {$e->getMessage()}. Oшибка при удалении данных.");
            FunctionController::redirect('/form-message');
        }
    }
}

