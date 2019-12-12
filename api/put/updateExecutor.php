<?php
header('Access-Control-Allow-Origin: *');               /* * Даёт доступ всем пользователям */
header('Access-Control-Allow-Methods: PUT');            /* * Устанавливает http-метод на PUT */

require_once '././config/Connect.php';                  /* * Подключает файл Connect.php */
require_once '././models/Update.php';                   /* * Подключает файл Update.php */

$connect = new Connect();                               /* * Создаёт объект класса Connect */
$db = $connect->connectDB();                            /* * Подключается к БД */

$update = new Update($db);                              /* * Создаёт объект класса Update */

try {                                                   /* * Проверка запроса и выозв функции обновления исполнителя задачи */
    if (!empty($_POST)) {

        $result = $update->updateExecutor();

        echo "Исполнитель задачи изменён";
    }
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
<form method="post" action="">
    <input name="id" required placeholder="Введите ID задачи" type="number" min="1">   
    <select name="employeeName" required placeholder="Исполнитель задачи">
        <option>Алексей Герасимов</option>
        <option>Герман Ботов</option>  
        <option>Ирина Антонова</option>
        <option>Юлиана Назимова</option>
    </select>     
    <input type="submit" value="Изменить исполнителя задачи">
</form>


