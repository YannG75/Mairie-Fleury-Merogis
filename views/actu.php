<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/scss/main.css">
    <title>Actualités</title>
</head>
<body>
<?php require "partials/header.php"; ?>
<h1>Actualités</h1>
<div class="middle">
    <p>Choisissez la date qui vous intéresse :</p>
    <input type="date" id="date" placeholder="Choisissez une date :"
           aria-label="Use the arrow keys to pick a date">
</div>

<article class="articlesContainer">
    <?php foreach ($allEvent as $event): ?>
    <div class="article">
        <div class="img">
            <img src="assets/images/<?php echo $event['image'] ?>" alt="">
        </div>
        <h4><?php echo $event['title'] ?></h4>
        <p><?php echo $event['summary'] ?></p>

        <a href="index.php?page=article&event_id=<?php echo $event['id']?>"><button>En savoir plus</button></a>
    </div>
    <?php endforeach; ?>
</article>
<?php require "partials/footer.php"; ?>
<script src="assets/js/actu.js"></script>
</body>
</html>