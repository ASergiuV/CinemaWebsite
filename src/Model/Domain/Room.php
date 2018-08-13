<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:39
 */

namespace Model\Domain;


class Room
{
    private $id;
    private $name;
    private $seats;

    /**
     * Room constructor.
     *
     * @param $id
     * @param $name
     * @param $seats
     */
    public function __construct(int $id, string $name, array $seats)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->seats = $seats;
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
    public function getSeats() : array
    {
        return $this->seats;
    }


}
