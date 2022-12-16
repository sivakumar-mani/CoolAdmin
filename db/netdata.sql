-- --------------------------------------------------------
CREATE TABLE `logincd` (
  `userID` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
	PRIMARY KEY(`userID`)
);

INSERT INTO `cabledb`.`logincd` (`userID`, `password`, `firstname`, `lastname`) VALUES ('sivakumar.pmani@gmail.com', 'Hunters@1310', 'Sivakumar', 'Mani'), ('mythili.msiva@gmail.com', 'Hunters@1310', 'Mythili', 'Sivakumar ');
-- 
-- Table structure for table `Customer details`

CREATE TABLE `netcustdetails` (
`ncustid` int NOT NULL AUTO_INCREMENT,
`firstname` varchar(256) NOT NULL,
`lastname` varchar(256) NOT NULL,
`address` varchar(1000) NOT NULL,
`mobileno1` varchar(15),
`mobileno` varchar(15),
`netid` varchar(30),
`cdate` date NOT NULL,
`plandetails` varchar(50) NOT NULL,
`planamt` int(15) NOT NULL,
`installamt` int(15) NOT NULL,
`routerdetails` varchar(100) NOT NULL,
`status` varchar(50),
`remarks` varchar(1000),
PRIMARY KEY(`custid`)
)ENGINE = MyISAM DEFAULT CHARSET = utf8;

CREATE TABLE `netcustdetails` (
`custid` int NOT NULL AUTO_INCREMENT,
`firstname` varchar(256) NOT NULL,
`lastname` varchar(256) NOT NULL,
`netID` varchar(50) NOT NULL,
`address` varchar(500) NOT NULL,
`mobileno1` varchar(15),
`mobileno2` varchar(15),
`email` varchar(100),
`cdate` date NOT NULL,
`plandetail` varchar(100) NOT NULL,
`planamt` int(15) NOT NULL,
`installamt` int(15) NOT NULL,
`routerdetails` varchar(15) NOT NULL,
`status` varchar(15) NOT NULL,
`remarks` varchar(1000),
PRIMARY KEY(`custid`)
)ENGINE = MyISAM DEFAULT CHARSET = utf8;


CREATE TABLE `netpayregistry` (
`payid` int NOT NULL AUTO_INCREMENT,
`custid` int(6) NOT NULL,
`firstname` varchar(256) NOT NULL,
`lastname` varchar(256) NOT NULL,
`monthnum` int(6) NOT NULL,
`monthname` varchar(50) NOT NULL,
`yearnum` int(6) NOT NULL,
`receiver` varchar(256) ,
`modeofpay` varchar(100) NOT NULL,
`renewdate` date,
`collectdate` date,
`amount` int(6) NOT NULL,
`balance` int(6) NOT NULL,
`status` varchar(25) NOT NULL,
PRIMARY KEY(`payid`)
);



CREATE TABLE `payregistry` (
`payid` int NOT NULL AUTO_INCREMENT,
`custid` int(6) NOT NULL,
`firstname` varchar(256) NOT NULL,
`lastname` varchar(256) NOT NULL,
`monthnum` int(6) NOT NULL,
`monthname` varchar(50) NOT NULL,
`yearnum` int(6) NOT NULL,
`receiver` varchar(256) ,
`collector` varchar(256),
`collectdate` date,
`amount` int(6) NOT NULL,
`balance` int(6) NOT NULL,
`status` varchar(25) NOT NULL,
PRIMARY KEY(`payid`)
);

CREATE TABLE `accounts` (
`accountid` int NOT NULL AUTO_INCREMENT,
`accountdate` date,
`description` varchar(256) NOT NULL,
`accounttype` varchar(256) NOT NULL,
`amount` int(10) NOT NULL,
PRIMARY KEY(`accountid`)
);

CREATE TABLE `payregistry1` (
`payid` int NOT NULL AUTO_INCREMENT,
`custid` int(6) NOT NULL,
`firstname` varchar(256) NOT NULL,
`lastname` varchar(256) NOT NULL,
`monthnum` int(6) NOT NULL,
`monthname` varchar(50) NOT NULL,
PRIMARY KEY(`payid`)
);

CREATE TABLE `complaints` (
`complaintid` int NOT NULL AUTO_INCREMENT,
`name` varchar(256) NOT NULL,
`address` varchar(250) NOT NULL,
`phoneno` varchar(15) NOT NULL,
`subject` varchar(50) NOT NULL,
`message` varchar(256) NOT NULL,
`attender` varchar(50) NOT NULL,
`remedy` varchar(250) NOT NULL,
`status` varchar(25) NOT NULL,
PRIMARY KEY(`complaintid`)
)ENGINE = MyISAM DEFAULT CHARSET = utf8;

`compdate` date,
`attenddate` date,

CREATE TABLE `complaint` (
`complaintid` int NOT NULL AUTO_INCREMENT,
`name` varchar(256) NOT NULL,
`address` varchar(1000) NOT NULL,
`contactno` varchar(50) NOT NULL,
`subject` varchar(25) NOT NULL,
`message` varchar(250) NOT NULL,
`compdate` date,
`attenddate` date,
`attender` varchar(50) NULL,
`remedy` varchar(250) NULL,
`status` varchar(25) NULL,
PRIMARY KEY(`complaintid`)
);


CREATE TABLE `complaint-old` (
 `complaintid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `contactno` varchar(50) NOT NULL,
  `subject` varchar(25) NOT NULL,
  `message` varchar(250) NOT NULL,
  `compdate` date DEFAULT NULL,
  `attenddate` date DEFAULT NULL,
  `attender` varchar(50) DEFAULT NULL,
  `remedy` varchar(250) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- 
SAMPLE datables
CREATE TABLE `categories` ( 
  `id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `position` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `pm`
-- 

CREATE TABLE `pm` (
  `id` bigint(20) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `topics`
-- 

CREATE TABLE `topics` (
  `parent` smallint(6) NOT NULL,
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `timestamp2` int(11) NOT NULL,
  PRIMARY KEY  (`id`,`id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `logincd` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `signup_date` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
