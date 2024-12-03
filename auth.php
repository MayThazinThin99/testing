<?php
session_start();
$loginStatus = $_SESSION['login'];
$role = $_SESSION['role'];
echo $loginStatus . "<br>";
echo $role . "<br>";
exit();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "the user is not login";
    exit();
    // header('Location: ../index.php');
    // exit();
} else {
    if ($_SESSION['role'] !== 'admin') {
        header('Location: user/dashbaord.php');
        exit();
    } else {
        header('Location: ../product/list.php');
        exit();
    }
}
