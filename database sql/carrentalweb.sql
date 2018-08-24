-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2018 at 07:10 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrentalweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_details`
--

CREATE TABLE `car_details` (
  `id` int(255) NOT NULL,
  `hiring_price` varchar(255) NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `speed` varchar(10) NOT NULL,
  `make_id` int(255) NOT NULL,
  `model_id` int(255) NOT NULL,
  `company_id` int(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `new` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_details`
--

INSERT INTO `car_details` (`id`, `hiring_price`, `fuel_type`, `color`, `description`, `speed`, `make_id`, `model_id`, `company_id`, `link`, `image`, `new`) VALUES
(16, '100', 'Diesel', 'Blue', 'Desc', '90', 1, 26, 1, 'https://mark.muthii.me/car-rental-test-link', 'blue car.jpg', 1),
(17, '900', 'Petrol', 'Purple', 'Cool purple', '100', 1, 1, 1, 'https://mark.muthii.me/car-rental-test-link-4', 'purple car.jpg', 0),
(19, '200', 'Diesel', 'Purple', 'HJJHJHJHJ', '800', 1, 1, 1, 'https://mark.muthii.me/car-rental-test-link', 'purple car.jpg', 1),
(21, '670', 'petrol', 'yellow', 'beautiful car', '500', 5, 27, 1, 'http://facebook.com', 'blue car.jpg', 0),
(22, '765', 'petrol', 'white', 'Epic ride', '465', 6, 28, 3, 'https://strathmore.edu', 'fancy car.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_rental_company`
--

CREATE TABLE `car_rental_company` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_rental_company`
--

INSERT INTO `car_rental_company` (`id`, `name`) VALUES
(1, 'Mark and Sons'),
(3, 'Kevine and Daughters'),
(4, 'Get car edit 6');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `googleplus` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `about` longtext,
  `terms` longtext,
  `privacy` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `facebook`, `twitter`, `instagram`, `googleplus`, `email`, `phonenumber`, `about`, `terms`, `privacy`) VALUES
(1, 'facebook', 'twitter', 'instagram', 'googleplus', 'companyemail@gmail.com', '+2547070707', '<h2>A HEADING FOR THE ABOUT US PAGE</h2><p>&nbsp;</p><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p><blockquote><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p></blockquote><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p>', '<h2>Terms of Service Sample</h2><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p><p><strong>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam ev</strong>eniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p><blockquote><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p></blockquote>', '<h2>Privacy Policy Sample</h2><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam<i> tempora dolorem. Suscipit, deleniti nesciunt.</i></p><blockquote><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p></blockquote><p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores quam quibusdam dolor nesciunt facilis, explicabo rem, qui reiciendis optio in id nam eveniet totam ipsam tempora dolorem. Suscipit, deleniti nesciunt.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(255) NOT NULL,
  `make_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `make_name`) VALUES
(1, 'Toyota Edit 4'),
(2, 'Honda'),
(3, 'Nissan'),
(4, 'Chevloret Edit'),
(5, 'sunny edit'),
(6, 'Rainy');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(255) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `make_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `model_name`, `make_id`) VALUES
(1, 'Model Edit 4', 2),
(2, 'Model Edit 2', 2),
(9, 'Model Form Test', 2),
(10, 'Model Test 2', 4),
(26, 'Z9', 1),
(27, 'franc edit 6', 5),
(28, 'janc', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_id` int(255) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `phonenumber`, `username`, `password`, `company_id`, `role`) VALUES
(1, 'Mark', 'Muthii', 'muthiimainam@gmail.com', '0772219258', 'mark', '$2y$10$U3El2Miw9Rzzwpn8pY5G1.YXpOovAesORHJhURa/JpQYlg901uSUC', 1, 'client'),
(2, 'Mark', 'Muthii', 'markmm@muthii.me', '772219258', 'markm', '$2y$10$b5V3uvU3hs5U8.GhbumBweqPGyXhUQyo0lYZYbVtbqVzN2ZwGLzOi', NULL, 'client'),
(3, 'Mark', 'Muthii', 'mark@muthii.me', '772219258', 'mmmm', '$2y$10$QHNJO0xab22auYrQeReIUuR9coh1hgLqR3npZpUVMgYdZCD8pnSly', NULL, 'client'),
(4, 'Mark', 'Muthii', 'mark@muthii.mee', '772219258', 'markmm', '$2y$10$lxLe7mwFSzt07VYpjDu6pOyMHkvCSr8i3Bw7ioNV/UXsun4PiLX6u', NULL, 'client'),
(5, 'Ken', 'Obunga', 'kenobunga@gmail.com', '3232323', 'ken', '$2y$10$uHRA8iwnQM02ttnVXk2Va.BW7MDsXg5pT9EazT.VBMzt5op4ivr/C', NULL, 'client'),
(6, 'stephen', 'mungai', 'nardosteve@gmail.com', '0701561941', 'nardosteve', '$2y$10$oTmuyocfykdhJWz9j53Z9ejO.Q6aHNXMr/E9TSg1nCrpSqjACLSvK', NULL, 'client'),
(7, 'Elan', 'Elan', 'elan@elan.elan', 'Elan', 'elan', '$2y$10$S1Cj//MMlAccYuU.MSj6U.6ZIt1rdMLZ.cG8uG8h2U.IBkfFYlAjq', NULL, 'client'),
(10, 'Kevine', 'Musoni', 'kevinenicky@gmail.com', '0795839443', 'kevine', '$2y$10$Uu5c.DInRmKNaZ.SG1UdZ.Avzsz/hgOCheLxYt6tr6x/QwmSWXyVi', NULL, 'client'),
(11, 'Kram', 'Aniam', 'kram@aniam.com', '772219258', 'kram', '$2y$10$CyJs920tIDyFBNtTrH892OvUBpAyA6ninRgMfI9l590shSBXCKNUG', NULL, 'su'),
(12, 'kenn', 'mike', 'kenmike@gmail.com', '0987654321', 'kenn', '$2y$10$.cN7l8WDuss.mjU15pRNEuM0Ve90pVg70S1T6Zd/fhB91jF/LFJj2', NULL, 'client'),
(13, 'damon', 'salvator', 'damon.salvator@gmail.com', '1234567890', 'damon', '$2y$10$CdgTXC7vvI/9kcwxvd8Aw.xdKxZ52hzYlNW6duUDAu8T3GCobUSsm', 1, 'client'),
(14, 'damon', 'salvator', 'damonsalvator@gmail.com', '1234567890', 'damon1', '$2y$10$3GsdCjbCPBQFgHeB0u0Rsuq6aE607SfOj4oKQoLFC7uElnONie92S', 3, 'client'),
(15, 'levi', 'arckaman', 'leviarckaman@gmail.com', '0798654321', 'levi', '$2y$10$/gOJgA9XVSPkraqCuwScCOQizlp853AZ7EaPCpcNKIGnSc46z1.Ji', NULL, 'client'),
(16, 'Kevine', 'Musoni', 'kevinemusoni@gmail.com', '0795839443', 'kevine2', '$2y$10$LbKRQQBrDS7gOrDi/hk61e1WyQLKu2dSCmlH2McsgsgVji.WEKr.W', NULL, 'su'),
(18, 'Kennedy', 'Obunga', 'kennedy.obunga32@gmail.com', '212121212', 'kenny', '$2y$10$Knga9Hij4mx8E7g/SWxyse.ZCFhiB2eGZcxAjlU66DmzEDibCkj8e', 1, 'admin'),
(19, 'Elan', 'Katheryne', 'elankatheryne@gmail.com', '0710214136', 'Elan Pierce', '$2y$10$06NrPAwoEYaoifOeI1mUKuQH6ZRPnvagqqcOaR803LTm8XYtaQzRK', NULL, 'client'),
(20, 'John', 'Doe', 'johndoe@gmail.com', '0712345678', 'john', '$2y$10$kM6TG.p6ykGKaz0UjtZIAe2nO5EpVxehUSJyZnTqa/Iz5CN7bYqnG', 3, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_details`
--
ALTER TABLE `car_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `make_id` (`make_id`);

--
-- Indexes for table `car_rental_company`
--
ALTER TABLE `car_rental_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `make_id` (`make_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_details`
--
ALTER TABLE `car_details`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `car_rental_company`
--
ALTER TABLE `car_rental_company`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `car_details`
--
ALTER TABLE `car_details`
  ADD CONSTRAINT `car_details_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`),
  ADD CONSTRAINT `car_details_ibfk_3` FOREIGN KEY (`company_id`) REFERENCES `car_rental_company` (`id`),
  ADD CONSTRAINT `car_details_ibfk_4` FOREIGN KEY (`make_id`) REFERENCES `make` (`id`);

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`make_id`) REFERENCES `make` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `car_rental_company` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
