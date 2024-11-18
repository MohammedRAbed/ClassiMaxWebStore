<?php
setcookie('email',"",time()-(60*60),"/");
setcookie('password',"",time()-(60*60),"/");
session_start();
session_unset();
session_destroy();
header('Location: login.php');
?>