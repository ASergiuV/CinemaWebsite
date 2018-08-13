<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:39
 */

namespace Model\Domain;


class Movie
{
    private $id;
    private $name;
    private $year;
    private $image;
    private $genres;


    /**
     * Movie constructor.
     *
     * @param $id
     * @param $name
     * @param $year
     * @param $image
     * @param $genres
     */
    public function __construct(int $id, string $name, int $year, string $image, array $genres)
    {
        $this->id     = $id;
        $this->name   = $name;
        $this->year   = $year;
        $this->image  = $image;
        $this->genres = $genres;
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
     * @return int
     */
    public function getYear() : int
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getImage() : string
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getGenres() : array
    {
        return $this->genres;
    }

}
