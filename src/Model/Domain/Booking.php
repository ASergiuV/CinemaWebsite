<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:40
 */

namespace Model\Domain;


class Booking
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

}
