<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 07.08.2018
 * Time: 20:22
 */

namespace Controller;


use Model\Repository\MovieRepository;
use Util\HTTP\JsonResponse;

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
        return new JsonResponse($this->movieRepository->findAll());
    }

    public function getOneById(int $id)
    {
        return new JsonResponse($this->movieRepository->find($id));
    }
}
