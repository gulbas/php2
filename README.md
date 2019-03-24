# php2
## lesson 1
task  | file or folder name  |
------------- | ------------- |
1 - 4 | lesson1/product.class.php |
5  | lesson1/task5.php  |
6  | lesson1/task6.php  |
7  | lesson1/task7.php  |
## lesson 2 
| task  | file or folder name  |
| ------------- | ------------- |
| 1 | lesson2/engine/Autoload.php |
| 2 | lesson2/model/Orders.php |
|  | lesson2/model/Cart.php |
| 1* | lesson2/model/Product.php |
| 2* | lesson2/model/Singletone.php |
## lesson 3
| task  | file or folder name  |
| ------------- | ------------- |
| 1 | lesson3/data/shop.sql |
| 2 | lesson3/model/Products.php |
|  | lesson3/model/Users.php |
|  | lesson3/model/Orders.php |
| 3 | ✓ |
| 4 | 	$product = new Products(null, 'Продукт', 'Описание продукта', 100, 1, 1);|
|  |    $product->insert();|
|  |  	$product->delete();|
|  |  	$product->update(); |
| 5 |  	lesson3/model/Model.php - getAllObjects(), getOneObject()|
## lesson 4
ok
## lesson 5
`composer install`
## lesson 6
`composer install`
- [x] Products
    - [x] fixed - the visibility of the "load more" button with a value of zero
    - [x] added async remove product
- [x] Cart
    - [x] added async remove item cart
- [x] Admin
    - [x] added page admin
- [x] User
    - [x] did authorization
    - [x] added personal area and views five last pages
    
and other fixes and improvements.



