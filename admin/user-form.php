<?php
require_once '../tools/common.php';

if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 0){
	header('location:../index.php');
	exit;
}
function chaine_aleatoire($nb_car, $chaine = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQMSLDKFJGHWNXBCV123456789!&?%=+-*/')
{
    $nb_lettres = strlen($chaine) - 1;
    $generation = '';
    for($i=0; $i < $nb_car; $i++)
    {
        $pos = mt_rand(0, $nb_lettres);
        $car = $chaine[$pos];
        $generation .= $car;
    }
    return $generation;
}
$mdp = chaine_aleatoire(8);

//Si $_POST['save'] existe, cela signifie que c'est un ajout d'utilisateur
if(isset($_POST['save'])){
	if (!empty($_POST['firstname']) AND !empty($_POST['lastname']) AND !empty($_POST['birthdate']) AND !empty($_POST['adress']) AND !empty($_POST['email']) AND !empty($_POST['phone_number'])){
        $query = $db->prepare('INSERT INTO user (firstname, lastname, birthdate, adress, email, phone_number, password, is_admin ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $newUser = $query->execute([
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['birthdate'],
            $_POST['adress'],
            $_POST['email'],
            $_POST['phone_number'],
            hash('md5', $mdp),
            $_POST['is_admin']
        ]);
    }
	elseif (!empty($_POST['firstname']) AND !empty($_POST['lastname']) AND empty($_POST['birthdate']) AND !empty($_POST['adress']) AND !empty($_POST['email']) AND !empty($_POST['phone_number'])){
        $query = $db->prepare('INSERT INTO user (firstname, lastname, adress, email, phone_number, password, is_admin ) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $newUser = $query->execute([
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['adress'],
            $_POST['email'],
            $_POST['phone_number'],
            hash('md5', $mdp),
            $_POST['is_admin']
        ]);
    }

    elseif (!empty($_POST['firstname']) AND !empty($_POST['lastname']) AND !empty($_POST['birthdate']) AND !empty($_POST['adress']) AND !empty($_POST['email']) AND empty($_POST['phone_number'])){
        $query = $db->prepare('INSERT INTO user (firstname, lastname, birthdate, adress, email, password, is_admin ) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $newUser = $query->execute([
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['birthdate'],
            $_POST['adress'],
            $_POST['email'],
            hash('md5', $mdp),
            $_POST['is_admin']
        ]);
    }

    elseif (!empty($_POST['firstname']) AND !empty($_POST['lastname']) AND empty($_POST['birthdate']) AND !empty($_POST['adress']) AND !empty($_POST['email']) AND empty($_POST['phone_number'])){
        $query = $db->prepare('INSERT INTO user (firstname, lastname, adress, email, password, is_admin ) VALUES (?, ?, ?, ?, ?, ?)');
        $newUser = $query->execute([
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['adress'],
            $_POST['email'],
            hash('md5', $mdp),
            $_POST['is_admin']
        ]);
    }

	if($newUser){
        $to = $_POST['email'];
        $subject = 'changement de mot de passe';
        $message = 'Bonjour ! Voici votre nouveau mot de passe :'. $mdp.'/r Prenez soin de le noter a l\'avenir !';
        $message = wordwrap($message, 70, "\r\n");
        mail($to, $subject, $message);

		header('location:user-list.php');
		exit;
    }
	else{
		$message = "Impossible d'enregistrer le nouvel utilisateur...";
	}
}


if(isset($_POST['update'])){


	$queryString = 'UPDATE user SET firstname = :firstname, lastname = :lastname,adress= :adress, email = :email, is_admin= :is_admin ';

	$queryParameters = [ 
		'firstname' => $_POST['firstname'], 
		'lastname' => $_POST['lastname'],
        'adress' => $_POST['adress'],
		'email' => $_POST['email'],
        'is_admin' => $_POST['is_admin'],
		'id' => $_POST['id']
	];

	if(!empty($_POST['birthdate'])){
        $queryString .= ', birthdate= :birthdate ';
        $queryParameters['birthdate'] = $_POST['birthdate'];
    }

    if(!empty($_POST['phone_number'])){

        $queryString .= ', phone_number= :phone_number ';
        $queryParameters['phone_number'] = $_POST['phone_number'];
    }

	if( !empty($_POST['password'])) {

		$queryString .= ', password = :password ';

		$queryParameters['password'] = hash('md5', $_POST['password']);
	}
	

	$queryString .= 'WHERE id = :id';
	

	$query = $db->prepare($queryString);
	$result = $query->execute($queryParameters);
	
	if($result){
		header('location:user-list.php');
		exit;
	}
	else{
		$message = 'Erreur.';
	}
}


if(isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){
	$query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($_GET['user_id']));

	$user = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration des utilisateurs - Mon premier blog !</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">
			<?php require 'partials/header.php'; ?>
			<div class="row my-3 index-content">
				<?php require 'partials/nav.php'; ?>
				<section class="col-9">
					<header class="pb-3">

						<h4><?php if(isset($user)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un utilisateur</h4>
					</header>
					<?php if(isset($message)):  ?>
					<div class="bg-danger text-white">
						<?= $message; ?>
					</div>
					<?php endif; ?>

					<form action="user-form.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
                            <b class="text-danger">*</b><label for="firstname">Prénom :</label>
							<input class="form-control" value="<?= isset($user) ? htmlentities($user['firstname']) : '';?>" type="text" placeholder="Prénom" name="firstname" id="firstname" />
						</div>
						<div class="form-group">
                            <b class="text-danger">*</b><label for="lastname">Nom de famille : </label>
							<input class="form-control" value="<?= isset($user) ? htmlentities($user['lastname']) : '';?>" type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
						</div>
						<div class="form-group">
							<label for="birthdate">Date de naissance </label>
							<input class="form-control" value="<?= isset($user) ? htmlentities($user['birthdate']) : '';?>" type="date" name="birthdate" id="birthdate" />
						</div>
                        <div class="form-group">
                            <b class="text-danger">*</b><label for="adress">adresse</label>
                            <input class="form-control" value="<?= isset($user) ? htmlentities($user['adress']) : '';?>" type="text" placeholder="Adresse postale" name="adress" id="adress" />
                        </div>
						<div class="form-group">
                            <b class="text-danger">*</b><label for="email">Email :</label>
							<input class="form-control" value="<?= isset($user) ? htmlentities($user['email']) : '';?>" type="email" placeholder="Email" name="email" id="email" />
						</div>
						<div class="form-group">
							<label for="phone_number">telephone :</label>
							<input class="form-control" type="tel" name="phone_number" id="phone_number" placeholder="numéro de telephone"><?= isset($user) ? htmlentities($user['phone_number']) : '';?></input>
						</div>
						<div class="form-group">
                            <b class="text-danger">*</b><label for="is_admin"> Admin ?</label>
							<select class="form-control" name="is_admin" id="is_admin">
								<option value="0" <?= isset($user) && $user['is_admin'] == 0 ? 'selected' : '';?>>Non</option>
								<option value="1" <?= isset($user) && $user['is_admin'] == 1 ? 'selected' : '';?>>Oui</option>
							</select>
						</div>
						<div class="text-right">

							<?php if(isset($user)): ?>
							<input class="btn btn-success" type="submit" name="update" value="Mettre à jour" />

							<?php else: ?>
							<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
							<?php endif; ?>
						</div>

						<?php if(isset($user)): ?>
						<input type="hidden" name="id" value="<?= $user['id']?>" />
						<?php endif; ?>
					</form>
				</section>
			</div>
		</div>
	</body>
</html>
