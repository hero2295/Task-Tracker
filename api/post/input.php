<?php
header('Acces-Control-Allow-Origin: *');                /* * Даёт доступ всем пользователям */

require_once '././config/Connect.php';                  /* * Подключает файл Connect.php */
require_once '././models/Input.php';                    /* * Подключает файл Input.php */

$connect = new Connect();                               /* * Создаёт объект класса Connect */
$db = $connect->connectDB();                            /* * Создаёт подключение к БД */

$input = new Input($db);                                /* * Создаёт объект класса Input */

try {                                                   /* * Проверка наличия запроса и выполнение функции вставки */
    if (!empty($_POST)) {
        $result = $input->inputTask();
        echo "Задача успешно добавлена";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
<form method="post" action="">
    <input name="taskShortName" required placeholder="Задача" type="text">
    <input name="taskDescription"  required placeholder="Описание задачи" type="text">
    <select name="taskExecutor" required placeholder="Исполнитель задачи">
        <option>Алексей Герасимов</option>
        <option>Герман Ботов</option>  
        <option>Ирина Антонова</option>
        <option>Юлиана Назимова</option>
    </select>
    <input name="taskCreationDate" required placeholder="Дата создания" type="date">
    <select name="taskStatus" required placeholder="Статус">
        <option>В процессе</option>
        <option>Выполнено</option>  
    </select>
    <input type="submit" value="Добавить задачу">
</form>