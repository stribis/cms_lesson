-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 30, 2023 at 03:31 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms-example`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_posts`
--

CREATE TABLE `db_posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `contact` varchar(191) NOT NULL,
  `image` varchar(255) NOT NULL,
  `op` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_posts`
--

INSERT INTO `db_posts` (`id`, `title`, `content`, `contact`, `image`, `op`, `date_posted`) VALUES
(22, 'Lost cat', 'Hi guys, \r\nI was hoping somebody here has seen my cat aroud? He is a chubby ginger cat. He answers to the name Garfield.\r\nHe went outside for a walk on Monday and never came back.\r\n\r\nIf you have any information, please contact me under the given contact Adress or give me a call at 555 45 45.', 'lostmycat@pet.io', 'image_6475d3cc6db28_1685443532.jpeg', 5, '2023-05-30 10:45:32'),
(23, 'Selling vintage sofa', 'Currently selling my vintage russian sofa.\r\nSome wear and tear (see image).\r\nI won\'t take anything bellow 340chf.\r\nContact me with an offer if you are interested.', 'martin@hut.ch', 'image_6475d486d5645_1685443718.jpeg', 5, '2023-05-30 10:48:38'),
(24, 'Looking for partner', 'Hello,\r\nMy name is Harry and I am in the search for a Quidditch partner to practice with.\r\nI am based in England, but willing to apparate anywhere if required.\r\n', 'harry.potter@hogwarts.uk', 'image_6475d5c9ce791_1685444041.jpeg', 7, '2023-05-30 10:54:01'),
(25, 'Job Opportunity Graphic Designer Needed', 'Hello community members! Our design agency is seeking a talented graphic designer to join our team. If you have a passion for creating stunning visuals, experience with Adobe Creative Suite, and a strong portfolio, we\'d love to hear from you. Please send your resume and portfolio to the provided email address. Looking forward to connecting with you!', 'designjobs@example.com', 'image_6475d83190c12_1685444657.jpeg', 8, '2023-05-30 11:04:17'),
(26, 'Seeking Roommate for Apartment Share', 'Attention all prospective roommates! I have a spacious apartment with an extra bedroom up for grabs. The apartment is located in a convenient and safe neighborhood, close to public transportation. If you\'re responsible, clean, and looking for a cozy place to call home, please reach out to me at the provided email address. Let\'s schedule a time to chat and see if we\'d be a good fit!', 'roommatesearch@example.com', 'image_6475d8a0a4b13_1685444768.jpeg', 8, '2023-05-30 11:06:08'),
(27, 'Selling Furniture and Electronics', 'Hey neighbors! I\'m hosting a garage sale this Saturday from 9 AM to 2 PM. I have a variety of items up for grabs, including furniture, electronics, kitchenware, and more. Everything is in great condition and priced to sell. If you\'re interested or want to see what\'s available, shoot me an email or drop by on the day of the sale. Looking forward to seeing you there!', 'garagesale2023@example.com', 'image_6475d9189a2ee_1685444888.webp', 8, '2023-05-30 11:08:08'),
(28, 'Experienced Teacher Available', 'Attention music enthusiasts! If you\'ve always wanted to learn how to play the piano or want to improve your skills, I\'m here to help. I\'m an experienced piano teacher with a passion for sharing the joy of music. Lessons are available for all ages and skill levels. Whether you\'re a beginner or looking to refine your technique, send me an email to discuss availability and rates. Let\'s make beautiful music together!', 'musicteacher@example.com', 'image_6475d97329ef2_1685444979.jpeg', 8, '2023-05-30 11:09:39'),
(29, 'Popcorn Tasting Club', 'Hey popcorn enthusiasts! Are you tired of settling for plain buttered popcorn? Join our Popcorn Tasting Club and embark on a flavor adventure! We\'ll explore unique and delicious popcorn flavors from around the world. From cheesy jalapeno to caramel apple pie, there\'s no limit to the possibilities. Drop us an email to join the club and get ready to pop, taste, and enjoy!', 'popcornlovers@example.com', 'image_6475da1bc732e_1685445147.jpeg', 8, '2023-05-30 11:12:27'),
(30, ' Dress up Your Furry Friends', 'Calling all pet fashionistas! It\'s time to showcase your furry friends\' style and strut their stuff on the runway. Join us for the Pet Fashion Show Extravaganza, where pets will compete in categories like \"Best Dressed,\" \"Most Glamorous,\" and \"Most Adorable.\" From fancy bowties to fabulous tutus, let your pet\'s personality shine! Email us to register your pet and let the fashion frenzy begin!', 'fashionfurbabies@example.com', 'image_6475dae9323c1_1685445353.jpeg', 8, '2023-05-30 11:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_me` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`id`, `name`, `email`, `password`, `remember_me`, `status`, `created_at`) VALUES
(5, 'Martin Hutchings', 'martinhutch1@gmail.com', '$2y$10$DO2NSaIe3a.QZZiYePSQ.ef.jkTDnUrFShMwLwlybui8jQ/dhsrwG', NULL, 1, '2023-05-29 15:30:42'),
(6, 'Jasmin Fischli', 'jasmin@fisch.io', '$2y$10$y1yzdnHU.7BWlOvTDGqhqe./pAIvAG.x0nN/HIRDs4MkhuZSVAo8a', NULL, 1, '2023-05-29 15:40:31'),
(7, 'Harry Potter', 'harry.potter@hogwarts.uk', '$2y$10$57s.MHg/gkAgit/6OydTi.QTVxTx0gTJ1gQ3rgVuqhP5QQmJItBBO', NULL, 1, '2023-05-30 10:50:43'),
(8, 'Open AI', 'chatgpt@open.ai', '$2y$10$YWycg8LQUCy5T8UKMa3yVebLxT0Y5jrNBV1XkLpVd.zC/BWPu7NmW', NULL, 1, '2023-05-30 11:00:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_posts`
--
ALTER TABLE `db_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `op` (`op`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_posts`
--
ALTER TABLE `db_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `db_posts`
--
ALTER TABLE `db_posts`
  ADD CONSTRAINT `db_posts_ibfk_1` FOREIGN KEY (`op`) REFERENCES `db_user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
