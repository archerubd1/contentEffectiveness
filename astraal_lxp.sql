-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2026 at 08:20 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astraal_lxp`
--

-- --------------------------------------------------------

--
-- Table structure for table `content_effectiveness_predictions`
--

CREATE TABLE `content_effectiveness_predictions` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `predicted_effectiveness` float DEFAULT NULL,
  `risk_level` varchar(50) DEFAULT NULL,
  `confidence_score` float DEFAULT NULL,
  `calculated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content_effectiveness_predictions`
--

INSERT INTO `content_effectiveness_predictions` (`id`, `unit_id`, `predicted_effectiveness`, `risk_level`, `confidence_score`, `calculated_on`) VALUES
(1, 1, 0.645, 'Monitor', 0.45, '2026-03-04 16:15:31'),
(2, 1, 0.645, 'Monitor', 0.45, '2026-03-04 16:20:16'),
(3, 1, 0.75, 'Stable', 0.9, '2026-03-04 21:06:50'),
(4, 2, 0.45, 'Review', 0.85, '2026-03-04 21:06:50'),
(5, 3, 0.6, 'Monitor', 0.88, '2026-03-04 21:06:50'),
(6, 4, 0.82, 'Stable', 0.92, '2026-03-04 21:06:50'),
(7, 5, 0.3, 'Review', 0.8, '2026-03-04 21:06:50'),
(8, 1, 0.75, 'Stable', 0.9, '2026-03-04 21:10:39'),
(9, 2, 0.45, 'Review', 0.85, '2026-03-04 21:10:39'),
(10, 3, 0.6, 'Monitor', 0.88, '2026-03-04 21:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `content_revision_log`
--

CREATE TABLE `content_revision_log` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `action_taken` text,
  `revised_by` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `content_signals`
--

CREATE TABLE `content_signals` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `avg_time_spent` float DEFAULT NULL,
  `expected_time` float DEFAULT NULL,
  `dropoff_rate` float DEFAULT NULL,
  `early_assessment_score` float DEFAULT NULL,
  `engagement_variance` float DEFAULT NULL,
  `revisit_rate` float DEFAULT NULL,
  `sample_size` int(11) DEFAULT NULL,
  `calculated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `content_signals`
--

INSERT INTO `content_signals` (`id`, `unit_id`, `avg_time_spent`, `expected_time`, `dropoff_rate`, `early_assessment_score`, `engagement_variance`, `revisit_rate`, `sample_size`, `calculated_on`) VALUES
(1, 1, 0.85, 600, 0.3, 78, 120, 0.25, 45, '2026-03-04 16:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `content_skill_impact`
--

CREATE TABLE `content_skill_impact` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `skill_node` int(11) DEFAULT NULL,
  `career_node` int(11) DEFAULT NULL,
  `structural_impact` float DEFAULT NULL,
  `calculated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kg_edges`
--

CREATE TABLE `kg_edges` (
  `id` int(11) NOT NULL,
  `from_node` int(11) DEFAULT NULL,
  `to_node` int(11) DEFAULT NULL,
  `relationship_type` varchar(50) DEFAULT NULL,
  `weight` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kg_edges`
--

INSERT INTO `kg_edges` (`id`, `from_node`, `to_node`, `relationship_type`, `weight`) VALUES
(1, 1, 101, 'BUILDS', 0.8),
(2, 101, 201, 'REQUIRES', 1),
(3, 101, 202, 'REQUIRES', 0.9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'vaishu', 'v@123'),
(3, 'root', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content_effectiveness_predictions`
--
ALTER TABLE `content_effectiveness_predictions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_revision_log`
--
ALTER TABLE `content_revision_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_signals`
--
ALTER TABLE `content_signals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_skill_impact`
--
ALTER TABLE `content_skill_impact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kg_edges`
--
ALTER TABLE `kg_edges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content_effectiveness_predictions`
--
ALTER TABLE `content_effectiveness_predictions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `content_revision_log`
--
ALTER TABLE `content_revision_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `content_signals`
--
ALTER TABLE `content_signals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `content_skill_impact`
--
ALTER TABLE `content_skill_impact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kg_edges`
--
ALTER TABLE `kg_edges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
