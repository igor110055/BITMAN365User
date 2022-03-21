<?php
    include_once '../php/config/Database.php';
    include_once '../php/class/Users.php';
    include_once '../php/class/Admin.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $query = new Admin($db);

    if(!$user->is_logged_in()){
        $user->redirect('../');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0; URL=./membership_mngt.php">
    <title>Document</title>
</head>
<body>
    <p>Redirect to page Membership Information.........</p>
</body>
</html>