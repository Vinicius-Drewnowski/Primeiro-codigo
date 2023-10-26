<?php
session_start();
if(!isset($_SESSION['login1'])){
    header("location: index.php");
}
include "config.php";
$consulta=$conn->prepare('SELECT * FROM login WHERE id_log = :id');
$consulta->bindValue(":id", $_SESSION['login1']);
$consulta->execute();
$row=$consulta->fetch();
?>
<h1>Olá, <?php echo $row['user_log']; ?></h1>
<a href="logout.php">Logout</a>