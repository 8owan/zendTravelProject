-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2017 at 06:52 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zendProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_request`
--

CREATE TABLE `car_request` (
  `id` int(11) NOT NULL,
  `sight_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_request`
--

INSERT INTO `car_request` (`id`, `sight_id`, `start_date`, `end_date`, `user_id`) VALUES(1, 4, '2017-03-04', '2017-03-15', 6);
INSERT INTO `car_request` (`id`, `sight_id`, `start_date`, `end_date`, `user_id`) VALUES(2, 5, '2017-03-21', '2017-03-22', 6);
INSERT INTO `car_request` (`id`, `sight_id`, `start_date`, `end_date`, `user_id`) VALUES(3, 6, '2017-03-15', '2017-03-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(250) NOT NULL,
  `country_id` int(11) NOT NULL,
  `photo` text,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(1, 'Alex', 1, '/images/Alex.jpg', 'Alexandria is the second largest city and a major economic centre in Egypt, extending about 32 km (20 mi) along the coast of the Mediterranean Sea in the north central part of the country. Its low elevation on the Nile delta makes it highly vulnerable to rising sea levels. ');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(4, 'Berkeley', 1, '/images/Berkeley.jpg', 'Berkeley is a city on the east shore of San Francisco Bay in northern Alameda County, California. It is named after the 18th-century Anglo-Irish bishop and philosopher George Berkeley. It borders the cities of Oakland and Emeryville to the south and the city of Albany and the unincorporated community of Kensington to the north.');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(6, 'Soria', 1, '/images/Soria.jpg', 'Soria (Spanish pronunciation: [ˈsoɾja]) is a city in north-central Spain, the capital of the province of Soria in the autonomous community of Castile and León. In 2010 the municipality has a population of c. 39,500 inhabitants, nearly 40% of the population of the province. ');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(7, 'Berlin', 1, '/images/Berlin.jpg', 'Berlin is the capital and the largest city of Germany as well as one of its constituent 16 states. With a population of approximately 3.5 million, Berlin is the second most populous city proper and the seventh most populous urban area in the European Union.');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(8, 'Cairo', 1, '/images/Cairo.jpg', 'Cairo has long been a center of the region\'s political and cultural life, and is titled "the city of a thousand minarets" for its preponderance of Islamic architecture.');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(9, 'Bora Bora', 1, '/images/Bora Bora.jpg', 'Bora Bora is a 29.3 km2 (11 sq mi) island in the Leeward group in the western part of the Society Islands of French Polynesia, an overseas collectivity of France in the Pacific Ocean');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(11, 'Paris', 2, '/images/Paris.jpg', 'The Paris Region had a GDP of 624 billion EUR(US $687 billion) in 2012, accounting for 30.0 percent of the GDP of France and ranking it as one of the wealthiest regions in Europe; it is the banking and financial centre of France and contains the headquarters of 29 of the 31 French companies ranked in the 2015 Fortune Global 500.');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(12, 'Porto Acre', 1, '/images/Porto Acre.jpg', 'Porto Acre is a municipality located in the northeast of the Brazilian state of Acre. The economy is mainly based on agriculture. As of 2010 the municipality had a population of 14,806.');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(13, 'Tanta', 1, '/images/Tanta.jpg', 'Tanta is a large city in Egypt. It is the country\'s fifth largest populated area, with 421,076 inhabitants as of 2006. Tanta is located between Cairo and Alexandria: 94 km (58 mi) north of Cairo and 130 km (81 mi) southeast of Alexandria.');
INSERT INTO `city` (`id`, `city_name`, `country_id`, `photo`, `description`) VALUES(14, 'Maldives', 5, '/images/Maldives.jpg', 'My Dream is maldives');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `experince_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `experince_id`, `content`) VALUES(1, 6, 2, 'this is a comment');
INSERT INTO `comment` (`id`, `user_id`, `experince_id`, `content`) VALUES(2, 1, 2, 'Test for comment');
INSERT INTO `comment` (`id`, `user_id`, `experince_id`, `content`) VALUES(3, 1, 3, 'el manshya de gamela f7t l dor ele t7t');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country_name` varchar(250) NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(1, 'Egypt', '/images/Egypt.jpg');
INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(2, 'France', '/images/France.jpg');
INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(3, 'Mexico', '/images/Mexico.jpg');
INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(4, 'Turkey', '/images/Turkey.jpg');
INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(5, 'Spain', '/images/Spain.jpg');
INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(6, 'Tanzania', '/images/Tanzania.jpg');
INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(7, 'Yemen', '/images/Yemen.jpg');
INSERT INTO `country` (`id`, `country_name`, `image`) VALUES(8, 'Morcco', '/images/Morcco.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `photo` text,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `user_id`, `title`, `description`, `photo`, `city_id`) VALUES(2, 6, 'az', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.  Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, 1);
INSERT INTO `experience` (`id`, `user_id`, `title`, `description`, `photo`, `city_id`) VALUES(3, 3, 'opensource', 'amazing track', '/images/opensource.jpg', 11);
INSERT INTO `experience` (`id`, `user_id`, `title`, `description`, `photo`, `city_id`) VALUES(4, 6, 'q', 'qzzzzzzzzzzzzz', NULL, 1);
INSERT INTO `experience` (`id`, `user_id`, `title`, `description`, `photo`, `city_id`) VALUES(5, 1, 'Amazing Experience', 'Amazing place', '/images/Amazing Experience.jpg', 9);
INSERT INTO `experience` (`id`, `user_id`, `title`, `description`, `photo`, `city_id`) VALUES(6, 12, 'Masr Bladna', 'welcome', '/images/Masr Bladna.jpg', 13);

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(250) NOT NULL,
  `avail_room` int(11) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `avail_room`, `city_id`) VALUES(1, 'Hilton', 229, 1);
INSERT INTO `hotels` (`id`, `hotel_name`, `avail_room`, `city_id`) VALUES(3, 'Sheraton Plaza', 200, 7);
INSERT INTO `hotels` (`id`, `hotel_name`, `avail_room`, `city_id`) VALUES(4, 'Palestine Hotel', 150, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_request`
--

CREATE TABLE `hotel_request` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `no_of_rooms` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel_request`
--

INSERT INTO `hotel_request` (`id`, `hotel_id`, `start_date`, `end_date`, `no_of_rooms`, `user_id`) VALUES(1, 3, '2017-03-15', '2017-03-30', 5, 1);
INSERT INTO `hotel_request` (`id`, `hotel_id`, `start_date`, `end_date`, `no_of_rooms`, `user_id`) VALUES(2, 3, '2017-03-09', '2017-03-31', 50, 1);
INSERT INTO `hotel_request` (`id`, `hotel_id`, `start_date`, `end_date`, `no_of_rooms`, `user_id`) VALUES(3, 4, '2017-03-05', '2017-03-24', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sights`
--

CREATE TABLE `sights` (
  `id` int(11) NOT NULL,
  `sight_name` varchar(250) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sights`
--

INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(1, 'Sea', 4);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(2, 'Miami', 6);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(3, 'Shatby', 1);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(4, 'Temple of Taposiris Magna', 9);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(5, ' Alexandria International Airport', 1);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(6, 'El Mansheya', 11);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(7, 'Abu Qir', 13);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(8, 'El Awayid', 6);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(9, 'Library of Alexandria', 7);
INSERT INTO `sights` (`id`, `sight_name`, `city_id`) VALUES(10, 'The Graeco-Roman Museum', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(1, 'Merna Shaker', '123', 'merna@yahoo.com', 'admin', '/images/Merna Shaker.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(2, 'Sara Sherif', '123', 'sara@yahoo.com', 'blocked', '/images/Sara Sherif.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(3, 'Rowan', '123', 'rowan@yahoo.com', 'normal', '/images/Rowan.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(4, 'Anas Ahmed', '123', 'anas@yahoo.com', 'admin', '/images/Anas Ahmed.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(5, 'Test', '123', 'sdfsd@yah.com', 'blocked', '/images/Test.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(6, 'Esraa Mahmoud', '123', 'esraa@yahoo.com', 'admin', '/images/Esraa Mahmoud.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(7, 'Bassant Ahmed', '123', 'bassant@yahoo.com', 'blocked', '/images/Bassant Ahmed.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(8, 'Mina Shaker', '123', 'mina@yahoo.com', 'normal', '/images/Mina Shaker.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(9, 'Salma Gaber', '123', 'salma@yahoo.com', 'blocked', '/images/Salma Gaber.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(10, 'Mina Zakaria', '123', 'minaZ@yahoo.com', 'normal', '/images/Mina Zakaria.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(12, 'Simona', '123', 'simo@yahoo.com', 'normal', '/images/Simona.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(14, 'Nada Bayomye', '123', 'nada@yahoo.com', 'normal', '/images/Nada Bayomye.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(18, 'Eslam', '123', 'eslam@yahoo.com', 'normal', '/images/Eslam.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(19, 'Ahmed Saad', '123', 'ahmed@yahoo.com', 'normal', '/images/Ahmed Saad.jpg');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(20, 'Merna Shaker', '', 'mera_shaker@yahoo.com', 'normal', '');
INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `type`, `image`) VALUES(21, 'Magdy', '123', 'magdy@yahoo.com', 'normal', '/images/Magdy.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_request`
--
ALTER TABLE `car_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sight_id` (`sight_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experince_id` (`experince_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sight_id` (`city_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `hotel_request`
--
ALTER TABLE `hotel_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sights`
--
ALTER TABLE `sights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_request`
--
ALTER TABLE `car_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hotel_request`
--
ALTER TABLE `hotel_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sights`
--
ALTER TABLE `sights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_request`
--
ALTER TABLE `car_request`
  ADD CONSTRAINT `car_request_ibfk_1` FOREIGN KEY (`sight_id`) REFERENCES `sights` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `car_request_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`experince_id`) REFERENCES `experience` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `experience_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotel_request`
--
ALTER TABLE `hotel_request`
  ADD CONSTRAINT `hotel_request_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hotel_request_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sights`
--
ALTER TABLE `sights`
  ADD CONSTRAINT `sights_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
