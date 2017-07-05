-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2017 at 11:59 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `role` enum('Editor','Writer','Marketing Specialist','Trackimo Customer Support','Social Media Specialist','Multimedia Specialist','Data Processor','SEO Specialist/Internet Marketing','Wordpress Developer','Content Marketing Assistant','On-the-job Trainee') NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `email`, `fname`, `lname`, `role`, `job_title`, `pass`) VALUES
(1, 'neil.llenes@gmail.com', 'Neil Patrick', 'Llenes', 'On-the-job Trainee', 'Developer for Automated Data System Inputs', 'kittens');

-- --------------------------------------------------------

--
-- Table structure for table `content_marketing_assistant`
--

CREATE TABLE `content_marketing_assistant` (
  `content_marketing_assistant_id` int(11) NOT NULL,
  `curated_cnt` int(11) DEFAULT NULL,
  `drafted_cnt` int(11) DEFAULT NULL,
  `pictures_cnt` int(11) DEFAULT NULL,
  `videos_cnt` int(11) DEFAULT NULL,
  `misc_cnt` int(11) DEFAULT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_processor_tracker`
--

CREATE TABLE `data_processor_tracker` (
  `data_processor_id` int(11) NOT NULL,
  `daily_task` text NOT NULL,
  `task_status` varchar(50) NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `editor_tracker`
--

CREATE TABLE `editor_tracker` (
  `editor_id` int(11) NOT NULL,
  `writer_id` int(11) DEFAULT NULL,
  `word_cnt` int(11) NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_tracker`
--

CREATE TABLE `marketing_tracker` (
  `marketing_id` int(11) NOT NULL,
  `daily_task` text NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `multimedia_tracker`
--

CREATE TABLE `multimedia_tracker` (
  `multimedia_id` int(11) NOT NULL,
  `featured_image_cnt` int(11) NOT NULL,
  `graphic_designing_cnt` int(11) NOT NULL,
  `banner_cnt` int(11) NOT NULL,
  `misc_cnt` int(11) NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ojt_developer_system`
--

CREATE TABLE `ojt_developer_system` (
  `ojt_developer_system_id` int(11) NOT NULL,
  `create_website` text,
  `organize` text,
  `misc` text,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ojt_researcher`
--

CREATE TABLE `ojt_researcher` (
  `ojt_researcher_id` int(11) NOT NULL,
  `niche` text,
  `num_companies` text,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ojt_seo`
--

CREATE TABLE `ojt_seo` (
  `ojt_seo_id` int(11) NOT NULL,
  `comment` text,
  `site_audit` text,
  `schema_markup` text,
  `competitor_backlink_analysis` text,
  `relationship_link_research` text,
  `misc` text,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ojt_webdev`
--

CREATE TABLE `ojt_webdev` (
  `ojt_webdev_id` int(11) NOT NULL,
  `fix_bugs_cnt` int(11) DEFAULT NULL,
  `responsive_cnt` int(11) DEFAULT NULL,
  `backup_cnt` int(11) DEFAULT NULL,
  `optimize_cnt` int(11) DEFAULT NULL,
  `misc_cnt` int(11) DEFAULT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seo_specialist`
--

CREATE TABLE `seo_specialist` (
  `seospecialist_id` int(11) NOT NULL,
  `daily_task` text NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social_media_tracker`
--

CREATE TABLE `social_media_tracker` (
  `social_media_id` int(11) NOT NULL,
  `fb_balay_cnt` int(11) NOT NULL,
  `printerest_balay_cnt` int(11) NOT NULL,
  `mb_cnt` int(11) NOT NULL,
  `taft_cnt` int(11) NOT NULL,
  `wa_cnt` int(11) NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trackimo_cs_tracker`
--

CREATE TABLE `trackimo_cs_tracker` (
  `trackimo_cs_id` int(11) NOT NULL,
  `daily_task` text NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wordpress_developer`
--

CREATE TABLE `wordpress_developer` (
  `wordpress_developer_id` int(11) NOT NULL,
  `fix_bug_cnt` int(11) DEFAULT NULL,
  `create_pages_cnt` int(11) DEFAULT NULL,
  `responsive_design_cnt` int(11) DEFAULT NULL,
  `modify_pages_cnt` int(11) DEFAULT NULL,
  `misc_cnt` int(11) DEFAULT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `writer_tracker`
--

CREATE TABLE `writer_tracker` (
  `writer_id` int(11) NOT NULL,
  `article_title` varchar(50) NOT NULL,
  `word_cnt` int(11) NOT NULL,
  `track_date` date NOT NULL,
  `entry_time` datetime NOT NULL,
  `account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writer_tracker`
--

INSERT INTO `writer_tracker` (`writer_id`, `article_title`, `word_cnt`, `track_date`, `entry_time`, `account_id`) VALUES
(1, 'HEY', 100, '2017-06-28', '0000-00-00 00:00:00', 1),
(2, 'task', 123, '0000-00-00', '0000-00-00 00:00:00', 1),
(3, 'task', 100, '0000-00-00', '0000-00-00 00:00:00', 1),
(4, 'task 2', 50, '0000-00-00', '0000-00-00 00:00:00', 1),
(5, 'lkfwejf', 123, '0000-00-00', '0000-00-00 00:00:00', 1),
(6, 'fwekljf', 321, '0000-00-00', '0000-00-00 00:00:00', 1),
(9, 'test 1', 123, '0000-00-00', '0000-00-00 00:00:00', 1),
(10, 'test 2', 45, '0000-00-00', '0000-00-00 00:00:00', 1),
(11, 'NEWEST', 101, '0000-00-00', '0000-00-00 00:00:00', 1),
(12, 'test new', 500, '0000-00-00', '0000-00-00 00:00:00', 1),
(13, 'article alec', 400, '0000-00-00', '0000-00-00 00:00:00', 1),
(14, 'Test the new DATE and DATETIME', 2, '2017-06-30', '2017-06-30 15:45:30', 1),
(15, 'Huzzah it works', 50, '2017-06-30', '2017-06-30 15:47:14', 1),
(16, 'AngularJS is cool', 30, '2017-06-30', '2017-06-30 15:47:38', 1),
(17, 'AngularJS changed my life', 720, '2017-06-30', '2017-06-30 15:47:38', 1),
(19, 'today', 321, '2017-07-03', '2017-07-03 14:12:28', 1),
(20, 'Try adding 1', 250, '2017-07-03', '2017-07-03 14:20:52', 1),
(21, 'Try adding 2', 175, '2017-07-03', '2017-07-03 14:20:52', 1),
(26, 'Yayyy it works', 131, '2017-07-03', '2017-07-03 14:30:44', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `content_marketing_assistant`
--
ALTER TABLE `content_marketing_assistant`
  ADD PRIMARY KEY (`content_marketing_assistant_id`),
  ADD KEY `content_marketing_assistant_fk` (`account_id`);

--
-- Indexes for table `data_processor_tracker`
--
ALTER TABLE `data_processor_tracker`
  ADD PRIMARY KEY (`data_processor_id`),
  ADD KEY `data_processor_fk` (`account_id`);

--
-- Indexes for table `editor_tracker`
--
ALTER TABLE `editor_tracker`
  ADD PRIMARY KEY (`editor_id`),
  ADD KEY `editor_tracker_fk1` (`writer_id`),
  ADD KEY `writer_tracker_fk2` (`account_id`);

--
-- Indexes for table `marketing_tracker`
--
ALTER TABLE `marketing_tracker`
  ADD PRIMARY KEY (`marketing_id`),
  ADD KEY `marketing_tracker_fk` (`account_id`);

--
-- Indexes for table `multimedia_tracker`
--
ALTER TABLE `multimedia_tracker`
  ADD PRIMARY KEY (`multimedia_id`),
  ADD KEY `multimedia_tracker_fk` (`account_id`);

--
-- Indexes for table `ojt_developer_system`
--
ALTER TABLE `ojt_developer_system`
  ADD PRIMARY KEY (`ojt_developer_system_id`),
  ADD KEY `ojt_developer_system_fk` (`account_id`);

--
-- Indexes for table `ojt_researcher`
--
ALTER TABLE `ojt_researcher`
  ADD PRIMARY KEY (`ojt_researcher_id`),
  ADD KEY `ojt_researcher_fk` (`account_id`);

--
-- Indexes for table `ojt_seo`
--
ALTER TABLE `ojt_seo`
  ADD PRIMARY KEY (`ojt_seo_id`),
  ADD KEY `ojt_seo_fk` (`account_id`);

--
-- Indexes for table `ojt_webdev`
--
ALTER TABLE `ojt_webdev`
  ADD PRIMARY KEY (`ojt_webdev_id`),
  ADD KEY `ojt_webdev_fk` (`account_id`);

--
-- Indexes for table `seo_specialist`
--
ALTER TABLE `seo_specialist`
  ADD PRIMARY KEY (`seospecialist_id`),
  ADD KEY `seo_fk` (`account_id`);

--
-- Indexes for table `social_media_tracker`
--
ALTER TABLE `social_media_tracker`
  ADD PRIMARY KEY (`social_media_id`),
  ADD KEY `social_media_tracker_fk` (`account_id`);

--
-- Indexes for table `trackimo_cs_tracker`
--
ALTER TABLE `trackimo_cs_tracker`
  ADD PRIMARY KEY (`trackimo_cs_id`),
  ADD KEY `trackimo_cs_tracker_fk` (`account_id`);

--
-- Indexes for table `wordpress_developer`
--
ALTER TABLE `wordpress_developer`
  ADD PRIMARY KEY (`wordpress_developer_id`),
  ADD KEY `wordpress_developer_fk` (`account_id`);

--
-- Indexes for table `writer_tracker`
--
ALTER TABLE `writer_tracker`
  ADD PRIMARY KEY (`writer_id`),
  ADD KEY `writer_tracker_fk` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `content_marketing_assistant`
--
ALTER TABLE `content_marketing_assistant`
  MODIFY `content_marketing_assistant_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_processor_tracker`
--
ALTER TABLE `data_processor_tracker`
  MODIFY `data_processor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `editor_tracker`
--
ALTER TABLE `editor_tracker`
  MODIFY `editor_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marketing_tracker`
--
ALTER TABLE `marketing_tracker`
  MODIFY `marketing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `multimedia_tracker`
--
ALTER TABLE `multimedia_tracker`
  MODIFY `multimedia_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ojt_developer_system`
--
ALTER TABLE `ojt_developer_system`
  MODIFY `ojt_developer_system_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ojt_researcher`
--
ALTER TABLE `ojt_researcher`
  MODIFY `ojt_researcher_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ojt_seo`
--
ALTER TABLE `ojt_seo`
  MODIFY `ojt_seo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ojt_webdev`
--
ALTER TABLE `ojt_webdev`
  MODIFY `ojt_webdev_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seo_specialist`
--
ALTER TABLE `seo_specialist`
  MODIFY `seospecialist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_media_tracker`
--
ALTER TABLE `social_media_tracker`
  MODIFY `social_media_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trackimo_cs_tracker`
--
ALTER TABLE `trackimo_cs_tracker`
  MODIFY `trackimo_cs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wordpress_developer`
--
ALTER TABLE `wordpress_developer`
  MODIFY `wordpress_developer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `writer_tracker`
--
ALTER TABLE `writer_tracker`
  MODIFY `writer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `content_marketing_assistant`
--
ALTER TABLE `content_marketing_assistant`
  ADD CONSTRAINT `content_marketing_assistant_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `data_processor_tracker`
--
ALTER TABLE `data_processor_tracker`
  ADD CONSTRAINT `data_processor_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `editor_tracker`
--
ALTER TABLE `editor_tracker`
  ADD CONSTRAINT `editor_tracker_fk1` FOREIGN KEY (`writer_id`) REFERENCES `writer_tracker` (`writer_id`),
  ADD CONSTRAINT `writer_tracker_fk2` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `marketing_tracker`
--
ALTER TABLE `marketing_tracker`
  ADD CONSTRAINT `marketing_tracker_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `multimedia_tracker`
--
ALTER TABLE `multimedia_tracker`
  ADD CONSTRAINT `multimedia_tracker_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `ojt_developer_system`
--
ALTER TABLE `ojt_developer_system`
  ADD CONSTRAINT `ojt_developer_system_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `ojt_researcher`
--
ALTER TABLE `ojt_researcher`
  ADD CONSTRAINT `ojt_researcher_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `ojt_seo`
--
ALTER TABLE `ojt_seo`
  ADD CONSTRAINT `ojt_seo_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `ojt_webdev`
--
ALTER TABLE `ojt_webdev`
  ADD CONSTRAINT `ojt_webdev_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `seo_specialist`
--
ALTER TABLE `seo_specialist`
  ADD CONSTRAINT `seo_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `social_media_tracker`
--
ALTER TABLE `social_media_tracker`
  ADD CONSTRAINT `social_media_tracker_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `trackimo_cs_tracker`
--
ALTER TABLE `trackimo_cs_tracker`
  ADD CONSTRAINT `trackimo_cs_tracker_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `wordpress_developer`
--
ALTER TABLE `wordpress_developer`
  ADD CONSTRAINT `wordpress_developer_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

--
-- Constraints for table `writer_tracker`
--
ALTER TABLE `writer_tracker`
  ADD CONSTRAINT `writer_tracker_fk` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
