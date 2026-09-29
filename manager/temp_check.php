<?php
include 'config.php';
$sql = mysqli_query($con, "SELECT id, c_desc, sdesc, section_heading FROM category WHERE id = 66");
$row = mysqli_fetch_assoc($sql);
echo "Content length: " . strlen($row['c_desc']) . " chars\n";
echo "Content:\n" . $row['c_desc'];
?>