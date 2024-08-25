-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-08-2024 a las 23:01:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `technical_test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `city`
--

INSERT INTO `city` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Londres', 1, '2024-08-24 06:55:21', '2024-08-24 06:55:21'),
(2, 'Liverpool', 1, '2024-08-24 06:55:21', '2024-08-24 06:55:21'),
(3, 'Tokio', 2, '2024-08-24 06:55:21', '2024-08-24 06:55:21'),
(4, 'Fukuoka', 2, '2024-08-24 06:55:21', '2024-08-24 06:55:21'),
(5, 'Nueva Delhi', 3, '2024-08-24 06:55:21', '2024-08-24 06:55:21'),
(6, 'Calcuta', 3, '2024-08-24 06:55:21', '2024-08-24 06:55:21'),
(7, 'Copenhague', 4, '2024-08-24 06:55:21', '2024-08-24 06:55:21'),
(8, 'Elsinor', 4, '2024-08-24 06:55:21', '2024-08-24 06:55:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `currency_name` varchar(50) NOT NULL,
  `currency_symbol` varchar(10) NOT NULL,
  `currency_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`id`, `name`, `created_at`, `updated_at`, `currency_name`, `currency_symbol`, `currency_code`) VALUES
(1, 'Inglaterra', '2024-08-24 06:42:03', '2024-08-25 16:36:16', 'Libra esterlina', '£', 'GBP'),
(2, 'Japón', '2024-08-24 06:42:03', '2024-08-25 06:30:41', 'Yen ', '¥', 'JPY'),
(3, 'India', '2024-08-24 06:42:03', '2024-08-25 06:30:00', 'Rupia', '₹', 'INR'),
(4, 'Dinamarca', '2024-08-24 06:42:03', '2024-08-25 06:30:25', 'Corona danesa', 'kr', 'DKK');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `amount_cop` int(20) NOT NULL,
  `current_amount` int(20) NOT NULL,
  `exchange_rate` float NOT NULL,
  `date` varchar(50) NOT NULL,
  `temperature` varchar(45) DEFAULT NULL,
  `currency_symbol` varchar(5) DEFAULT NULL,
  `currency_name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `history`
--

INSERT INTO `history` (`id`, `user_id`, `city_id`, `country_id`, `amount_cop`, `current_amount`, `exchange_rate`, `date`, `temperature`, `currency_symbol`, `currency_name`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 5000000, 0, 0, '2024-08-25', NULL, NULL, NULL, '2024-08-25 09:33:47', '2024-08-25 09:33:47'),
(2, 6, 3, 2, 1000000, 36190, 0, '2024-08-25', '27.88', '¥', 'Yen ', '2024-08-25 21:01:18', '2024-08-25 21:01:18'),
(3, 6, 3, 2, 1000000, 36190, 0, '2024-08-25', '27.79', '¥', 'Yen ', '2024-08-25 21:17:18', '2024-08-25 21:17:18'),
(4, 6, 3, 2, 1000000, 36190, 0.03619, '2024-08-25', '27.79', '¥', 'Yen ', '2024-08-25 21:21:33', '2024-08-25 21:21:33'),
(5, 6, 5, 3, 6000000, 125400, 0.0209, '2024-08-25', '27.29', '₹', 'Rupia', '2024-08-25 21:32:35', '2024-08-25 21:32:35'),
(6, 6, 2, 1, 6000000, 1141, 0.0001902, '2024-08-25', '16.64', '£', 'Libra esterlina', '2024-08-25 21:36:41', '2024-08-25 21:36:41'),
(7, 6, 2, 1, 6000000, 1141, 0.0001902, '2024-08-25', '16.47', '£', 'Libra esterlina', '2024-08-25 21:41:41', '2024-08-25 21:41:41'),
(8, 6, 8, 4, 6000000, 10002, 0.001667, '2024-08-25', '17.48', 'kr', 'Corona danesa', '2024-08-25 22:03:51', '2024-08-25 22:03:51'),
(9, 6, 8, 4, 6000000, 10002, 0.001667, '2024-08-25', '15.65', 'kr', 'Corona danesa', '2024-08-25 23:19:00', '2024-08-25 23:19:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email_verified_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `created_at`, `updated_at`, `email_verified_at`) VALUES
(6, 'Juan camilo Alzate Murillo', 'JuanAlzate', 'eljuancaalzatemurillo@gmail.com', '$2y$12$e/pSIdkqUqd.reVWWlt71.rhUOBzrSDvOM21pk.rNYs.m9iI9TFQW', '2024-08-25 03:23:42', '2024-08-25 03:23:42', '2024-08-24 22:23:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Filtros para la tabla `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `history_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
