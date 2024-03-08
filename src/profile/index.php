<?php
session_start();
if(empty($_SESSION['id'])) {
    session_unset();
    header('Location: ../login');
    exit();
}

echo "Siema, ".$_SESSION['login'];
echo '<br><a href="../logout">Wyloguj się</a>';

?>