<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/scss/main.css">
    <title>Informations sur la ville</title>
</head>
<body>
<?php require "partials/header.php"; ?>
<section class="ville">
    <h2>Presentation de la ville</h2>
    <?php foreach ($city_infos as $info): ?>
    <article class="<?php echo $info['orientation'] ?>">
        <div class="text"><h4><?php echo $info['title_info'] ?></h4>
        <p><?php echo $info['content_info'] ?></p>
        </div>
        <div class="imgContain">
            <img src="assets/images/<?php echo $info['image_info'] ?>" alt="photo de la mairie">
        </div>
    </article>
    <?php endforeach; ?>
</section>
<section class="services">
    <h2>Presentation des services</h2>
    <?php foreach ($city_services as $service): ?>
    <article class="<?php echo $service['orientation'] ?>">
        <div class="imgContain">
            <img src="assets/images/<?php echo $service['service_image'] ?>" alt="photo de la prison">
        </div>
        <div class="text"><h4><?php echo $service['service_title'] ?></h4>
            <p><?php echo $service['service_content'] ?></p>
            <?php if(!empty($service['adress'])): ?>
            <a href="<?php echo $service['adress'] ?>" target="_blank"><button>Y aller</button></a>
            <?php endif; ?>
        </div>

    </article>
        <?php endforeach; ?>
</section>

<?php require "partials/footer.php"; ?>
</body>
</html>
