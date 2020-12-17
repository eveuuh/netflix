<?php
require_once("config.php");

if(!isset($_SESSION["userLoggedIn"])) {
    header("Location: register.php");
}
?>