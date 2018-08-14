<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 19:39
 */

namespace Model\Domain;


class Seat implements \JsonSerializable
{
    private $id;
    private $row;
    private $col;

    /**
     * Seat constructor.
     *
     * @param $id
     * @param $row
     * @param $col
     */
    public function __construct(int $id, int $row, int $col)
    {
        $this->id  = $id;
        $this->row = $row;
        $this->col = $col;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRow() : int
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getCol() : int
    {
        return $this->col;
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
            'row' => $this->getRow(),
            'col' => $this->getCol()
        ];
    }
}
