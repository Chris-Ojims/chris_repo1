<?php
session_start();
session_destroy();
header("Location: miniproj_login.html");
exit();

?>