<!DOCTYPE html>
<html lang="ru">
<head>
  <title>ASM stock</title>
  <meta charset='utf-8'>
</head>
<body>
    <?php
        require_once "mysql/connect.php";
        if (!isset($_REQUEST['enter'])) {?>
        <form action="<?=$_SERVER['SCRIPT_NAME']?>">
        <label>Логин:</label>
        <input type="text" name="login" value=""><br />
        <label>Пароль:</label>
        <input type="password" name="password" value=""><br />
        <input type="submit" name="enter" value="Нажмите кнопку!">
    </form>
    <?php 
        } else {
            $login = "login";
            $password = "password";
            if ($_REQUEST['login'] == authentication($login) && $_REQUEST['password'] == authentication($password)) {
                echo "Доступ открыт для пользователя {$_REQUEST['login']}";
            } else {
                echo "\nДоступ закрыт!";
                #sleep(5);
                #system("rundll32.exe user32.dll,LockWorkStation");
            }
        } 
    ?>
</body>
</html>