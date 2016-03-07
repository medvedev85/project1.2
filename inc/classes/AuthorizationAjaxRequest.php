<?php
require '/inc/lib.php';

class AuthorizationAjaxRequest extends AjaxRequest
{
	public $actions = array(
			"login" => "login",
			"logout" => "logout",
			"register" => "register",
	);

	public function login()
	{
		if ($_SERVER["REQUEST_METHOD"] !== "POST") {
			// Method Not Allowed
			http_response_code(405);
			header("Allow: POST");
			$this->setFieldError("main", "Данный метод запрещен!");
			return;
		}
		setcookie("sid", "");
		$username = $this->getRequestParam("username");
		$password = $this->getRequestParam("password");
		$remember = !!$this->getRequestParam("remember-me");
		if (empty($username)) {
			$this->setFieldError("username", "Введите имя!");
			return;
		}
		if (empty($username)) {
			$this->setFieldError("usermail", "Введите Email!");
			return;
		}
		if (empty($password)) {
			$this->setFieldError("password", "Введите пароль!");
			return;
		}
		$user = new User();
		$auth_result = $user->authorize($username, $password, $remember);
		if (!$auth_result) {
			$this->setFieldError("password", "Неправильные имя или пароль! ");
			return;
		}
		$this->status = "ok";
		$this->setResponse("redirect", ".");
		$this->message = sprintf("Привет, %s! Вы успешно зарегистрированы!.", $username);
	}

	public function logout()
	{
		if ($_SERVER["REQUEST_METHOD"] !== "POST") {
			// Method Not Allowed
			http_response_code(405);
			header("Allow: POST");
			$this->setFieldError("main", "Данный метод запрещен!");
			return;
		}
		setcookie("sid", "");
		$user = new User();
		$user->logout();

		$this->setResponse("redirect", ".");
		$this->status = "ok";
	}

	public function register()
	{
		if ($_SERVER["REQUEST_METHOD"] !== "POST") {
			// Method Not Allowed
			http_response_code(405);
			header("Allow: POST");
			$this->setFieldError("main", "Данный метод запрещен!");
			return;
		}
		setcookie("sid", "");
		$username = $this->getRequestParam("username");
		$password1 = $this->getRequestParam("password1");
		$password2 = $this->getRequestParam("password2");
		if (empty($username)) {
			$this->setFieldError("username", "Введите имя");
			return;
		}
		if (empty($password1)) {
			$this->setFieldError("password1", "Введите пароль");
			return;
		}
		if (empty($password2)) {
			$this->setFieldError("password2", "Подтвердите пароль");
			return;
		}
		if ($password1 !== $password2) {
			$this->setFieldError("password2", "Пароли не совпадают. Пожалуйста повторите ввод пароля");
			return;
		}
		$user = new User();
		try {
			$new_user_id = $user->create($username, $password1);
		} catch (\Exception $e) {
			$this->setFieldError("username", $e->getMessage());
			return;
		}
		$user->authorize($username, $password1);
		$this->message = sprintf("Добро пожаловать, %s! Теперь вы зарегистрированы!", $username);
		$this->setResponse("redirect", "/");
		$this->status = "ok";
	}
}
