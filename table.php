<?php 
require_once 'connection.php';

if(isset($_GET['page'])) {
    $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $limit = 3;
    $number = ($page * $limit) - $limit;

    $res_count = $mysqli -> query('SELECT COUNT(*) FROM assignment') or die(mysqli_error($res_count));

    $row = $res_count -> fetch_row();
    $total = $row[0];
    $atr_page = ceil($total / $limit);

    $query = $mysqli -> query("SELECT SQL_CALC_FOUND_ROWS * FROM assignment LIMIT $number, $limit") or die(mysqli_error($res_count));


    $key_array = array('id','username','email','task_text','checkbox');
    $sort_array = array('asc','desc');
    
    if (isset($_GET['key']))
    {
     $key=$_GET['key'];
     $sort=$_GET['sort'];
   }
   else
   {
     $key='id';
     $sort='asc';
   }

   if(in_array($key, $key_array) && in_array($sort, $sort_array))
   {
     $query = "SELECT * FROM assignment ORDER BY $key $sort LIMIT $number, $limit";
     $result = $mysqli -> query($query) or die(mysqli_error($result));
   }
   else exit("неверный формат запроса!");   

   if($sort=='asc')
   {
     $sort='desc';
   }
   else
   {
     $sort='asc';

   }

    if ( $_COOKIE['login']) {
        if ($result -> num_rows > 0) {
        echo "
        <table class='table'>
        <thead>
            <tr>
                <th><a href='?key=username&sort=$sort'>Имя</a></th>
                <th><a href='?key=email&sort=$sort'>E-mail</a></th>
                <th><a href='?key=task_text&sort=$sort'>Задача</a></th>
                <th><a href='?key=checkbox&sort=$sort'>Статус</a></th>
                <th></th>
            </tr>
        </thead><tbody><form action='select.php' method='post' id='data'></form>";

        while ($row = $result -> fetch_array()) {
            $id = $row['id'];
            $username = $row['username'];
            $email = $row['email'];
            $task_text = $row['task_text'];
            $checked = 'Не выполнено';
            if($row['checkbox'] == 1) {
            $checked = 'Выполнено';
            } 
            echo "<tr><td>$username</td>
            <td>$email</td>
            <td>$task_text</td>
            <td>$checked</td>
            <td><button class='btn btn-primary' type='submit' name='button' form='data' value='$id'>Редактировать</button>
            <button class='btn btn-primary' type='submit' name='delete' form='data' value='$id'>Удалить</button></td></tr>";
        }
        echo "</tbody></table>";
        } else {
        echo "Нет задач";
        }
    } else {
        if ($result -> num_rows > 0) {
            echo "
            <table class='table'>
            <thead>
                <tr>
                    <th><a href='?key=username&sort=$sort'>Имя</a></th>
                    <th><a href='?key=email&sort=$sort'>E-mail</a></th>
                    <th><a href='?key=task_text&sort=$sort'>Задача</a></th>
                    <th><a href='?key=checkbox&sort=$sort'>Статус</a></th>
                    <th></th>
                </tr>
            </thead><tbody><form action='select.php' method='post' id='data'></form>";
            while ($row = $result -> fetch_array()) {

                
                $username = $row['username'];
                $email = $row['email'];
                $task_text = $row['task_text'];
                $checked = 'Не выполнено';
                if($row['checkbox'] == 1){
                $checked = 'Выполнено';
                } 
                    echo "<tr><td>$username</td>
                    <td>$email</td>
                    <td>$task_text</td>
                    <td>$checked</td></tr>";
                }
            echo "</tbody></table>";
            } else {
            echo "Нет задач";
            }
    }

    echo '<div id="page" >';
    for($i=1; $i<=$atr_page; $i++) {
        if(!empty($_GET)) {
            $href = $_SERVER['REQUEST_URI'];
            echo '<a href="'.$href.'&page='.$i.'">'.$i.'<a/>';
        }
        else {
            echo '<a href="?page='.$i.'">'.$i.'<a/>';
        }
    }
    echo '</div>';