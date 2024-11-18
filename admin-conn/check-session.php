<?php
session_start();

if(!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    if(!isset($_COOKIE['email']) || !isset($_COOKIE['password'])) {
        header('Location: login.php');
        exit();
    }
}
?>