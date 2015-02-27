DROP DATABASE IF EXISTS LinuxPerformanceAnalysis;
CREATE DATABASE LinuxPerformanceAnalysis;
USE LinuxPerformanceAnalysis;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT COMMENT 'number of user, used like id',
  `user` varchar(16) NOT NULL COMMENT 'username, that is used for login',
  `password` char(32) NOT NULL COMMENT 'user password for login, use md5 encode.',
  `first_name` varchar(45) NOT NULL COMMENT 'first name of the user',
  `last_name` varchar(45) NOT NULL COMMENT 'last name of the user',
  `email` varchar(45) NOT NULL COMMENT 'contact email for the user',
  `host_directory` varchar(256) NOT NULL COMMENT 'Each user must have a directory',
  `active` char(1) NOT NULL COMMENT '1 or 0 , if the user is active or not',
  `level` char(1) NOT NULL COMMENT 'level of the user, 1 for admin 2 for others',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE patch (
`id_patch` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of the patch',
`name` varchar(45) NOT NULL COMMENT 'The name of the patch',
`status` varchar(15) NOT NULL COMMENT 'Accepted|Rejected|Tested',
`id_user` int(11) NOT NULL COMMENT 'Owner of the patch',
PRIMARY KEY (id_patch),
FOREIGN KEY (id_user) REFERENCES user(id_user)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
