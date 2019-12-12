<?php

/**
 * Удаляет запись из БД по id
 */
class Delete {

    private $conn;
    public $id;

    /**
     * Конструктор для подключения к БД 
     * @param type $db
     */
    function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Фукнция удаления записи
     * @return type
     */
    function deleteTask() {
        $sql = "DELETE FROM tasks WHERE id=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Функция для сброса id после удаления. Здесь используется вложенная
     * процедура, которая хранится в самой БД. 
     */
    function updateIDs() {
        $sql = "CALL update_IDs";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->execute();
    }

}
?>

