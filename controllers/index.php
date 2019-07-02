<?php
require "models/article.php";
$lastEvent = getEvents($home = 1);
require "views/index.php";