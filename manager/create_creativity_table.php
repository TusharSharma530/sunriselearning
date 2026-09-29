<?php
include 'config.php';
$sql = "CREATE TABLE IF NOT EXISTS `creativity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
if(mysqli_query($con, $sql)){
    echo "Table created successfully";
}else{
    echo "Error: " . mysqli_error($con);
}
?>
