<?php

	namespace app\model;

	use app\model\{User, OrderItem};
	class Orders extends DbModel
	{
		public $id;
		public $created_at;
		public $user_id;
		public $status;

		public function __construct($id = null, $created_at = null, $user_id = null, $status = null)
		{
			$this->id = $id;
			$this->created_at = $created_at;
			$this->user_id = $user_id;
			$this->status = $status;
		}

		public static function addOrder() {
			if (!User::isLoggedUser()) {
				header('Location: /');
			} else {
				$userID = $_SESSION['auth']['id'];
					if (isset($_SESSION['cart'])) {
						$order = new Orders(null, null, $userID, 0);
						$lastId = $order->insert();

						if ($lastId > 0) {
							OrderItem::addProduct($lastId);
						}
					}
				 header('Location: /');
		}
	}

	public static function getTableName(): string
		{
			return 'orders';
		}
	}