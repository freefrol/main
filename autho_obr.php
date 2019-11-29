<?php session_start();
$adminLogin = "admin";
$adminPassword = "qwerty";

$login = $_POST["login"];
$password = $_POST["password"];

if($login == $adminLogin & $password == $adminPassword){
    $_SESSION["inside"] = true;
    $_SESSION["userName"] = "Вася";
    echo 1;
} else {
    $_SESSION["inside"] = false;
    echo 0;
}
?>