<header>
    <nav id="largeMenu">
        <img src="assets/images/logo.png" alt="logo de la ville">
        <a class="home" href="index.php">Accueil</a>
        <a href="index.php?page=info">Infos</a>
        <a href="index.php?page=actus">Actualités</a>
        <a href="index.php?page=report">Signaler un problème</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="index.php?page=account"><p>Mr/Mme <?php echo $_SESSION['user']['lastname']; ?></p></a>
            <a class="d-block btn btn-danger mb-4 mt-2" href="index.php?logout">Déconnexion</a>

        <?php else: ?>

            <a href="index.php?page=login">Se connecter</a>

        <?php endif; ?>
    </nav>
    <div class="mobileContainer">
        <div id="menu-burger">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <img src="assets/images/logo.png" alt="logo de la ville">

    </div>
    <div id="menuBackground"></div>
    <nav id="menu">
        <ul>
            <li><a class="home" href="index.php">Accueil</a></li>
            <li><a href="index.php?page=info">Infos</a></li>
            <li><a href="index.php?page=actus">Actualités</a></li>
            <li><a href="index.php?page=report">Signaler un problème</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="index.php?page=account"><p>Mr/Mme <?php echo $_SESSION['user']['lastname']; ?></p></a></li>
                <li><a href="index.php?logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="index.php?page=login">Se connecter</a></li>
            <?php endif; ?>

        </ul>
    </nav>


</header>
<script type="text/javascript" src="assets/js/burgerMenu.js"></script>