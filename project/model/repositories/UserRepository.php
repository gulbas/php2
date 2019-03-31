<?php

	namespace app\model\repositories;

	use app\engine\App;
	use app\model\entities\User;
	use app\model\Repository;

	class UserRepository extends Repository
	{
		public function routeLogin()
		{
			if ($this->isLoggedUser()) {
				header('Location: /user/home');
			}

			$error = false;

			if (isset(App::call()->request->getParams()['login_user'])) {
				$login = App::call()->request->getParams()['login'];
				$password = App::call()->request->getParams()['password'];

				$user = App::call()->userRepository->getOneWhere('login', $login);

				if ($user) {

					if (password_verify($password, $user['password'])) {
						if (isset(App::call()->request->getParams()['remember'])) {
							$this->loginUser($login, true);
						} else {
							$this->loginUser($login);
						}
						header('Location: /user/home');
					}
				} else {
					$error = 'Пользватель не найден или пароль и логин не верные';
				}
			}

			return $error;
		}

		public function loginUser(string $login, bool $remember = false): void
		{
			$user = $this->getOneWhere('login', $login);

			$_SESSION['auth'] = [
				'id'    => $user['id'],
				'login' => $user['login'],
			];

			if ($login === 'admin') {
				$_SESSION['auth']['admin'] = true;
			}

			if ($remember) {
				$auth = [
					'login' => $_SESSION['auth']['login'],
				];
				$this->setCook('auth', json_encode($auth));
			}
		}

		public function isLoggedUser(): bool
		{
			return isset($_SESSION['auth']['login']);
		}

		public function setCook(string $key, $value): void
		{
			setcookie(
				$key,
				$value,
				time() + 3600 * 2, //seconds
				'/',
				App::call()->config['site'],
				true,
				true
			);
		}

		public function resetCook(string $key): void
		{
			setcookie(
				$key,
				'',
				0,
				'/',
				App::call()->config['site'],
				true,
				true
			);
		}

		public function isAdmin(): bool
		{
			return (isset($_SESSION['auth']['admin']) && $_SESSION['auth']['admin']);
		}

		public function register()
		{
			$error = null;
			if (isset($_POST['reg_user'])) {
				$email = htmlspecialchars($_POST['email']);
				$name = htmlspecialchars($_POST['name']);
				$login = htmlspecialchars($_POST['login']);
				$password = htmlspecialchars($_POST['password']);
				$password = password_hash($password, PASSWORD_DEFAULT);

				if (!empty($name) && !empty($email) && !empty($password) && !empty($login)) {
					$user = new User(null, $login, $password, $name, $email, null);
					if ($this->insert($user) > 0) {

						$this->loginUser($login, true);
						header('Location: /user/home');
					}
				} else {
					$error = 'Something went wrong';
				}

				return $error;
			}
		}

		public function getTableName()
		{
			return 'users';
		}

		public function getEntityClass()
		{
			return User::class;
		}
	}