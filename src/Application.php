<?php

use Controller\MovieController;
use Controller\UserController;
use Util\EncryptionHandler;
use View\View;

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
     * @throws Exception
     */
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
            echo View::render('web-src/home.phtml');

            return;
        }
        switch ($pathArray[0]) {
            case 'users':
                $this->listenUsers($pathArray);
                break;
            case 'movies':
                $this->listenMovies($pathArray);
                break;
            case 'login':
                echo View::render('web-src/login.html');
                break;
            default:
                echo View::render('web-src/404.html');
                break;
        }

    }

    /**
     * @param array $pathArray
     *
     * @throws Exception
     */
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
                echo View::render('web-src/404.html');
                break;
        }
    }

    /**
     * @param array $pathArray
     *
     * @throws Exception
     */
    private function listenMovies(array $pathArray)
    {
        switch (count($pathArray)) {
            case 1:
                $output = View::render('web-src/movies.phtml', [
                    "genre" => $this->movieController->getAllGenres(),
                    "movies" => $this->movieController->getAll()
                ]);
                $output = View::render('web-src/home.phtml', ["containerContent" => $output]);
                echo $output;
                //echo $this->movieController->getAll()->getContent();
                break;
            case 2:
                if (!is_numeric($pathArray[1])) {
                    break;
                }
                echo $this->movieController->getOneById((int)$pathArray[1])->getContent();
                break;

            default:
                echo View::render('web-src/404.html');
                break;
        }
    }

    private function handleLoginSubmit(array $post)
    {
        if (count($post) === 3) {
            if ($this->userController->checkEmailAndPassword($post['email'],
                EncryptionHandler::encrypt($post['password']))) {
                session_start();//aici zice ca nu poate ca headerele au fost trimise
                header('Location: http://www.cinema.local/');
            }//$this->sendAlert('Password or email is invalid');
            echo "<script>
                alert('Password or email is invalid');
                </script>";
            header('Refresh: 0; URL=http://www.cinema.local/login');

            return;
        }
        if ($this->userController->checkUserEmailExist($post['email'])) {
            $this->sendAlert('E-mail is already in use');
            header('Refresh: 0; URL=http://www.cinema.local/login');

            return;
        }
        if ($post['password'] !== $post['confirm-password']) {
            $this->sendAlert('Passwords do not match');
            header('Refresh: 0; URL=http://www.cinema.local/login');


            return;
        }
        $this->userController->addUser($post['email'], EncryptionHandler::encrypt($post['password']));
        session_start();
        header('Location: http://www.cinema.local/');

    }

    private function sendAlert(string $alertMessage)
    {
        echo "<script>
                alert($alertMessage);
                </script>";
    }
}
