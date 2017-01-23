<?


// create a new wallet sql
$sql = 'INSERT INTO wallet(id, name, owner_id, created) values(null, "Domaci ucetnictvi", 1, null)';

$sql = "CREATE TABLE IF NOT EXISTS `" . $user_id . "_" . $wallet_id . "` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `sum` int(15) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `time` (`time`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";