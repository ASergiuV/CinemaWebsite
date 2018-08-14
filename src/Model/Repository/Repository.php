<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 13.08.2018
 * Time: 18:06
 */

namespace Model\Repository;


use PDO;

abstract class Repository
{


    protected $connection;

    /**
     * MovieRepository constructor.
     *
     * @param $dbconn
     */
    public function __construct(PDO $dbconn)
    {
        $this->connection = $dbconn;
    }

    /**
     * Builds and executes a multi-insert query with the given data
     * (i.e. INSERT INTO `table` (`col_1`, `col_2`) VALUES ('val_1', 'val_2'), ('val_3', 'val_4'), [...];
     *
     * @param array $data
     * @param string $tableName
     *
     * @return bool
     */
    public function multiInsertOnDuplicate($data, $tableName)
    {
        // sanity check: do we have data to insert?
        if (empty($data)) {
            return false; // technically, the insert failed, so false
        }

        // sanity check: is the data array in the expected format?
        $columnNames = isset($data[0]) ? array_keys($data[0]) : [];
        if (empty($columnNames)) {
            return false;
        }

        // we need two different structures:
        // - one to hold the placeholders for binding our values,
        // - one to hold the actual values
        $placeholders = [];
        $valuesToBind = [];

        foreach ($data as $i => $row) {
            $params = [];

            foreach ($row as $column => $value) {
                $param                = ":" . $column . $i;
                $params[]             = $param;
                $valuesToBind[$param] = $value;
            }
            $placeholders[] = "(" . implode(", ", $params) . ")";
        }

        //build on duplicate key update
        $onDup = "";
        foreach ($columnNames as $columnName) {
            $onDup .= " " . $this->connection->quote($columnName) . "=VALUES(" . $this->connection->quote($columnName) . "),";
        }
        $onDup = ltrim($onDup, ',');

        // build and prepare the SQL statement
        $sql = "INSERT INTO " . $this->connection->quote($tableName) . " (" . implode(", ",
                $columnNames) . ") VALUES " . implode(", ", $placeholders);//. " ON DUPLICATE KEY UPDATE " . $onDup;

        $stmt = $this->connection->prepare($sql);

        // bind the values
        foreach ($valuesToBind as $param => $value) {
            $stmt->bindValue($param, $value);
        }

        // here we go!
        return $stmt->execute();
    }

    /**
     * Builds and executes a multi-insert query with the given data
     * (i.e. INSERT INTO `table` (`col_1`, `col_2`) VALUES ('val_1', 'val_2'), ('val_3', 'val_4'), [...];
     *
     * @param array $data
     * @param string $tableName
     *
     * @return bool
     */
    public function multiInsert($data, $tableName)
    {
        // sanity check: do we have data to insert?
        if (empty($data)) {
            return false; // technically, the insert failed, so false
        }

        // sanity check: is the data array in the expected format?
        $columnNames = isset($data[0]) ? array_keys($data[0]) : [];
        if (empty($columnNames)) {
            return false;
        }

        // we need two different structures:
        // - one to hold the placeholders for binding our values,
        // - one to hold the actual values
        $placeholders = [];
        $valuesToBind = [];

        foreach ($data as $i => $row) {
            $params = [];

            foreach ($row as $column => $value) {
                $param                = ":" . $column . $i;
                $params[]             = $param;
                $valuesToBind[$param] = $value;
            }
            $placeholders[] = "(" . implode(", ", $params) . ")";
        }

        // build and prepare the SQL statement
        $sql  = "INSERT INTO `$tableName` (" . implode(", ", $columnNames) . ") VALUES " . implode(", ", $placeholders);
        $stmt = $this->connection->prepare($sql);

        // bind the values
        foreach ($valuesToBind as $param => $value) {
            $stmt->bindValue($param, $value);
        }

        // here we go!
        return $stmt->execute();
    }


    /**
     * @param $id
     * @param $tableName
     *
     * @return array
     */
    public function find($id, $tableName)
    {
        $stmt = $this->connection->query("SELECT * FROM $tableName WHERE id = " . $this->connection->quote((int)$id) . "
        ");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    public function findAll($tableName)
    {
        $stmt = $this->connection->prepare("SELECT * FROM $tableName");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }
}
