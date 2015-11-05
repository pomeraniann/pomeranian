-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 11 月 05 日 05:58
-- サーバのバージョン： 5.5.42-log
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartboardDB`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gametitle`
--

CREATE TABLE `gametitle` (
  `game_id` int(4) NOT NULL,
  `game_name` varchar(30) NOT NULL,
  `game_info` varchar(200) DEFAULT NULL,
  `game_img` mediumblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `groups`
--

CREATE TABLE `groups` (
  `gorup_id` int(4) NOT NULL,
  `game_id` int(4) NOT NULL,
  `group_name` varchar(30) NOT NULL,
  `group_info` varchar(200) DEFAULT NULL,
  `group_img` mediumblob,
  `user_num` int(4) NOT NULL,
  `invitation_url` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `jenre`
--

CREATE TABLE `jenre` (
  `jenre_id` int(4) NOT NULL,
  `jenre_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `member`
--

CREATE TABLE `member` (
  `group_id` int(4) NOT NULL,
  `twitter_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `posting`
--

CREATE TABLE `posting` (
  `game_id` int(4) NOT NULL,
  `group_id` int(4) NOT NULL,
  `twitter_id` int(4) NOT NULL,
  `posting_id` int(4) NOT NULL,
  `posting_time` datetime NOT NULL,
  `posting_content` varchar(140) NOT NULL,
  `posting_img` mediumblob,
  `twitter_img` mediumblob,
  `identifier_id` int(4) NOT NULL COMMENT '親識別ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `twitter_id` int(15) NOT NULL COMMENT 'twitterの方から取得',
  `twitter_name` varchar(30) NOT NULL COMMENT 'twitterの方から取得',
  `twitter_img` mediumblob COMMENT 'twitterの方から取得',
  `user_info` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gametitle`
--
ALTER TABLE `gametitle`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gorup_id`,`game_id`);

--
-- Indexes for table `jenre`
--
ALTER TABLE `jenre`
  ADD PRIMARY KEY (`jenre_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`group_id`,`twitter_id`);

--
-- Indexes for table `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`game_id`,`posting_id`,`group_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`twitter_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gametitle`
--
ALTER TABLE `gametitle`
  MODIFY `game_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gorup_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jenre`
--
ALTER TABLE `jenre`
  MODIFY `jenre_id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `twitter_id` int(15) NOT NULL AUTO_INCREMENT COMMENT 'twitterの方から取得';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
