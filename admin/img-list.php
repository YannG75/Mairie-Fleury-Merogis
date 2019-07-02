<?php

require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
    header('location:../index.php');
    exit;
}

//supprimer la catégorie dont l'ID est envoyé en paramètre URL
if(isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

    $query = $db->prepare('DELETE FROM image_galery WHERE id = ?');
    $result = $query->execute([
        $_GET['event_id']
    ]);

    //générer un message à afficher plus bas pour l'administrateur
    if($result){
        $message = "Suppression efféctuée.";
    }
    else{
        $message = "Impossible de supprimer la séléction.";
    }
}

//séléctionner toutes les catégories pour affichage de la liste
$query = $db->query('SELECT * FROM image_galery ORDER BY id ASC ');
$imgs = $query->fetchall();
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
                <h4>Liste des images secondaire</h4>
                <a class="btn btn-primary" href="img-form.php">Ajouter une image secondaire</a>
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
                    <th>event_id</th>
                    <th>secondary_image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if($imgs): ?>
                    <?php foreach($imgs as $img): ?>
                        <tr>
                            <!-- htmlentities sert à écrire les balises html sans les interpréter -->
                            <th><?= htmlentities($img['id']); ?></th>
                            <td><?= htmlentities($img['event_id']); ?></td>
                            <td><?= $img['secondary_image']; ?></td>
                            <td>
                                <a href="img-form.php?event_id=<?= $img['id']; ?>&action=edit" class="btn btn-warning">Modifier</a>
                                <a onclick="return confirm('Are you sure?')" href="img-list.php?event_id=<?= $img['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    Aucune image enregistrée.
                <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>
</html>

