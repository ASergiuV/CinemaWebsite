<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 14.08.2018
 * Time: 13:23
 */

class ShowtimeUploader
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
        $sql = $this->generateSQL($this->dataArray);
        $this->pdo->exec($sql);
    }

    private function generateSQL($dataArray) : string
    {
        return "INSERT INTO `SHOWTIME` (`movie_id`, `room_id`, `datetime`) VALUES ({$this->pdo->quote($dataArray['movie'])},{$this->pdo->quote($dataArray['room'])},{$this->pdo->quote($dataArray['date'])})";
    }
}
