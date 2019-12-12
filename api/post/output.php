<?php

header('Acces-Control-Allow-Origin: *');            /* * Даёт доступ всем пользователям */
header('Content-Type: application/json');           /* * Устанавливает тип контента страницы на отображение данных в формате json */

require_once '././config/Connect.php';              /* * Подключает файл Connect.php */
require_once '././models/Output.php';               /* * Подключает файл output.php */

$connect = new Connect();                           /* * Создаёт объект класса Connect */
$db = $connect->connectDB();                        /* * Создаёт подключение к БД */

$output = new Output($db);                          /* * Создаёт объект класса Output */
$result = $output->outputTasks();                     /* * Выполняет функцию вывода данных */

$num = mysqli_num_rows($result);                    /* * Считает кол-во строк в полученных данных */

if ($num > 0) {                                     /* * Проверяет кол-во строк. Если они есть, то помещает их в массив */
    $tasks = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($tasks, $row);
    }
}
echo json_encode($tasks);                           /* * Выводит массив в формате json */
?>



