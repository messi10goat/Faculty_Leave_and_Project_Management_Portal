-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 03:16 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbms10`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `act_on_fellow` (IN `req_id` INT, IN `actioner_id` INT, IN `reason1` TEXT, IN `yes_no` INT)  NO SQL
BEGIN 

DECLARE a INT DEFAULT 3;
DECLARE c INT DEFAULT 0;
DECLARE b INT DEFAULT 0;
DECLARE d INT DEFAULT 0;
DECLARE bb DATE;
DECLARE cc DATE;

SELECT status1 INTO a from expenditures WHERE id = req_id;
SELECT project_id INTO b from expenditures WHERE id = req_id;
SELECT amount INTO c from expenditures WHERE id = req_id;

IF(yes_no=1 and a =1) THEN
UPDATE expenditures SET status1 = 3, reason = reason1 WHERE id = req_id;
INSERT INTO papertraile (expenditures_id, action_time, status_id, action_by_id, comment_given) VALUES (a, NOW(), 3, actioner_id, reason1);

ELSEIF(yes_no=0 and a =1) THEN
UPDATE expenditures SET status1 = -3, reason = reason1 WHERE id = req_id;
INSERT INTO papertraile (expenditures_id, action_time, status_id, action_by_id, comment_given) VALUES (a, NOW(), -3, actioner_id, reason1);

ELSEIF(yes_no=1 and a =3) THEN
UPDATE expenditures SET status1 = 4, reason = reason1 WHERE id = req_id;
INSERT INTO papertraile (expenditures_id, action_time, status_id, action_by_id, comment_given) VALUES (a, NOW(), 4, actioner_id, reason1);
 UPDATE project SET budget_remaining = budget_remaining -c  WHERE id = b;

ELSEIF(yes_no=0 and a =3) THEN
UPDATE expenditures SET status1 = -4, reason = reason1 WHERE id = req_id;
INSERT INTO papertraile (expenditures_id, action_time, status_id, action_by_id, comment_given) VALUES (a, NOW(), -4, actioner_id, reason1);

END IF;


end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `act_on_leave` (IN `req_id` INT, IN `yes_no` INT, IN `actioner_id` INT, IN `coom` TEXT)  NO SQL
BEGIN 

DECLARE a INT DEFAULT 0;
DECLARE c INT DEFAULT 0;
DECLARE b INT DEFAULT 0;
DECLARE d INT DEFAULT 0;
DECLARE bb DATE;
DECLARE cc DATE;

SELECT status_id INTO a FROM leaves WHERE id = req_id;

IF(yes_no=1) THEN
	SELECT status_id INTO b FROM leaves WHERE id = req_id;
    IF(a=0) THEN UPDATE leaves SET status_id = 1 WHERE id = req_id;
    ELSEIF(a=1) THEN UPDATE leaves SET status_id = 2 WHERE id = req_id;
    ELSEIF(a=3 OR a=4) THEN UPDATE leaves SET status_id = 5 WHERE id = req_id;
    ELSEIF(a=6) THEN UPDATE leaves SET status_id = 7 WHERE id = req_id;
    ELSEIF(a=7) THEN UPDATE leaves SET status_id = 8 WHERE id = req_id;
    ELSEIF(a=8 OR a=9 OR a=10) THEN UPDATE leaves SET status_id = 5 WHERE id = req_id;
    END IF;
ELSE
	SELECT status_id INTO b FROM leaves WHERE id = req_id;
	IF(a=0) THEN UPDATE leaves SET status_id = -1 WHERE id = req_id;
    ELSEIF(a=1) THEN UPDATE leaves SET status_id = -2 WHERE id = req_id;
    ELSEIF(a=3 OR a=4) THEN UPDATE leaves SET status_id = -5 WHERE id = req_id;
    ELSEIF(a=6) THEN UPDATE leaves SET status_id = -1 WHERE id = req_id;
    ELSEIF(a=7) THEN UPDATE leaves SET status_id = -2 WHERE id = req_id;
    ELSEIF(a=8 OR a=9 OR a=10) THEN UPDATE leaves SET status_id = -5 WHERE id = req_id;
    END IF;
END IF;

IF(a=0 or a=6) THEN UPDATE leaves SET hod_comment = coom WHERE id = req_id;
ELSEIF(a=1 || a=7) THEN UPDATE leaves SET dean_comment = coom WHERE id = req_id;
ELSEIF(a=3 OR a=4 or a=8 or a=9 or a=10) THEN UPDATE leaves SET director_comment = coom WHERE id = req_id;
        
END IF;

SELECT status_id INTO a FROM leaves WHERE id = req_id;
INSERT INTO papertrail1 (action_by_id,action_time,comment_given, leave_id, status_id) VALUES (actioner_id, NOW(),coom, req_id,a);


SELECT from_day INTO bb FROM leaves WHERE id = req_id;
SELECT to_day INTO cc FROM leaves WHERE id = req_id;

SELECT status_id INTO a FROM leaves WHERE id = req_id;
SELECT faculty_id INTO d FROM leaves WHERE id = req_id;


if(a=2 OR a=5) THEN 
UPDATE faculty SET faculty.leaves_remaining = faculty.leaves_remaining - (1+DATEDIFF(cc,bb)) WHERE faculty.id=d;
END IF;


end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_fellow` (IN `req_id` INT, IN `total_cost` INT, IN `aaction_by_id` INT, IN `reason1` TEXT)  NO SQL
BEGIN 

DECLARE a INT DEFAULT 3;
DECLARE c INT DEFAULT 0;
DECLARE b INT DEFAULT 0;
DECLARE d INT DEFAULT 0;
DECLARE bb DATE;
DECLARE cc DATE;

SELECT min(position_id) INTO a FROM personell_project WHERE  project_id = req_id AND faculty_id = aaction_by_id;



IF(a=3 OR a=2) THEN
INSERT INTO expenditures (project_id, amount, doa, faculty_id, reason, status1) VALUES (req_id, total_cost, NOW(), aaction_by_id, reason1, 1);

SELECT max(id) INTO b FROM expenditures;

INSERT INTO papertraile (expenditures_id, action_time, status_id, action_by_id, comment_given) VALUES (b, NOW(), 1,aaction_by_id, reason1 );

ELSE

INSERT INTO expenditures (project_id, amount, doa, faculty_id, reason, status1) VALUES (req_id, total_cost, NOW(), aaction_by_id, reason1, 3);

SELECT max(id) INTO b FROM expenditures;

INSERT INTO papertraile (expenditures_id, action_time, status_id, action_by_id, comment_given) VALUES (b, NOW(), 3,aaction_by_id, reason1 );

END IF;

SELECT budget_remaining INTO c from project WHERE id = req_id;
SELECT max(id) INTO b FROM expenditures;
if(total_cost>c) THEN

UPDATE expenditures SET status1 =-5, reason='Insufficient fund remaining'  WHERE id = b;

INSERT INTO papertraile (expenditures_id, action_time, status_id, action_by_id, comment_given) VALUES (b, NOW(), -5,-1, 'Insufficient fund remaining' );

END IF;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_pi` (IN `pi_position` INT, IN `req_id` INT, IN `req_project_id` INT)  NO SQL
BEGIN
DECLARE a INT DEFAULT 0;
DECLARE b INT DEFAULT 0;
DECLARE c INT DEFAULT 0;


INSERT INTO personell_project (project_id, faculty_id, position_id, doa) VALUES (req_project_id, req_id, pi_position, NOW());


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `apply_leave` (IN `req_id` INT, IN `Start_date` DATE, IN `number_of_days` INT, IN `coom` TEXT)  NO SQL
BEGIN
DECLARE a INT DEFAULT 0;
DECLARE b INT DEFAULT 0;
DECLARE c INT DEFAULT 0;
SELECT position INTO a from faculty WHERE faculty.id=req_id;
SELECT leaves_remaining INTO b from faculty WHERE faculty.id=req_id;

IF (a=1) then SET @a=3;
ELSEIF (a=2) then SET @a=4;
end if;

IF (curdate()>start_date) THEN
	SELECT leaves_remaining INTO b from faculty WHERE faculty.id=req_id;
	IF(a=0) THEN SET @a=6;
    elseIF(a=3) THEN SET @a=9;
    elseIF(a=4) then SET @a=10;
    end if; 
END IF;

INSERT INTO leaves (faculty_id, from_day, to_day, status_id, applied_time, faculty_comment, HOD_comment, dean_comment, director_comment, system_comment) VALUES ( req_id, Start_date, DATE_ADD(Start_date, INTERVAL number_of_days-1 DAY),  a, NOW(), coom, 'NA', 'NA', 'NA', 'NA');



SELECT max(id) INTO c FROM leaves;

INSERT INTO papertrail1 (leave_id, action_time, status_id, action_by_id, comment_given) VALUES (c, NOW(), a, req_id, coom);

if(b<number_of_days) THEN
UPDATE leaves SET status_id = -6 WHERE id = c;
UPDATE leaves SET system_comment = 'Applied leaves are more than the remaining leaves' WHERE id = c;

INSERT INTO papertrail1 (leave_id, action_time, status_id, action_by_id, comment_given) VALUES (c, NOW(), -6, req_id,'Applied leaves are more than the remaining leaves' );

END IF;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `apply_project` (IN `project_name` TEXT, IN `total_budget` INT, IN `funding_agency` TEXT, IN `duration` INT, IN `req_id` INT, IN `jrf_pay` INT, IN `srf_pay` INT)  NO SQL
BEGIN
DECLARE a INT DEFAULT 0;
DECLARE b INT DEFAULT 0;
DECLARE c INT DEFAULT 0;


INSERT INTO project (name, budget, action_time, agency, duration_in_months, budget_remaining, action_by_id,jrf_salary, srf_salary) VALUES (project_name, total_budget, NOW(), funding_agency, duration, total_budget, req_id, jrf_pay, srf_pay);


SELECT max(id) INTO a FROM project;

INSERT INTO personell_project (project_id, faculty_id, position_id, doa) VALUES (a, req_id, 1, NOW());


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_dean` (IN `req_id` INT, IN `exec_id` INT, IN `dept1` INT)  BEGIN 

DECLARE a INT DEFAULT 0;
SELECT id INTO a FROM deans WHERE deans.post = dept1;
UPDATE faculty SET faculty.position = 0 WHERE faculty.id=a; 
UPDATE faculty SET faculty.position = 2 WHERE faculty.id = req_id; 
UPDATE deans SET deans.id = req_id WHERE deans.post = dept1; 
UPDATE deans SET deans.doa = NOW() WHERE deans.post = dept1; 
INSERT INTO papertrail2 (action_time, appointed_by_id, appointed_till_date, faculty_id, new_position_id) VALUES(NOW(), exec_id ,DATE_ADD(CURDATE(), INTERVAL 365 DAY), req_id, 2); 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_director` (IN `req_id` INT)  BEGIN
	DECLARE totalOrder INT DEFAULT 0;
    UPDATE faculty SET faculty.position = 0 WHERE faculty.position=3;
    UPDATE faculty SET faculty.position = 3 WHERE faculty.id = req_id;
    UPDATE director SET director.id = req_id;
    UPDATE director SET director.doa = NOW();
    INSERT INTO papertrail2 (action_time, appointed_by_id, appointed_till_date, faculty_id, new_position_id) VALUES(NOW(), -1,NOW(), req_id, 3); 
    
    SELECT totalOrder;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_hod` (IN `req_id` INT(2), IN `exec_id` INT(1))  BEGIN 

DECLARE a INT DEFAULT 0;
DECLARE dept1 VARCHAR(3);
SELECT dept into dept1 FROM faculty WHERE faculty.id=req_id; 

UPDATE faculty SET position = 0 WHERE position=1 and dept = dept1; 
UPDATE faculty SET position = 1 WHERE id = req_id; 
UPDATE hod SET id = req_id WHERE dept = dept1; 
UPDATE hod SET doa = NOW() WHERE dept = dept1; 
INSERT INTO papertrail2 (action_time, appointed_by_id, appointed_till_date, faculty_id, new_position_id) VALUES(NOW(), exec_id ,DATE_ADD(CURDATE(),INTERVAL 365 DAY), req_id, 1); 
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `deans`
--

CREATE TABLE `deans` (
  `id` int(11) NOT NULL,
  `doa` datetime DEFAULT NULL,
  `post` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deans`
--

INSERT INTO `deans` (`id`, `doa`, `post`) VALUES
(9, '2021-04-20 21:58:13', 2),
(14, '2021-04-22 16:13:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `doa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`id`, `doa`) VALUES
(1, '2021-04-20 16:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `doa` datetime DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `project_id`, `amount`, `doa`, `faculty_id`, `reason`, `status1`) VALUES
(5, 1, 70000, '2021-04-21 23:29:09', 7, '\'hehe\'', 4),
(6, 4, 250000, '2021-04-22 11:16:00', 13, 'abcd', 3),
(7, 4, 360000, '2021-04-22 11:18:01', 18, 'vfggesv', 4),
(8, 4, 200000, '2021-04-22 11:30:44', 18, 'trwtgrg', -3),
(10, 5, 200000, '2021-04-22 16:47:44', 12, 'vfggesv', -4),
(11, 5, 200000, '2021-04-22 17:21:34', 10, 'allowed', 3),
(13, 5, 2100000, '2021-04-22 17:36:38', 12, 'Insufficient fund remaining', -5);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `dept` varchar(3) DEFAULT 'CSE',
  `position` int(11) DEFAULT 0,
  `leaves_remaining` int(11) DEFAULT 18,
  `doa` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `dept`, `position`, `leaves_remaining`, `doa`) VALUES
(1, 'Rajeev Ahuja', 'MEB', 3, 18, '2021-04-20 11:57:42'),
(2, 'person one', 'CSE', 0, 3, '2021-04-20 16:27:13'),
(3, 'Person two', 'EEB', 0, 18, '2021-04-20 16:27:13'),
(4, 'Person Three', 'MEB', 0, 18, '2021-04-20 16:28:50'),
(5, 'Person Four', 'EEB', 1, 18, '2021-04-20 16:29:51'),
(6, 'Person Five', 'CSE', 1, 18, '2021-04-20 16:29:51'),
(7, 'Normal 1', 'MEB', 0, 18, '2021-04-20 16:35:21'),
(8, 'Jasnoor Singh', 'EEB', 0, 18, '2021-04-20 21:52:33'),
(9, 'Aman Saraf', 'MEB', 2, 18, '2021-04-20 21:52:23'),
(10, 'Harsh Mittal', 'EEB', 0, 18, '2021-04-22 10:20:16'),
(11, 'Rohit Sharma', 'MEB', 0, 18, '2021-04-22 10:20:54'),
(12, 'Pradeep Verma', 'CSE', 0, 18, '2021-04-22 10:21:36'),
(13, 'Tom Holland', 'MEB', 0, 18, '2021-04-22 10:23:28'),
(14, 'Tom Cruise', 'CSE', 2, 18, '2021-04-22 10:23:28'),
(15, 'Jason Momoa', 'EEB', 0, 18, '2021-04-22 10:23:28'),
(16, 'Jennifer Lawerence', 'MEB', 1, 18, '2021-04-22 10:23:28'),
(17, 'Camila Cabello', 'CSE', 0, 18, '2021-04-22 10:23:28'),
(18, 'William Shakespeare', 'EEB', 0, 18, '2021-04-22 10:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `id` int(11) NOT NULL,
  `dept` varchar(3) DEFAULT 'CSE',
  `doa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`id`, `dept`, `doa`) VALUES
(5, 'EEB', '2021-04-20 22:04:32'),
(6, 'CSE', '2021-04-20 22:47:56'),
(16, 'MEB', '2021-04-22 10:43:41');

-- --------------------------------------------------------

--
-- Table structure for table `jrf_srf`
--

CREATE TABLE `jrf_srf` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `doa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `from_day` date DEFAULT NULL,
  `to_day` date DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `applied_time` datetime DEFAULT NULL,
  `faculty_comment` text DEFAULT 'NA',
  `HOD_comment` text DEFAULT 'NA',
  `dean_comment` text DEFAULT 'NA',
  `director_comment` text DEFAULT 'NA',
  `system_comment` text DEFAULT 'NA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `faculty_id`, `from_day`, `to_day`, `status_id`, `applied_time`, `faculty_comment`, `HOD_comment`, `dean_comment`, `director_comment`, `system_comment`) VALUES
(5, 8, '2021-04-24', '2021-04-26', 1, '2021-04-22 00:25:46', 'Please jaane do', 'dekh lo bhai', 'NA', 'NA', 'NA'),
(8, 2, '2021-04-24', '2021-04-26', 2, '2021-04-22 10:15:43', 'Please jaane do1', 'dekh lo bhai1', 'okay', 'NA', 'NA'),
(9, 17, '2021-04-27', '2021-05-02', -1, '2021-04-22 10:25:02', 'mujhe ghar jaana hai', 'permission granted', 'NA', 'NA', 'NA'),
(10, 15, '2021-04-27', '2021-04-28', 0, '2021-04-22 12:38:02', 'sgfggsfg', 'NA', 'NA', 'NA', 'NA'),
(11, 0, '0000-00-00', NULL, 0, '2021-04-22 15:03:05', '', 'NA', 'NA', 'NA', 'NA'),
(12, 0, '0000-00-00', NULL, 0, '2021-04-22 15:03:07', '', 'NA', 'NA', 'NA', 'NA'),
(13, 0, '0000-00-00', NULL, 0, '2021-04-22 15:03:47', '', 'NA', 'NA', 'NA', 'NA'),
(14, 0, '2021-04-27', '2021-04-29', -6, '2021-04-22 15:04:53', 'adsadad', 'NA', 'NA', 'NA', 'Applied leaves are more than the remaining leaves'),
(15, 0, '2021-04-26', '2021-04-27', -6, '2021-04-22 15:09:18', 'sadsda', 'NA', 'NA', 'NA', 'Applied leaves are more than the remaining leaves'),
(16, 12, '2021-04-29', '2021-04-30', 0, '2021-04-22 15:12:20', 'sadsda', 'NA', 'NA', 'NA', 'NA');

-- --------------------------------------------------------

--
-- Table structure for table `papertrail1`
--

CREATE TABLE `papertrail1` (
  `id` int(11) NOT NULL,
  `leave_id` int(11) DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `action_by_id` int(11) DEFAULT NULL,
  `comment_given` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `papertrail1`
--

INSERT INTO `papertrail1` (`id`, `leave_id`, `action_time`, `status_id`, `action_by_id`, `comment_given`) VALUES
(10, 5, '2021-04-22 00:25:46', 0, 8, 'Please jaane do'),
(11, 6, '2021-04-22 00:26:30', 0, 8, 'Please jaane do'),
(12, 7, '2021-04-22 00:26:45', 0, 8, 'Please jaane do'),
(13, 5, '2021-04-22 01:13:53', 1, 5, 'dekh lo bhai'),
(14, 8, '2021-04-22 10:15:43', 0, 2, 'Please jaane do1'),
(15, 8, '2021-04-22 10:17:32', 1, 6, 'dekh lo bhai1'),
(16, 9, '2021-04-22 10:25:02', 0, 17, 'mujhe ghar jaana hai'),
(17, 9, '2021-04-22 10:26:07', -1, 1, 'permission granted'),
(18, 8, '2021-04-22 10:28:57', 2, 3, 'okay'),
(19, 10, '2021-04-22 12:38:02', 0, 15, 'sgfggsfg'),
(20, 11, '2021-04-22 15:03:05', 0, 0, ''),
(21, 12, '2021-04-22 15:03:07', 0, 0, ''),
(22, 13, '2021-04-22 15:03:47', 0, 0, ''),
(23, 14, '2021-04-22 15:04:53', 0, 0, 'adsadad'),
(24, 14, '2021-04-22 15:04:53', -6, 0, 'Applied leaves are more than the remaining leaves'),
(25, 15, '2021-04-22 15:09:18', 0, 0, 'sadsda'),
(26, 15, '2021-04-22 15:09:18', -6, 0, 'Applied leaves are more than the remaining leaves'),
(27, 16, '2021-04-22 15:12:20', 0, 12, 'sadsda');

-- --------------------------------------------------------

--
-- Table structure for table `papertrail2`
--

CREATE TABLE `papertrail2` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `new_position_id` int(11) DEFAULT NULL,
  `appointed_by_id` int(11) DEFAULT NULL,
  `appointed_till_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `papertrail2`
--

INSERT INTO `papertrail2` (`id`, `faculty_id`, `action_time`, `new_position_id`, `appointed_by_id`, `appointed_till_date`) VALUES
(1, 7, '2021-04-20 16:51:12', 1, 1, '2021-04-20'),
(2, 9, '2021-04-20 21:57:43', 2, 1, '2021-04-20'),
(3, 9, '2021-04-20 21:58:13', 2, 1, '2021-04-20'),
(4, 3, '2021-04-20 22:03:14', 2, 1, '2021-04-20'),
(5, 5, '2021-04-20 22:04:32', 1, 1, '2021-04-20'),
(6, 4, '2021-04-20 22:07:23', 1, 1, '2021-04-20'),
(7, 2, '2021-04-20 22:46:50', 1, 1, '2021-04-20'),
(8, 6, '2021-04-20 22:47:56', 1, 1, '2021-04-20'),
(9, 7, '2021-04-22 01:28:40', 1, 1, '2021-04-22'),
(10, 7, '2021-04-22 01:28:45', 1, 1, '2021-04-22'),
(11, 4, '2021-04-22 10:37:45', 2, 1, '2021-04-22'),
(12, 13, '2021-04-22 10:39:07', 1, 1, '2021-04-22'),
(13, 16, '2021-04-22 10:43:41', 1, 1, '2022-04-22'),
(14, 17, '2021-04-22 10:46:47', 2, 1, '2022-04-22'),
(15, 14, '2021-04-22 16:13:50', 2, 1, '2022-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `papertraile`
--

CREATE TABLE `papertraile` (
  `id` int(11) NOT NULL,
  `expenditures_id` int(11) DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `action_by_id` int(11) DEFAULT NULL,
  `comment_given` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `papertraile`
--

INSERT INTO `papertraile` (`id`, `expenditures_id`, `action_time`, `status_id`, `action_by_id`, `comment_given`) VALUES
(5, 5, '2021-04-21 23:29:09', 3, 7, '\'trying\''),
(6, 3, '2021-04-21 23:30:24', 4, 9, '\'hehe\''),
(7, 3, '2021-04-21 23:32:26', 4, 9, '\'hehe\''),
(8, 6, '2021-04-22 11:16:00', 3, 13, 'abcd'),
(9, 7, '2021-04-22 11:18:01', 1, 18, 'vfggesv'),
(10, 1, '2021-04-22 11:27:49', 3, 13, 'he is fine'),
(11, 8, '2021-04-22 11:30:44', 1, 18, 'dfabdhdjfa'),
(12, 1, '2021-04-22 11:31:09', -3, 13, 'trwtgrg'),
(13, 9, '2021-04-22 16:46:18', 3, 0, 'asdsad'),
(14, 10, '2021-04-22 16:47:44', 3, 12, 'fdsgsfgfg'),
(15, 11, '2021-04-22 17:21:34', 1, 10, 'fsfsdfdsfegqew'),
(16, 1, '2021-04-22 17:22:24', 3, 12, 'allowed'),
(17, 12, '2021-04-22 17:23:55', 3, 12, 'lnknlk'),
(18, 13, '2021-04-22 17:36:38', 3, 12, 'fdsfaf'),
(19, 13, '2021-04-22 17:36:38', -5, -1, 'Insufficient fund remaining'),
(20, 3, '2021-04-22 17:58:28', 4, 9, 'vfggesv'),
(21, 3, '2021-04-22 17:59:36', -4, 9, 'vfggesv');

-- --------------------------------------------------------

--
-- Table structure for table `personell_project`
--

CREATE TABLE `personell_project` (
  `project_id` int(11) DEFAULT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `doa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personell_project`
--

INSERT INTO `personell_project` (`project_id`, `faculty_id`, `position_id`, `doa`) VALUES
(1, 7, 1, '2021-04-21 16:40:07'),
(2, 8, 1, '2021-04-22 01:42:30'),
(3, 8, 1, '2021-04-22 01:45:34'),
(4, 13, 1, '2021-04-22 10:48:54'),
(4, 18, 2, '2021-04-22 10:56:14'),
(5, 12, 1, '2021-04-22 16:26:51'),
(5, 17, 2, '2021-04-22 17:08:42'),
(5, 10, 3, '2021-04-22 17:20:41');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL DEFAULT 0,
  `name` text NOT NULL DEFAULT '\'Faculty\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`) VALUES
(0, '\'Faculty\''),
(1, '\'HoD\''),
(2, '\'Dean\''),
(3, '\'Director\''),
(4, '\'SRF\''),
(5, '\'JRF\'');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `action_time` datetime DEFAULT NULL,
  `agency` text DEFAULT NULL,
  `Duration_in_months` int(11) DEFAULT NULL,
  `budget_remaining` int(11) DEFAULT NULL,
  `action_by_id` int(11) DEFAULT NULL,
  `jrf_salary` int(11) NOT NULL DEFAULT 31000,
  `srf_salary` int(11) NOT NULL DEFAULT 40000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `budget`, `action_time`, `agency`, `Duration_in_months`, `budget_remaining`, `action_by_id`, `jrf_salary`, `srf_salary`) VALUES
(1, 'Checking for covid', 10000000, '2021-04-21 16:40:07', 'MHRD', 6, 9930000, 7, 35000, 45000),
(3, 'Tappu Sena', 100, '2021-04-22 01:45:34', 'Gada Electronics', 10, 100, 8, 2, 3),
(4, 'Tappu Sena1', 1000000, '2021-04-22 10:48:54', 'Gada Electronics1', 20, 640000, 13, 50000, 60000),
(5, 'dsa', 100000, '2021-04-22 16:26:51', 'drdo', 10, 100000, 12, 50000, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `status1`
--

CREATE TABLE `status1` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status1`
--

INSERT INTO `status1` (`id`, `name`) VALUES
(-6, 'System rejected Leave application'),
(-5, 'Directer approved the Leave application'),
(-2, 'Dean FA rejected Leave Application from Faculty'),
(-1, 'HOD rejected Leave Application from Faculty'),
(0, 'Normal Leave Application from Faculty'),
(1, 'HOD approved Leave Application from Faculty'),
(2, 'Dean Faculty Affairs approved Leave Application from Faculty'),
(3, 'Normal Leave Application from HoD'),
(4, 'Normal Leave Application from Dean'),
(5, 'Directer approved the Leave application'),
(6, 'Retrospective Leave application from Faculty'),
(7, 'HOD approved Leave Application from Faculty'),
(8, 'Dean approved Leave Application from Faculty'),
(9, 'Retrospective Leave application from HoD'),
(10, 'Retrospective Leave application from Dean');

-- --------------------------------------------------------

--
-- Table structure for table `status2`
--

CREATE TABLE `status2` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status2`
--

INSERT INTO `status2` (`id`, `name`) VALUES
(1, 'Filed by PI'),
(3, 'Approved by head PI'),
(-3, 'Rejected by head PI'),
(4, 'Approved by Dean Sponsored Projects'),
(-4, 'Rejected by Dean Sponsored Projects'),
(-5, 'Rejected by system');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deans`
--
ALTER TABLE `deans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jrf_srf`
--
ALTER TABLE `jrf_srf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papertrail1`
--
ALTER TABLE `papertrail1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papertrail2`
--
ALTER TABLE `papertrail2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `papertraile`
--
ALTER TABLE `papertraile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status1`
--
ALTER TABLE `status1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jrf_srf`
--
ALTER TABLE `jrf_srf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `papertrail1`
--
ALTER TABLE `papertrail1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `papertrail2`
--
ALTER TABLE `papertrail2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `papertraile`
--
ALTER TABLE `papertraile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
