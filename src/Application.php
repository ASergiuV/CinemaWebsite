<?php

use Controller\MovieController;
use Controller\UserController;
use Util\EncryptionHandler;

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

    /**
     * Returns a one-dimensional array from an array of any depth
     *
     * @param $tokens
     *
     * @return array
     */
    private function flattenArray($tokens)
    {
        $flattenedToken = [];
        $count          = 0;
        $it             = new RecursiveIteratorIterator(new RecursiveArrayIterator($tokens));

        foreach ($it as $v) {
            $flattenedToken[$count] = $v;
            $count++;
            $tokens = $flattenedToken;
        }

        return $tokens;
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
        $pathArray[0] = explode('?', $pathArray[0]);
        $pathArray    = $this->flattenArray($pathArray);
        switch ($pathArray[0]) {
            case 'users':
                $this->listenUsers($pathArray);
                break;
            case 'movies':
                $this->listenMovies($pathArray);
                break;
            case 'filters':
                $this->listenFilters($pathArray);
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
                echo $this->userController->getOneById((int)$pathArray[1])->getContent();
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
                require 'web-src/movies.html';
                break;
            case 2:
                if (!is_numeric($pathArray[1]) && $pathArray[1] === 'all' && isset($_GET)) {
                    echo $this->movieController->getAll()->getContent();
                    break;
                }
                echo $this->movieController->getOneById((int)$pathArray[1])->getContent();
                break;

            default:
                require 'web-src/404.html';
                break;
        }
    }

    private function handleLoginSubmit(array $post)
    {
        if (count($post) === 3) {
            if ($this->userController->checkEmailAndPassword($post['email'],
                EncryptionHandler::encrypt($post['password']))) {
                session_start();
                header('Location: http://www.cinema.local/');
            }
            echo "<script>
                alert('Password or email is invalid');
                </script>";
            header('Refresh: 0; URL=http://www.cinema.local/login');

            return;
        }
        if ($this->userController->checkUserEmailExist($post['email'])) {
            echo "<script>
                alert('E-mail is already in use');
                </script>";
            header('Refresh: 0; URL=http://www.cinema.local/login');

            return;
        }
        if ($post['password'] !== $post['confirm-password']) {
            echo "<script>
                alert('Passwords do not match');
                </script>";
            header('Refresh: 0; URL=http://www.cinema.local/login');


            return;
        }
        $this->userController->addUser($post['email'], EncryptionHandler::encrypt($post['password']));
        session_start();
        header('Location: http://www.cinema.local/');

    }

    private function listenFilters()
    {
        $response = $this->movieController->getAllFiltered()->getContent();
        echo $response;
    }
}
