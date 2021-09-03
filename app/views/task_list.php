<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css" type="text/css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/js/main.js"></script>
    <title>Task List</title>
</head>
<body>
<header>
    <div class="d-flex flex-row align-items-center bg-white border-bottom">
        <label for="login">Login</label>
        <input id="login" class="form-control" type="text"/>
        <label for="password">Password</label>
        <input id="password" class="form-control" type="text"/>
        <a class="btn btn-outline-primary sign-in" href="">Sign in</a>
    </div>
</header>
<script>
    $('.sign-in').click(function (e){
        e.preventDefault()
        let login = $('#login').val()
        let password = $('#password').val()
        $.ajax({
            url: '/index.php',
            method: 'post',
            dataType: 'html',
            data: {
                login: login,
                password: password,
            },
            success: function(data){
                console.log(data)
                $('body').html(data)
            }
        });
    })

</script>
<div class="container">
    <table class="table-bordered table text-center">
        <thead>
        <tr>
            <th colspan="4">Tasks</th>
        </tr>
        <tr>
            <th>Task name</th>
            <th>User</th>
            <th>Email</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody>
        <?foreach ($tasks as $task):?>
        <tr>
            <td><?=$task['name']?></td>
            <td><?=$task['user_name']?></td>
            <td><?=$task['user_email']?></td>
            <td><?=$task['description']?></td>
        </tr>
        <?endforeach;?>
        </tbody>
    </table>
</div>

</body>
</html>

