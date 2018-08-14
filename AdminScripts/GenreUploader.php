<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 14.08.2018
 * Time: 13:18
 */

class GenreUploader
{

    private $dataArray;
    private $pdo;

    /**
     * UploadGenre constructor.
     *
     * @param $dataArray
     * @param $pdo
     */
    public function __construct(array $dataArray,PDO $pdo)
    {
        $this->dataArray = $dataArray;
        $this->pdo       = $pdo;
    }


    public function upload() : void
    {
        $sql = $this->generateSQL($this->dataArray);
        $this->pdo->exec($sql);
    }

    private function generateSQL(array $dataArray) : string
    {
        $sql = "INSERT INTO `genre` (`name`) VALUES";
        foreach ($dataArray as $entry) {
            $sql .= " ({$this->pdo->quote(ucwords($entry[0]))}),";
        }

        return trim($sql, ',');
    }

}
