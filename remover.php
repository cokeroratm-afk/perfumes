<?php
    session_start();
    include 'config.php';
    include 'banco.php';
    include 'classes/Perfumes.php';

    $remover = new Perfumes($mysqli);

    $id = $_GET['id'];
    $remover->remover($id);

?>