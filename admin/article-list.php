<?php

require_once '../tools/common.php';

if (!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0) {
    header('location:../index.php');
    exit;
}


if (isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {

    $queryDel = $db->prepare('SELECT image FROM event WHERE id = ?');
    $queryDel->execute([
        $_GET['event_id']
    ]);

    $resultImg = $queryDel->fetch();



    $query = $db->prepare('DELETE FROM event WHERE id = ?');
    $result = $query->execute([
        $_GET['event_id']
    ]);

    $way = '../assets/images/';
    if ($resultImg[0] != null) {
        unlink($way . $resultImg['image']);
    }


    $query = $db->prepare('DELETE FROM image_galery WHERE event_id = ?');
    $resultCategory = $query->execute([
        $_GET['event_id']
    ]);

    //générer un message à afficher pour l'administrateur
    if ($result) {
        $message = "Suppression efféctuée.";
    } else {
        $message = "Impossible de supprimer la séléction.";
    }
}

//séléctionner tous les articles pour affichage de la liste
$query = $db->query('SELECT * FROM event ORDER BY id DESC');
$events = $query->fetchall();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration des articles - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>
    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>
        <section class="col-9">
            <header class="pb-4 d-flex justify-content-between">
                <h4>Liste des articles</h4>
                <a class="btn btn-primary" href="article-form.php">Ajouter un article</a>
            </header>
            <?php if (isset($message)): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-success text-white p-2 mb-4">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['message'])): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-success text-white p-2 mb-4">
                    <?= $_SESSION['message']; ?>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Publié</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($events): ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <!-- htmlentities sert à écrire les balises html sans les interpréter -->
                            <th><?= htmlentities($event['id']); ?></th>
                            <td><?= htmlentities($event['title']); ?></td>
                            <td>
                                <?= $event['is_published'] == 1 ? 'Oui' : 'Non' ?>
                            </td>
                            <td>
                                <a href="article-form.php?event_id=<?= $event['id']; ?>&action=edit"
                                   class="btn btn-warning">Modifier</a>
                                <a onclick="return confirm('Are you sure?')"
                                   href="article-list.php?event_id=<?= $event['id']; ?>&action=delete"
                                   class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    Aucun article enregistré.
                <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>
</html>
