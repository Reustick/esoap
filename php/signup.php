<?php
require "db.php";

$data = $_POST;
if (isset($data['do_signup']))
{
    //здесь регистрируем
    $errors = array();
    if(trim($data['name'])=='')
    {
        $errors[]="Введите Имя";
    }
    if(trim($data['surname'])=='')
    {
        $errors[]="Введите Фамилию";
    }
    if(trim($data['login'])=='')
    {
        $errors[]="Введите логин";
    }
    if($data['password']=='')
    {
        $errors[]="Введите Пароль";
    }
    if($data['password2'] != $data["password"])
    {
        $errors[]="Повторный пароль введен неверно";
    }
    if(R::count("users", "login=?", array($data["login"]))>0)
    {
        $errors[]="Пользователь с таким логином уже сущесвтует";
    }
    
    if( empty($errors))
    {
        //все хорошо
        $user = R::dispense("users");
        $user->name = $data["name"];
        $user->surname = $data["surname"];
        $user->login = $data["login"];
        //$user->password = password_hash($data["password"], PASSWORD_DEFAULT); // хеширование пароля для версии PHP 5.5 и выше
        $user->password = $data["password"];
        R::store ($user);

      //echo '<div style="color: green;">Вы зарегистрировалсиь</div>';
        header("Location: http://3.u0156265.z8.ru/itmo/rustam/rustam/project1/login.html");

    }  
     else
     {
        echo '<div style="color: red;">Error</div>';
    }
}
