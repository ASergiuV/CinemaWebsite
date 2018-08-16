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
    private $showtimeRepo;

    public function __construct(PDO $dbconn)
    {
        parent::__construct($dbconn);
        $this->genreRepo    = new GenreRepository($dbconn);
        $this->showtimeRepo = new ShowtimeRepository($dbconn);
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
            $currentMovieShowtimes = [];
            foreach ($this->showtimeRepo->findByMovieId($movie['id'], 'SHOWTIME') as $showtime) {
                $currentMovieShowtimes[] = $showtime['datetime'];
            }
            $returnArray[] = [
                'movie' =>
                    new Movie($movie['id'], $movie['name'], $movie['year'], $movie['image'],
                        $currentMovieGenre),
                'showtime' => $currentMovieShowtimes
            ];
        }

        return $returnArray;

    }

    public function find(int $id, $tableName = 'MOVIE')
    {
        $movieArray      = parent::find($id, $tableName);
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

    private function addSortToSQL(string $sql) : string
    {
        if (!isset($_GET['sort_by_release'])) {
            return $sql;
        }

        return "$sql ORDER BY year " . strtoupper($_GET['sort_by_release']);
    }

    private function addFiltersToSQL(string $sql) : string
    {

        $firstIsSet = false;
        $pdo        = $this->connection;
        $filters    = [
            'year',
            'genre',
            'date'
        ];
        foreach ($filters as $filter) {
            if ($_GET[$filter] === 'All') {
                continue;
            }
            if ($firstIsSet === false && !empty($_GET[$filter])) {
                $sql        = "SELECT * FROM ($sql) AS unfiltered WHERE $filter LIKE {$pdo->quote("%$_GET[$filter]%")}";
                $firstIsSet = true;
            } else {
                if ($firstIsSet === true && !empty($_GET[$filter])) {
                    $sql = "$sql AND $filter LIKE {$pdo->quote("%$_GET[$filter]%")}";
                }
            }
        }

        return $sql;
    }

    public function findAllFiltered()
    {
        $sql    = "SELECT * FROM (
                SELECT
                  movie.id,
                  movie.name,
                  movie.year,
                  movie.image,
                  (
                  SELECT
                      group_concat(SHOWTIME.datetime)
                    FROM
                      SHOWTIME
                    WHERE
                      movie.id = SHOWTIME.movie_id
                      AND
                      SHOWTIME.datetime > NOW()
                    GROUP BY
                      SHOWTIME.movie_id
                  ) as date,
                  (select group_concat(name) as name from GENRE genre inner join GENRE_MOVIE mg on genre.id=mg.genre_id WHERE movie.id=mg.movie_id GROUP BY mg.movie_id) as genre
                FROM
                  MOVIE movie) AS query
                WHERE
                  query.date IS NOT NULL
                ";
        $sql    = $this->addFiltersToSQL($sql);
        $sql    = $this->addSortToSQL($sql);
        $pdo    = $this->connection;
        $stmt   = $pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $returnArray = [];

        foreach ($result as $detailedMovie) {
            $returnArray[] = [
                'movie' =>
                    new Movie($detailedMovie['id'], $detailedMovie['name'], $detailedMovie['year'],
                        $detailedMovie['image'],
                        explode(',', $detailedMovie['genre'])),
                'showtime' => explode(',', $detailedMovie['date'])
            ];
        }

        return $returnArray;
    }
}
