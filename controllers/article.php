<?php
require "models/article.php";
isset($_GET['event_id']) AND ctype_digit($_GET['event_id']) ? $event = getEvent($_GET['event_id']) : '';
if($event) {
    require "models/img_galery.php";
    $galery = getImg($_GET['event_id']);
    require_once('./views/article.php');
}
else header('location:index.php');