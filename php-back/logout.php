<?php
session_start();
unset($_SESSION['usertype']);
unset($_SESSION['username']);
session_destroy();

header("Location: ../index.php")
?>