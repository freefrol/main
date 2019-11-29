<?php 
$title = "Личный кабинет";
include("head.php");
if($_SESSION["inside"] == true){
?>
    <p> Добро пожаловать: <?php echo $_SESSION["userName"]; ?> </p>
<?php 
} else {
?>
    <p> необходимо авторизоваться </p>
<?php
}
?>
</body>
</html>