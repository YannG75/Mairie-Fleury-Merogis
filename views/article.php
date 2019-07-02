<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/scss/main.css">
    <title></title>
</head>
<body>
<?php require "partials/header.php"; ?>
<button onclick="goBack()" class="back">Retour</button>
<h2><?php echo $event['title'] ?></h2>
<section class="articleContainer">
    <div class="imgContainer">
        <img src="assets/images/<?php echo $event['image'] ?>" alt="image d'article">
    </div>

    <p><?php echo $event['content'] ?></p>

    <?php if(isset($galery) AND !empty($galery)): ?>
        <div class="imgGalerie">
            <?php foreach($galery as $image) :?>
            <div class="img">
                <img src="assets/images/<?php echo $image ?>" alt="">
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(!empty($event['video'])): ?>
            <div class="videoContainer">
                <iframe width="100%" height="100%" src="<?php echo $event['video'] ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            </div>
    <?php endif; ?>

</section>
<?php require "partials/footer.php"; ?>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
