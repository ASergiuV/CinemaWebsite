<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 08.08.2018
 * Time: 17:53
 */

namespace Model\Repository;


class UserRepository
{
    private $dbconn;

    /**
     * UserRepository constructor.
     *
     * @param $dbconn
     */
    public function __construct($dbconn)
    {
        $this->dbconn = $dbconn;
    }

}