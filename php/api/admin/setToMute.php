<?php
    include_once 'includes.php';

    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $post = $query->setToMUte($_GET["setMute"]);