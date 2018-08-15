<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:39
 */

namespace Model\Domain;


class Movie implements \JsonSerializable
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
            'name' => $this->getName(),
            'year' => $this->getYear(),
            'image' => $this->getImage(),
            'genres' => json_encode($this->getGenres(), JSON_UNESCAPED_UNICODE)
        ];
    }
}
