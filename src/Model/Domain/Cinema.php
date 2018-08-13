<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:40
 */

namespace Model\Domain;


class Cinema
{
    private $id;
    private $name;
    private $rooms;
    private $movies;

    /**
     * Cinema constructor.
     *
     * @param $id
     * @param $name
     * @param $rooms
     * @param $movies
     */
    public function __construct(int $id, string $name, array $rooms, array $movies)
    {
        $this->id     = $id;
        $this->name   = $name;
        $this->rooms  = $rooms;
        $this->movies = $movies;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRooms() : array
    {
        return $this->rooms;
    }

    /**
     * @return array
     */
    public function getMovies() : array
    {
        return $this->movies;
    }

}
