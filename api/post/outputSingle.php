<?php

header('Acces-Control-Allow-Origin: *');                        /* * Даёт доступ всем пользователям */
header('Content-Type: application/json');                       /* * Устанавливает тип контента страницы на отображение данных в формате json */

require_once '././config/Connect.php';                          /* * Подключает файл Connect.php */
require_once '././models/Output.php';                           /* * Подключает файл output.php */

$connect = new Connect();                                       /* * Создаёт объект класса Connect */
$db = $connect->connectDB();                                    /* * Создаёт подключение к БД */

$outputSingle = new Output($db);                                /* * Создаёт объект класса Output */

$outputSingle->id = isset($_GET['id']) ? $_GET['id'] : die();   /* * Проверяет, указан ли в url параметр id */

$outputSingle->outputSingle();                                  /* * Выполняет функцию вывода данных по id */

$outputSingle_arr = array(                                      /* * Создаёт массив с полученными из запроса значениями */
    'id' => $outputSingle->id,
    'taskShortName' => $outputSingle->taskShortName,
    'taskDescription' => $outputSingle->taskDescription,
    'taskExecutor' => $outputSingle->taskExecutor,
    'taskCreationDate' => $outputSingle->taskCreationDate,
    'taskStatus' => $outputSingle->taskStatus
);

print_r(json_encode($outputSingle_arr));                        /* * Выводит полученный массив в формате json */
?>
