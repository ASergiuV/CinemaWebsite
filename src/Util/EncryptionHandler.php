<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 09.08.2018
 * Time: 16:14
 */

namespace Util;


class EncryptionHandler
{
    const SECRET_KEY = 'Ilovemysixpacksomuch,';
    const SECRET_IV = 'Iprotectitwithalayeroffat.';
    const ENCRYPT_METHOD = "AES-256-CBC";

    public static function encrypt($string)
    {
        $output = false;

        $key    = hash('sha256', EncryptionHandler::SECRET_KEY);
        $iv     = substr(hash('sha256', EncryptionHandler::SECRET_IV), 0, 16);
        $output = base64_encode(openssl_encrypt($string, EncryptionHandler::ENCRYPT_METHOD, $key, 0, $iv));

        return $output;
    }

    public static function decrypt($string)
    {
        $output = false;

        $key    = hash('sha256', EncryptionHandler::SECRET_KEY);
        $iv     = substr(hash('sha256', EncryptionHandler::SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), EncryptionHandler::ENCRYPT_METHOD, $key, 0, $iv);

        return $output;
    }
}
