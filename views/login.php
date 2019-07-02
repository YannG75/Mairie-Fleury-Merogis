<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/scss/main.css">
    <title>Connexion</title>
</head>
<body>
<?php require "partials/header.php"; ?>
<main>
<h1>Connexion</h1>
<section id="loginContainer">

    <div>
        <form action="index.php?page=login" name="connexion" method="post" id="connexion">
        <label for="connxionID">Identifiant :</label>
        <input name="connxionID" value="<?= isset($loginError) ? $_POST['connxionID'] : '' ?>" type="email" placeholder="Identifiant">
            <label for="password">Mot de passe :</label>
        <input type="password" name="password" placeholder="Mot de passe">

            <button type="submit" name="login" form="connexion">Se connecter</button>

            <?php if(isset($loginError)): ?>
                <span style="color: red"><?php echo $loginError; ?></span>
            <?php endif; ?>
        </form>

    </div>
</section>
</main>
<?php require "partials/footer.php"; ?>
</body>
</html>
