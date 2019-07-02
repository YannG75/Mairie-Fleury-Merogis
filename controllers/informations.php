<?php
require "models/city_info.php";
require "models/city_service.php";
$city_infos = getCityInfos();
$city_services = getCityServices();
require "views/informations.php";
