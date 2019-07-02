<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
    <link rel="stylesheet" href="assets/scss/main.css">
    <link rel="stylesheet" href="assets/css/fa-5.5.0/all.min.css">


    <title>Document</title>
</head>
<body>
<?php require "partials/header.php"; ?>
<h1>Dernières actus</h1>
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <?php foreach ($lastEvent as $event): ?>
        <div class="swiper-slide"><img src="assets/images/<?php echo $event['image'] ?>" alt="" class="img img-fluid">
            <div class="swiper-subject">
                <h2><?php echo $event['title'] ?></h2>
                <p><?php echo $event['summary'] ?></p>
                <a href="index.php?page=article&event_id=<?php echo $event['id'] ?>">
                    <button>En savoir plus</button>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>


</div>

<?php require "partials/footer.php" ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<script src="assets/js/caroussel.js"></script>
</body>
</html>