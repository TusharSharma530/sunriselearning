<?php
include 'config.php';

// Simulate exactly what createcategory.php does
$cname = trim(mysqli_real_escape_string($con,"Meet the Founder"));
$url = seo_friendly_url($cname);
$ctype = trim(mysqli_real_escape_string($con,"3"));
$cdesc = trim(mysqli_real_escape_string($con,"<p>Test description</p>"));
$sdesc = trim(mysqli_real_escape_string($con,"<p>Test short desc</p>"));
$mtitle = "";
$mkeywords = "";
$mdesc = "";
$order = trim(mysqli_real_escape_string($con,"5"));
$uploadpath = "";

echo "cname: $cname<br>";
echo "ctype: $ctype<br>";
echo "url: $url<br>";
echo "order: $order<br>";

$sqlins = mysqli_query($con,"INSERT INTO category (id, c_name, c_type, c_url, c_desc, sdesc, featured_img, meta_title, meta_keywords, meta_desc, `order`) VALUES (NULL, '$cname', '$ctype', '$url', '$cdesc', '$sdesc', '$uploadpath', '$mtitle', '$mkeywords', '$mdesc', '$order')");

if($sqlins){
    echo "<br>Success! ID: " . mysqli_insert_id($con);
    // Delete the test record
    $testid = mysqli_insert_id($con);
    mysqli_query($con, "DELETE FROM category WHERE id = $testid");
    echo "<br>Test record deleted";
}else{
    echo "<br>Error: " . mysqli_error($con);
}
?>
