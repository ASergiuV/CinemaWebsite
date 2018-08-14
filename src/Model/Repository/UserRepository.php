<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 17:53
 */

namespace Model\Repository;


use Model\Domain\User;
use PDO;

class UserRepository extends Repository
{
    /**
     * @param $email
     * @param $password
     *
     * @return bool
     */
    public function checkEmailAndPassword($email, $password)
    {
        $stmt = $this->connection->query("SELECT password FROM USER WHERE email = " . $this->connection->quote($email));
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        return in_array($password, $result[0]);
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function checkEmailExist($email) : bool
    {
        $stmt = $this->connection->query("SELECT * FROM USER WHERE email = " . $this->connection->quote($email));
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        return count($stmt->fetchAll()) > 0 ? true : false;
    }

    public function findAll(string $tableName)
    {
        $userArray   = parent::findAll($tableName);
        $returnArray = [];
        foreach ($userArray as $user) {
            $returnArray[] = new User($user['id'], $user['email'], $user['password']);
        }

        return $returnArray;
    }
}
