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
    private $room;

    /**
     * Showtime constructor.
     *
     * @param int $id
     * @param DateTime $datetime
     * @param Movie $movie
     * @param Room $room
     */
    public function __construct(int $id, DateTime $datetime, Movie $movie, Room $room)
    {
        $this->id       = $id;
        $this->datetime = $datetime;
        $this->movie    = $movie;
        $this->room     = $room;
    }

    /**
     * @return Room
     */
    public function getRoom() : Room
    {
        return $this->room;
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
