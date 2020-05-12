<?php
require_once 'connection.php';

if(isset($_POST['delete'])) 
{
    if(isset($_COOKIE['login']) AND $_COOKIE['login']!=''){
        $delete=$_POST['delete'];
        $sql_delete = $mysqli ->query ('DELETE FROM assignment WHERE id='.$delete.'') or die(mysqli_error($sql_delete));
        header('Location: /index.php');
    } else {
        echo 'Вы не вошли в систему!';
        include ('login.php');
    }
} 

if (isset($_POST['button'])) {
    if(isset($_COOKIE['login']) AND $_COOKIE['login']!=''){
    $id_btn = (int) $_POST['button'];
    $res = $mysqli->query('SELECT * FROM assignment WHERE id='.$id_btn.'') or die(mysqli_error($res));
    $row = $res->fetch_assoc();
    $id = $row['id'];
    $username = $row['username'];
    $email = $row['email'];
    $task_text = $row['task_text'];
    if($row['checkbox'] == 1){
        $checked = 'checked';
        } 
    echo '<div class="col-sm-7"><form action="" method="post" class="form-horizontal" id="change">
    <div>
    <h3>Редактирование данных</h3>
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Имя:</label>
        <div class="col-sm-7">
        <input type="text" readonly class="form-control-plaintext" id="username" value="'.$username.'">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
        <div class="col-sm-7">
        <input type="text" readonly class="form-control-plaintext" id="email" value="'.$email.'">
        </div>
    </div>
    <div class="form-group row">
        <label for="task_text" class="col-sm-2 col-form-label">Задача:</label>
        <div class="col-sm-7">
        <input type="text" class="form-control" name="task_text" id="task_text" value="'.$task_text.'">
        </div>
    </div>
    <div class="form-check">
    <input class="form-check-input" name="checked" type="checkbox" '.$checked.' id="checkbox">
    <label class="form-check-label" for="checkbox">
        Выполнено
    </label>
    </div>
    <div class="form-group row">
        <div class="col-sm-7">
        <button type="submit" class="btn btn-primary" name="save" value="'.$id.'">Сохранить</button>
        <button type="cancel" class="btn btn-primary" name="cancal">Отмена</button>
        </div>
    </div>
    </div>
    </div>
</form>';
}
else {
    ?>
    <script>
        alert('Вы не авторизованы!');
        location.replace("/index.php");</script>
    <?php
}
}

if(isset($_POST['cancal'])) {
    header('Location: /index.php');
}

if(isset($_POST['save'])) {
    if(isset($_COOKIE['login']) AND $_COOKIE['login']!=''){
        $task_text = $_POST['task_text'];
        $checked = (int) ((isset($_POST['checked']))? 1 : 0);
        $id_save = $_POST['save']; 


        $task_db = $mysqli->query('SELECT * FROM assignment WHERE id='.$id_save.'') or die(mysqli_error($task_db));
        
        $row = $task_db->fetch_assoc();
        $task = $row['task_text'];
        
        if ($task_text != $task) {
            if((strpos($task, '(ред.администратором)') !== false)) {
                $res = $mysqli->query('UPDATE assignment SET task_text ="'.$task_text.'", checkbox ="'.$checked.'" WHERE id="'.$id_save.'"') or die(mysqli_error($res));
            } else {
                $res = $mysqli->query('UPDATE assignment SET task_text ="'.$task_text.' (ред.администратором)", checkbox ="'.$checked.'" WHERE id="'.$id_save.'"') or die(mysqli_error($res));
            }
        }
        else {
            $res = $mysqli->query('UPDATE assignment SET task_text ="'.$task_text.'", checkbox ="'.$checked.'" WHERE id="'.$id_save.'"') or die(mysqli_error($res));
        }
        
        header('Location: /index.php'); 
    }
    else {
        ?>
        <script>
            alert('Вы не авторизованы!');
            location.replace("/index.php");</script>
        <?php
    }
} 
    ?>
    <link rel="stylesheet" type="text/css" href="style.css" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
