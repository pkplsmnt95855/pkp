-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2015 at 02:18 PM
-- Server version: 5.5.34
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pakistanplacement`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `reset_key` varchar(255) NOT NULL,
  `status` enum('Inactive','Active','Blocked') NOT NULL,
  `role` enum('Candidate') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `email`, `password`, `firstname`, `lastname`, `activation_key`, `reset_key`, `status`, `role`) VALUES
(1, 'hammadhere5@gmail.com', '$2a$13$mhjso5qmPf2dUL862VBTyO16h6jsPpgk0gUTBJqboK8/v1.sQe/om', 'Hammad', 'Rasheed', 'CS9ZUrDnZJGbnzJahizGF3J9ezMqCT0RHtNULutbGtwjE0Cv3vDyb6TkB9nzv3giw_1StJmp_jQ1', '', 'Active', 'Candidate'),
(2, '', '', '', '', '', '', '', 'Candidate');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_resume`
--

CREATE TABLE IF NOT EXISTS `candidate_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `directory_name` varchar(255) NOT NULL,
  `date_uploaded` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_id` (`candidate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `candidate_resume`
--

INSERT INTO `candidate_resume` (`id`, `candidate_id`, `filename`, `directory_name`, `date_uploaded`) VALUES
(1, 1, '401-features.docx', '012015', '2015-02-01 00:12:59'),
(2, 1, '801-dandruff.pdf', '012015', '2015-02-01 00:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE IF NOT EXISTS `employer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation_key` varchar(255) NOT NULL,
  `reset_key` varchar(255) NOT NULL,
  `status` enum('Inactive','Active','Expired','Blocked') NOT NULL,
  `role` enum('Employer') NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_description` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `email`, `password`, `activation_key`, `reset_key`, `status`, `role`, `company_name`, `company_description`, `logo`) VALUES
(1, 'hammadhere5@gmail.com', '$2a$13$3RFXxLaON1V2hZU37XeDluw0sINeS0j7uzdX7K8nZxIPqo9A/qzyG', '938Zus0S16EA55VnJELYS67Ruil4Oy94H8bPcxpCTGLkwo1fcdA8gylflgPEniTTH3ThKuc_qFx1', '', 'Active', 'Employer', 'Nestle Pakistan', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `degree_title` varchar(255) NOT NULL,
  `career_level` varchar(255) NOT NULL,
  `minimum_salary` int(11) NOT NULL,
  `maximum_salary` int(11) DEFAULT NULL,
  `minimum_experience` int(11) DEFAULT NULL,
  `required_travel` enum('Not Required','25%','50%','75%','100%') NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `department` varchar(255) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `number_of_positions` int(11) NOT NULL,
  `job_type` enum('Permanent','Contractual') NOT NULL,
  `job_description` text NOT NULL,
  `status` enum('Inactive','Active','Expired','Deleted') NOT NULL,
  `posted_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `social` enum('Yes','No') NOT NULL DEFAULT 'No',
  `employer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_id` (`employer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `title`, `degree_title`, `career_level`, `minimum_salary`, `maximum_salary`, `minimum_experience`, `required_travel`, `age`, `gender`, `department`, `industry`, `number_of_positions`, `job_type`, `job_description`, `status`, `posted_date`, `expiry_date`, `social`, `employer_id`) VALUES
(5, 'Brand Manager', 'MBA', 'Officer', 25000, 40000, 2, '50%', 18, 'Female', 'Finance and Administration ', 'Automotive', 1, 'Permanent', 'Do some job', 'Active', '2015-01-31 20:43:58', '2015-02-25 23:53:00', 'No', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_application`
--

CREATE TABLE IF NOT EXISTS `job_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `date_applied` datetime NOT NULL,
  `status` enum('Applied','Viewed','Shortlisted','Rejected') NOT NULL,
  `cover_letter` text NOT NULL,
  `resume_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `candidate_id` (`candidate_id`),
  KEY `resume_id` (`resume_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `job_application`
--

INSERT INTO `job_application` (`id`, `job_id`, `candidate_id`, `date_applied`, `status`, `cover_letter`, `resume_id`) VALUES
(1, 5, 1, '2015-02-01 00:53:16', 'Applied', 'Hi there', 2),
(2, 5, 1, '2015-02-01 00:55:29', 'Applied', 'asdfasd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_location`
--

CREATE TABLE IF NOT EXISTS `job_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `job_location`
--

INSERT INTO `job_location` (`id`, `job_id`, `location_id`) VALUES
(16, 5, 1),
(17, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `job_skill`
--

CREATE TABLE IF NOT EXISTS `job_skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `skill_id` (`skill_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `job_skill`
--

INSERT INTO `job_skill` (`id`, `job_id`, `skill_id`) VALUES
(13, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=370 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `location`) VALUES
(1, 'Abbottabad'),
(2, 'Adezai'),
(3, 'Ahmed Nager Chatha'),
(4, 'Ahmedpur East'),
(5, 'Ali Bandar'),
(6, 'Ali Pur'),
(7, 'Amir Chah'),
(8, 'Arifwala'),
(9, 'Astor'),
(10, 'Attock'),
(11, 'Ayubia'),
(12, 'Baden'),
(13, 'Bagh'),
(14, 'Bahawalnagar'),
(15, 'Bahawalpur'),
(16, 'Bajaur'),
(17, 'Banda Daud Shah'),
(18, 'Bannu'),
(19, 'Baramula'),
(20, 'Basti Malook'),
(21, 'Batagram'),
(22, 'Bazdar'),
(23, 'Bela'),
(24, 'Bellpat'),
(25, 'Bhagalchur'),
(26, 'Bhaipheru'),
(27, 'Bhakkar'),
(28, 'Bhalwal'),
(29, 'Bhimber'),
(30, 'Birote'),
(31, 'Buner'),
(32, 'Burewala'),
(33, 'Burj'),
(34, 'Chachro'),
(35, 'Chagai'),
(36, 'Chah Sandan'),
(37, 'Chailianwala'),
(38, 'Chakdara'),
(39, 'Chakku'),
(40, 'Chakwal'),
(41, 'Chaman'),
(42, 'Charsadda'),
(43, 'Chhatr'),
(44, 'Chichawatni'),
(45, 'Chiniot'),
(46, 'Chitral'),
(47, 'Chowk Azam'),
(48, 'Chowk Sarwar Shaheed'),
(49, 'Dadu'),
(50, 'Dalbandin'),
(51, 'Dargai'),
(52, 'Darya Khan'),
(53, 'Daska'),
(54, 'Dera Bugti'),
(55, 'Dera Ghazi Khan'),
(56, 'Dera Ismail Khan'),
(57, 'Derawar Fort'),
(58, 'Dhana Sar'),
(59, 'Dhaular'),
(60, 'Digri'),
(61, 'Dina City'),
(62, 'Dinga'),
(63, 'Dipalpur'),
(64, 'Diplo'),
(65, 'Diwana'),
(66, 'Dokri'),
(67, 'Drasan'),
(68, 'Drosh'),
(69, 'Duki'),
(70, 'Dushi'),
(71, 'Duzab'),
(72, 'Faisalabad'),
(73, 'Fateh Jang'),
(74, 'Gadar'),
(75, 'Gadra'),
(76, 'Gajar'),
(77, 'Gandava'),
(78, 'Garhi Khairo'),
(79, 'Garruck'),
(80, 'Ghakhar Mandi'),
(81, 'Ghanian'),
(82, 'Ghauspur'),
(83, 'Ghazluna'),
(84, 'Ghotki'),
(85, 'Gilgit'),
(86, 'Girdan'),
(87, 'Gujar Khan'),
(88, 'Gujranwala'),
(89, 'Gujrat'),
(90, 'Gulistan'),
(91, 'Gwadar'),
(92, 'Gwash'),
(93, 'Hab Chauki'),
(94, 'Hafizabad'),
(95, 'Hala'),
(96, 'Hameedabad'),
(97, 'Hangu'),
(98, 'Haripur'),
(99, 'Harnai'),
(100, 'Haroonabad'),
(101, 'Hasilpur'),
(102, 'Haveli Lakha'),
(103, 'Hinglaj'),
(104, 'Hoshab'),
(105, 'Hunza'),
(106, 'Hyderabad'),
(107, 'Islamabad'),
(108, 'Islamkot'),
(109, 'Ispikan'),
(110, 'Jacobabad'),
(111, 'Jahania'),
(112, 'Jalla Araain'),
(113, 'Jamesabad'),
(114, 'Jampur'),
(115, 'Jamshoro'),
(116, 'Janghar'),
(117, 'Jati Mughalbhin '),
(118, 'Jauharabad'),
(119, 'Jhal'),
(120, 'Jhal Jhao'),
(121, 'Jhang'),
(122, 'Jhatpat'),
(123, 'Jhelum'),
(124, 'Jhudo'),
(125, 'Jiwani'),
(126, 'Jungshahi'),
(127, 'Kalabagh'),
(128, 'Kalam'),
(129, 'Kalandi'),
(130, 'Kalat'),
(131, 'Kamalia'),
(132, 'Kamararod'),
(133, 'Kamokey'),
(134, 'Kanak'),
(135, 'Kandi'),
(136, 'Kandiaro'),
(137, 'Kanpur'),
(138, 'Kapip'),
(139, 'Kappar'),
(140, 'Karachi'),
(141, 'Karak'),
(142, 'Karodi'),
(143, 'Karor Lal Esan'),
(144, 'Kashmor'),
(145, 'Kasur'),
(146, 'Katuri'),
(147, 'Keti Bandar'),
(148, 'Khairpur'),
(149, 'Khanaspur'),
(150, 'Khanewal'),
(151, 'Khanpur'),
(152, 'Kharan'),
(153, 'Kharian'),
(154, 'Khokhropur'),
(155, 'Khora'),
(156, 'khuiratta'),
(157, 'Khushab'),
(158, 'Khuzdar'),
(159, 'Khyber'),
(160, 'Kikki'),
(161, 'Klupro'),
(162, 'Kohan'),
(163, 'Kohat'),
(164, 'Kohistan'),
(165, 'Kohlu'),
(166, 'Korak'),
(167, 'Korangi'),
(168, 'Kot Addu'),
(169, 'Kot Sarae'),
(170, 'Kotli'),
(171, 'Kotri'),
(172, 'Kurram'),
(173, 'Laar'),
(174, 'Lahore'),
(175, 'Lahri'),
(176, 'Lakki Marwat'),
(177, 'Lalamusa'),
(178, 'Larkana'),
(179, 'Lasbela'),
(180, 'Latamber'),
(181, 'Layyah'),
(182, 'Liari'),
(183, 'Lodhran'),
(184, 'Loralai'),
(185, 'Lower Dir'),
(186, 'Lund'),
(187, 'Mach'),
(188, 'Madyan'),
(189, 'Mailsi'),
(190, 'Makhdoom Aali'),
(191, 'Malakand'),
(192, 'Mamoori'),
(193, 'Mand'),
(194, 'Mandi Bahauddin'),
(195, 'Mandi Warburton'),
(196, 'Mangla'),
(197, 'Manguchar'),
(198, 'Mansehra'),
(199, 'Mardan'),
(200, 'Mashki Chah'),
(201, 'Maslti'),
(202, 'Mastuj'),
(203, 'Mastung'),
(204, 'Mathi'),
(205, 'Matiari'),
(206, 'Mehar'),
(207, 'Mekhtar'),
(208, 'Merui'),
(209, 'Mian Channu'),
(210, 'Mianez'),
(211, 'Mianwali'),
(212, 'Minawala'),
(213, 'Miram Shah'),
(214, 'Mirpur'),
(215, 'Mirpur Batoro'),
(216, 'Mirpur Khas'),
(217, 'Mirpur Sakro'),
(218, 'Mithani'),
(219, 'Mithi'),
(220, 'Mohmand'),
(221, 'Mongora'),
(222, 'Moro'),
(223, 'Multan'),
(224, 'Murgha Kibzai'),
(225, 'Muridke'),
(226, 'Murree'),
(227, 'Musa Khel Bazar'),
(228, 'Muzaffarabad'),
(229, 'Muzaffargarh'),
(230, 'Nagar'),
(231, 'Nagar Parkar'),
(232, 'Nagha Kalat'),
(233, 'Nal'),
(234, 'Naokot'),
(235, 'Narowal'),
(236, 'Naseerabad'),
(237, 'Naudero'),
(238, 'Nauroz Kalat'),
(239, 'Naushara'),
(240, 'Nawabshah'),
(241, 'Nazimabad'),
(242, 'North Waziristan'),
(243, 'Noushero Feroz'),
(244, 'Nowshera'),
(245, 'Nur Gamma'),
(246, 'Nushki'),
(247, 'Nuttal'),
(248, 'NWFP'),
(249, 'Okara'),
(250, 'Ormara'),
(251, 'Paharpur'),
(252, 'Pak Pattan'),
(253, 'Palantuk'),
(254, 'Panjgur'),
(255, 'Pasni'),
(256, 'Pattoki'),
(257, 'Pendoo'),
(258, 'Peshawar'),
(259, 'Piharak'),
(260, 'Pirmahal'),
(261, 'pirMahal'),
(262, 'Pishin'),
(263, 'Plandri'),
(264, 'Pokran'),
(265, 'Punch'),
(266, 'Punjab'),
(267, 'Qambar'),
(268, 'Qamruddin Karez'),
(269, 'Qazi Ahmad'),
(270, 'Qila Abdullah'),
(271, 'Qila Didar Singh'),
(272, 'Qila Ladgasht'),
(273, 'Qila Safed'),
(274, 'Qila Saifullah'),
(275, 'Quetta'),
(276, 'Rabwah'),
(277, 'Rahim Yar Khan'),
(278, 'Raiwind'),
(279, 'Rajan Pur'),
(280, 'Rakhni'),
(281, 'Ranipur'),
(282, 'Ratodero'),
(283, 'Rawalakot'),
(284, 'Rawalpindi'),
(285, 'Renala Khurd'),
(286, 'Robat Thana'),
(287, 'Rodkhan'),
(288, 'Rohri'),
(289, 'Sadiqabad'),
(290, 'Safdar Abad – Dhaban Singh '),
(291, 'Sahiwal'),
(292, 'Saidu Sharif'),
(293, 'Saindak'),
(294, 'Sakesar'),
(295, 'Sakrand'),
(296, 'Samberial'),
(297, 'Sanghar'),
(298, 'Sangla Hill'),
(299, 'Sanjawi'),
(300, 'Sarai Alamgir'),
(301, 'Sargodha'),
(302, 'Saruna'),
(303, 'Shabaz Kalat'),
(304, 'Shadadkhot'),
(305, 'Shafqat Shaheed Chowk'),
(306, 'Shahbandar'),
(307, 'Shahdadpur'),
(308, 'Shahpur'),
(309, 'Shahpur Chakar'),
(310, 'Shakargarh'),
(311, 'Shandur'),
(312, 'Shangla'),
(313, 'Shangrila'),
(314, 'Sharam Jogizai'),
(315, 'Sheikhupura'),
(316, 'Shikarpur'),
(317, 'Shingar'),
(318, 'Shorap'),
(319, 'Sialkot'),
(320, 'Sibi'),
(321, 'Skardu'),
(322, 'Sohawa'),
(323, 'Sonmiani'),
(324, 'Sooianwala'),
(325, 'South Waziristan'),
(326, 'Spezand'),
(327, 'Spintangi'),
(328, 'Sui'),
(329, 'Sujawal'),
(330, 'Sukkur'),
(331, 'Sundar city '),
(332, 'Suntsar'),
(333, 'Surab'),
(334, 'Swabi'),
(335, 'Swat'),
(336, 'Takhtbai'),
(337, 'Talagang'),
(338, 'Tando Adam'),
(339, 'Tando Allahyar'),
(340, 'Tando Bago'),
(341, 'Tangi'),
(342, 'Tank'),
(343, 'Tar Ahamd Rind'),
(344, 'Tarbela'),
(345, 'Taxila'),
(346, 'Thall'),
(347, 'Thalo'),
(348, 'Thatta'),
(349, 'Toba Tek Singh'),
(350, 'Tordher'),
(351, 'Tujal'),
(352, 'Tump'),
(353, 'Turbat'),
(354, 'Umarao'),
(355, 'Umarkot'),
(356, 'Upper Dir'),
(357, 'Uthal'),
(358, 'Vehari'),
(359, 'Veirwaro'),
(360, 'Vitakri'),
(361, 'Wadh'),
(362, 'Wah Cantonment'),
(363, 'Wana'),
(364, 'Warah'),
(365, 'Washap'),
(366, 'Wasjuk'),
(367, 'Wazirabad'),
(368, 'Yakmach'),
(369, 'Zhob');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skillname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `skillname`) VALUES
(1, 'C++'),
(2, 'Java'),
(3, 'Microsoft Officer');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate_resume`
--
ALTER TABLE `candidate_resume`
  ADD CONSTRAINT `candidate_resume_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`id`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`id`);

--
-- Constraints for table `job_application`
--
ALTER TABLE `job_application`
  ADD CONSTRAINT `job_application_ibfk_3` FOREIGN KEY (`resume_id`) REFERENCES `candidate_resume` (`id`),
  ADD CONSTRAINT `job_application_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`),
  ADD CONSTRAINT `job_application_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`id`);

--
-- Constraints for table `job_location`
--
ALTER TABLE `job_location`
  ADD CONSTRAINT `job_location_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`),
  ADD CONSTRAINT `job_location_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`);

--
-- Constraints for table `job_skill`
--
ALTER TABLE `job_skill`
  ADD CONSTRAINT `job_skill_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`),
  ADD CONSTRAINT `job_skill_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
