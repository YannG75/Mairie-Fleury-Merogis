<?php
require "models/report_categories.php";
$CategoriesToSelect = getcategories();
require "views/report.php";
