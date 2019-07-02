<?php
function getEvents($home = false)
{
    $db = dbConnect();

    $queryString = 'SELECT * FROM event WHERE published_at <= NOW() AND is_published = 1 ORDER BY published_at DESC ';

    if ($home) $queryString .= ' LIMIT 3';
    $query = $db->query($queryString);
    $events = $query->fetchAll();
return $events;
}

function getEvent($eventId)
{
    $db = dbConnect();

    $query = $db->prepare('SELECT * FROM event WHERE published_at <= NOW() AND is_published = 1 AND id = ?');

    $query->execute(array($eventId));

    return $events = $query->fetch();
}
