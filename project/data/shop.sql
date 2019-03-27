-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 27 2019 г., 22:18
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Телефоны'),
(2, 'Ноутбуки'),
(3, 'Компьютеры'),
(4, 'Планшеты');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`) VALUES
(1, 1, 0),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `product_id`, `order_id`, `quantity`) VALUES
(1, 5, 1, 2),
(2, 4, 2, 1),
(3, 5, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) DEFAULT '1',
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `quantity`, `category_id`) VALUES
(1, 'Ipad', 'iPad Pro - следующее поколение планшетных компьютеров, призванное убить эру персональных компьютеров. Его мощностные характеристики, диагональ экрана, удобство работы и совершенный дизайн как бы говорит вам - Я - будущее. Зачем теперь нужен персональный компьютер, когда есть это чудо инженерной мысли?', '20000.00', 1, 4),
(2, 'MacBook', 'Обновлённый MacBook Pro 2017 раскроет все ваши таланты с первого касания. Какую бы задачу вам не требовалось выполнить на этом ноутбуке - она будет выполнена на все 100%. Наверняка, вы - творческая личность, если вам потребовался именно MacBook Pro, а значит, вашему креативу не будет предела, потому что этот ноутбук создан именно для вас! Творить и создавать вам позволит широкий выбор комплектаций этого устройства:', '99000.00', 1, 2),
(3, 'iMac', 'Обновлённые настольные компьютеры Apple iMac теперь ещё быстрее и мощнее. Всё, что может понадобиться вам от домашнего или же рабочего компьютера будет выполнено новым iMac 2017 года. Любой, даже самый ресурсоёмкий процесс будет с лёгкостью выполнен благодаря процессорам седьмого поколения Intel Core i5 и i7 и новым графическим процессорам.', '160000.00', 1, 3),
(4, 'ALCATEL 1 5033D', 'ОС Android 8.0, экран: 5\", 960×480, процессор: MediaTek MT6739, 1280МГц, 4-х ядерный, камера: 5Мп, FM-радио, GPS, время работы в режиме разговора, до: 16ч, в режиме ожидания, до: 350ч, оперативная память: 1Гб, встроенная память: 8Гб', '3970.00', 1, 1),
(5, 'APPLE iPhone XS', 'ОС iPhone iOS 12, экран: 6.5\", OLED, 2688×1242, процессор: Apple A12 Bionic, , камера: 12Мп, GPS, ГЛОНАСС, с защитой от пыли и влаги, время работы в режиме разговора, до: 25ч, встроенная память: 512Гб', '116790.00', 2, 1),
(6, 'iPhone X', 'Код: 499089; ОС iPhone iOS 11, экран: 5.8\", 2436×1125, процессор: Apple A11 Bionic, + Встроенный сопроцессор движения М11, камера: 12Мп, GPS, ГЛОНАСС, с защитой от пыли и влаги, время работы в режиме разговора, до: 21ч, встроенная память: 64Гб', '63790.00', 2, 1),
(7, 'iPhone 1023', 'sdas23423dfdf', '5040.00', 10, 1),
(8, 'SAMSUNG Galaxy Note 9 ', 'Код: 1118003; ОС Android 8.1, экран: 6.4\", Super AMOLED, 2960×1440, процессор: Exynos 9810, , 8-ми ядерный, камера: 12Мп, GPS, ГЛОНАСС, с защитой от пыли и влаги, оперативная память: 8Гб, встроенная память: 512Гб', '5040.00', 10, 1),
(9, 'SAMSUNG Galaxy Note 10 ', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(11, 'SAMSUNG Galaxy Note 14 ', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(12, 'SAMSUNG Galaxy Note 13 ', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(13, 'SAMSUNG Galaxy Note 12', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(14, 'SAMSUNG Galaxy Note 11', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(15, 'SAMSUNG Galaxy Note 15', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(16, 'SAMSUNG Galaxy Note 18 ', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(17, 'SAMSUNG Galaxy Note 19 ', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(18, 'SAMSUNG Galaxy Note 16 ', 'Смартфон Apple iPhone XS MAX MT552RU/A 256Gb золотистый с корпусом из стекла с металлической рамой оснащен литиевой батареей высокой емкости. Устройство поддерживает технологию беспроводной зарядки и обладает водо- и пылезащитой по стандарту IP68.', '5040.00', 10, 1),
(55, 'SAMSUNG Galaxy S10+ 128Gb', 'Код: 1124189; ОС Android 9, экран: 6.4\", AMOLED, 2960×1440, процессор: Exynos 9820, , 8-ми ядерный, камера: 16Мп, GPS, ГЛОНАСС, с защитой от пыли и влаги, оперативная память: 8Гб, встроенная память: 128Гб', '76990.00', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `email`) VALUES
(1, 'admin', '$2y$10$IdcdDpRm25Ug55jFLY5Yu.38QpMEjRe0.gtx8ip1p1LWAmxj3N.RO', 'Вася Пупкин', 'admin@pupkin.ru'),
(2, 'user', '$2y$10$IdcdDpRm25Ug55jFLY5Yu.38QpMEjRe0.gtx8ip1p1LWAmxj3N.RO', 'Петя Сидоров', 'sidorov@sidorov.ru'),
(3, 'ssdfs', 'secretnii', 'Vasya', '234@ttt.ru'),
(5, 'pulya2', 'secretnii', 'Vasya', 'vasya@vasya.vasya');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_fk` (`user_id`);

--
-- Индексы таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_product_fk` (`product_id`),
  ADD KEY `order_item_order_fk` (`order_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_fk` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_login_uindex` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_order_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_product_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
