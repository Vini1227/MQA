<?php 

session_start();
session_destroy();

echo "<script>alert('Sessão Encerrada');</script>";
echo "<script>window.location.href='login.php';</script>";

exit();

?>