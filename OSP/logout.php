<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['views']);
			unset($_SESSION['IsValid']);
						unset($_SESSION['emailid']);
session_destroy();
header("location:index.php");
?>
