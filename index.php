<?php
    require_once "mysql/connect.php";
    $login = 'login';
    $password = "password";
    if (isset($_REQUEST['enter'])) {
        if ($_REQUEST['login'] == authentication($login) && $_REQUEST['password'] == authentication($password)) {
            header('Location: computers.php');
        } else {
            echo "Доступ закрыт!";
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <title>ASM stock</title>
</head>
<body>
<?php if (!isset($_REQUEST['enter'])) : ?>
    <form action="index.php">
        <label>Логин:</label>
        <label>
            <input type="text" name="login" value="">
        </label>
        <br />
        <label>Пароль:</label>
        <label>
            <input type="password" name="password" value="">
        </label>
        <br />
        <input type="submit" name="enter" value="Нажмите кнопку!">
    </form>
<?php endif; ?>
</body>
</html>