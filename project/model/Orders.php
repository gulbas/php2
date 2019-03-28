<?php

namespace app\model;

use app\model\OrderItem;
use app\model\Products;
use app\model\User;
use app\engine\Request;

class Orders extends DbModel
{
    protected $id;
    protected $created_at;
    protected $users_id;
    protected $status;
    protected $properties = [
        'id' => false,
        'created_at' => false,
        'users_id' => false,
        'status' => false,
    ];

    public function __construct($id = null, $created_at = null, $users_id = null, $status = null)
    {
        $this->id = $id;
        $this->created_at = $created_at;
        $this->users_id = $users_id;
        $this->status = $status;
    }

    public function setStatus($status): void
    {
        $this->properties['status'] = true;
        $this->status = $status;
	}
	
	public function getStatus()
	{
		return $this->status;
	}

    public static function addOrder(): void
    {
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

    public static function viewe($id)
    {
        if (isset($id)) {
            $order = OrderItem::getAllWhere('order_id', $id);
            $products = Products::getAll();

            $orderEnd = [];

            foreach ($order as $item) {
                foreach ($products as $product) {
                    if ($item['products_id'] == $product['id']) {
                        $item['products_id'] = $product['name'];
                    }
                }
                array_push($orderEnd, $item);
            }
        }
        return $orderEnd;
    }

    public static function change($id)
    {
        $order = Orders::getOneObject($id);
        if ($order->getStatus() === '0') {
			$order->setStatus(1);
		} else {
			$order->setStatus(0);
		}
       $order->update();
    }

    public static function getTableName(): string
    {
        return 'orders';
    }
}
