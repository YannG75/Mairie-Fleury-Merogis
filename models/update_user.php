<?php
header("Access-Control-Allow-Origin: *");
$confirmed = $_POST['is_confirmed'];


$res = new \stdClass();

try {
    $db = new PDO('mysql:host=localhost;dbname=mairie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}
if (empty($confirmed) || $confirmed == 0) {
    $res->type = 0;
    $res->msg = "fail";
    echo json_encode($res);
} else {
    $query_user = $db->prepare('UPDATE user SET is_confirmed= :is_confirmed');
    $query_user->execute(
        array(
            'is_confirmed' => $_POST['is_confirmed']
        ));

    $_SESSION['user']['is_confirmed'] = 1;
    $res->type = 1;
    $res->msg = "udpate done";
   $res->newSession = $_SESSION['user']['is_confirmed'];
    echo json_encode($res);
}

