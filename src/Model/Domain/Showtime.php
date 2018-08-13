<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:49
 */

namespace Model\Domain;


use DateTime;

class Showtime
{
    private $id;
    private $datetime;
    private $movie;

    /**
     * Showtime constructor.
     *
     * @param $id
     * @param $datetime
     * @param $movie
     */
    public function __construct(int $id,DateTime $datetime, Movie $movie)
    {
        $this->id       = $id;
        $this->datetime = $datetime;
        $this->movie    = $movie;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getDatetime() : DateTime
    {
        return $this->datetime;
    }

    /**
     * @return Movie
     */
    public function getMovie() : Movie
    {
        return $this->movie;
    }

}
