<?php

/**
 * Производит вывод как всех данных из таблицы БД, так и по определённым
 * параметрам
 */
class Output {

    /**
     * Свойства класса, используемые во всех его функциях 
     * @var type 
     */
    private $conn;
    public $id;
    public $taskShortName;
    public $taskDescription;
    public $taskExecutor;
    public $taskCreationDate;
    public $taskStatus;

    /**
     * Конструктор для подключения к БД
     * @param type $db
     */
    function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Функция вывода всех записей из таблицы БД
     * @return type
     */
    function outputTasks() {
        $sql = "SELECT * FROM tasks ORDER BY id";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }

    /**
     * Функция вывода одной записи по введённому id
     */
    function outputSingle() {
        $sql = "SELECT * FROM tasks WHERE id=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);

        $this->id = $row['id'];
        $this->taskShortName = $row['taskShortName'];
        $this->taskDescription = $row['taskDescription'];
        $this->taskExecutor = $row['taskExecutor'];
        $this->taskCreationDate = $row['taskCreationDate'];
        $this->taskStatus = $row['taskStatus'];
    }

    /**
     * Функция вывода записей по исполнителю задачи
     * @return type
     */
    function outputExecutor() {
        $sql = "SELECT * FROM tasks WHERE taskExecutor=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("s", $this->taskExecutor);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Функция вывода записей по дате создания задачи
     * @return type
     */
    function outputDate() {
        list($day, $month, $year) = preg_split('[-]', $this->taskCreationDate);
        $taskCreationDate = $year . "-" . $month . "-" . $day;

        $sql = "SELECT * FROM tasks WHERE taskCreationDate=?";
        $stmt = mysqli_prepare($this->conn, $sql);
        $stmt->bind_param("s", $taskCreationDate);
        $stmt->execute();
        return $stmt;
    }

}
?>

