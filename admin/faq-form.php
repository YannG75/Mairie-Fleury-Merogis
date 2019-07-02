<?php
require_once '../tools/common.php';

if (!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0) {
    header('location:../index.php');
    exit;
}

$query_category = $db->query('SELECT * FROM faq_category');
$category_name = $query_category->fetchAll();


if (isset($_POST['save'])) {

    if (!empty($_POST['question']) AND !empty($_POST['reponse']) AND ctype_digit($_POST['categories'])) {
        $query = $db->prepare('INSERT INTO faq (category_id, question, answer) VALUES (?, ?, ?)');
        $faq = $query->execute([
            $_POST['categories'],
            htmlspecialchars_decode($_POST['question']),
            htmlspecialchars_decode($_POST['reponse'])
        ]);

        if ($faq) {
            header('location:faq-list.php');
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
    $query = $db->prepare('UPDATE faq SET
		category_id = :category, question = :question, answer = :reponse
		WHERE id = :id'
    );
    //données du formulaire
    $result = $query->execute([
        'category' => $_POST['categories'],
        'question' => $_POST['question'],
        'reponse' => $_POST['reponse'],
        'id' => $_POST['id']
    ]);
    if ($result) {
        header('location:faq-list.php');
        exit;
    } else {
        $message = "Impossible d'enregistrer la nouvelle categorie...";
    }
}

//si on modifie une catégorie, on doit séléctionner la catégorie en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if (isset($_GET['faq_id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $query = $db->prepare('SELECT * FROM faq WHERE id = ?');
    $query->execute(array($_GET['faq_id']));
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
                <h4><?php if (isset($category)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une combinaison Q/R</h4>
            </header>
            <?php if (isset($message)): //si un message a été généré plus haut, l'afficher ?>
                <div class="bg-danger text-white">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <!-- Si $category existe, chaque champ du formulaire sera pré-remplit avec les informations de la catégorie -->
            <form action="faq-form.php" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <span class="article-category">*</span><label for="categories"> Catégorie </label>
                    <select class="form-control" name="categories" id="categories">

                        <?php foreach ($category_name as $nameCategory) : ?>
                            <?php $selectedCategories = $db->prepare('SELECT * FROM faq WHERE id = ? AND category_id = ?');
                            $selectedCategories->execute(array($_GET['faq_id'], $nameCategory['id']));
                            $SelectedCat = $selectedCategories->fetch();
                            ?>

                            <option value="<?= $nameCategory['id']; ?>" <?= isset($_GET['faq_id']) && $SelectedCat ? 'selected' : ''; ?>>
                                <?= $nameCategory['category_name']; ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="form-group">
                    <span class="article-category">*</span><label for="question">Question :</label>
                    <textarea class="form-control" name="question" id="question"
                              placeholder="question"><?= isset($category) ? $category['question'] : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <span class="article-category">*</span><label for="reponse">Réponse :</label>
                    <textarea class="form-control" name="reponse" id="reponse"
                              placeholder="reponse"><?= isset($category) ? $category['answer'] : ''; ?></textarea>
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
