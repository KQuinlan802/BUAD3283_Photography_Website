<?php
/**
 * Utility
 *
 * Created 5/31/17 4:33 PM
 * Utility class
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Pbc\Bandolier\Type;

class Utility
{

    /**
     * Grab IP from host
     * http://www.php.net/manual/en/function.gethostbyname.php#78965
     * @param $address
     * @return mixed
     */
    public static function lookUpHostIp($address)
    {

        $ipAddress = null;
        if (function_exists('dns_get_record')) {
            $records = dns_get_record(trim($address));
            foreach ($records as $record) {
                if ($record['type'] == 'A') {
                    $ipAddress = $record['ip'];
                }
            }
        }
        return $ipAddress;
    }
}
