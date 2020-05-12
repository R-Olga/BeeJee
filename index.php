<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <title>BeeJee</title>
</head>
<body>
    <div class="container" id="entry"><?php include ('login.php');?></div>
    <div class="container">
        <form action="add.php" method="post" id="form" >
        <h1>Приложение-задачник</h1>
            <div class="form-inline" id="task">
                <input type="text" class="form-control" name="username" placeholder="Имя" required>
                <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                <input type="text" class="form-control" name="task_text" placeholder="Текст задачи" required>
                <button type="submit" class='btn btn-primary' name="submit">Создать задачу</button>
            </div>
        </form>
    </div>
    <div class="container"><?php include ('table.php');?></div>
</body>
</html>