<?php
header("Access-Control-Allow-Origin: *");
$motif = $_POST['first'];

$res = new \stdClass();
try{
    $db = new PDO('mysql:host=localhost;dbname=mairie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exception)
{
    die( 'Erreur : ' . $exception->getMessage() );
}
if (isset($motif) and !empty($motif)) {
    $options = $db->prepare('SELECT motif_option, id FROM report_option WHERE motif_id = ?');
    $options->execute(array($motif));
    $categoryOptions = $options->fetchAll(PDO::FETCH_ASSOC);

    $res->type = 1;
    $res->msg = 'fine';
    $res->content = $categoryOptions;
    echo json_encode($res);
}
else {
    $res->type = 1;
    $res->msg = 'une erreur est survenue !';
    echo json_encode($res);
}


