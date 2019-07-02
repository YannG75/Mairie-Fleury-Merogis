<?php
require_once '../tools/common.php';

if (!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0) {
    header('location:../index.php');
    exit;
}

$query_category = $db->query('SELECT * FROM user');
$allBill = $query_category->fetchAll();


if (isset($_POST['save'])) {

    if (ctype_digit($_POST['user_id']) AND !empty($_POST['bill_number']) AND !empty($_POST['name']) AND !empty($_POST['price']) AND !empty($_POST['date']) AND !empty($_FILES['pdf']['tmp_name']) AND ctype_digit($_POST['acquitted'])) {

        $allowed_extensions = ['pdf'];
        $my_file_extension = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);

        if (in_array($my_file_extension, $allowed_extensions)) {
            do {
                $new_file_name = rand();
                $destination = '../assets/images/' . $new_file_name . '.' . $my_file_extension;
                $pdfDestination = $new_file_name . '.' . $my_file_extension;

            } while (file_exists($destination));
        }
        $result = move_uploaded_file($_FILES['pdf']['tmp_name'], $destination);

        $query = $db->prepare('INSERT INTO bill (user_id, bill_number, name, price, date, pdf, acquitted ) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $faq = $query->execute([
            $_POST['user_id'],
            $_POST['bill_number'],
            $_POST['name'],
            $_POST['price'],
            $_POST['date'],
            $pdfDestination,
            $_POST['acquitted']
        ]);

        if ($faq) {
            header('location:bill-list.php');
            exit;
        } else {
            $message = "Impossible d'enregistrer le nouvel ensemble de question/réponse ...";
        }
    } else {
        $message = "Veuillez remplir les champs obligatoires !";
    }

}

//Si $_POST['update'] existe, cela signifie que c'est une mise à jour de catégorie
if (isset($_POST['update'])) {
    $query = $db->prepare('UPDATE bill SET
		user_id = :user_id, bill_number = :bill_number, name = :name, price= :price, date= :date, acquitted= :acquitted
		WHERE id = :id'
    );
    //données du formulaire
    $result = $query->execute([
        'user_id' => $_POST['user_id'],
        'bill_number' => $_POST['bill_number'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'date' => $_POST['date'],
        'acquitted' => $_POST['acquitted'],
        'id' => $_POST['id']

    ]);

    if ($_FILES['pdf']['error'] == 0) {
        $queryDel = $db->prepare('SELECT pdf FROM bill WHERE id = ?');
        $queryDel->execute([
            $_POST['id']
        ]);

        $resultImg = $queryDel->fetch();

        $way = '../assets/images/';
        unlink($way . $resultImg['pdf']);

        $allowed_extensions = ['pdf'];
        $my_file_extension = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);

        if (in_array($my_file_extension, $allowed_extensions)) {
            do {
                $new_file_name = rand();
                $destination = '../assets/images/' . $new_file_name . '.' . $my_file_extension;
                $pdfDestination = $new_file_name . '.' . $my_file_extension;

            } while (file_exists($destination));
        }
        $result = move_uploaded_file($_FILES['pdf']['tmp_name'], $destination);

        $queryImgDel = $db->prepare('UPDATE bill SET pdf = :pdf WHERE id = :id');
        $queryImgDel->execute([
            'pdf' => $pdfDestination,
            'id' => $_POST['id']
        ]);

    }


    if ($result) {
        header('location:bill-list.php');
        exit;
    } else {
        $message = "Impossible d'enregistrer la nouvelle categorie...";
    }
}

//si on modifie une catégorie, on doit séléctionner la catégorie en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['bill_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $query = $db->prepare('SELECT * FROM bill WHERE id = ?');
    $query->execute(array($_GET['bill_id']));
    //$category contiendra les informations de la catégorie dont l'id a été envoyé en paramètre d'URL
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
    <div class="row my-3 index-content">
        <?php require 'partials/nav.php'; ?>
        <section class="col-9">
            <header class="pb-3">
                <!-- Si $category existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4><?php if (isset($category)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une facture</h4>
            </header>
            <?php if (isset($message)): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-danger text-white">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <!-- Si $category existe, chaque champ du formulaire sera pré-remplit avec les informations de la catégorie -->
            <form action="bill-form.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <span class="article-category">*</span><label for="user_id">user_id</label>
                    <select class="form-control" name="user_id" id="user_id">

                        <?php foreach ($allBill as $billId) : ?>
                            <?php $selectedCategories = $db->prepare('SELECT * FROM bill WHERE id = ? AND user_id = ?');
                            $selectedCategories->execute(array($_GET['bill_id'], $billId['id']));
                            $SelectedUser = $selectedCategories->fetch();
                            ?>

                            <option value="<?= $billId['id']; ?>" <?= isset($_GET['faq_id']) && $SelectedUser ? 'selected' : ''; ?>>
                                <?= $billId['id']; ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <span class="article-category">*</span><label for="bill_number">Facture n°</label>
                    <input class="form-control" name="bill_number" id="bill_number" type="text"
                           placeholder="Facture n°" value="<?= isset($category) ? $category['bill_number'] : ''; ?>">
                </div>
                <div class="form-group">
                    <span class="article-category">*</span><label for="name">Intitulé</label>
                    <input class="form-control" name="name" id="name" type="text"
                           placeholder="intitulé" value="<?= isset($category) ? $category['name'] : ''; ?>">
                </div>
                <div class="form-group">
                    <span class="article-category">*</span><label for="price">Montant</label>
                    <input class="form-control" name="price" id="price" type="number"
                           placeholder="Montant" value="<?= isset($category) ? $category['price'] : ''; ?>">
                </div>
                <div class="form-group">
                    <span class="article-category">*</span><label for="date">date</label>
                    <input class="form-control" name="date" id="date" type="date"
                           value="<?= isset($category) ? $category['date'] : ''; ?>">
                </div>
                <div class="form-group">
                    <span class="article-category">*</span><label for="pdf">pdf</label>
                    <input class="form-control" name="pdf" id="pdf" type="file"
                           value="<?= isset($category) ? $category['pdf'] : ''; ?>">
                </div>

                <div class="form-group">
                    <b class="text-danger">*</b><label for="acquitted">Acquittée ?</label>
                    <select class="form-control" name="acquitted" id="acquitted">
                        <option value="0" <?= isset($user) && $user['is_admin'] == 0 ? 'selected' : ''; ?>>Non</option>
                        <option value="1" <?= isset($user) && $user['is_admin'] == 1 ? 'selected' : ''; ?>>Oui</option>
                    </select>
                </div>

                <div class="text-right">
                    <!-- Si $category existe, on affiche un lien de mise à jour -->
                    <?php if (isset($category)): ?>
                        <input class="btn btn-success" type="submit" name="update" value="Mettre à jour"/>
                        <!-- Sinon on afficher un lien d'enregistrement d'une nouvelle catégorie -->
                    <?php else: ?>
                        <input class="btn btn-success" type="submit" name="save" value="Enregistrer"/>
                    <?php endif; ?>
                </div>
                <!-- Si $category existe, on ajoute un champ caché contenant l'id de la catégorie à modifier pour la requête UPDATE -->
                <?php if (isset($category)): ?>
                    <input type="hidden" name="id" value="<?= $category['id'] ?>"/>
                <?php endif; ?>
            </form>
        </section>
    </div>
</div>
</body>
</html>
