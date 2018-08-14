<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 14.08.2018
 * Time: 13:23
 */


class RoomUploader
{
    private $dataArray;
    private $pdo;

    /**
     * UploadRoom constructor.
     *
     * @param $dataArray
     * @param $pdo
     */
    public function __construct(array $dataArray, PDO $pdo)
    {
        $this->dataArray = $dataArray;
        $this->pdo       = $pdo;
    }

    public function upload() : void
    {
        foreach ($this->dataArray as $entry) {
            if ($this->checkIfEntryExists($entry) === true) {
                $this->insertRoom($entry);
            }
        }
    }

    private function checkIfEntryExists($entry) : bool
    {
        $sql    = "SELECT `name` FROM ROOM WHERE `name`={$this->pdo->quote($entry[0])}";
        $stmt   = $this->pdo->query($sql);
        return empty($stmt->fetchAll());
    }

    private function insertRoom($entry) : void
    {
        $sql    = "INSERT INTO `ROOM` (`name`) VALUES ({$this->pdo->quote($entry[0])})";
        $this->pdo->exec($sql);
    }
}
