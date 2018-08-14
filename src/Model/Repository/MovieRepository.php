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

    public function findAll($tableName = 'MOVIE')
    {
        $movieArray      = parent::findAll($tableName);
        $genreArray      = $this->genreRepo->findAll('GENRE');
        $movieGenreArray = $this->genreRepo->findAll('GENRE_MOVIE');
        $returnArray     = [];
        foreach ($movieArray as $movie) {
            $currentMovieGenre = [];
            foreach ($movieGenreArray as $movieGenre) {
                if (in_array($movieGenre['movie_id'], explode(',', $movie['id']))) {
                    foreach ($genreArray as $genre) {
                        if ($genre['id'] === $movieGenre['genre_id']) {
                            $currentMovieGenre[] = $genre['name'];
                        }
                    }
                }
            }
            $returnArray[] = new Movie($movie['id'], $movie['name'], $movie['year'], $movie['image'],
                $currentMovieGenre);
        }

        return $returnArray;

    }

}
