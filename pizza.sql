-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2019. Nov 24. 22:34
-- Kiszolgáló verziója: 10.3.16-MariaDB
-- PHP verzió: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pizza`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `passwd` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `admins`
--

INSERT INTO `admins` (`id`, `email`, `passwd`, `name`) VALUES
(1, 'utasibence@gmail.com', '$2y$10$QdcV9ZvvHHWZ94vM1bv79.ZQfDcEt5L5clGHzG1ThD3vb3e6Xcjcu', 'Utasi Bence');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `address` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `tel` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `tel`, `price`, `date`) VALUES
(24, 'Utasi Bence', '6724 Szeged, Alföldi utca 1.', '+36302647411', 2640, '2019-11-24 20:47:00'),
(25, 'Bódi Dominik', '6800 Hódmezővásárhely, Béla utca 1.', '+36202543423', 5910, '2019-11-24 20:58:00'),
(26, 'Gábor Milán', '6724 Szeged, Boldogasszony sgt. 10. 1/B.', '+36208726343', 4910, '2019-11-24 21:00:00'),
(27, 'Kis Péter', '6750 Algyő', '+36702988726', 15380, '2019-11-24 22:34:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders_pizza`
--

CREATE TABLE `orders_pizza` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pizza_id` int(11) NOT NULL,
  `db` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `orders_pizza`
--

INSERT INTO `orders_pizza` (`id`, `order_id`, `pizza_id`, `db`) VALUES
(11, 24, 5, 2),
(12, 25, 8, 2),
(13, 25, 9, 3),
(14, 26, 7, 3),
(15, 26, 10, 1),
(16, 27, 1, 2),
(17, 27, 2, 2),
(18, 27, 3, 10);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `price` int(11) NOT NULL,
  `toppings` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `img` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `pizza`
--

INSERT INTO `pizza` (`id`, `name`, `price`, `toppings`, `img`) VALUES
(1, 'Magyaros pizza', 1150, 'pizzaszósz, sajt, sonka, kolbász, hagyma, paprika, szalonna', 'magyaros.jpg'),
(2, 'Sonkás-kukoricás pizza', 1090, 'pizzaszósz, sonka, sajt, csemegekukorica', 'sonka_kukorica.jpg'),
(3, 'Ananászos pizza', 1090, 'pizzaszósz, sajt, ananász', 'ananasz.jpg'),
(4, 'Brokkolianan pizza', 1090, 'tejföl, sajt, brokkoli, ananász, szezámmag', 'brokkoli.jpg'),
(5, 'Csőrike pizza', 1320, 'pizzaszósz, sajt, fokhagyma, csirkemell, hagyma, gomba, oliva', 'csorike.jpg'),
(6, 'Falusi pizza', 1150, 'pizzaszósz, fokhagyma, gomba, sonka, bacon, sajt', 'falusi.jpg'),
(7, 'Ínyenc pizza', 1320, 'pizzaszósz, kéksajt, Pick-szalámi, edámi sajt, füstölt sajt', 'inyenc.jpg'),
(8, 'Kerti csirke pizza', 1320, 'pizzaszósz, mexikói zöldségkeverék, sajt, lilahagyma, csirkemell', 'kerti_csirke.jpg'),
(9, 'Kolbászos pizza', 1090, 'pizzaszósz, kolbász, sajt', 'kolbaszos.jpg'),
(10, 'Kukoricás pizza', 950, 'pizzaszósz, sajt, csemegekukorica', 'kukorica.jpg');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orders_pizza`
--
ALTER TABLE `orders_pizza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `pizza_id` (`pizza_id`);

--
-- A tábla indexei `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT a táblához `orders_pizza`
--
ALTER TABLE `orders_pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `orders_pizza`
--
ALTER TABLE `orders_pizza`
  ADD CONSTRAINT `orders_pizza_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_pizza_ibfk_2` FOREIGN KEY (`pizza_id`) REFERENCES `pizza` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
