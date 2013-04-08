CREATE TABLE `participant` (
  `participant_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `participant_nom` varchar(11) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `participant_prenom` varchar(11) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `participant_sexe` enum('M','F') CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`participant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;