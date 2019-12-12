<?php

header('Acces-Control-Allow-Origin: *');                /* * Даёт доступ всем пользователям */

require_once '././config/Connect.php';                  /* * Подключает файл Connect.php */
require_once '././models/Delete.php';                   /* * Подключает файл Delete.php */

$connect = new Connect();                               /* * Создаёт объект класса Connect */
$db = $connect->connectDB();                            /* * Создаёт подключение к БД */

$delete = new Delete($db);                              /* * Создаёт объект класса Delete */
$delete->id = isset($_GET['id']) ? $_GET['id'] : die(); /* * Проверяет, установлен ли id */

try {                                                   /* * Выполнение функций и вывод сообщения */
    $result = $delete->deleteTask();
    $result->close();
    $updresult = $delete->updateIDs();
    echo "Задача удалена";
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>


