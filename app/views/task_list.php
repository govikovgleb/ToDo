<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Task List</title>
</head>
<body>
<header>
    <div class="d-flex flex-row align-items-center bg-white border-bottom">
        <label for="login">Login</label>
        <input id="login" class="form-control" type="text"/>
        <label for="password">Password</label>
        <input id="password" class="form-control" type="text"/>
        <a class="btn btn-outline-primary" href="#">Sign in</a>
    </div>
</header>
<div class="container">
    <table class="table text-center">
        <thead>
        <tr>
            <th colspan="3">Tasks</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?=$user_name?></td>
            <td><?=$user_email?></td>
            <td><?=$description?></td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>

