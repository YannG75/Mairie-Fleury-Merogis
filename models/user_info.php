<?php
function getUserInfo()
{
    $db = dbConnect();

    $query = $db->prepare('SELECT *
			FROM user
			WHERE id = ?');
    $query->execute(array($_SESSION['user']['id']));
     $user = $query->fetch();


    if ($user) {

        $_SESSION['user']['is_admin'] = $user['is_admin'];
        $_SESSION['user']['lastname'] = $user['lastname'];
        $_SESSION['user']['is_confirmed'] = $user['is_confirmed'];

        $_SESSION['user']['id'] = $user['id'];
    }
    return $user;
}


