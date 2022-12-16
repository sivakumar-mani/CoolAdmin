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

CREATE TABLE `custdetails` (
`custid` int NOT NULL AUTO_INCREMENT,
`firstname` varchar(256) NOT NULL,
`lastname` varchar(256) NOT NULL,
`dno` varchar(256) NOT NULL,
`streetname` varchar(256) NOT NULL,
`area` varchar(256) NOT NULL,
`postalarea` varchar(256) NOT NULL,
`city` varchar(100) NOT NULL,
`pincode`int(6) NOT NULL,
`homephone` varchar(15),
`mobileno` varchar(15),
`cdate` date NOT NULL,
`ctype` varchar(50) NOT NULL,
`stbno` varchar(15),
`paidamt` int(15) NOT NULL,
`balamt` int(15) NOT NULL,
`duedate` date,
`status` varchar(15) NOT NULL,
`remarks` varchar(1000),
PRIMARY KEY(`custid`)
)ENGINE = MyISAM DEFAULT CHARSET = utf8;



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


CREATE TABLE `category` (
	`catid` int NOT NULL AUTO_INCREMENT,
  `categoryId` varchar(100) NOT NULL,
  `categoryname` varchar(100) NOT NULL,
	PRIMARY KEY(`catid`)
);

CREATE TABLE `brands` (
	`bid` int NOT NULL AUTO_INCREMENT,
  `brandsid` varchar(100) NOT NULL,
  `brandsname` varchar(100) NOT NULL,
	PRIMARY KEY(`bid`)
);

CREATE TABLE `item` (
	`iid` int NOT NULL AUTO_INCREMENT,
  `itemid` varchar(100) NOT NULL,
  `itemname` varchar(100) NOT NULL,
	PRIMARY KEY(`iid`)
);

CREATE TABLE `vendor_details` (
  `vid` int NOT NULL AUTO_INCREMENT,
  `vendorid` varchar(100) NOT NULL,
  `vendorname` varchar(100) NOT NULL,
  `vendorcompanyname` varchar(100) NOT NULL,
  `vendoraddress` varchar(1000) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` int(10) NOT NULL,
  `gstno` varchar(50) NOT NULL,
  `pan` varchar(50) NOT NULL,
  `licenceno` varchar(50) NOT NULL,
`mobile` int(25) NOT NULL,
`mobile1` int(25) NOT NULL,
`landline` int(25) NOT NULL,
  `emailid` varchar(100) NOT NULL,
	PRIMARY KEY(`vid`)
);

CREATE TABLE `purchased_invoice` (
  `ivid` int NOT NULL AUTO_INCREMENT,
  `invoiceid` varchar(100) NOT NULL,
  `vendorid` varchar(100) NOT NULL,
  `vendorcompanyname` varchar(100) NOT NULL,
  `invoicedate` date NOT NULL,
  `invoiceno` varchar(25) NOT NULL,
  `billno` varchar(25) NOT NULL,
  `totalinvoiceamount` int(25) NOT NULL,
  `totalpaidamount` int(25) NOT NULL,
  `totalbalanceamount` int(25) NOT NULL,
  `totaldiscount` int(25) NOT NULL,
  `totalgst` int(25) NOT NULL,
 `docspath` varchar(600) NOT NULL,
 `docsname` varchar(100) NOT NULL,
	PRIMARY KEY(`ivid`)
);

CREATE TABLE `purchased_items_inventory` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `invoiceid` varchar(100) NOT NULL,
  `vendorid` varchar(100) NOT NULL,
  `purchaseid` varchar(100) NOT NULL,
  `brandsname` varchar(100) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `categoryname` varchar(100) NOT NULL,
 `serialnumber` varchar(1000) NOT NULL,
  `mrp` int(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `discount` int(25) NOT NULL,
  `totalprice` int(25) NOT NULL,
  `cgst` int(25) NOT NULL,
  `sgst` int(25) NOT NULL,
	PRIMARY KEY(`pid`)
);


CREATE TABLE `stock_inventory` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `stockcode` varchar(100) NOT NULL,
  `stockname` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `mrp` int(25) NOT NULL,
  `stocktype` varchar(100) NOT NULL,
	PRIMARY KEY(`sid`)
);



266
