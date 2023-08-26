<?php

namespace Core\Traits;

use RuntimeException;
use Core\Session;

trait Helpers
{

    /**
     * Hashes provided password with BCrypt
     *
     * @param string $string
     * @param int $cost
     * @throws RuntimeException
     *
     * @return string
     */
    public static function getHash(string $string, int $cost = 12):string
    {
        $hash = password_hash($string, PASSWORD_BCRYPT, [
            'cost' => $cost
        ]);

        if ($hash === null) {
            throw new RuntimeException("Hashing algorithm is invalid. Blowfish not supported? ");
        }

        if ($hash === false) {
            throw new RuntimeException("Generate blowfish hash failed");
        }

        return $hash;
    }

    public static function auth():bool
    {
        return Session::instance()->get('isAuth');
    }

    public static function id():int
    {
        return (int) Session::instance()->get('userId');
    }

    
    /**
     * Returns a random string of a specified length
     *
     * @param int $length
     * @return string $key
     */
    public static function getRandomKey(int $length = self::TOKEN_LENGTH):string
    {
        $dictionary = 'A1B2C3D4E5F6G7H8I9J0K1L2M3N4O5P6Q7R8S9T0U1V2W3X4Y5Z6a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6';
        $dictionary_length = strlen($dictionary);
        $key = '';

        for ($i = 0; $i < $length; $i++) {
            $key .= $dictionary[mt_rand(0, $dictionary_length - 1)];
        }

        return $key;
    }

}