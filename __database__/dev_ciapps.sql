-- phpMyAdmin SQL Dump
-- version 3.4.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2012 at 02:37 AM
-- Server version: 5.5.19
-- PHP Version: 5.3.8-ZS5.5.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dev_ciapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `notebook_categories`
--

CREATE TABLE IF NOT EXISTS `notebook_categories` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_title` varchar(100) NOT NULL,
  `c_desc` text NOT NULL,
  `uid` int(100) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `notebook_categories`
--

INSERT INTO `notebook_categories` (`c_id`, `c_title`, `c_desc`, `uid`) VALUES
(2, 'Note', 'This is General notes', 7),
(3, 'General Notes', 'This is General Notes..', 7),
(4, 'Programming', 'Notes about Programming...', 7),
(5, 'Lyrics', 'This category contain Lyrics', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notebook_data`
--

CREATE TABLE IF NOT EXISTS `notebook_data` (
  `n_id` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `c_id` int(50) NOT NULL,
  `note_title` text NOT NULL,
  `note_body` text NOT NULL,
  `date_create` varchar(100) NOT NULL,
  `status` tinyint(10) NOT NULL,
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `notebook_data`
--

INSERT INTO `notebook_data` (`n_id`, `uid`, `c_id`, `note_title`, `note_body`, `date_create`, `status`) VALUES
(1, 7, 3, 'Note', '<p>\n	aa</p>\n', '', 2),
(4, 7, 3, 'Something', '<p>\n	hey hey</p>\n', '1305796534', 1),
(5, 7, 4, 'Programming is easy', '<p>\n	Ofcoz... programmin is just a simple job. :P</p>\n', '1305978989', 2),
(6, 7, 5, 'Born to lead', '<p>\n	With eyes closed tightly,<br />\n	I march so blindly.<br />\n	Pretending everything&#39;s fine,<br />\n	&#39;Cause you&#39;re there to keep me in line.<br />\n	I don&#39;t want your guidance,<br />\n	I&#39;ll break my silence.<br />\n	So sick of asking and being denied and now I realise.<br />\n	<br />\n	We&#39;re holding the key, to unlock our destiny,<br />\n	We were Born To Lead.<br />\n	We&#39;re finally free, no longer following,<br />\n	We were Born To Lead... we were Born To Lead.<br />\n	<br />\n	You can&#39;t ignore me (you can&#39;t ingnore me)<br />\n	You cant think for me (you can&#39;t think for me)<br />\n	Your world will come crashing down to the ground,<br />\n	&#39;Cause I figured you out.<br />\n	<br />\n	<span style="color: rgb(255, 255, 255);"> <span style="background-color: rgb(255, 0, 0);"> We&#39;re holding the key, to unlock our destiny,</span><br />\n	<span style="background-color: rgb(255, 0, 0);"> We were Born To Lead.</span><br />\n	<span style="background-color: rgb(255, 0, 0);"> We&#39;re finally free, no longer following,</span><br />\n	<span style="background-color: rgb(255, 0, 0);"> We were Born To Lead... we were Born To Lead.</span></span><br />\n	<br />\n	I use to think I&#39;m ALL alone,<br />\n	But now I see our numbers grow.<br />\n	I&#39;m not afraid to break away,<br />\n	Think on my own<br />\n	<br />\n	With eyes wide open,<br />\n	My new life begins.<br />\n	Without you there to tell me, when, where and how,<br />\n	And you can&#39;t stop me now!<br />\n	<br />\n	We&#39;re holding the key, to unlock our destiny,<br />\n	We were Born To Lead.<br />\n	We&#39;re finally free, no longer following,<br />\n	We were Born To Lead... we were Born To Lead.<br />\n	<br />\n	We&#39;re holding the key, to unlock our destiny,<br />\n	We were Born To Lead<br />\n	We&#39;re finally free, no longer following,<br />\n	We were Born To Lead.</p>\n', '1306055384', 2),
(7, 7, 4, 'CodeIgniter', '<p>\n	CodeIgniter is an Application Development Framework - a toolkit - for people who build web sites using PHP. Its goal is to enable you to develop projects much faster than you could if you were writing code from scratch, by providing a rich set of libraries for commonly needed tasks, as well as a simple interface and logical structure to access these libraries. CodeIgniter lets you creatively focus on your project by minimizing the amount of code needed for a given task..</p>\n', '1306055518', 2),
(8, 7, 4, 'Extending CodeIgniter Helpers', '<p>\n	As of CodeIgniter 1.6.0 (not out as of this writing unless you <a href="http://www.derekallard.com/blog/post/checking-codeigniter-out-of-the-subversion-repository/">use the svn repository</a>), you&rsquo;ll be able to &ldquo;extend&rdquo; CodeIgniter helpers.&nbsp; This is a huge convenience if you just need a small change, or a single additional function, but don&rsquo;t want to make an entire duplicate copy of the helper.</p>\n<p>\n	For example, I often find myself needing a &ldquo;mysqldatetime_to_timestamp()&rdquo; function in there.&nbsp; Previously, <a href="http://www.derekallard.com/blog/post/giving-your-helpers-a-little-help/">it would mean making an entire duplicate helper in application/helpers</a>, but now, adding an additional function is as easy as creating an application/MY_date_helper.php page, and just adding in a single function.</p>\n', '1306148813', 1),
(9, 7, 5, 'Born to lead', '<p>\n	With eyes closed tightly,<br />\n	I march so blindly.<br />\n	Pretending everything&#39;s fine,<br />\n	&#39;Cause you&#39;re there to keep me in line.<br />\n	I don&#39;t want your guidance,<br />\n	I&#39;ll break my silence.<br />\n	So sick of asking and being denied and now I realise.<br />\n	<br />\n	We&#39;re holding the key, to unlock our destiny,<br />\n	We were Born To Lead.<br />\n	We&#39;re finally free, no longer following,<br />\n	We were Born To Lead... we were Born To Lead.<br />\n	<br />\n	You can&#39;t ignore me (you can&#39;t ingnore me)<br />\n	You cant think for me (you can&#39;t think for me)<br />\n	Your world will come crashing down to the ground,<br />\n	&#39;Cause I figured you out.<br />\n	<br />\n	<span style="color: rgb(255, 255, 255);"> <span style="background-color: rgb(255, 0, 0);"> We&#39;re holding the key, to unlock our destiny,</span><br />\n	<span style="background-color: rgb(255, 0, 0);"> We were Born To Lead.</span><br />\n	<span style="background-color: rgb(255, 0, 0);"> We&#39;re finally free, no longer following,</span><br />\n	<span style="background-color: rgb(255, 0, 0);"> We were Born To Lead... we were Born To Lead.</span></span><br />\n	<br />\n	I use to think I&#39;m ALL alone,<br />\n	But now I see our numbers grow.<br />\n	I&#39;m not afraid to break away,<br />\n	Think on my own<br />\n	<br />\n	With eyes wide open,<br />\n	My new life begins.<br />\n	Without you there to tell me, when, where and how,<br />\n	And you can&#39;t stop me now!<br />\n	<br />\n	We&#39;re holding the key, to unlock our destiny,<br />\n	We were Born To Lead.<br />\n	We&#39;re finally free, no longer following,<br />\n	We were Born To Lead... we were Born To Lead.<br />\n	<br />\n	We&#39;re holding the key, to unlock our destiny,<br />\n	We were Born To Lead<br />\n	We&#39;re finally free, no longer following,<br />\n	We were Born To Lead.</p>\n', '1306384004', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(25) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `join_time` int(100) NOT NULL,
  `time_zone` varchar(5) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `fullname`, `join_time`, `time_zone`) VALUES
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'yemaw.online@gmail.com', 'Ye Maw', 1305469864, 'UP65'),
(8, 'yemaw', '21232f297a57a5a743894a0e4a801fc3', 'yemaw.online@gmail.com', 'Ye Maw', 1305863435, 'UP65');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
