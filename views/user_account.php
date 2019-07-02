<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/scss/main.css">
    <title>Mon Compte</title>
</head>
<body>
<?php require "partials/header.php"; ?>
<main id="hidden">
    <?php if ($_SESSION['user']['is_confirmed'] == 0): ?>
        <div class="background">
            <div class="modal">
                <h2>validation de vos informations</h2>

                <div class="content">

                    <div class="fields"><span><b>Nom : </b><?php echo $user['lastname'] ?></span>
                        <span><b>Prenom : </b><?php echo $user['firstname'] ?></span>
                        <span><b>Adresse : </b><?php echo $user['adress'] ?></span>
                        <span><b>Email : </b><?php echo $user['email'] ?></span>
                    </div>

                </div>
                <div class="confirme">
                    <span id="wrong">Il y a une erreur..</span>
                    <button id="right" name="is_confirmed" value="1" type="submit">je valide ces informations</button>

                </div>

            </div>
        </div>

        <div class="personalInfo">
            <h3>To change your erroned information please go to problem signal page and select 'Other' to explain us
                what we
                need to change</h3>
        </div>
    <?php endif; ?>


    <h1>Mes factures</h1>
    <div class="billTable">
        <div class="rowTitle">
            <div class="title useless"><h4>Facture n°</h4></div>
            <div class="title"><h4>Nom</h4></div>
            <div class="title"><h4>Montant</h4></div>
            <div class="title useless"><h4>Date</h4></div>
            <div class="title"><h4>Statut</h4></div>
        </div>
        <div>
            <?php if ($bills) :?>
            <?php foreach ($bills as $bill) : ?>
                <div class="rowContainer">
                    <span class="useless"><?php echo $bill['bill_number'] ?></span>
                    <span><?php echo $bill['name'] ?></span>
                    <span><?php echo $bill['price'] ?></span>
                    <span class="useless"><?php echo $bill['date'] ?></span>
                    <?php if ($bill['acquitted'] == 0) : ?>
                        <button>payer</button>
                    <?php else: ?>
                        <a href="assets/images/<?php echo $bill['pdf'] ?>" target="_blank">payée</a>
                    <?php endif; ?>
                </div>
                <?php  endforeach; ?>
            <?php else: ?>
            <h3 >Aucune facture disponible</h3>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php require "partials/footer.php"; ?>

<script type="text/javascript" src="assets/js/validateInfo.js"></script>
</body>
</html>
