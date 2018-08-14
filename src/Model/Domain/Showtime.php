<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:49
 */

namespace Model\Domain;


use DateTime;

class Showtime implements \JsonSerializable
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
    public function __construct(int $id, string $datetime, Movie $movie, Room $room)
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
    public function getDatetime() : string
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

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'datetime' => $this->getDatetime(),
            'movie' => json_encode($this->getMovie()),
            'room' => json_encode($this->getRoom())
        ];
    }
}
