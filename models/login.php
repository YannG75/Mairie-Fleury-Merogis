<?php
function login(){
    $db = dbConnect();
    if(empty($_POST['connxionID']) OR empty($_POST['password'])){
        $loginError = "Merci de remplir tous les champs";
    }
    else{
        //on cherche un utilisateur correspondant au couple email / password renseigné
        $query = $db->prepare('SELECT *
			FROM user
			WHERE email = ? AND password = ?');
        $query->execute( array( $_POST['connxionID'], hash('md5', $_POST['password']), ) );
        $user = $query->fetch();

        //si un utilisateur correspond
        if($user){
            //on prend en session ses droits d'administration pour vérifier s'il a la permission d'accès au back-office
            $_SESSION['user']['is_admin'] = $user['is_admin'];
            $_SESSION['user']['lastname'] = $user['lastname'];
            $_SESSION['user']['is_confirmed'] = $user['is_confirmed'];

            $_SESSION['user']['id'] = $user['id'];
        }
        else{ //si pas d'utilisateur correspondant on génère un message pour l'afficher plus bas
            $loginError = "Mauvais identifiants";
        }
    }
    return $loginError;
}

