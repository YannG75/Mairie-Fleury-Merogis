<?php
require "models/login.php";
if(isset($_POST['login'])) $loginError = login();
if(isset($_SESSION['user'])){
    header('location:index.php?page=account');
    exit;
}
require "views/login.php";
