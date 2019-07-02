<?php
function getCityServices()
{
    $db = dbConnect();
    $query = $db->query('SELECT * FROM city_service');
    $cityservices = $query->fetchAll();

    return $cityservices;
}