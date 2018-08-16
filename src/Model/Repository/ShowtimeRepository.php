<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 13.08.2018
 * Time: 19:15
 */

namespace Model\Repository;


use PDO;

class ShowtimeRepository extends Repository
{
    /**
     * @param $id
     * @param $tableName
     *
     * @return array
     */
    public function findByMovieId(int $id, string $tableName)
    {
        $stmt = $this->connection->query("SELECT * FROM $tableName WHERE movie_id = " . $this->connection->quote((int)$id) . "
        AND datetime>NOW() ORDER BY datetime ASC ");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }
}
