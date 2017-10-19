-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2017 at 11:53 AM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kapeeler_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_COUNT_EMAIL`(IN eml VARCHAR(50))
Select count(*) as c from tbl_users where email = eml$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_COUNT_USER`(IN eml VARCHAR(50), IN pwd VARCHAR(60))
Select count(*) as c from tbl_users where email = eml and password = pwd$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_CREATE_POST`(IN `post_title` VARCHAR(100), IN `post_content` TEXT, IN `post_status` TEXT, IN `post_created_time` TIMESTAMP, IN `post_updated_time` TIMESTAMP, IN `post_author_uid` INT(11), IN `post_category_id` INT(11))
    NO SQL
insert into tbl_posts values (null, post_title, post_content, post_status,post_created_time,post_updated_time,post_author_uid,post_category_id)$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_CREATE_POST_CATEGORY`(IN `cat_title` TEXT, IN `created_uid` INT(11), IN `cat_slug` CHAR(20))
insert into tbl_post_categories values (null, cat_title, created_uid, cat_slug)$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_DELETE_CATEGORY`(IN `catid` INT(11))
    NO SQL
DELETE FROM tbl_post_categories
WHERE post_category_id = catid$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_DELETE_POST`(IN `PID` INT(11))
    NO SQL
DELETE FROM tbl_posts
WHERE post_id = pid$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_FIND_ACTIVATION_CODE`(IN uid INT(11))
Select activation_code from tbl_users where user_id = uid$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_FIND_USER`(IN `uid` INT(100))
Select * from tbl_users where user_id = uid$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_FIND_USER_ID`(IN `eml` VARCHAR(100))
Select user_id from tbl_users where email = eml$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_GET_POSTS`()
    NO SQL
Select * from tbl_posts ORDER BY post_id DESC$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_GET_POST_CATEGORIES`()
Select * from tbl_post_categories$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_GET_POST_CATEGORY`(IN `cat_id` INT(11))
    NO SQL
Select * from tbl_post_categories where post_category_id=cat_id$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_REGISTER_USER`(IN eml           VARCHAR(100), IN pwd VARCHAR(100),
                                  IN fname       VARCHAR(100), IN lname VARCHAR(100), IN av_url VARCHAR(100),
                                  IN prof_desc    TEXT(65535), IN act_code VARCHAR(50))
insert into tbl_users values (NULL, eml, pwd, fname, lname, av_url, prof_desc, act_code, 0 , 0)$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_UPDATE_CATEGORY`(IN catid int(11), IN cat_title VARCHAR(60), IN create_uid int(11), IN cat_slug VARCHAR(20))
UPDATE tbl_post_categories SET title=cat_title, created_by=create_uid, slug=cat_slug WHERE post_category_id=catid$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_UPDATE_POST`(IN `pid` INT(11), IN `post_title` VARCHAR(100), IN `post_body` TEXT, IN `post_status` TEXT, IN `auid` INT(11), IN `pcid` INT(11))
    NO SQL
UPDATE tbl_posts SET title=post_title, content=post_body, status=post_status, author_user_id=auid, post_category_id=pcid WHERE post_id=pid$$

CREATE DEFINER=`kapeeler`@`localhost` PROCEDURE `SP_UPDATE_USER`(IN uid       INT(10), IN eml VARCHAR(100), IN pwd VARCHAR(100), IN fname VARCHAR(100),
                                IN lname     VARCHAR(100), IN av_url VARCHAR(100), IN prof_desc TEXT(65535),
                                IN activated BOOL, IN admin BOOL)
UPDATE tbl_users SET email=eml, password=pwd, first_name=fname, last_name=lname, avatar_url=av_url, profile_desc=prof_desc, is_activated=activated, is_admin=admin WHERE user_id=uid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE IF NOT EXISTS `tbl_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text,
  `status` text NOT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `author_user_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`post_id`, `title`, `content`, `status`, `created_time`, `updated_time`, `author_user_id`, `post_category_id`) VALUES
(5, 'Lorem Ipsum Long Post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a congue sem, eu ultricies libero. Integer nibh quam, viverra ut condimentum sed, condimentum vitae arcu. Praesent orci risus, bibendum id enim ut, accumsan dapibus tellus. Nulla ligula velit, vulputate ut ultricies et, posuere eget leo. Pellentesque orci quam, mollis ac suscipit ac, sagittis nec enim. Vestibulum lacinia, sem sed laoreet viverra, neque est tempor sapien, non fermentum ante erat a ligula. Ut vulputate enim dolor, sit amet ullamcorper odio laoreet eget. Integer bibendum sem ligula, id dictum velit feugiat et. Suspendisse vestibulum molestie viverra. Maecenas ornare diam et neque egestas, sodales rhoncus nisi elementum. Sed eget dui nec diam vehicula vehicula vel in ligula. Pellentesque ornare rutrum vehicula. Quisque varius mauris augue, a ornare urna dapibus quis.\r\n\r\nQuisque et sem eu lorem malesuada gravida vitae pulvinar quam. Mauris vehicula ipsum ante, sed tristique quam laoreet et. Sed dolor justo, tincidunt at vehicula vitae, vehicula vitae quam. Nullam ullamcorper facilisis arcu, eget euismod nisl ornare posuere. Vivamus quis diam sem. Integer sed mauris tempus metus vestibulum pulvinar. Vivamus posuere tempus lectus, nec gravida leo consectetur nec. Vestibulum nec pharetra lacus. Nam molestie erat sit amet elementum pretium. Sed eget viverra tortor. Nullam rutrum orci id sollicitudin interdum. Aenean elementum ipsum arcu, ut vehicula ex tempor vel. Nulla vitae risus pellentesque, ultrices tortor in, mattis purus. Aenean convallis justo sed libero lobortis volutpat. Vestibulum ultricies eget dolor a malesuada. Aenean dapibus orci eu hendrerit vestibulum.\r\n\r\nDuis rhoncus convallis eros, quis pretium nisl condimentum in. Nulla augue justo, dapibus ac laoreet ac, commodo faucibus tellus. Nulla facilisi. Pellentesque commodo eget sem non auctor. Nulla nec metus mattis, ultrices dui et, pulvinar erat. Mauris sagittis lectus quis convallis condimentum. Aenean ante arcu, scelerisque ut diam eu, dictum suscipit neque. Nullam rhoncus neque at aliquet egestas. Mauris ac aliquam nunc. Ut finibus elit a erat ullamcorper, porta consectetur leo rutrum. Suspendisse mattis felis maximus augue sodales, et fringilla nisi elementum. Maecenas sed arcu vitae lacus fermentum aliquam. Vivamus lacus arcu, rutrum vitae augue vehicula, fringilla mattis leo. Vestibulum vulputate sapien et bibendum fringilla. Duis tincidunt, elit at congue luctus, nulla libero laoreet justo, nec tristique erat elit sit amet nibh. Sed diam eros, pellentesque nec urna non, molestie consequat lectus.', 'published', NULL, NULL, 1014, 7),
(6, 'Test post', 'Here is some text. Blah blah blach.', 'published', NULL, NULL, 1014, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_post_categories` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `slug` varchar(20) NOT NULL,
  PRIMARY KEY (`post_category_id`),
  KEY `post_category_id` (`post_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_post_categories`
--

INSERT INTO `tbl_post_categories` (`post_category_id`, `title`, `created_by`, `slug`) VALUES
(2, 'Category 2', 1014, 'category-2'),
(5, 'Category 4', 0, 'category-4'),
(6, 'Test Category', 1014, 'test-category'),
(7, 'Lorem Ipsums', 1014, 'lorem-ipsums');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `avatar_url` varchar(100) NOT NULL,
  `profile_desc` text NOT NULL,
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1017 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `avatar_url`, `profile_desc`, `activation_code`, `is_activated`, `is_admin`) VALUES
(1014, 'kapeeler@iupui.edu', 'testpass', 'Kyle', 'Peeler', 'https://ui-avatars.com/api/?name=Kyle+Peeler&amp;rounded=true', 'The creator of this blog, student in CSCIN342 class.', 'ytJE7EdiwzqucYbej1ePmsNESec7v6s3AcIHQV0nuqRHp2WI4b', 1, 1),
(1016, 'testuser@test.com', 'testpass', 'Test', 'User', 'https://ui-avatars.com/api/?name=Test+User&rounded=true', 'Test Account Admin', 'CseGtAsnxnq9usAvs38AneKKofSoXQ3zihfMSIaq6AAA3a5vee', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
