<?php
function getBills($userId)
{
    $db = dbConnect();

    $query = $db->prepare('SELECT * FROM bill WHERE user_id = ?');

    $query->execute(array($userId));

    return $bills = $query->fetchAll();


}