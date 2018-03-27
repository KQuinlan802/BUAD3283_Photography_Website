<?php
/**
 * Encoded
 *
 * Created 10/3/16 3:13 PM
 * Encoded Class, handling encode strings
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Pbc\Bandolier\Type;

/**
 * Class Encoded
 * @package Pbc\Bandolier\Type
 */
class Encoded
{

    protected static $types = array('json','serialized','base64');

    protected static $base64BadCharacterThreshold = 35;

    /**
     * Find a key inside a string that may or may not be encoded
     * @param $strange
     * @param $thing
     * @return mixed
     */
    public static function getThingThatIsEncoded($strange, $thing)
    {
        $encodeType = self::getEncodeType($strange);
        $unpackMethod = 'unpack'.ucfirst($encodeType);
        switch ($encodeType) {
            case ('json'):
            case ('serialized'):
                $decode = self::$unpackMethod($strange);
                if (array_key_exists($thing, $decode)) {
                    return $decode[$thing];
                }
                break;
            case('base64'):
                $decode = self::$unpackMethod($strange);
                return self::getThingThatIsEncoded($decode, $thing);
        }

        return $strange;
    }

    /**
     * @param $string
     * @return bool|string
     */
    public static function getEncodeType($string)
    {
        $return = false;
        array_walk(self::$types, function($type) use (&$return, $string){
          static $found = false;
          if($found) {
            return;
          }
          $unpackMethod = 'is'.ucfirst($type);
          if (in_array($unpackMethod, get_class_methods(Encoded::class)) && self::$unpackMethod($string)) {
              $found = true;
              $return = $type;
          }
          return;
        });

        return $return;

    }

    /**
     * Check if string is json
     * @param $string
     * @return bool
     */
    public static function isJson($string)
    {
        if (!is_string($string) || (is_string($string)
                && substr($string, 0, 1) !== '{'
                && substr($string, 0, 1) !== '[')
        ) {
            return false;
        }
        @json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Check if string is serialized
     * @param $string
     * @return bool
     */
    public static function isSerialized($string)
    {
        $data = @unserialize($string);
        return $data !== false;
    }

    /**
     * Check and see if a string is base64 encoded
     * https://stackoverflow.com/a/30231906/405758
     * @param $string
     * @return bool
     */
    public static function isBase64($string)
    {
        if(!is_string($string)) return false;

        // Check if there is no invalid character in string
        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

        // Decode the string in strict mode and send the response
        if (!base64_decode($string, true)) return false;

        // Encode and compare it to original one
        if (base64_encode(base64_decode($string, true)) !== $string) return false;

        // http://www.albertmartin.de/blog/code.php/19/base64-detection
        // check for bad character when decoding the base64 string
        $check = str_split(base64_decode($string, true));
        $x = 0;
        array_walk($check, function($char) use (&$x){
            if (ord($char) > 126) $x++;
        });
        //var_dump("Count: ". $x . " " . ($x/count($check)*100) . "%" . PHP_EOL);
        if ($x/count($check)*100 > self::$base64BadCharacterThreshold) return false;

        return true;

    }

    /**
     * @param $string
     * @param bool $associativeArray
     * @return mixed
     */
    public static function unpackJson($string, $associativeArray = true)
    {
        return json_decode($string, $associativeArray);
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function unpackSerialized($string)
    {
        return unserialize($string);
    }

    /**
     * Unpack a base64 encoded string
     * @param $string
     * @return mixed
     */
    public static function unpackBase64($string)
    {
      return base64_decode($string, true);
    }

}
