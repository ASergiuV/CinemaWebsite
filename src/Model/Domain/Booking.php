<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:40
 */

namespace Model\Domain;


class Booking implements \JsonSerializable
{
    private $id;
    private $showtime;
    private $user;
    private $seat;

    /**
     * Booking constructor.
     *
     * @param $id
     * @param $showtime
     * @param $user
     * @param $seat
     */
    public function __construct(int $id, Showtime $showtime, User $user, Seat $seat)
    {
        $this->id       = $id;
        $this->showtime = $showtime;
        $this->user     = $user;
        $this->seat     = $seat;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }


    /**
     * @return Showtime
     */
    public function getShowtime() : Showtime
    {
        return $this->showtime;
    }

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @return Seat
     */
    public function getSeat() : Seat
    {
        return $this->seat;
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
            'showtime' => json_encode($this->getShowtime()),
            'user' => json_encode($this->getUser()),
            'seat' => json_encode($this->getSeat())
        ];
    }
}
