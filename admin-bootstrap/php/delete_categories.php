<?php
include "../../admin-conn/db-conn.php";
include "../../admin-conn/check-session.php";
$id = $_GET['id'];
$sql_check_cat = "SELECT * FROM `stores` WHERE `category` = $id";
$st = mysqli_fetch_assoc(mysqli_query($conn,$sql_check_cat)); 
if($st!=null) {
    header("Location: error_admin_page.php");
} else{
    $sql_delete_category = "DELETE FROM `categories` WHERE `id` = $id;";
    $r = mysqli_query($conn,$sql_delete_category);
    if($r) {
        header('Location: show_categories.php?message=1');
    } else{
        echo "Not : ";
        echo mysqli_error($conn);
    }
} 
?>