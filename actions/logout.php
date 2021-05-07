<?php
session_start();
session_unset();
session_destroy();

header("location: ../views"); //gp back to index.php / login page
exit;
?>