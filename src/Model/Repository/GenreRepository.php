<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 13.08.2018
 * Time: 19:14
 */

namespace Model\Repository;


use Model\Domain\Genre;

class GenreRepository extends Repository
{

    public function findAll(string $tableName = 'GENRE') : array
    {
        $returnArray = [];
        $genresArray = parent::findAll($tableName);
        foreach ($genresArray as $genre) {
            $returnArray[] = new Genre($genre['id'], $genre['name']);
        }

        return $returnArray;
    }

    public function findAllAsArray(string $tableName = 'GENRE')
    {
        return parent::findAll($tableName);
    }

    public function findAllMovieGenres(string $tableName = 'GENRE_MOVIE')
    {
        return parent::findAll($tableName);
    }
}
