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
            $this->handleLoginSubmit($_POST);
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
                $this->userController->getAll();
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
            //asta inseamna login
            //prima pozitie e mail
            //a doua e password si a 3a e 'Log In'
            return;
        }
        //asta inseamna register
        //prima pozitie e mail
        //a doua e password si a 3a e confirm password si a 4a e Register Now

    }
}
