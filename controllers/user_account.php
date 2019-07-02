<?php
if (!isset($_SESSION['user'])) header('location:index.php?page=login');
require "models/user_info.php";
$user = getUserInfo();
require "models/bill.php";
$bills = getBills($_SESSION['user']['id']);
require "views/user_account.php";
