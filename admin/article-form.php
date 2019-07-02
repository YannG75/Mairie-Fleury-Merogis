<?php

require_once '../tools/common.php';

if (!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0) {
    header('location:../index.php');
    exit;
}

//Si $_POST['save'] existe, cela signifie que c'est un ajout d'article
if (isset($_POST['save'])) {

    if (!empty($_FILES['image']['tmp_name']) AND !empty($_POST['title']) AND !empty($_POST['content']) AND !empty($_POST['summary']) AND ctype_digit($_POST['is_published']) AND !empty($_POST['published_at']) AND empty($_POST['video'])) {

        $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
        $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (in_array($my_file_extension, $allowed_extensions)) {
            do {
                $new_file_name = rand();
                $destination = '../assets/images/' . $new_file_name . '.' . $my_file_extension;
                $imgDestination = $new_file_name . '.' . $my_file_extension;

            } while (file_exists($destination));
        }
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);


        $query = $db->prepare('INSERT INTO event (title, content, summary, published_at, image , is_published) VALUES (?, ?, ?, ?, ?, ?) ');
        $newArticle = $query->execute([
            $_POST['title'],
            $_POST['content'],
            $_POST['summary'],
            $_POST['published_at'],
            $imgDestination,
            $_POST['is_published']
        ]);

    } elseif (!empty($_FILES['image']['tmp_name']) AND !empty(($_POST['title']) AND !empty($_POST['content']) AND !empty($_POST['summary']) AND ctype_digit($_POST['is_published']) AND !empty($_POST['published_at']) AND filter_input(INPUT_POST, 'video', FILTER_VALIDATE_URL))) {

        $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
        $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (in_array($my_file_extension, $allowed_extensions)) {
            do {
                $new_file_name = rand();
                $destination = '../assets/images/' . $new_file_name . '.' . $my_file_extension;
                $imgDestination = $new_file_name . '.' . $my_file_extension;

            } while (file_exists($destination));
        }
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);


        $query = $db->prepare('INSERT INTO event (title, content, summary, published_at, image, video , is_published) VALUES (?, ?, ?, ?, ?, ?, ?) ');
        $newArticle = $query->execute([
            $_POST['title'],
            $_POST['content'],
            $_POST['summary'],
            $_POST['published_at'],
            $imgDestination,
            $_POST['video'],
            $_POST['is_published']
        ]);

        if ($newArticle) {
            //redirection après enregistrement
            $_SESSION['message'] = 'Article ajouté !';
            header('location:article-list.php');
            exit;
        } else { //si pas $newArticle => enregistrement échoué => générer un message pour l'administrateur à afficher plus bas
            $message = "Impossible d'enregistrer le nouvel article...";
        }

    } else {
        $message = "Merci de remplir tous les champs obligatoire !";
    }

}

//Si $_POST['update'] existe, cela signifie que c'est une mise à jour d'article
if (isset($_POST['update'])) {

    $query = $db->prepare('UPDATE event SET
		title = :title,
		content = :content,
		summary = :summary,
		is_published = :is_published,
		published_at = :published_at
		WHERE id = :id'
    );


    //mise à jour avec les données du formulaire
    $resultArticle = $query->execute([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'summary' => $_POST['summary'],
        'is_published' => $_POST['is_published'],
        'published_at' => $_POST['published_at'],
        'id' => $_POST['id'],
    ]);

    if ($_FILES['image']['error'] == 0) {
        $queryDel = $db->prepare('SELECT image FROM event WHERE id = ?');
        $queryDel->execute([
            $_POST['id']
        ]);

        $resultImg = $queryDel->fetch();

        $way = '../assets/images/';
        unlink($way . $resultImg['image']);

        $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
        $my_file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (in_array($my_file_extension, $allowed_extensions)) {
            do {
                $new_file_name = rand();
                $destination = '../assets/images/' . $new_file_name . '.' . $my_file_extension;
                $imgDestination = $new_file_name . '.' . $my_file_extension;

            } while (file_exists($destination));
        }
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        $queryImgDel = $db->prepare('UPDATE event SET image = :image WHERE id = :id');
        $queryImgDel->execute([
            'image' => $imgDestination,
            'id' => $_POST['id']
        ]);

    }
    if(isset($_POST['video']) AND filter_input(INPUT_POST, 'video', FILTER_VALIDATE_URL)) {
        $queryImgDel = $db->prepare('UPDATE event SET video = :video WHERE id = :id');
        $queryImgDel->execute([
            'video' => $_POST['video'],
            'id' => $_POST['id']
        ]);
    }


    //si enregistrement ok
    if ($resultArticle) {
        $_SESSION['message'] = 'Article mis à jour !';
        header('location:article-list.php');
        exit;
    } else {
        $message = 'Erreur.';
    }
}


//si on modifie un article, on doit séléctionner l'article en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {

    $query = $db->prepare('SELECT * 
    FROM event
    WHERE id = ?');
    $query->execute(array($_GET['event_id']));
    //$article contiendra les informations de l'article dont l'id a été envoyé en paramètre d'URL
    $article = $query->fetch();

}
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
            <header class="pb-3">
                <!-- Si $article existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4><?php if (isset($article)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un évènement</h4>
            </header>
            <?php if (isset($message)): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-danger text-white">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <!-- Si $article existe, chaque champ du formulaire sera pré-remplit avec les informations de l'article -->
            <form action="article-form.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title"><b class="text-danger">*</b>Titre :</label>
                    <input class="form-control" value="<?= isset($article) ? htmlentities($article['title']) : ''; ?>"
                           type="text" placeholder="Titre" name="title" id="title"/>
                </div>
                <div class="form-group">
                    <label for="summary"><b class="text-danger">*</b>Résumé :</label>
                    <input class="form-control" value="<?= isset($article) ? htmlentities($article['summary']) : ''; ?>"
                           type="text" placeholder="Résumé" name="summary" id="summary"/>
                </div>
                <div class="form-group">
                    <label for="content"><b class="text-danger">*</b>Contenu :</label>
                    <textarea class="form-control" name="content" id="content"
                              placeholder="Contenu"><?= isset($article) ? htmlentities($article['content']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="published_at"><b class="text-danger">*</b>Date de publication :</label>
                    <input class="form-control"
                           value="<?= isset($article) ? htmlentities($article['published_at']) : ''; ?>" type="date"
                           placeholder="Résumé" name="published_at" id="published_at"/>
                </div>

                <div class="form-group">
                    <label for="is_published"><b class="text-danger">*</b>Publié ?</label>
                    <select class="form-control" name="is_published" id="is_published">
                        <option value="0" <?= isset($article) && $article['is_published'] == 0 ? 'selected' : ''; ?>>
                            Non
                        </option>
                        <option value="1" <?= isset($article) && $article['is_published'] == 1 ? 'selected' : ''; ?>>
                            Oui
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image"><b class="text-danger">*</b>Image :</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="video">Video youtube :</label>
                    <input class="form-control" type="url" name="video" id="video" placeholder="Url de la vidéo">
                </div>


                <div class="text-right">
                    <!-- Si $article existe, on affiche un lien de mise à jour -->
                    <?php if (isset($article)): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                        <!-- Sinon on afficher un lien d'enregistrement d'un nouvel article -->
                    <?php else: ?>
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                    <?php endif; ?>
                </div>

                <!-- Si $article existe, on ajoute un champ caché contenant l'id de l'article à modifier pour la requête UPDATE -->
                <?php if (isset($article)): ?>
                    <input type="hidden" name="id" value="<?= $article['id']; ?>"/>
                <?php endif; ?>


            </form>

        </section>
    </div>
</div>
</body>
</html>
