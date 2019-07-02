<?php
header("Access-Control-Allow-Origin: *");
$date = $_POST['published_at'];

$res = new \stdClass();
try {
    $db = new PDO('mysql:host=localhost;dbname=mairie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}
if (isset($date) and !empty($date)) {
    $options = $db->prepare('SELECT * FROM event WHERE published_at <= ? AND is_published = 1 ORDER BY published_at DESC ');
    $options->execute(array($date));
    $categoryOptions = $options->fetchAll(PDO::FETCH_ASSOC);

    if ($categoryOptions) {
        $res->type = 1;
        $res->msg = 'tout marche !';
        $res->content = $categoryOptions;
        echo json_encode($res);
    } else {
        $res->type = 2;
        $res->msg = 'Aucun article disponible à cette date';
        echo json_encode($res);
    }
} else {
    $res->type = 0;
    $res->msg = 'une erreur est survenue !';
    echo json_encode($res);
}