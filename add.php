<?php

require_once 'connection.php';
$username = strip_tags($_POST['username']);
$email = $_POST['email'];
$task_text = strip_tags($_POST['task_text']);
$sql = "INSERT INTO assignment (username, email, task_text) VALUES ('$username','$email','$task_text')";
$result = $mysqli -> query($sql);
?>
	<script>location.replace("/index.php");
	alert("Запись успешно добавлена!");</script>
		<?php 
