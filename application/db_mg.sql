-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2014 at 09:40 
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE IF NOT EXISTS `admin_table` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `agent_table`
--

CREATE TABLE IF NOT EXISTS `agent_table` (
`id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `agent_table`
--

INSERT INTO `agent_table` (`id`, `name`, `email`, `status`) VALUES
(2, 'agent-test3', 'agent3@agent3.com', 'approved'),
(3, 'agent-test2', 'agent2@agent.com', 'approved');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ajax_get_approved_user`
--
CREATE TABLE IF NOT EXISTS `ajax_get_approved_user` (
`id` int(11)
,`mg_user_id` varchar(20)
,`name` varchar(20)
,`address` varchar(100)
,`city` varchar(20)
,`phone` varchar(20)
,`id_number` varchar(20)
,`birthdate` datetime
,`genre` varchar(6)
,`email` varchar(50)
,`password` varchar(32)
,`status` varchar(10)
,`agent` int(11)
,`point` int(11)
,`agentname` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ajax_get_gift_request`
--
CREATE TABLE IF NOT EXISTS `ajax_get_gift_request` (
`id` int(11)
,`user_id` int(11)
,`gift_id` int(11)
,`status` varchar(10)
,`username` varchar(20)
,`giftname` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ajax_get_not_approved_change_agent`
--
CREATE TABLE IF NOT EXISTS `ajax_get_not_approved_change_agent` (
`id` int(11)
,`user_id` int(11)
,`old_agent` varchar(20)
,`new_agent` varchar(20)
,`old_mguserid` varchar(20)
,`new_mguserid` varchar(20)
,`date_request` datetime
,`status` varchar(8)
,`date_updated` datetime
,`name` varchar(20)
,`oldagentname` varchar(20)
,`newagentname` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ajax_get_not_approved_user`
--
CREATE TABLE IF NOT EXISTS `ajax_get_not_approved_user` (
`id` int(11)
,`mg_user_id` varchar(20)
,`name` varchar(20)
,`address` varchar(100)
,`city` varchar(20)
,`phone` varchar(20)
,`id_number` varchar(20)
,`birthdate` datetime
,`genre` varchar(6)
,`email` varchar(50)
,`password` varchar(32)
,`status` varchar(10)
,`agent` int(11)
,`point` int(11)
,`agentname` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ajax_get_pending_gift`
--
CREATE TABLE IF NOT EXISTS `ajax_get_pending_gift` (
`id` int(11)
,`user_id` int(11)
,`gift_id` int(11)
,`status` varchar(10)
,`gift` varchar(20)
,`gift_name` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ajax_get_transaction`
--
CREATE TABLE IF NOT EXISTS `ajax_get_transaction` (
`id` int(11)
,`hotel` varchar(30)
,`room` int(11)
,`night` int(11)
,`name` varchar(20)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ajax_get_user_transaction`
--
CREATE TABLE IF NOT EXISTS `ajax_get_user_transaction` (
`id` int(11)
,`user_id` int(11)
,`hotel` varchar(30)
,`room` int(11)
,`night` int(11)
,`fromdate` datetime
,`todate` datetime
,`name` varchar(20)
);
-- --------------------------------------------------------

--
-- Table structure for table `change_agent_table`
--

CREATE TABLE IF NOT EXISTS `change_agent_table` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_agent` varchar(20) NOT NULL,
  `new_agent` varchar(20) NOT NULL,
  `old_mguserid` varchar(20) NOT NULL,
  `new_mguserid` varchar(20) NOT NULL,
  `date_request` datetime NOT NULL,
  `status` varchar(8) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `change_agent_table`
--

INSERT INTO `change_agent_table` (`id`, `user_id`, `old_agent`, `new_agent`, `old_mguserid`, `new_mguserid`, `date_request`, `status`, `date_updated`) VALUES
(7, 1, '3', '2', '3', 'johan', '2014-11-27 00:00:00', 'rejected', '2014-11-27 00:00:00'),
(8, 1, '3', '3', '3', 'johanc', '2014-11-27 00:00:00', 'rejected', '2014-11-27 00:00:00'),
(9, 1, '3', '2', '3', 'johan', '2014-11-27 00:00:00', 'rejected', '2014-11-27 00:00:00'),
(10, 1, '3', '2', 'johan', 'johan', '2014-11-27 00:00:00', 'approved', '2014-11-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gift_table`
--

CREATE TABLE IF NOT EXISTS `gift_table` (
`id` int(11) NOT NULL,
  `filename` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `point` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `gift_table`
--

INSERT INTO `gift_table` (`id`, `filename`, `name`, `point`, `status`, `description`) VALUES
(4, 'avatar.png', 'test', 10, 'approved', 'test'),
(5, 'avatar2.png', 'test2', 10, 'deleted', 'test2'),
(6, 'avatar1.png', 'test2', 10, 'approved', ''),
(7, 'avatar3.png', 'test3', 10, 'approved', ''),
(8, 'avatar4.png', 'test4', 10, 'approved', ''),
(9, 'avatar5.png', 'test5', 10, 'approved', ''),
(10, 'avatar6.png', 'test6', 10, 'approved', 'test6'),
(11, 'avatar7.png', 'test7', 10, 'approved', 'test7'),
(12, 'avatar8.png', 'test', 30, 'approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `main_table`
--

CREATE TABLE IF NOT EXISTS `main_table` (
`id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `request_gift_table`
--

CREATE TABLE IF NOT EXISTS `request_gift_table` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gift_id` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `request_gift_table`
--

INSERT INTO `request_gift_table` (`id`, `user_id`, `gift_id`, `status`) VALUES
(2, 1, 2, 'pending'),
(5, 1, 4, 'pending'),
(6, 1, 4, 'deleted'),
(7, 1, 4, 'deleted'),
(8, 1, 4, 'deleted'),
(9, 1, 4, 'deleted'),
(10, 1, 4, 'deleted'),
(11, 1, 4, 'deleted'),
(12, 1, 4, 'pending'),
(13, 1, 10, 'pending'),
(14, 1, 4, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_table`
--

CREATE TABLE IF NOT EXISTS `transaction_table` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hotel` varchar(30) NOT NULL,
  `room` int(11) NOT NULL,
  `night` int(11) NOT NULL,
  `fromdate` datetime NOT NULL,
  `todate` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `transaction_table`
--

INSERT INTO `transaction_table` (`id`, `user_id`, `hotel`, `room`, `night`, `fromdate`, `todate`) VALUES
(1, 1, 'test', 2, 2, '1995-01-02 00:00:00', '1995-01-04 00:00:00'),
(2, 1, 'test1', 2, 2, '1995-01-02 00:00:00', '1995-01-04 00:00:00'),
(3, 4, 'dfdfd', 7, 5, '1995-01-02 00:00:00', '1995-01-04 00:00:00'),
(4, 4, 'dfdfd', 7, 5, '1995-01-02 00:00:00', '1995-01-04 00:00:00'),
(5, 4, 'dfdfd', 7, 5, '1995-01-02 00:00:00', '1995-01-04 00:00:00'),
(6, 1, 'dfdfd', 2, 2, '2014-11-20 00:00:00', '2014-11-22 00:00:00'),
(7, 1, 'dfdfd', 3, 3, '2014-11-21 00:00:00', '2014-11-25 00:00:00'),
(8, 5, 'dfdfd', 2, 3, '2014-11-24 00:00:00', '2014-11-24 00:00:00'),
(9, 0, '', 1, 1, '1970-01-01 00:00:00', '1970-01-01 00:00:00'),
(10, 0, '', 1, 1, '1970-01-01 00:00:00', '1970-01-01 00:00:00'),
(11, 5, 'dfdfd', 1, 1, '1970-01-01 00:00:00', '1970-01-01 00:00:00'),
(12, 5, 'dfdfd', 1, 1, '1970-01-01 00:00:00', '1970-01-01 00:00:00'),
(13, 1, 'fdfdfd', 3, 10, '2014-12-25 00:00:00', '2014-12-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
`id` int(11) NOT NULL,
  `mg_user_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `id_number` varchar(20) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `genre` varchar(6) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `status` varchar(10) NOT NULL,
  `agent` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `token` varchar(40) DEFAULT NULL,
  `expired` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `mg_user_id`, `name`, `address`, `city`, `phone`, `id_number`, `birthdate`, `genre`, `email`, `password`, `status`, `agent`, `point`, `token`, `expired`) VALUES
(1, 'johan', 'test', 'test', 'test', '1234', '1234', '1988-02-01 00:00:00', 'male', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 'approved', 2, 67, '', '0000-00-00 00:00:00'),
(3, 'johann', 'test1', 'test1', 'test1', '1234', '12345', '1988-02-01 00:00:00', 'male', 'test1@test.com', '5a105e8b9d40e1329780d62ea2265d8a', 'approved', 3, 0, '', '0000-00-00 00:00:00'),
(4, 'test3', 'test3', 'test3', 'test3', '1234567', '1234567', '1988-02-01 00:00:00', 'male', 'test3@test3.com', '8ad8757baa8564dc136c1e07507f4a98', 'deleted', 3, 70, '', '0000-00-00 00:00:00'),
(5, 'johan.kristian', 'Johan', 'test', 'Jakarta', '12345678', '12345678', '1989-05-01 00:00:00', 'male', 'johan.kristian@coderscolony.com', '7fedcb034ecf9df4be8c1ea13362053b', 'approved', 2, 8, '5-Zrgf8yfk53QqIdwqSYyhLfF8BqgZiMu94Qd1E9', '2014-12-08 14:07:15');

-- --------------------------------------------------------

--
-- Structure for view `ajax_get_approved_user`
--
DROP TABLE IF EXISTS `ajax_get_approved_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ajax_get_approved_user` AS select `a`.`id` AS `id`,`a`.`mg_user_id` AS `mg_user_id`,`a`.`name` AS `name`,`a`.`address` AS `address`,`a`.`city` AS `city`,`a`.`phone` AS `phone`,`a`.`id_number` AS `id_number`,`a`.`birthdate` AS `birthdate`,`a`.`genre` AS `genre`,`a`.`email` AS `email`,`a`.`password` AS `password`,`a`.`status` AS `status`,`a`.`agent` AS `agent`,`a`.`point` AS `point`,`b`.`name` AS `agentname` from (`user_table` `a` join `agent_table` `b` on((`a`.`agent` = `b`.`id`))) where (`a`.`status` = 'approved');

-- --------------------------------------------------------

--
-- Structure for view `ajax_get_gift_request`
--
DROP TABLE IF EXISTS `ajax_get_gift_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ajax_get_gift_request` AS select `request_gift_table`.`id` AS `id`,`request_gift_table`.`user_id` AS `user_id`,`request_gift_table`.`gift_id` AS `gift_id`,`request_gift_table`.`status` AS `status`,`user_table`.`name` AS `username`,`gift_table`.`name` AS `giftname` from ((`request_gift_table` join `user_table` on((`user_table`.`id` = `request_gift_table`.`user_id`))) join `gift_table` on((`gift_table`.`id` = `request_gift_table`.`gift_id`))) where (`request_gift_table`.`status` = 'pending');

-- --------------------------------------------------------

--
-- Structure for view `ajax_get_not_approved_change_agent`
--
DROP TABLE IF EXISTS `ajax_get_not_approved_change_agent`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ajax_get_not_approved_change_agent` AS select `a`.`id` AS `id`,`a`.`user_id` AS `user_id`,`a`.`old_agent` AS `old_agent`,`a`.`new_agent` AS `new_agent`,`a`.`old_mguserid` AS `old_mguserid`,`a`.`new_mguserid` AS `new_mguserid`,`a`.`date_request` AS `date_request`,`a`.`status` AS `status`,`a`.`date_updated` AS `date_updated`,`b`.`name` AS `name`,`c`.`name` AS `oldagentname`,`d`.`name` AS `newagentname` from (((`change_agent_table` `a` join `user_table` `b` on((`a`.`user_id` = `b`.`id`))) join `agent_table` `c` on((`a`.`old_agent` = `c`.`id`))) join `agent_table` `d` on((`a`.`new_agent` = `d`.`id`))) where (`a`.`status` = 'pending');

-- --------------------------------------------------------

--
-- Structure for view `ajax_get_not_approved_user`
--
DROP TABLE IF EXISTS `ajax_get_not_approved_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ajax_get_not_approved_user` AS select `a`.`id` AS `id`,`a`.`mg_user_id` AS `mg_user_id`,`a`.`name` AS `name`,`a`.`address` AS `address`,`a`.`city` AS `city`,`a`.`phone` AS `phone`,`a`.`id_number` AS `id_number`,`a`.`birthdate` AS `birthdate`,`a`.`genre` AS `genre`,`a`.`email` AS `email`,`a`.`password` AS `password`,`a`.`status` AS `status`,`a`.`agent` AS `agent`,`a`.`point` AS `point`,`b`.`name` AS `agentname` from (`user_table` `a` join `agent_table` `b` on((`a`.`agent` = `b`.`id`))) where (`a`.`status` = 'pending');

-- --------------------------------------------------------

--
-- Structure for view `ajax_get_pending_gift`
--
DROP TABLE IF EXISTS `ajax_get_pending_gift`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ajax_get_pending_gift` AS select `request_gift_table`.`id` AS `id`,`request_gift_table`.`user_id` AS `user_id`,`request_gift_table`.`gift_id` AS `gift_id`,`request_gift_table`.`status` AS `status`,`gift_table`.`filename` AS `gift`,`gift_table`.`name` AS `gift_name` from (`request_gift_table` join `gift_table` on((`request_gift_table`.`gift_id` = `gift_table`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `ajax_get_transaction`
--
DROP TABLE IF EXISTS `ajax_get_transaction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ajax_get_transaction` AS select `transaction_table`.`id` AS `id`,`transaction_table`.`hotel` AS `hotel`,`transaction_table`.`room` AS `room`,`transaction_table`.`night` AS `night`,`user_table`.`name` AS `name` from (`transaction_table` join `user_table` on((`user_table`.`id` = `transaction_table`.`user_id`)));

-- --------------------------------------------------------

--
-- Structure for view `ajax_get_user_transaction`
--
DROP TABLE IF EXISTS `ajax_get_user_transaction`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ajax_get_user_transaction` AS select `transaction_table`.`id` AS `id`,`transaction_table`.`user_id` AS `user_id`,`transaction_table`.`hotel` AS `hotel`,`transaction_table`.`room` AS `room`,`transaction_table`.`night` AS `night`,`transaction_table`.`fromdate` AS `fromdate`,`transaction_table`.`todate` AS `todate`,`user_table`.`name` AS `name` from (`transaction_table` join `user_table` on((`user_table`.`id` = `transaction_table`.`user_id`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `agent_table`
--
ALTER TABLE `agent_table`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `change_agent_table`
--
ALTER TABLE `change_agent_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gift_table`
--
ALTER TABLE `gift_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_table`
--
ALTER TABLE `main_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_gift_table`
--
ALTER TABLE `request_gift_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_table`
--
ALTER TABLE `transaction_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `mg_user_id` (`mg_user_id`,`agent`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `agent_table`
--
ALTER TABLE `agent_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `change_agent_table`
--
ALTER TABLE `change_agent_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `gift_table`
--
ALTER TABLE `gift_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `main_table`
--
ALTER TABLE `main_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `request_gift_table`
--
ALTER TABLE `request_gift_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `transaction_table`
--
ALTER TABLE `transaction_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
