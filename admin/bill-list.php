<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

//supprimer la catégorie dont l'ID est envoyé en paramètre URL
if(isset($_GET['bill_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $queryDel = $db->prepare('SELECT pdf FROM bill WHERE id = ?');
    $queryDel->execute([
        $_GET['bill_id']
    ]);

    $resultpdf = $queryDel->fetch();



    $query = $db->prepare('DELETE FROM bill WHERE id = ?');
    $result = $query->execute([
        $_GET['bill_id']
    ]);

    $way = '../assets/images/';
    if ($resultpdf[0] != null) {
        unlink($way . $resultpdf['pdf']);
    }

    //générer un message à afficher plus bas pour l'administrateur
    if($result){
        $message = "Suppression efféctuée.";
    }
    else{
        $message = "Impossible de supprimer la séléction.";
    }
}

//séléctionner toutes les catégories pour affichage de la liste
$query = $db->query('SELECT * FROM bill ORDER BY id ASC ');
$bills = $query->fetchall();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration des catégories - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>
    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>
        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des factures</h4>
                <a class="btn btn-primary" href="bill-form.php">Ajouter une facture</a>
            </header>
            <?php if(isset($message)): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-success text-white p-2 mb-4">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>user_id</th>
                    <th>bill_number</th>
                    <th>name</th>
                    <th>price</th>
                    <th>date</th>
                    <th>pdf</th>
                    <th>acquitted</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($bills): ?>
                    <?php foreach($bills as $bill): ?>
                        <tr>
                            <!-- htmlentities sert à écrire les balises html sans les interpréter -->
                            <th><?= $bill['id']; ?></th>
                            <td><?= htmlentities($bill['user_id']); ?></td>
                            <td><?= $bill['bill_number']; ?></td>
                            <td><?= $bill['name']; ?></td>
                            <td><?= $bill['price']; ?></td>
                            <td><?= $bill['date']; ?></td>
                            <td><?= $bill['pdf']; ?></td>
                            <td><?= $bill['acquitted']; ?></td>
                            <td>
                                <a href="bill-form.php?bill_id=<?= $bill['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                <a onclick="return confirm('Are you sure?')" href="bill-list.php?bill_id=<?= $bill['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    Aucune catégorie enregistré.
                <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>
</html>
