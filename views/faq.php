<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/scss/main.css">
    <title>FAQ</title>
</head>
<body>
<?php require "partials/header.php"; ?>
<main>
    <h1>FAQ</h1>
        <?php for ($i=0; $i<$count; $i++ ): ?>
            <h3><?php echo $faqCat[$i]['category_name'] ?></h3>
        <?php foreach ($faq as $QA): ?>
                    <?php if ($QA['category_id'] == $faqCat[$i]['id']): ?>
                <button class="accordion"><?php echo $QA['question'] ?></button>
                <div class="panel">
                    <p><?php echo $QA['answer'] ?></p>
                </div>
        <?php endif; endforeach;  endfor;?>

</main>
<?php require "partials/footer.php"; ?>
<script src="assets/js/accordion.js"></script>
</body>
</html>
