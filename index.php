<?php
require_once 'tools/common.php';

if (isset($_GET['page'])) {

    switch ($_GET['page']) {
        case 'info':
            require('./controllers/informations.php');
            break;
        case 'actus':
            require('./controllers/actu.php');
            break;
        case 'article':
            require('./controllers/article.php');
            break;
        case 'legals':
            require('./controllers/legals.php');
            break;
        case 'faq':
            require('./controllers/faq.php');
            break;
        case 'report':
            require('./controllers/report.php');
            break;
        case 'login':
            require('./controllers/login.php');
            break;
        case 'account' :
            require('./controllers/user_account.php');
            break;
        default:
            header('Location : index.php');
            exit;
            break;
    }

} else {
    require('./controllers/index.php');

}