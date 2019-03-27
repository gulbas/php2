<?php

	namespace app\model;

	use app\engine\Request;

	class User extends DbModel
	{
		public $id = null;
		public $login;
		public $password;
		public $name;
		public $email;
		public $created_at = null;

		public function __construct($id = null, $login = null, $password = null, $name = null, $email =
		null, $created_at = null)
		{
//			parent::__construct();
			$this->id = $id;
			$this->login = $login;
			$this->password = $password;
			$this->name = $name;
			$this->email = $email;
			$this->created_at = $created_at;
		}

		public static function routeLogin()
		{
			if (static::isLoggedUser()) {
				header('Location: /user/home');
			}

			$error = false;

			if (isset((new Request())->getParams()['login_user'])) {
				$login = (new Request())->getParams()['login'];
				$password = (new Request())->getParams()['password'];

				$user = self::getWhere('login', $login);

				if ($user) {

					if (password_verify($password, $user['password'])) {
						if (isset((new Request())->getParams()['remember'])) {
							self::loginUser($login, true);
						} else {
							self::loginUser($login);
						}
						header('Location: /user/home');
					}
				} else {
					$error = 'Пользватель не найден или пароль и логин не верные';
				}
			}

			return $error;
		}

		public static function loginUser(string $login, bool $remember = false): void
		{
			$user = self::getWhere('login', $login);

			$_SESSION['auth'] = [
				'id'    => $user['id'],
				'login' => $user['login'],
			];

			if ($login == 'admin') {
				$_SESSION['auth']['admin'] = true;
			}

			if ($remember) {
				$auth = [
					'login' => $_SESSION['auth']['login'],
				];
				self::setCook('auth', json_encode($auth));
			}
		}

		public static function isLoggedUser(): bool
		{
			return isset($_SESSION['auth']['login']);
		}

		public static function setCook(string $key, $value): void
		{
			setcookie(
				$key,
				$value,
				time() + 3600 * 2, //seconds
				'/',
				'phpoop.local',
				true,
				true
			);
		}

		public static function resetCook(string $key): void
		{
			setcookie(
				$key,
				'',
				0,
				'/',
				'phpoop.local',
				true,
				true
			);
		}

		public static function isAdmin(): bool
		{
			return (isset($_SESSION['auth']['admin']) && $_SESSION['auth']['admin']);
		}

		public static function register() {
			$error = null;
			if (isset($_POST['reg_user'])) {
				$email = htmlspecialchars($_POST['email']);
				$name = htmlspecialchars($_POST['name']);
				$login = htmlspecialchars($_POST['login']);
				$password = htmlspecialchars($_POST['password']);
				$password = password_hash($password, PASSWORD_DEFAULT);

				if (!empty($name) && !empty($email) && !empty($password) && !empty($login)) {
					$user = new User( null, $login, $password, $name, $email, null);
					if ($user->insert() > 0) {

					self::loginUser($login, true);
					header("Location: /user/home");
				}
				} else {
					$error = "Something went wrong";
				}

				return $error;
			}
		}

		public static function getTableName(): string
		{
			return 'users';
		}
	}