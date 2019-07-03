<?php
header("Access-Control-Allow-Origin: *");
$motif = $_POST['first'];
$option = $_POST['second'];
$precision = $_POST['precision'];
$email = $_POST['email'];

$res = new \stdClass();

try {
    $db = new PDO('mysql:host=localhost;dbname=mairie;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $exception) {
    die('Erreur : ' . $exception->getMessage());
}
if ((isset($motif) AND $motif == '') || (isset($option) AND $option == '') || (isset($email) AND $email == '') || (isset($precision) AND $precision == '')) {
    $res->type = 0;
    $res->msg = "L'envoi n'a pas été effectué veuillez rempir tous les champs !";
    echo json_encode($res);
} elseif ($motif == 5 AND (isset($precision) AND $precision == '')) {
    $res->type = 0;
    $res->msg = "L'envoi n'a pas été effectué veuillez rempir tous les champs !";
    echo json_encode($res);
}
 else {
    $query_user = $db->prepare('INSERT INTO report (motif, motif_option, report_precision, email) VALUES (?, ?, ?, ?)');
    $query_user->execute(
        array(
            $motif,
            $option,
            $precision,
            $email,
        ));

    /*
     * $to = 'mairie@admin.com';
    $subject = 'Signalement de problème';
    $message = 'Motif :' . $motif . ' /r Option :' . $option . '/r' . $precision . '/r From :' . $email;
    $message = wordwrap($message, 70, "\r\n");
    mail($to, $subject, $message);
    */

    $res->type = 1;
    $res->msg = "L'envoi à été effectué avec succès ";
    echo json_encode($res);
}
