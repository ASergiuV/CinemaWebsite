<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 07.08.2018
 * Time: 20:22
 */

namespace Controller;


use Model\Repository\UserRepository;
use Util\HTTP\JsonResponse;

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

    /**
     * @return JsonResponse
     */
    public function getAll() : JsonResponse
    {
        return new JsonResponse($this->userRepository->findAll('USER'));
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function getOneById(int $id) : JsonResponse
    {
        return new JsonResponse($this->userRepository->find($id, 'USER'));
    }

    /**
     * @param $email
     * @param $password
     *
     * @return bool
     */
    public function checkEmailAndPassword($email, $password) : bool
    {
        return $this->userRepository->checkEmailAndPassword($email, $password);
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function checkUserEmailExist($email) : bool
    {
        return $this->userRepository->checkEmailExist($email);
    }

    /**
     * @param $email
     * @param $password
     */
    public function addUser($email, $password)
    {
        $this->userRepository->multiInsert([[
            'email' => $email,
            'password' => $password
        ]], 'USER');
    }
}
