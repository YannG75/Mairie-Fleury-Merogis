<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/scss/main.css">
    <title>Document</title>
</head>
<body>
<?php require "partials/header.php"; ?>
<main>
<h1>Signaler un problème</h1>
<section id="sectionForm">
    <article >
        <form action="index.php?page=report" id="reportForm">
            <label for="first">Motif :</label>
            <select name="first" id="first">
                <?php foreach ($CategoriesToSelect as $category): ?>
                <option value="<?php echo $category['id']?>"><?php echo $category['motif']?></option>
                <?php endforeach; ?>
            </select>
        </form>
    </article>

</section>
</main>
<?php require "partials/footer.php"; ?>
<script src="assets/js/reportForm.js"></script>
</body>
</html>