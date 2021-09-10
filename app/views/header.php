<?php global $user?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
    <title>Task List</title>
</head>
<body>
<header>
    <div class="bg-white border-bottom auth">
        <?php if ($user->isAuthorize()): ?>
        <span><?= $user->name ?></span>
        <a class="btn btn-outline-primary sign-out" href="">Sign out</a>
        <?php else:?>
        <label for="login">Login</label>
        <input id="login" class="form-control" type="text"/>
        <label for="password">Password</label>
        <input id="password" class="form-control" type="text"/>
        <a class="btn btn-outline-primary sign-in" href="">Sign in</a>
        <?php endif;?>
    </div>
</header>