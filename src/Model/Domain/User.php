<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 03.08.2018
 * Time: 16:29
 */

namespace Model\Domain;


class User
{
    private $id;
    private $email;
    private $password;

    /**
     * User constructor.
     *
     * @param $id
     * @param $email
     * @param $password
     */
    public function __construct(int $id, string $email, string $password)
    {
        $this->id       = $id;
        $this->email    = $email;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }


}
