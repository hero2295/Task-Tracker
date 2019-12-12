<?php

/**
 * Производит вставку новой записи в БД
 */
class Input {

    private $conn;

    /**
     * Конструктор для подключения к БД 
     * @param type $db
     */
    function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Функция вставки новой записи
     * @return type
     */
    function inputTask() {
        $sql = "INSERT INTO tasks (taskShortName, taskDescription, taskExecutor, taskCreationDate, taskStatus)"
                . "VALUES(?,?,?,?,?)";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("sssss", $_POST['taskShortName'], $_POST['taskDescription'], $_POST['taskExecutor'],
                $_POST['taskCreationDate'], $_POST['taskStatus']);
        $stmt->execute();

        return $stmt;
    }

}
