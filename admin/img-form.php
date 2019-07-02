<?php
require_once '../tools/common.php';

if (!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0) {
    header('location:../index.php');
    exit;
}

$query_category = $db->query('SELECT * FROM event');
$evenstId = $query_category->fetchAll();


if (isset($_POST['save'])) {
    if (!empty($_FILES['secondary_image']['tmp_name'])) {

        $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
        $my_file_extension = pathinfo($_FILES['secondary_image']['name'], PATHINFO_EXTENSION);

        if (in_array($my_file_extension, $allowed_extensions)) {
            do {
                $new_file_name = rand();
                $destination = '../assets/images/' . $new_file_name . '.' . $my_file_extension;
                $imgDestination = $new_file_name . '.' . $my_file_extension;

            } while (file_exists($destination));
        }
        $result = move_uploaded_file($_FILES['secondary_image']['tmp_name'], $destination);

        $query = $db->prepare('INSERT INTO image_galery (event_id, secondary_image) VALUES (?, ?)');
        $sImg = $query->execute([
            $_POST['event_id'],
            $imgDestination

        ]);

        if ($sImg) {
            header('location:img-list.php');
            exit;
        } else {
            $message = "Impossible d'enregistrer la nouvelle image !";
        }
    } else {
        $message = "Veuillez remplir les champs obligatoires !";
    }

}


if (isset($_POST['update'])) {

    $queryImgDel = $db->prepare('UPDATE image_galery SET event_id = :event_id WHERE id = :id');
    $queryImgDel->execute([
        'event_id' => $_POST['event_id'],
        'id' => $_POST['id']
    ]);

       if ($_FILES['secondary_image']['error'] == 0) {
        $queryDel = $db->prepare('SELECT secondary_image FROM image_galery WHERE id = ?');
        $queryDel->execute([
            $_POST['id']
        ]);

        $resultImg = $queryDel->fetch();

        $way = '../assets/images/';
        unlink($way . $resultImg['secondary_image']);

        $allowed_extensions = ['jpg', 'jpeg', 'gif', 'png'];
        $my_file_extension = pathinfo($_FILES['secondary_image']['name'], PATHINFO_EXTENSION);

        if (in_array($my_file_extension, $allowed_extensions)) {
            do {
                $new_file_name = rand();
                $destination = '../assets/images/' . $new_file_name . '.' . $my_file_extension;
                $imgDestination = $new_file_name . '.' . $my_file_extension;

            } while (file_exists($destination));
        }
        $result = move_uploaded_file($_FILES['secondary_image']['tmp_name'], $destination);

        $queryImgDel = $db->prepare('UPDATE image_galery SET  event_id= :event_id, secondary_image = :secondary_image WHERE id = :id');
        $queryImgDel->execute([
            'event_id' => $_POST['event_id'],
            'secondary_image' => $imgDestination,
            'id' => $_POST['id']
        ]);

    }
    if ($queryImgDel) {
        header('location:img-list.php');
        exit;
    } else {
        $message = "Impossible d'enregistrer la nouvelle categorie...";
    }
}

if (isset($_GET['event_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $query = $db->prepare('SELECT * FROM image_galery WHERE id = ?');
    $query->execute(array($_GET['event_id']));

    $category = $query->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration de la faq - Mon premier blog !</title>
    <?php require 'partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">
    <?php require 'partials/header.php'; ?>
    <div class="row my-3 index-content"><?php require 'partials/nav.php'; ?>
        <section class="col-9">
            <header class="pb-3">
                <h4><?php if (isset($category)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une image
                    secondaire</h4>
            </header>
            <?php if (isset($message)): ?>
                <div class="bg-danger text-white">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <form action="img-form.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <span class="article-category">*</span><label for="event_id">Evenement</label>
                    <select class="form-control" name="event_id" id="event_id">

                        <?php foreach ($evenstId as $eventId) : ?>
                            <?php $selectedCategories = $db->prepare('SELECT * FROM image_galery WHERE id = ? AND event_id = ?');
                            $selectedCategories->execute(array($_GET['event_id'], $eventId['id']));
                            $SelectedCat = $selectedCategories->fetch();
                            ?>

                            <option value="<?= $eventId['id']; ?>" <?= isset($_GET['event_id']) && $SelectedCat ? 'selected' : ''; ?>>
                                <?= $eventId['title']; ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="form-group">
                    <span class="article-category">*</span><label for="secondary_image">Image secondaire</label>
                    <input class="form-control" name="secondary_image" id="secondary_image" type="file"
                           value="<?= isset($category) ? $category['secondary_image'] : ''; ?>">
                </div>
                <div class="text-right">

                    <?php if (isset($category)): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>

                    <?php else: ?>
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                    <?php endif; ?>
                </div>

                <?php if (isset($category)): ?>
                    <input type="hidden" name="id" value="<?= $category['id'] ?>"/>
                <?php endif; ?>
            </form>
        </section>
    </div>
</div>
</body>
</html>

