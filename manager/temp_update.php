<?php
include 'config.php';

// Check current image
$sql = "SELECT featured_img FROM category WHERE id = 66";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
echo "Current: " . $row['featured_img'] . "\n";
?>