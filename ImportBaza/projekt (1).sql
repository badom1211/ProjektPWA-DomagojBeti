-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 11:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  `korisnicko_ime` varchar(50) DEFAULT NULL,
  `lozinka` varchar(255) DEFAULT NULL,
  `razina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Domagoj', 'Beti', 'badom', '$2y$10$KLbktxsN5A8BaF4UBFFkb.RY291E33Kewyz.3tuI3ii37rifaUlcW', 0),
(2, 'admin', 'admin', 'admin', '$2y$10$3p5LnQ52FpSYAYlA8m7qK.RoLSeahxrfrk2KiexY/gF3bHHmgGBsK', 1),
(3, 'Eureka', 'Noteureka', 'eureka', '$2y$10$oqXf6zDxc58NruMFMHmEse/z6f8OLn0eGfoyW.prymZY2QsWszk5G', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) CHARACTER SET cp1250 COLLATE cp1250_croatian_ci NOT NULL,
  `sazetak` text CHARACTER SET cp1250 COLLATE cp1250_croatian_ci NOT NULL,
  `tekst` text CHARACTER SET cp1250 COLLATE cp1250_croatian_ci NOT NULL,
  `slika` varchar(255) CHARACTER SET cp1250 COLLATE cp1250_croatian_ci NOT NULL,
  `kategorija` varchar(50) CHARACTER SET cp1250 COLLATE cp1250_croatian_ci NOT NULL,
  `arhiva` tinyint(1) NOT NULL DEFAULT 0,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`id`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`, `datum`) VALUES
(2, 'The Benefits of Regular Meditation', 'Explore the mental and physical benefits of meditation.', 'Explore the mental and physical benefits of meditation. Find out how regular practice can help reduce stress, improve focus, and enhance overall well-being.', 'meditation.jpg', 'health', 1, '2024-05-16 00:00:00'),
(3, 'Top 10 Superfoods for a Healthy Diet', 'Incorporate these superfoods into your diet to improve your health.', 'Incorporate these superfoods into your diet to improve your health. From berries to leafy greens, discover the top 10 foods that pack a nutritional punch.', 'superfoods.jpg', 'health', 1, '2024-05-04 00:00:00'),
(4, '5 Effective HIIT Workouts for Busy Schedules', 'High-Intensity Interval Training (HIIT) is an incredibly effective way to burn fat, build muscle, and improve cardiovascular health in a short amount of time.', 'High-Intensity Interval Training (HIIT) is an incredibly effective way to burn fat, build muscle, and improve cardiovascular health in a short amount of time. Perfect for those with busy schedules, HIIT workouts are designed to maximize efficiency and results.', 'HIIT.jpg', 'fitness', 1, '2024-05-16 00:00:00'),
(5, 'The Best Yoga Poses for Beginners', 'Yoga is a fantastic way to improve flexibility, build strength, and reduce stress.', 'Yoga is a fantastic way to improve flexibility, build strength, and reduce stress. If you\'re new to yoga, it\'s important to start with poses that are simple and safe to perform.', 'yoga.jpg', 'fitness', 1, '2024-05-15 00:00:00'),
(6, 'Strength Training Tips for Women', 'Strength training is essential for women of all ages.', 'Strength training is essential for women of all ages. Learn the best exercises, techniques, and benefits of incorporating strength training into your fitness routine.', 'strengthwomen.jpg', 'fitness', 1, '2024-05-14 00:00:00'),
(7, 'Eating Healthy on a Budget', 'Learn how to maintain a healthy diet without breaking the bank.', 'Learn how to maintain a healthy diet without breaking the bank. Discover tips and tricks for eating healthy on a budget.', 'healthBudget.jpg', 'nutrition', 1, '2024-05-17 00:00:00'),
(8, 'Understanding Macros: Protein, Carbs, and Fats', 'Gain a deeper understanding of macronutrients and their roles in your diet.', 'Gain a deeper understanding of macronutrients and their roles in your diet. Learn how to balance protein, carbs, and fats for optimal health.', 'macros.jpg', 'nutrition', 1, '2024-05-18 00:00:00'),
(9, 'Hydration: The Importance of Drinking Water', 'Discover why staying hydrated is crucial for your health.', 'Discover why staying hydrated is crucial for your health. Learn about the benefits of drinking water and how to ensure you\'re getting enough.', 'hydration.jpg', 'nutrition', 1, '2024-05-19 00:00:00'),
(15, 'asdasdasd', 'dasdsadasdasd', '123123512312312', 'strengthwomen.jpg', 'fitness', 1, '2024-06-13 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD UNIQUE KEY `korisnicko_ime_2` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
