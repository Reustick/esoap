<?
session_start();

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="icon" type="image/png" href="../fav/favicon.ico" />
    <title>E-soap</title>
</head>

<body class="body">
    <header class="header">E-soap </header>
    <article class="description">
        E-soap - это почтовый сервис который позволит вам общаться с друзьями из любой точки мира.
        А так же позволит использовать учетную запись для регистрации на любых сервисах в инетернете таких как
        Вконтакте, Instagram, Facebook и др.
    </article>

    <?php

    require "db.php";

    $data = $_POST;
    if (isset($data['do_login'])) {
        $errors = array();
        $user = R::find('users', 'login=?', array($data['login']));

        // var_export($data);
        if ($user) {
            // var_export($user);
            echo $user->name;

            //логин сущесвтует
            if ($data['password'] == $user->password) {

                //password_verify($data['password'],$user->password)){

            } else {
                $errors[] = 'неверно введен пароль!';
            }
        } else {
            $errors[] = 'Пользователь с таким логином не найден!';
        }
        if (!empty($errors)) {


            echo '<div style="color: red;">' . array_shift($errors) . '</div>';
        } else {

            //echo 'no errors';

            foreach ($user as $use) {
                echo 'HEllo, ' . $use['name'];
                $_SESSION['u_name'] = $use['name'];
            }
            $sql = '  SELECT * FROM msgs where too="' . $_SESSION['u_name'] . '"';
            $msgs = R::getAll($sql);
            //        $msgs =R::find('msgs','to=?',array($_SESSION['u_id']));
            if (count($msgs)) {
                echo '<br>Inbox messages:';

                foreach ($msgs as $msg) {
                    echo '<div class="">' . $msg['title'] . '.....from' . $msg['fromm'] . '</div>';
                }
            } else {
                echo 'no messages';
            }
            //
            //var_export($_SESSION);
            //echo $user[0];
        }
    }


    ?>
    <form action="sendmsg.php" class="form-head" method="POST">
        <h3>Отправить сообщение</h3>
        <div class="form-row">
            <input disabled type="text" name="fromm" value="<?= $_SESSION['u_name'] ?>">
        </div>
        <div class="form-row">
            <input name="too" type="text" value="Введите логин получателя">
        </div>
        <div class="form-row">
            <textarea name="body" name="body" type="text">Текст письма </textarea>
        </div>
        <p><input class="sub-res" type="submit" name="do_login" value="Отправить"></p>
        <a href="../php/logaut.php">Выход</a>

    </form>
    <footer class="footer">
        <ul class="footer-description">
            <li class="list-item"> <a href="#" class="link-footer">О нас</a> </li>
            <li class="list-item"> <a href="#" class="link-footer">Поддержать проект</a> </li>
            <li class="list-item"> <a href="#" class="link-footer">Правила пользования</a> </li>
            <li class="list-item"> <a href="#" class="link-footer">Политика конфедициальности</a> </li>
        </ul>
    </footer>
</body>

</html>