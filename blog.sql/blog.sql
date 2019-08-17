--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `Msg` varchar(255) NOT NULL,
  `Date_Time` datetime NOT NULL,
  `Sender_ID` int(11) NOT NULL,
  `Receiver_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `Msg`, `Date_Time`, `Sender_ID`, `Receiver_ID`) VALUES
(1, 'test test test', '2017-12-05 09:30:00', 1, 2),
(2, 'test test test tany', '2017-12-05 03:30:00', 3, 4),
(3, 'l2a', '2017-12-05 09:30:00', 1, 2),
(4, 'ah', '2017-12-05 03:30:00', 3, 4),
(5, 'Hello', '2017-12-05 09:30:00', 1, 2),
(6, 'Hello tany', '2017-12-05 03:30:00', 4, 3),
(7, 'Right', '2017-12-05 09:30:00', 2, 1),
(8, 'Right tany', '2017-12-05 03:30:00', 4, 3),
(9, 'Never', '2017-12-05 09:30:00', 1, 2),
(10, 'Never tany', '2017-12-05 03:30:00', 4, 3),
(11, 'HI', '2017-12-05 09:30:00', 1, 2),
(12, 'HI tany', '2017-12-05 03:30:00', 4, 3),
(13, 'yoh', '2017-12-05 09:30:00', 1, 2),
(14, 'yoh tany', '2017-12-05 03:30:00', 4, 3),
(15, 'estny', '2017-12-05 09:30:00', 1, 2),
(16, '-_-', '2017-12-05 03:30:00', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Date_Time` datetime NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Post` text,
  `Category` varchar(50) NOT NULL,
  `Total_Rates` int(11) DEFAULT NULL,
  `Raters_Number` int(11) DEFAULT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`ID`, `Title`, `Date_Time`, `Image`, `Post`, `Category`, `Total_Rates`, `Raters_Number`, `User_ID`) VALUES
(1, 'Update my post -_-', '2017-12-07 07:19:17', 'images/beginagain.jpg', 'This is my personal post', 'entertainment', 0, 0, 1),
(2, 'science is cool', '2017-12-04 12:36:09', 'images/science.png', 'In the debate about whether science is cool again, one answer remained unuttered, so, what the hell, I might as well say it: No. Science is not cool. Here’s why. First of all, the word “cool” sells science short. Science is wonderful. Science is vital, science is fascinating, science is awe-inspiring, and science is praiseworthy. You know what’s been called “cool?” Parachute pants, slap bracelets, pogs, the Macarena, and Hypercolor shirts. (Maybe I’m unfairly picking on the early ’90s, but holy hell, what an awful lot of crap we liked.) Fist-pumping over science’s newfound coolness implies, it seems to me, that “cool” is a higher aspiration for science, and it isn’t.', 'science', 6, 2, 2),
(3, 'sport', '2017-12-04 11:36:09', 'images/sport.jpg', 'Sport (British English) or sports (American English) includes all forms of competitive physical activity or games which, through casual or organised participation, aim to use, maintain or improve physical ability and skills while providing enjoyment to participants, and in some cases, entertainment for spectators.', 'sports', 28, 10, 3),
(4, 'what is food', '2017-12-04 09:36:09', 'images/food.jpg', 'Food is any substance consumed to provide nutritional support for an organism. It is usually of plant or animal origin, and contains essential nutrients, such as carbohydrates, fats, proteins, vitamins, or minerals. The substance is ingested by an organism and assimilated by the organism''s cells to provide energy, maintain life, or stimulate growth.', 'others', 21, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `User_ID` int(11) NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `Rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`User_ID`, `Post_ID`, `Rate`) VALUES
(1, 3, 3),
(2, 3, 2),
(3, 3, 2),
(4, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) DEFAULT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `Fname`, `Lname`, `Password`, `Email`) VALUES
(1, 'nermin', 'khaled', '1', 'nermin_khaled@yahoo.com'),
(2, 'yasmeen', 'hesham', '12', 'yasmeen_hesham@yahoo.com'),
(3, 'menna', 'lotfy', '123', 'menna_lotfy@yahoo.com'),
(4, 'hager', 'samir', '1234', 'hager_samir@yahoo.com'),
(5, 'nermin', 'khaled', '143', 'nermin_khaled@hotmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `messages_ibfk_1` (`Sender_ID`),
  ADD KEY `messages_ibfk_2` (`Receiver_ID`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_ID` (`User_ID`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD UNIQUE KEY `User_ID_2` (`User_ID`,`Post_ID`),
  ADD UNIQUE KEY `User_ID_3` (`User_ID`,`Post_ID`),
  ADD KEY `user_ID` (`User_ID`),
  ADD KEY `post_ID` (`Post_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`Sender_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Receiver_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `cascade_on_delete` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`Post_ID`) REFERENCES `post` (`ID`);

