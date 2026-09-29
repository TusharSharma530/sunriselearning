<?php include 'config.php';
$cat_id = $_GET['cat_id'] ?? 0;
$sql = mysqli_query($con, "SELECT id, sc_name, sc_url FROM sub_cat WHERE cat_id = $cat_id AND status = 1");
$subcats = array();
while($row = mysqli_fetch_assoc($sql)){
    $subcats[] = $row;
}
echo json_encode($subcats);
?>