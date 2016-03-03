<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Оценочные компании</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Оценка недвижимости" />
		<meta name="description" content="Выбрать оценочную компанию по банку, цене, скорости в подготовке отчета." />
		<link href="/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/picture/logo3.ico" rel="shortcut icon" type="image/x-icon" />
		<link href="http://yandex.st/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
		<script src="http://yandex.st/jquery/1.8.0/jquery.min.js"></script>
		<script src="http://yandex.st/bootstrap/3.1.1/js/bootstrap.min.js"></script>
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
			<script src="https://api-maps.yandex.ru/2.1/?load=package.full&lang=ru_RU" type="text/javascript"></script>
			<script src="yandex/javascript/main.js"></script>
			<script>
				//DOM
				fancy.dom({
					'.sendsubmit2': {
						this: {
							click: function () {
								console.log('city');
								city = $('.form-control[name=search_address]').val();
								fancy.Maps.search(city, 'proverka.php');
							}
						}
					}
				});
			</script>
			<center>
				<form method="post" id="span_text" action="" onsubmit='return false;'>
					<span id="span_text_3">
					<h3>Выберете банк и адрес объекта оценки</h3><br />
					<select>
						<option value="" disabled selected style='display:none;'>Выберите банк из списка</option>
						<option value="<?=$_SESSION["bank"]?>">ПАО АКБ «Связь-Банк»</option>
					</select>
					<select>
						<option value="" disabled selected style='display:none;'>Выберите тип недвижимости</option>
						<option value="<?=$_SESSION["real"]?>">квартира</option>
						<option value="<?=$_SESSION["real"]?>">комната</option>
						<option value="<?=$_SESSION["real"]?>">машиноместо</option>
						<option value="<?=$_SESSION["real"]?>">апартаменты</option>
						<option value="<?=$_SESSION["real"]?>">загородный дом (меньше 100 метров)</option>
						<option value="<?=$_SESSION["real"]?>">загородный дом (больше 100 метров)</option>
					</select>
					<input type="text" class="form-control" name="search_address" style="height:45px" size="100"
								 placeholder="Введите адрес объекта оценки" value="<?=$_SESSION["address"]?>" autocomplete="on" required />
					<input type="submit" class="sendsubmit2" name="send" value="Отправить" /><br /><br />
				</form>
				<div class="container">
					<div class="row">
						<div id="map" style="width: 100%; height: 450px;"></div>
					</div>
					<div id="add_img" class="row"></div>
				</div>
			</center>
			<footer></footer>
		</div>
	</body>
</html>