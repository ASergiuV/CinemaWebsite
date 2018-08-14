<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 14.08.2018
 * Time: 14:04
 */


use Model\Repository\Database;

$db        = new Database();
$conn      = $db->getConnection();
$adminCtrl = new AdminController($conn);
$adminCtrl->run();
