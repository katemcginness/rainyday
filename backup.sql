CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `expenses` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `userid` int(11) NOT NULL,
  `expensename` varchar(50) NOT NULL,
  `expenseamount` int(255) NOT NULL,
  `expensefrequency` varchar(12) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `income` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `userid` int(11) NOT NULL,
  `incomename` varchar(50) NOT NULL,
  `incomeamount` int(255) NOT NULL,
  `incomefrequency` varchar(12) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;