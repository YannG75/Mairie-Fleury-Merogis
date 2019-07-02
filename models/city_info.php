<?php
function getCityInfos()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM city_info');
    $cityInfos = $query->fetchAll();

return $cityInfos;
}