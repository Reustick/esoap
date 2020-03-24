<?php
session_start();
/**
 * Created by PhpStorm.
 * User: home
 * Date: 08.01.2020
 * Time: 15:30
 */
require "db.php";

$msg = R::dispense('msgs');
$msg->title = $_REQUEST['body'];
$msg->fromm = $_SESSION['u_name'];
$msg->too = $_REQUEST['too'];

echo $id=R::store($msg);
echo "Письмо отправлено!";
header("Location: http://3.u0156265.z8.ru/itmo/rustam/rustam/project1/php/login.php");
?>