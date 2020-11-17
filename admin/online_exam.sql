-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 05:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam`
--
CREATE DATABASE IF NOT EXISTS `online_exam` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `online_exam`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@localhost.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `exam_title` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_title`, `date`) VALUES
(1, 'PHP Test', '2020-11-01 22:23:52'),
(5, 'Javascript Test', '2020-11-01 22:33:12'),
(6, 'HTML Test', '2020-11-01 22:53:19'),
(7, 'CSS', '2020-11-16 14:35:52'),
(8, 'JAVASCRIPT', '2020-11-16 18:22:09'),
(9, 'java', '2020-11-16 19:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ques_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(2000) NOT NULL,
  `option2` varchar(2000) NOT NULL,
  `option3` varchar(2000) NOT NULL,
  `option4` varchar(2000) NOT NULL,
  `answer` varchar(2000) NOT NULL,
  `exam_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ques_id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_no`) VALUES
(25, 'What does PHP stand for?', 'Private Home Page', 'Personal Hypertext Processor', 'Hypertext Preprocessor', 'Personal Hypertext Preprocessor', '2', 1),
(26, 'PHP server scripts are surrounded by delimiters, which?', '&lt;?php&gt;...&lt;/?&gt;', '&lt;&amp;&gt;...&lt;/&amp;&gt;', '&lt;script&gt;...&lt;/script&gt;', '&lt;?php...?&gt;', '3', 1),
(27, 'How do you write &quot;Hello World&quot; in PHP', 'echo &quot;Hello World&quot;; ', 'Document.Write(&quot;Hello World&quot;);', '&quot;Hello World&quot;;', 'print &quot;Hello World&quot;;', '0', 1),
(28, 'What is the correct way to end a PHP statement?', ';', 'New line', '&lt;/php&gt;', '.', '0', 1),
(29, 'What is the correct way to open the file &quot;time.txt&quot; as readable?', 'fopen(&quot;time.txt&quot;,&quot;r&quot;);', 'fopen(&quot;time.txt&quot;,&quot;r+&quot;);', 'open(&quot;time.txt&quot;,&quot;read&quot;);', 'open(&quot;time.txt&quot;);', '0', 1),
(30, 'What is the correct way to add 1 to the $count variable?', '$count++;', '++count', '$count =+1', 'count++;', '0', 1),
(31, 'What is a correct way to add a comment in PHP?', '/*...*/', '*...*', '&lt;comment&gt;...&lt;/comment&gt;', '&lt;!--...--&gt;', '0', 1),
(32, 'Which superglobal variable holds information about headers, paths, and script locations?', '$_SERVER', '$_GET', '$_SESSION', '$GLOBALS', '0', 1),
(33, 'Which one of these variables has an illegal name?', '$my-Var', '$my_Var', '$myVar', '$_myVar', '0', 1),
(34, 'What is the correct way to include the file &quot;time.inc&quot; ?', '&lt;?php include &quot;time.inc&quot;; ?&gt;', '&lt;!-- include file=&quot;time.inc&quot; --&gt;', '&lt;?php include:&quot;time.inc&quot;; ?&gt;', '&lt;?php include file=&quot;time.inc&quot;; ?&gt;', '0', 1),
(51, 'Inside which HTML element do we put the JavaScript?', '&lt;javascript&gt;', '&lt;script&gt;', '&lt;scripting&gt;', '&lt;js&gt;', '1', 5),
(52, 'What is the correct JavaScript syntax to change the content of the HTML element?', 'document.getElementById(&quot;demo&quot;).innerHTML = &quot;Hello World!&quot;;', 'document.getElement(&quot;p&quot;).innerHTML = &quot;Hello World!&quot;;', 'document.getElementByName(&quot;p&quot;).innerHTML = &quot;Hello World!&quot;;', '#demo.innerHTML = &quot;Hello World!&quot;;', '0', 5),
(53, 'How do you write &quot;Hello World&quot; in an alert box?', 'alert(&quot;Hello World&quot;);', 'msgBox(&quot;Hello World&quot;);', 'alertBox(&quot;Hello World&quot;);', 'msg(&quot;Hello World&quot;);', '0', 5),
(54, 'How to write an IF statement for executing some code if &quot;i&quot; is NOT equal to 5?', 'if (i != 5)', 'if i &lt;&gt; 5', 'if i =! 5 then', 'if (i &lt;&gt; 5)', '0', 5),
(55, 'What is the correct way to write a JavaScript array?', 'var colors = &quot;red&quot;, &quot;green&quot;, &quot;blue&quot;', 'var colors = [&quot;red&quot;, &quot;green&quot;, &quot;blue&quot;]', 'var colors = 1 = (&quot;red&quot;), 2 = (&quot;green&quot;), 3 = (&quot;blue&quot;)', 'var colors = (1:&quot;red&quot;, 2:&quot;green&quot;, 3:&quot;blue&quot;)', '1', 5),
(56, 'How do you declare a JavaScript variable?', 'var carName;', 'variable carName;', 'v carName;', '$ carName;', '0', 5),
(57, 'Which event occurs when the user clicks on an HTML element?', 'onclick', 'onmouseover', 'onmouseclick', 'onchange', '0', 5),
(58, 'How do you round the number 7.25, to the nearest integer?', 'Math.rnd(7.25)', 'Math.round(7.25) ', 'rnd(7.25)', 'round(7.25', '1', 5),
(59, 'How do you create a function in JavaScript?', 'function = myFunction()', 'function:myFunction()', 'function myFunction()', 'myFunction()', '2', 5),
(60, 'What is the correct syntax for referring to an external script called &quot;xxx.js&quot;?', '&lt;script href=&quot;xxx.js&quot;&gt;', '&lt;script name=&quot;xxx.js&quot;&gt;', '&lt;script src=&quot;xxx.js&quot;&gt;', '&lt;link href=&quot;xxx.js&quot;&gt;', '2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `name`, `status`) VALUES
(1, 'Enable/disable button for question in test', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `gender`, `mobile_no`, `address`, `image`) VALUES
(1, 'Shobha Patwal', 'shobha@gmail.com', 'shobha', 'Female', '123456789', 'lucknow', 'floral.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_result`
--

CREATE TABLE `user_exam_result` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `marks` varchar(20) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_exam_result`
--

INSERT INTO `user_exam_result` (`result_id`, `user_id`, `exam_id`, `marks`, `date`) VALUES
(1, 1, 1, '1,8,2,0', '2020-11-02 21:23:57'),
(11, 1, 5, '5,5,5,0', '2020-11-16 19:28:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ques_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_exam_result`
--
ALTER TABLE `user_exam_result`
  ADD PRIMARY KEY (`result_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ques_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_exam_result`
--
ALTER TABLE `user_exam_result`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
