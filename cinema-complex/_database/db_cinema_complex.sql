-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 05:29 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cinema_complex`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cycle`
--

CREATE TABLE `tbl_cycle` (
  `id` int(10) UNSIGNED NOT NULL,
  `weekday` varchar(45) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cycle`
--

INSERT INTO `tbl_cycle` (`id`, `weekday`, `date`) VALUES
(0, 'Wed', '2019-05-23'),
(1, 'Thu', '2019-05-24'),
(2, 'Fri', '2019-05-25'),
(3, 'Sat', '2019-05-26'),
(4, 'Sun', '2019-05-27'),
(5, 'Mon', '2019-05-28'),
(6, 'Tue', '2019-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genre`
--

CREATE TABLE `tbl_genre` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_genre`
--

INSERT INTO `tbl_genre` (`id`, `name`) VALUES
(0, 'Action'),
(1, 'Adventure'),
(2, 'Comedy'),
(3, 'Crime Film'),
(4, 'Drama'),
(5, 'Horror'),
(6, 'Musical'),
(7, 'Romance'),
(8, 'Romantic Comedy'),
(9, 'Science Fiction'),
(10, 'Thriller'),
(11, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_attempts`
--

CREATE TABLE `tbl_login_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attempts` tinyint(1) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `lock` int(11) DEFAULT NULL,
  `user_id` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_sessions`
--

CREATE TABLE `tbl_login_sessions` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `expiration` int(11) NOT NULL,
  `sess_identifier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_login_sessions`
--

INSERT INTO `tbl_login_sessions` (`user_id`, `expiration`, `sess_identifier`) VALUES
(2, 1561302898, '96a658ea69ded2afba4bfbbc7b62f768'),
(3, 1561303255, 'e021f4c223b13a3895417c9e44a0333f'),
(3, 1561303280, '00058d691b951dc799ac0cce9ecf3d3d');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movies`
--

CREATE TABLE `tbl_movies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `release_date` date NOT NULL,
  `runtime` int(10) NOT NULL,
  `rating_id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_movies`
--

INSERT INTO `tbl_movies` (`id`, `title`, `release_date`, `runtime`, `rating_id`, `slug`) VALUES
(5, 'Shazam', '2019-04-05', 132, 2, 'shazam'),
(6, 'A Star Is Born', '2018-10-08', 136, 1, 'a-star-is-born'),
(7, 'Glass', '2019-01-12', 129, 0, 'glass'),
(8, 'Avengers: Endgame', '2019-04-24', 181, 2, 'avengers-endgame'),
(9, 'Little', '2019-04-12', 109, 0, 'little'),
(10, 'The Lego Movie 2: The Second Part', '2019-02-08', 107, 0, 'the-lego-movie-2-the-second-part'),
(11, 'How to Train Your Dragon: The Hidden World', '2019-02-22', 104, 0, 'how-to-train-your-dragon-the-hidden-world'),
(12, 'Dumbo', '2019-03-29', 112, 0, 'dumbo'),
(13, 'Pokemon Detective Pikachu', '2019-05-09', 104, 1, 'pokemon-detective-pikachu'),
(14, 'Escape Room', '2019-01-04', 100, 2, 'escape-room'),
(15, 'Spider-Man: Into the Spider-Verse', '2018-12-14', 117, 0, 'spider-man-into-the-spider-verse'),
(16, 'Aladdin', '2019-05-24', 128, 1, 'aladdin'),
(17, 'Dora and the Lost City of Gold', '2019-08-09', 100, 0, 'dora-and-the-lost-city-of-gold'),
(19, 'Us', '2019-03-22', 116, 3, 'us'),
(20, 'Captain Marvel', '2019-02-27', 124, 2, 'captain-marvel'),
(21, 'Pet Sematary', '2019-04-05', 101, 4, 'pet-sematary');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie_genre`
--

CREATE TABLE `tbl_movie_genre` (
  `movie_id` int(10) UNSIGNED NOT NULL,
  `genre_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_movie_genre`
--

INSERT INTO `tbl_movie_genre` (`movie_id`, `genre_id`) VALUES
(5, 0),
(5, 2),
(6, 6),
(6, 8),
(7, 0),
(7, 10),
(8, 0),
(9, 2),
(10, 1),
(10, 2),
(11, 0),
(11, 1),
(12, 1),
(14, 5),
(15, 0),
(16, 1),
(16, 6),
(17, 1),
(19, 5),
(19, 10),
(13, 3),
(20, 0),
(21, 5),
(21, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permissions`
--

CREATE TABLE `tbl_permissions` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `access` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_permissions`
--

INSERT INTO `tbl_permissions` (`id`, `name`, `access`) VALUES
(0, 'BACKEND_ACCESS', 1),
(1, 'BACKEND_ACCESS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `name`) VALUES
(0, 'G'),
(1, 'PG'),
(2, 'PG-13'),
(3, 'R'),
(4, 'NC-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_room`
--

CREATE TABLE `tbl_room` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_no` varchar(45) NOT NULL,
  `columns` int(5) NOT NULL,
  `rows` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_room`
--

INSERT INTO `tbl_room` (`id`, `room_no`, `columns`, `rows`) VALUES
(0, 'Cinema 1', 12, 8),
(1, 'Cinema 2', 12, 10),
(2, 'Cinema 3', 12, 8),
(3, 'Cinema 4', 12, 10),
(4, 'Cinema 5', 12, 8),
(5, 'Cinema 6', 12, 10),
(6, 'Cinema 7', 12, 8),
(7, 'Cinema 8', 16, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_showing`
--

CREATE TABLE `tbl_showing` (
  `id` int(10) UNSIGNED NOT NULL,
  `movie_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_showing`
--

INSERT INTO `tbl_showing` (`id`, `movie_id`, `room_id`, `date`) VALUES
(41, 6, 0, '2019-05-23'),
(42, 8, 7, '2019-05-28'),
(43, 10, 5, '2019-05-26'),
(44, 5, 3, '2019-05-25'),
(45, 13, 4, '2019-05-24'),
(47, 21, 5, '2019-05-27'),
(48, 14, 2, '2019-05-28'),
(50, 8, 7, '2019-05-27'),
(51, 9, 5, '2019-05-23'),
(52, 16, 2, '2019-05-29'),
(53, 20, 5, '2019-05-25'),
(55, 8, 5, '2019-05-29'),
(56, 20, 4, '2019-05-26'),
(57, 7, 2, '2019-05-26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_showing_time`
--

CREATE TABLE `tbl_showing_time` (
  `showing_id` int(10) UNSIGNED NOT NULL,
  `time_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_showing_time`
--

INSERT INTO `tbl_showing_time` (`showing_id`, `time_id`) VALUES
(42, 24),
(43, 1),
(43, 4),
(43, 9),
(43, 16),
(43, 21),
(44, 3),
(44, 8),
(44, 12),
(44, 16),
(44, 21),
(45, 1),
(45, 4),
(45, 10),
(45, 16),
(45, 22),
(47, 1),
(47, 5),
(47, 9),
(47, 13),
(47, 18),
(47, 23),
(48, 2),
(48, 7),
(48, 10),
(48, 14),
(48, 18),
(48, 23),
(50, 24),
(51, 2),
(51, 8),
(51, 13),
(51, 17),
(51, 20),
(51, 24),
(52, 1),
(52, 7),
(52, 11),
(52, 15),
(52, 19),
(52, 22),
(53, 1),
(53, 6),
(53, 11),
(53, 15),
(53, 19),
(53, 23),
(41, 1),
(41, 6),
(41, 11),
(41, 15),
(41, 21),
(41, 24),
(55, 24),
(56, 4),
(56, 9),
(56, 13),
(56, 18),
(56, 22),
(57, 2),
(57, 5),
(57, 10),
(57, 14),
(57, 19),
(57, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `showing_id` int(10) UNSIGNED NOT NULL,
  `time` varchar(5) NOT NULL,
  `seat` int(10) UNSIGNED NOT NULL,
  `code` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_ticket`
--

INSERT INTO `tbl_ticket` (`user_id`, `showing_id`, `time`, `seat`, `code`) VALUES
(2, 41, '16:30', 5, 'f785c2a33e454ce3139af4951e538053dc2047739135dcf67d5762339f99d4ba'),
(2, 41, '16:30', 6, 'f785c2a33e454ce3139af4951e538053dc2047739135dcf67d5762339f99d4ba'),
(2, 41, '16:30', 7, 'f785c2a33e454ce3139af4951e538053dc2047739135dcf67d5762339f99d4ba'),
(2, 41, '16:30', 8, 'f785c2a33e454ce3139af4951e538053dc2047739135dcf67d5762339f99d4ba'),
(2, 41, '16:30', 75, '1603964a7f12601dc1fbef7bd3cadc7ff95fd7962091a45fe399974d72937e3c'),
(2, 41, '16:30', 76, '1603964a7f12601dc1fbef7bd3cadc7ff95fd7962091a45fe399974d72937e3c'),
(2, 41, '16:30', 77, '1603964a7f12601dc1fbef7bd3cadc7ff95fd7962091a45fe399974d72937e3c'),
(2, 41, '16:30', 78, '1603964a7f12601dc1fbef7bd3cadc7ff95fd7962091a45fe399974d72937e3c'),
(3, 45, '19:00', 52, '34cc6f3aa90d758fce37df4d6443d36170ee88107e8270bf495f4e0af53cf4ff'),
(3, 45, '19:00', 53, '34cc6f3aa90d758fce37df4d6443d36170ee88107e8270bf495f4e0af53cf4ff'),
(3, 45, '19:00', 54, '34cc6f3aa90d758fce37df4d6443d36170ee88107e8270bf495f4e0af53cf4ff'),
(3, 45, '19:00', 55, '34cc6f3aa90d758fce37df4d6443d36170ee88107e8270bf495f4e0af53cf4ff');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time`
--

CREATE TABLE `tbl_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_time`
--

INSERT INTO `tbl_time` (`id`, `time`) VALUES
(0, '11:00'),
(1, '11:30'),
(2, '12:00'),
(3, '12:30'),
(4, '13:00'),
(5, '13:30'),
(6, '14:00'),
(7, '14:30'),
(8, '15:00'),
(9, '15:30'),
(10, '16:00'),
(11, '16:30'),
(12, '17:00'),
(13, '17:30'),
(14, '18:00'),
(15, '18:30'),
(16, '19:00'),
(17, '19:30'),
(18, '20:00'),
(19, '20:30'),
(20, '21:00'),
(21, '21:30'),
(22, '22:00'),
(23, '22:30'),
(24, '23:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(150) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `role_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `password`, `salt`, `role_id`) VALUES
(2, 'client@email.com', '$2y$10$YQBPGGs7zCT4GIgZq8aPJehjzSBmHjkIET/r9rA.CgslsFYBDroHK', 'fd', 2),
(3, 'admin@email.com', '$2y$10$xwLIoRpHgYpzBhPvqxgtHOnBOYzNcxbpfhtwN/10iDrtyomyJZ0te', '0d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_details`
--

CREATE TABLE `tbl_user_details` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `surname` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_details`
--

INSERT INTO `tbl_user_details` (`user_id`, `name`, `surname`) VALUES
(2, 'Client', 'Client'),
(3, 'Admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cycle`
--
ALTER TABLE `tbl_cycle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `tbl_login_attempts`
--
ALTER TABLE `tbl_login_attempts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_tbl_login_attempts_tbl_users1_idx` (`user_id`);

--
-- Indexes for table `tbl_login_sessions`
--
ALTER TABLE `tbl_login_sessions`
  ADD KEY `fk_tbl_login_sessions_tbl_users1_idx` (`user_id`);

--
-- Indexes for table `tbl_movies`
--
ALTER TABLE `tbl_movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_tbl_movie_tbl_rating1_idx` (`rating_id`);

--
-- Indexes for table `tbl_movie_genre`
--
ALTER TABLE `tbl_movie_genre`
  ADD KEY `fk_table1_tbl_movie1_idx` (`movie_id`),
  ADD KEY `fk_table1_tbl_genre1_idx` (`genre_id`);

--
-- Indexes for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `tbl_showing`
--
ALTER TABLE `tbl_showing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_tbl_showing_tbl_movie1_idx` (`movie_id`),
  ADD KEY `fk_tbl_showing_tbl_room1_idx` (`room_id`);

--
-- Indexes for table `tbl_showing_time`
--
ALTER TABLE `tbl_showing_time`
  ADD KEY `fk_tbl_showing_time_tbl_showing1_idx` (`showing_id`),
  ADD KEY `fk_tbl_showing_time_tbl_time1_idx` (`time_id`);

--
-- Indexes for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD KEY `fk_table1_tbl_users1_idx` (`user_id`),
  ADD KEY `fk_tbl_ticket_tbl_showing1_idx` (`showing_id`);

--
-- Indexes for table `tbl_time`
--
ALTER TABLE `tbl_time`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `time_UNIQUE` (`time`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_tbl_users_tbl_roles1_idx` (`role_id`);

--
-- Indexes for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD KEY `fk_tbl_user_details_tbl_users1_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cycle`
--
ALTER TABLE `tbl_cycle`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_login_attempts`
--
ALTER TABLE `tbl_login_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_movies`
--
ALTER TABLE `tbl_movies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_permissions`
--
ALTER TABLE `tbl_permissions`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_showing`
--
ALTER TABLE `tbl_showing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_time`
--
ALTER TABLE `tbl_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_login_attempts`
--
ALTER TABLE `tbl_login_attempts`
  ADD CONSTRAINT `fk_tbl_login_attempts_tbl_users1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_login_sessions`
--
ALTER TABLE `tbl_login_sessions`
  ADD CONSTRAINT `fk_tbl_login_sessions_tbl_users1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_movies`
--
ALTER TABLE `tbl_movies`
  ADD CONSTRAINT `fk_tbl_movie_tbl_rating1` FOREIGN KEY (`rating_id`) REFERENCES `tbl_rating` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_movie_genre`
--
ALTER TABLE `tbl_movie_genre`
  ADD CONSTRAINT `fk_table1_tbl_genre1` FOREIGN KEY (`genre_id`) REFERENCES `tbl_genre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_tbl_movie1` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_showing`
--
ALTER TABLE `tbl_showing`
  ADD CONSTRAINT `fk_tbl_showing_tbl_movie1` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_showing_tbl_room1` FOREIGN KEY (`room_id`) REFERENCES `tbl_room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_showing_time`
--
ALTER TABLE `tbl_showing_time`
  ADD CONSTRAINT `fk_tbl_showing_time_tbl_showing1` FOREIGN KEY (`showing_id`) REFERENCES `tbl_showing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_showing_time_tbl_time1` FOREIGN KEY (`time_id`) REFERENCES `tbl_time` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  ADD CONSTRAINT `fk_table1_tbl_users1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_ticket_tbl_showing1` FOREIGN KEY (`showing_id`) REFERENCES `tbl_showing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_tbl_users_tbl_roles1` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user_details`
--
ALTER TABLE `tbl_user_details`
  ADD CONSTRAINT `fk_tbl_user_details_tbl_users1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
