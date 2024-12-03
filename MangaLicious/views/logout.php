<?php
	require_once "iniciar_session.php";
	$_SESSION = array();
	session_destroy();
	header("location:home.php");
?>