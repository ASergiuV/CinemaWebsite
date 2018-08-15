<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 07.08.2018
 * Time: 20:22
 */

namespace Controller;


use Model\Repository\GenreRepository;
use Model\Repository\MovieRepository;
use Util\HTTP\JsonResponse;

class MovieController
{
    private $movieRepository;
    private $genreRepository;

    /**
     * MovieController constructor.
     *
     * @param $dbconn
     */
    public function __construct($dbconn)
    {
        $this->movieRepository = new MovieRepository($dbconn);
        $this->genreRepository = new GenreRepository($dbconn);
    }

    public function getAll() : array
    {
        return $this->movieRepository->findAll();
    }

    public function getOneById(int $id) : JsonResponse
    {
        return new JsonResponse($this->movieRepository->find($id));
    }

    public function getAllGenres() : array
    {
        return $this->genreRepository->findAllAsArray();
    }
}
