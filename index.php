<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 03.08.2018
 * Time: 15:59
 */

use Controller\MovieController;
use Controller\UserController;
use Model\Repository\Database;

require './vendor/autoload.php';

function main()
{
    try {
        $db        = new Database();
        $db        = $db->getConnection();
        $movieCtrl = new MovieController($db);
        $userCtrl  = new UserController($db);
        $app       = new Application($movieCtrl, $userCtrl);

        $app->listen();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

main();


