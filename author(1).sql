-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 09:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `author`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `first_img` varchar(255) NOT NULL,
  `second_img` varchar(255) NOT NULL,
  `about_me` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`first_name`, `second_name`, `first_img`, `second_img`, `about_me`, `id`) VALUES
('محمود محمد', 'التركستاني', 'عالي١.jpg', 'صورة ٢.jpg', 'المھندس محمود اختیر كواحد من افضل &#34; 100 قائد للفكر جدیرة بالثقة في أوروبا والشرق الأوسط بالمنظمة الدولیة (الثقة عبر أمریكا) في عام 2011 . أیضا، وقد حصل على &#34;جائزة القیادة في مجال المسؤولیة الاجتماعیة للشركات في منطقة الشرق الأوسط&#34; من المنظمة الآسیویة لاتحاد الشركات&#34;. في عام 2013 ، و تم اعتماده كعضو في لجنة المسؤولیة الاجتماعیة بالرئاسة العامة لرعایة الشباب من قبل الامیر عبدلله بن مساعد كما وعین عضوا بلجنة جائزة التنافسیة المسؤولة برئاسة وزیر العمل السعودي. \r\n\r\nحاصل على درجة &#34;الماجستیر التنفیذي في إدارة الأعمال&#34; من جامعة الملك عبد العزیز وعلى درجة البكالوریوس في &#34;ھندسة الكمبیوتر&#34; من جامعة الملك فھد للبترول والمعادن.\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `avilable_date`
--

CREATE TABLE `avilable_date` (
  `id` int(11) NOT NULL,
  `time_day` varchar(255) NOT NULL,
  `time_hour` varchar(255) NOT NULL,
  `serv_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avilable_date`
--

INSERT INTO `avilable_date` (`id`, `time_day`, `time_hour`, `serv_name`) VALUES
(11, '2021-04-03', '11:28', ''),
(12, '2021-04-09', '10:28', '');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `service_day` varchar(255) NOT NULL,
  `service_hour` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `service_title` varchar(255) NOT NULL,
  `around` varchar(255) NOT NULL,
  `useful` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `second_name`, `email`, `phone`, `service_day`, `service_hour`, `note`, `service_title`, `around`, `useful`) VALUES
(4, 'Ahmed', 'marouf', 'aalfoly18@gmail.com', '1099903814', '2021-03-17', '10:24 ', 'لم تتم اضافة ملاحظات', 'الخدمة الأولى', 'testing', 'اختبار الموقع'),
(6, 'محمود', 'محمد', 'm@m.mm', '0590987875', '2021-03-31', '22:05 ', 'محمز', 'الخدمة الأولى', 'لترشيح ', 'تالا'),
(7, 'khld', 'mohd', 'mm@mm.bb', '98989898', '2021-04-01', '21:10 ', 'khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk khjh khkhjkj', 'الخدمة الأولى', ' khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk  khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk  khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk khjh khkh', 'khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk '),
(10, 'Mahmoud', 'mohd', 'mykhalidmix@gmail.com', '9415386941', '2021-04-09', '22:19 ', 'لم تتم اضافة ملاحظات', 'الخدمة الأولى', ' khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk  khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk  khjh khkhjkjh lkh k  hkhkjhjhjhjh jhjhjhkhkhjh kjhkjhkhkhkjh khkhkhjhkjh kjhkjhk khjh khkh', '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `service_time` int(11) NOT NULL,
  `service_hidden` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `content`, `img`, `price`, `service_time`, `service_hidden`) VALUES
(1, 'الخدمة الأولى', 'هذه هي الخدمة الأولي تم عملها لأختبار الموقع ومراجعة التعديلات المطلوبة', 'pexels-oleg-magni-2058130 (1).jpg', 30, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `second_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `pass`, `email`, `phone`, `note`, `group_id`, `second_name`) VALUES
(1, '', '12345678', 'mahmoudmix.1397vfd9@admin.codze', '', '', 1, ''),
(10, 'Ahmed', '', 'aalfoly18@gmail.com', '1099903814', '', 0, 'marouf'),
(11, 'محمود', '', 'm@m.mm', '0590987875', '', 0, 'محمد'),
(12, 'محمود', '', 'm@m.mm', '0590987875', 'محمز', 0, 'محمد'),
(13, 'tester', 'pass', 'ate@gmail.com', '123', '', 0, 'as'),
(14, 'تجربة', 'paaaaaaa', 're@gmail.com', '', '', 0, '2'),
(15, 'Mahmoud', 'mmmmmm', 'mykhalidmix@gmail.com', '', '', 0, 'mohd'),
(16, 'ahmed', 'ew43', 'ad@gmail.com', '', '', 0, 'aadsf'),
(17, 'يسر', 'f', 'sd@d.cd', '', '', 0, 'سي'),
(18, 'were', 'wd', 'sd@dasf.ccds', '234', '', 0, 'ds');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avilable_date`
--
ALTER TABLE `avilable_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `avilable_date`
--
ALTER TABLE `avilable_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
