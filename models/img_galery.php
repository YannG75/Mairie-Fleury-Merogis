<?php
function getImg($eventId){
    $db = dbConnect();

    $query = $db->prepare('SELECT secondary_image FROM image_galery WHERE  event_id = ?');

    $query->execute(array($eventId));

    return $eventImg = $query->fetchAll(PDO::FETCH_COLUMN);
}
