<?php
header('Access-Control-Allow-Origin: *');               /* * Даёт доступ всем пользователям */
header('Access-Control-Allow-Methods: PUT');            /* * Устанавливает http-метод на PUT */

require_once '././config/Connect.php';                  /* * Подключает файл Connect.php */
require_once '././models/Update.php';                   /* * Подключает файл Update.php */

$connect = new Connect();                               /* * Создаёт объект класса Connect */
$db = $connect->connectDB();                            /* * Подключается к БД */

$update = new Update($db);                              /* * Создаёт объект класса Update */

try {                                                   /* * Проверка запроса и вызов функции обновления записи */
    if (!empty($_POST)) {

        $result = $update->updateTask();

        echo "Задача изменена";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
<form method="post" action="">
    <input name="id" required placeholder="Введите ID задачи" type="number" min="1"> 
    <input name="taskShortName" required placeholder="Задача" type="text">
    <input name="taskDescription" required placeholder="Описание задачи" type="text">
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
    <input type="submit" value="Изменить задачу">
</form>

