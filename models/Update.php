<?php

/**
 * Производит обновление, как всей записи, так и статуса и исполнителя отдельно
 */
class Update {

    private $conn;

    /**
     * Конструктор для подключения к БД
     * @param type $db
     */
    function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Функция обновления записи таблицы БД по введённому id
     * @return type
     */
    function updateTask() {
        $sql = "UPDATE tasks SET taskShortName=?, taskDescription=?, taskExecutor=?, taskCreationDate=?, taskStatus=? WHERE id=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("sssssi", $_POST['taskShortName'], $_POST['taskDescription'], $_POST['taskExecutor'],
                $_POST['taskCreationDate'], $_POST['taskStatus'], $_POST['id']);

        if ($stmt->execute()) {
            return $stmt;
        }

        printf("Error: %s.\n", $stmt->error);
    }

    /**
     * Функция обновления статуса задачи по введённому id
     * @return type
     */
    function updateStatus() {
        $sql = "UPDATE tasks SET taskStatus=? WHERE id=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("si", $_POST['taskStatus'], $_POST['id']);

        if ($stmt->execute()) {
            return $stmt;
        }

        printf("Error: %s.\n", $stmt->error);
    }

    /**
     * Функция обновления (назначения) исполнителя задачи по введённому id задачи
     * @return type
     */
    function updateExecutor() {
        $sql = "UPDATE tasks INNER JOIN employees ON tasks.taskExecutor != employees.employeeName SET tasks.taskExecutor = employees.employeeName
            WHERE tasks.id=? AND employees.employeeName=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("is", $_POST['id'], $_POST['employeeName']);

        if ($stmt->execute()) {
            return $stmt;
        }

        printf("Error: %s.\n", $stmt->error);
    }

}

?>
