<?php
include "../../admin-conn/db-conn.php";
include "../../admin-conn/check-session.php";
$id = $_GET['id'];
$sql_get_item_deleted = "SELECT * FROM `stores` WHERE `id` = $id";
$store_sel = mysqli_fetch_assoc(mysqli_query($conn,$sql_get_item_deleted));
$img_name = $store_sel['img'];
$sql_delete_store = "DELETE FROM `stores` WHERE `id` = $id;";
unlink("../uploads/$img_name");
$r = mysqli_query($conn,$sql_delete_store);
if($r) {
    header('Location: show_stores.php?message=1');
} else{
    echo "Not : ";
    echo mysqli_error($conn);
} 
?>