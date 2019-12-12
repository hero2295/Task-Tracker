<?php

/**
 * Создаёт подключение к БД
 */
class Connect extends mysqli {

    /**
     * Свойства класса, необходимые для подключения к БД.
     * @var type 
     */
    private $host = "localhost";
    private $user = "root";
    private $password = "admin";
    private $db = "sys";
    private $conn;

    /**
     * Функция подключения к БД. Вызывается изо всех файлов в папках api/post
     * и api/put
     * @return type
     */
    function connectDB() {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db);
            $this->conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }

}
?>

