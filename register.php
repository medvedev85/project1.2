<?php
require 'inc/lib.php';
if (!empty($_COOKIE['sid'])) {	// если Cookie уществует то Стартуем Сессию
	session_id($_COOKIE['sid']);
}
session_start();
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP Ajax Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
  </head>
  <body>
    <div class="container">
      <?php if (User::isAuthorized()): ?>
      <h1>Вы уже зарегистрированы!</h1>
      <form class="ajax" method="post" action="./ajax.php">
          <input type="hidden" name="act" value="logout">
          <div class="form-actions">
              <button class="btn btn-large btn-primary" type="submit">Выйти</button>
          </div>
      </form>
      <?php else: ?>
      <form class="form-signin ajax" method="post" action="./ajax.php">
        <div class="main-error alert alert-error hide"></div>
        <h2 class="form-signin-heading">Регистрация нового пользователя</h2>
        <input name="username" type="text" class="input-block-level" placeholder="Введите имя" autofocus require>
        <input name="usermail" type="text" class="input-block-level" placeholder="Введите Email" autofocus require>
        <input name="password1" type="password" class="input-block-level" placeholder="Введите пароль" require>
        <input name="password2" type="password" class="input-block-level" placeholder="Подтверждение пароля" require>
        <input type="hidden" name="act" value="register">
        <button class="btn btn-large btn-primary" type="submit">Зарегистрироваться</button>
        <div class="alert alert-info" style="margin-top:15px;">
            <p>Уже есть аккаунт? <a href="/">Войти</a>
        </div>
      </form>
      <?php endif; ?>
    </div> <!-- /container -->
    <script src="./vendor/jquery-2.0.3.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/ajax-form.js"></script>
  </body>
</html>