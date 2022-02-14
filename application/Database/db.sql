-
-- Database: `project_task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `pt_projects`
--

CREATE TABLE `pt_projects` (
  `id_project` int(11) NOT NULL,
  `project_name` varchar(158) NOT NULL,
  `project_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Inactive, 1- Active',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pt_projects`
--

INSERT INTO `pt_projects` (`id_project`, `project_name`, `project_status`, `created_at`) VALUES
(1, 'Project1', 1, '2022-02-13 05:00:00'),
(2, 'Project2', 2, '2022-02-13 09:00:00'),
(3, 'Project3', 1, '2022-02-13 10:00:00'),
(4, 'Project4', 1, '2022-02-13 14:00:00'),
(5, 'Project5', 1, '2022-02-13 14:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `pt_tasks`
--

CREATE TABLE `pt_tasks` (
  `id_task` int(11) NOT NULL,
  `task_name` varchar(158) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0-Inactive, 1- Active',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pt_tasks`
--

INSERT INTO `pt_tasks` (`id_task`, `task_name`, `project_id`, `task_status`, `created_at`) VALUES
(1, 'Task1', 1, 1, '2022-02-13 05:00:00'),
(2, 'Task2', 1, 2, '2022-02-13 09:00:00'),
(3, 'Task3', 1, 1, '2022-02-13 10:00:00'),
(4, 'Task4', 4, 1, '2022-02-13 14:00:00'),
(5, 'Task5', 4, 1, '2022-02-13 14:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `pt_task_logs`
--

CREATE TABLE `pt_task_logs` (
  `id_task_log` int(11) NOT NULL,
  `description` text NOT NULL,
  `task_id` int(11) NOT NULL,
  `hours` int(11) UNSIGNED NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pt_task_logs`
--

INSERT INTO `pt_task_logs` (`id_task_log`, `description`, `task_id`, `hours`, `date`) VALUES
(1, 'Db added', 1, 1, '2022-02-14 04:54:05'),
(2, 'Plan', 2, 3, '2022-02-14 04:54:24'),
(3, 'CR', 1, 5, '2022-02-14 04:54:45'),
(4, 'Renew', 1, 1, '2022-02-14 04:55:18'),
(5, 'Quality', 1, 1, '2022-02-14 04:55:18'),
(6, 'Design temo', 5, 9, '2022-02-14 05:20:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pt_projects`
--
ALTER TABLE `pt_projects`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `pt_tasks`
--
ALTER TABLE `pt_tasks`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `pt_task_logs`
--
ALTER TABLE `pt_task_logs`
  ADD PRIMARY KEY (`id_task_log`),
  ADD KEY `project_id` (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pt_projects`
--
ALTER TABLE `pt_projects`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pt_tasks`
--
ALTER TABLE `pt_tasks`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pt_task_logs`
--
ALTER TABLE `pt_task_logs`
  MODIFY `id_task_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;