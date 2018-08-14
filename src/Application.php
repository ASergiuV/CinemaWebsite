<?php

use Controller\MovieController;
use Controller\UserController;

/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 07.08.2018
 * Time: 18:36
 */
class Application
{
    private $movieController;
    private $userController;


    /**
     * Application constructor.
     *
     * @param $movieController
     * @param $userController
     */
    public function __construct(MovieController $movieController, UserController $userController)
    {
        $this->movieController = $movieController;
        $this->userController  = $userController;

    }

    public function listen()
    {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] === 'http://www.cinema.local/login') {
            if (count($_POST) !== 0) {
                $this->handleLoginSubmit($_POST);

                return;
            }
        }
        $pathArray = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        if (count($pathArray) === 1 && $pathArray[0] === '') {
            require 'web-src/home.html';

            return;
        }
        switch ($pathArray[0]) {
            case 'users':
                $this->listenUsers($pathArray);
                break;
            case 'movies':
                $this->listenMovies($pathArray);
                break;
            case 'about':
                require 'web-src/about.html';
                break;
            case 'login':
                require 'web-src/login.html';
                break;
            default:
                require 'web-src/404.html';
                break;
        }

    }

    private function listenUsers(array $pathArray)
    {
        switch (count($pathArray)) {
            case 1:
                echo $this->userController->getAll()->getContent();
                break;
            case 2:
                if (!is_numeric($pathArray[1])) {
                    break;
                }
                $this->userController->getOneById($pathArray[1]);
                break;
            default:
                require 'web-src/404.html';
                break;
        }
    }

    private function listenMovies(array $pathArray)
    {
        switch (count($pathArray)) {
            case 1:
                $this->movieController->getAll();
                break;
            case 2:
                if (!is_numeric($pathArray[1])) {
                    break;
                }
                $this->movieController->getOneById($pathArray[1]);
                break;

            default:
                require 'web-src/404.html';
                break;
        }
    }

    private function handleLoginSubmit(array $post)
    {
        if (count($post) === 3) {
            if ($this->userController->checkEmailAndPassword($post['email'], $post['password'])) {
                session_start();
                //require 'web-src/home.html';
                header('Location: http://www.cinema.local/');

            }

            return;
        }
        if ($this->userController->checkUserEmailExist($post['email'])) {
            echo "E-mail is already in use";

            return;
        }
        if ($post['password'] !== $post['confirm-password']) {
            echo "Passwords do not match";

            return;
        }
        $this->userController->addUser($post['email'], $post['password']);
        session_start();
        header('Location: http://www.cinema.local/');

    }
}
