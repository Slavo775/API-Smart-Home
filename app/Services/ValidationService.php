<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-23
 * Time: 09:53
 */

namespace App\Services;


use App\Exceptions\ipAdressIsNotValidException;

class ValidationService
{
    /**
     *ip address validation
     *@param ?string $IP_address
     *@throws ipAdressIsNotValidException
     *@return string
     */
    public function validateIPAddress(?string $IP_address) :?string
    {
        if(!isset($IP_address)){
            throw new ipAdressIsNotValidException('This ip Address is not valid!');
        }
        $regex = "^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}.([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$" ;

        if (preg_match($regex, $IP_address)) {
            return $IP_address;
        }
        throw new ipAdressIsNotValidException('This ip Address is not valid!');

    }
}
