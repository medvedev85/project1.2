<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();

	if(isset($_POST["send"])){
		$aname = htmlspecialchars($_POST['aname']);
		$login = htmlspecialchars($_POST['login']);
		$password = $_POST['password'];
		$r_password = $_POST['r_password'];
		$_SESSION["aname"] = $aname;
		$_SESSION["login"] = $login;
		$error_login = "";
		$error_password = "";
		$error_r_password = "";
		$error = FALSE;
		if($login == "" || !preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $login)){
			$error_login = "Ошибка: неверный email адрес.";
			$error = TRUE;
		}
		if(strlen($password) <= 5){
			$error_password = "Пароль должен содержать не менее 6 символов.";
			$error = TRUE;
		}
		if($password != $r_password){
			$error_r_password = "Пароль не совпадает, проверьте правильность заполнения.";
			$error = TRUE;
		}
		if($error == FALSE){
			//$mysqli = new mysqli ("localhost", "root", "", "mybase");
			$mysqli = mysql_connect("localhost", "root", "", "mybase") or die('Не удалось соединиться: ' . mysql_error());
			//$mysqli->query ("SET NAMES 'utf8'");
			echo "ХУЙ";
			//$result2 = mysql_query ("INSERT INTO users (aname,login,password) VALUES('".$aname."','".$login."','".$password."',NOW())");
			//$result2 = mysql_query ("INSERT INTO `mybase`.`users` (`login`, `password`, `reg_date`) VALUES ('3', '".md5("11123")."', ".time().")");
			//$query = "INSERT INTO users (aname,login,password) VALUES('".$aname."','".$login."','".$password."',NOW())";
			$query = "INSERT INTO mybase.users (login, password, reg_date) VALUES ('" . $login . "','" . $password . "'," . time() . ")";
			$result2 = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
			echo "ХУЙ2";
			echo $result2;
			echo "ХУЙ23";
			if($result2){
				echo "ХУЙ3";
				$result3 = mysql_query("SELECT id FROM users WHERE login='$login'", $db);
				$myrow3 = mysql_fetch_array($result3);
				$mysqli->close();
				$activation = md5($myrow3['id']) . md5($login);
				$subject = "Подтверждение регистрации";
				$message = "Здравствуйте! Спасибо за регистрацию на citename.ru\nВаш логин:    " . $login . "\n
			  Перейдите    по ссылке, чтобы активировать ваш    аккаунт:\nhttp://localhost/test3/activation.php?login=" . $login . "&code=" . $activation . "\nС    уважением,\n
			  Администрация    citename.ru";
				//mail($email, $subject, $message, "Content-type:text/plane;    Charset=windows-1251\r\n");
				echo "Вам на E-mail выслано письмо с cсылкой, для подтверждения регистрации.    Внимание! Ссылка действительна 1 час. <a href='index.php'>Главная    страница</a>";
			}
		}
		echo $error;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Регистрация</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Регистрация" />
		<meta name="description" content="Поиск оценочных компаний. Регистрация на сайте." />
		<link href="/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/picture/logo3.ico" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div id="page-wrap">
			<header>
				<a href="/"><img src="/picture/logo.jpg" alt="logo"></a>
				<span class="right"><span class="contact"><a href="partners.php">Условия сотрудничества</a>
				<span class="right"><span class="contact"><a href="evaluating.php">Оценка</a>
				<span class="right"><span class="contact"><a href="insurance.php">Страховка</a>
				<span class="right"><span class="contact"><a href="rosreestr.php">Оформление в росреестре</a>
				<span class="right"><span class="contact"><a href="authorization.php">Вход</a>
				<span class="right"><span class="contact"><a href="registered.php">Регистрация</a>
			</header>
			<center>
				<form method="post" id="span_text" action="#">
					<span id="span_text_3">
						<h3>Создайте учетную запись для начала работы.</h3><br />
						<a href="registered.php">Уже есть учетная запись?</a><br />
						<span style="color:red"><?=$error_login?></span><br />
						<span style="color:red"><?=$error_password?></span><br />
						<span style="color:red"><?=$error_r_password?></span><br />
					</span>
					<input type="text" name="login" style="height:45px" size="50" placeholder="Электронная почта"
								 value="<?=$_SESSION["login"]?>" autocomplete="on" required /><br /><br />
					<input type="password" style="height:45px" size="50" name="password" placeholder="Придумайте пароль"
								 value="<?=$_SESSION["password"]?>" autocomplete="on" required /><br /><br />
					<input type="password" style="height:45px" size="50" name="r_password" placeholder="Повторите пароль"
								 value="<?=$_SESSION["r_password"]?>" autocomplete="on" required /><br /><br /><br />
					<input type="submit" class="sendsubmit" name="send" value="Отправить" />
				</form>
			</center>
			<footer></footer>
		</div>
	</body>
</html>