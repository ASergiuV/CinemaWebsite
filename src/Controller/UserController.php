<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 07.08.2018
 * Time: 20:22
 */

namespace Controller;


use Model\Repository\UserRepository;

class UserController
{
    private $userRepository;

    /**
     * UserController constructor.
     *
     * @param $dbconn
     */
    public function __construct($dbconn)
    {
        $this->userRepository = new UserRepository($dbconn);
    }

    public function getAll()
    {
        echo "UserController->getALL()";
    }

    public function getOneById(int $id)
    {
        echo "UserController->getOneById(int $id)";
    }
}
