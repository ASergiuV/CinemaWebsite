<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 07.08.2018
 * Time: 20:22
 */

namespace Controller;


use Model\Repository\MovieRepository;

class MovieController
{
    private $movieRepository;

    /**
     * MovieController constructor.
     *
     * @param $dbconn
     */
    public function __construct($dbconn)
    {
        $this->movieRepository = new MovieRepository($dbconn);
    }

    public function getAll()
    {
        echo "MovieController->getALL()";
    }

    public function getOneById(int $id)
    {
        echo "MovieController->getOneById(int $id)";
    }
}
