CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(250) NOT NULL,
 `password` varchar(50) NOT NULL,
 `active` binary(1) NOT NULL default '0',
 `token` varchar(255) NOT NULL default '0',
 `magictoken` varchar(255) NOT NULL default '0',
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);