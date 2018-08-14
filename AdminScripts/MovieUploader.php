<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 14.08.2018
 * Time: 13:22
 */

class MovieUploader
{

    private $dataArray;
    private $pdo;

    /**
     * UploadMovie constructor.
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
                $this->insertMovie($entry);
                $this->insertGenreForFilm($entry);
            }
        }
    }

    private function checkIfEntryExists($entry) : bool
    {
        $sql  = "SELECT `name` FROM MOVIE WHERE `name`={$this->pdo->quote($entry[0])}";
        $stmt = $this->pdo->query($sql);

        return empty($stmt->fetchAll());
    }

    private function insertMovie($entry) : void
    {
        $film = array_slice($entry, 0, 2);
        $sql  = "INSERT INTO `MOVIE` (`NAME`, `year`) VALUES ({$this->pdo->quote($film[0])}, {$this->pdo->quote($film[1])})";
        $this->pdo->exec($sql);
    }

    private function insertGenreForFilm($entry) : void
    {
        $genre = array_slice($entry, 2);
        foreach ($genre as $genreToAdd) {
            $genreToAdd = ucwords($genreToAdd);
            $sql        = "INSERT INTO `GENRE_MOVIE` (`movie_id`, `genre_id`) VALUES ((SELECT `id` FROM `MOVIE` WHERE `name`={$this->pdo->quote($entry[0])}), (SELECT `id` FROM GENRE WHERE `name`={$this->pdo->quote($genreToAdd)}))";
            $this->pdo->exec($sql);
        }
    }
}
