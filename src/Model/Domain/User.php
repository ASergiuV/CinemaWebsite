<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 03.08.2018
 * Time: 16:29
 */

namespace Model\Domain;


use Util\EncryptionHandler;

class User implements \JsonSerializable
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


    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];
        //EncryptionHandler::decrypt($this->getPassword());
    }
}
