-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 11:00 PM
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
(0, 'Wednesday', '2019-05-22'),
(1, 'Thursday', '2019-05-23'),
(2, 'Friday', '2019-05-24'),
(3, 'Saturday', '2019-05-25'),
(4, 'Sunday', '2019-05-26'),
(5, 'Monday', '2019-05-27'),
(6, 'Tuesday', '2019-05-28');

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

--
-- Dumping data for table `tbl_login_attempts`
--

INSERT INTO `tbl_login_attempts` (`id`, `attempts`, `ip_address`, `lock`, `user_id`) VALUES
(1, 1, '::1', 1558208234, NULL);

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
(1, 1560799948, 'a67b958b865a6ce1f68d62119418d899'),
(1, 1560865331, '5034f740cbeb9dbbea58534f9da544b4'),
(1, 1560936813, 'df1e8ce94deb987b032d11eeb5da4a0b'),
(1, 1560954516, '322fc5b446a4ab2041b8d0d8213dd9af'),
(1, 1560962047, '43d0390ca0c4e7dd55354b97b4a5e649'),
(1, 1561040022, '21b21d5d43d4653345d93f0d0ea9ef43'),
(1, 1561056008, '2afa6a8bc310cb0b5a6b177ba78d33ee'),
(1, 1561134739, '5565de42840a471472de9e3001776115');

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
(0, 'Cinema 1', 5, 5),
(1, 'Cinema 2', 5, 5),
(2, 'Cinema 3', 5, 5),
(3, 'Cinema 4', 5, 5),
(4, 'Cinema 5', 5, 5),
(5, 'Cinema 6', 5, 5),
(6, 'Cinema 7', 5, 5),
(7, 'Cinema 8', 5, 5);

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
(16, 13, 0, '2019-05-22'),
(17, 13, 6, '2019-05-23'),
(18, 13, 2, '2019-05-25'),
(19, 6, 5, '2019-05-26'),
(20, 6, 0, '2019-05-23'),
(21, 6, 2, '2019-05-27'),
(22, 14, 1, '2019-05-24'),
(23, 14, 5, '2019-05-25'),
(24, 14, 0, '2019-05-28'),
(25, 7, 4, '2019-05-26'),
(26, 7, 3, '2019-05-28'),
(27, 10, 3, '2019-05-23'),
(28, 10, 0, '2019-05-25'),
(29, 8, 7, '2019-05-28'),
(30, 5, 5, '2019-05-22'),
(31, 5, 2, '2019-05-25'),
(32, 5, 1, '2019-05-27'),
(33, 8, 5, '2019-05-26'),
(34, 8, 2, '2019-05-27'),
(35, 9, 6, '2019-05-22'),
(36, 9, 3, '2019-05-23'),
(37, 9, 0, '2019-05-28'),
(38, 11, 5, '2019-05-24'),
(39, 11, 0, '2019-05-26'),
(40, 13, 0, '2019-05-28');

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
(16, 0),
(16, 3),
(16, 7),
(16, 10),
(16, 13),
(16, 16),
(16, 21),
(17, 4),
(17, 8),
(17, 13),
(17, 16),
(17, 21),
(20, 1),
(20, 5),
(20, 8),
(20, 12),
(20, 16),
(20, 22),
(21, 1),
(21, 4),
(21, 9),
(21, 13),
(21, 19),
(21, 24),
(22, 2),
(22, 5),
(22, 9),
(22, 13),
(22, 16),
(22, 23),
(24, 2),
(24, 5),
(24, 10),
(24, 12),
(24, 17),
(24, 23),
(25, 2),
(25, 7),
(25, 14),
(25, 20),
(25, 23),
(26, 4),
(26, 11),
(26, 17),
(26, 21),
(26, 24),
(27, 0),
(27, 5),
(27, 10),
(27, 16),
(27, 22),
(28, 1),
(28, 5),
(28, 8),
(28, 11),
(28, 16),
(28, 19),
(28, 23),
(29, 24),
(30, 2),
(30, 6),
(30, 9),
(30, 12),
(30, 15),
(30, 20),
(30, 24),
(31, 1),
(31, 4),
(31, 7),
(31, 10),
(31, 13),
(31, 16),
(31, 20),
(31, 23),
(18, 1),
(18, 4),
(18, 7),
(18, 12),
(18, 16),
(18, 20),
(23, 3),
(23, 10),
(23, 13),
(23, 16),
(23, 23),
(19, 1),
(19, 7),
(19, 14),
(19, 19),
(32, 0),
(32, 4),
(32, 8),
(32, 11),
(32, 15),
(32, 19),
(32, 22),
(33, 24),
(34, 24),
(35, 1),
(35, 5),
(35, 8),
(35, 12),
(35, 16),
(35, 22),
(36, 3),
(36, 7),
(36, 10),
(36, 15),
(36, 20),
(36, 24),
(37, 2),
(37, 6),
(37, 12),
(37, 17),
(37, 22),
(40, 1),
(40, 6),
(40, 11),
(40, 13),
(40, 17),
(40, 21),
(40, 24),
(39, 0),
(39, 5),
(39, 9),
(39, 13),
(39, 17),
(39, 21),
(39, 24),
(38, 3),
(38, 7),
(38, 11),
(38, 19),
(38, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ticket`
--

CREATE TABLE `tbl_ticket` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `movie_id` int(10) UNSIGNED NOT NULL,
  `seat` int(10) UNSIGNED NOT NULL,
  `price` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'dan@y.com', '$2y$10$Z9ynw8OC1GqN5CQC095.z.7HY3XCHlfAduF3kWFbzfhytx.LcgPYq', '45d7', 1);

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
(1, 'D', 'D');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_table1_tbl_users1_idx` (`user_id`),
  ADD KEY `fk_tbl_ticket_tbl_movie1_idx` (`movie_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_ticket`
--
ALTER TABLE `tbl_ticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_time`
--
ALTER TABLE `tbl_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `fk_tbl_ticket_tbl_movie1` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
