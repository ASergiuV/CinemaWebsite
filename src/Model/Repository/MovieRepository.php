<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 17:53
 */

namespace Model\Repository;

use Model\Domain\Movie;
use PDO;

class MovieRepository extends Repository
{
    private $genreRepo;

    public function __construct(PDO $dbconn)
    {
        parent::__construct($dbconn);
        $this->genreRepo = new GenreRepository($dbconn);
    }

    public function findAll($tableName)
    {
        $movieArray  = parent::findAll($tableName);
        $genreArray  = $this->genreRepo->findAll('GENRE');
        $returnArray = [];
        foreach ($movieArray as $movie) {
            $currentMovieGenre = [];
            foreach ($genreArray as $genre) {
                if (in_array($genre['id'], explode(',', $movie['genre']))) {
                    $currentMovieGenre[] = $genre['name'];
                }
            }
            $returnArray[] = new Movie($movie['id'], $movie['name'], $movie['year'], $movie['image'],
                $currentMovieGenre);
        }

        return $returnArray;

    }

}
