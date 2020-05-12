<?php
ini_set('display_errors', 'Off');
session_start();

$login = $_POST['login'];
$password = $_POST['password'];
$out = $_POST['btn_exit'];
$login = trim($login);
$password = trim($password);

if ($login=='admin' AND $password=='123') {   
    setcookie('login', $login, time()+3600);
    ?>
    <script>location.replace("/index.php");</script>
    <?php
}

else if (isset($out)){    
    setcookie('login', $login, time()-3600);
    ?>
<script>location.replace("/index.php");</script>
<?php
}

if(isset($_COOKIE['login']) AND $_COOKIE['login']!='') {?>
	Добро пожаловать - <?=$_COOKIE['login']?>!
	<form action="login.php" method="post">
		<button type='submit' name='btn_exit' id='btn_exit'>Выйти</button>
	</form>
 <?php }

else if (isset($_POST["button"])) {
	if ($login !== 'admin' OR $password !== '123') {?>
	<script>location.replace("/index.php");
	alert("Неверный логин или пароль!");</script>
		<?php
	}
}

else {
	?>
<form action="login.php" method="post" id="authForm"> 
    <input type="text" name="login" id="login" placeholder="Имя" required/>
    <input type="password" name="password" id="password" placeholder="Пароль" required/>
    <button type="submit" name="button" id="button">Войти</button>
</form>

<?php 
}

