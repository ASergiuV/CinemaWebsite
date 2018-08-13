<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:40
 */

namespace Model\Domain;


class Genre
{
    private $id;
    private $name;

    /**
     * Genre constructor.
     *
     * @param $id
     * @param $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
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
}
