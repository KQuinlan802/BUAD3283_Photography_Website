<?php
/**
 * Arrays
 *
 * Created 10/24/16 9:53 PM
 * Arrays
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Pbc\Bandolier\Type;

/**
 * Class Arrays
 * @package Pbc\Bandolier\Type
 */
class Arrays extends BaseType
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array|string
     */
    protected $attribute;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var mixed
     */
    protected $default = null;

    /**
     * Arrays constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }


    /**
     * From default attribute list, overwrite if key is found
     * @param array $defaults
     * @param array $attributes
     * @return array|bool
     */
    public static function defaultAttributes(array $defaults = [], array $attributes = [])
    {
        return (new Arrays(['data' => $defaults, 'attribute' => $attributes]))->doDefaultAttributes();
    }

    /**
     * From default attribute list, overwrite if key is found
     * @return array|boolean
     */
    public function doDefaultAttributes()
    {
        foreach ($this->attribute as $name => $value) {
            if (array_key_exists($name, $this->data)) {
                $this->data[$name] = $value;
            }
        }
        return ($this->data) ? $this->data : false;
    }

    /**
     * @param array $data
     * @param null $attribute
     * @param null $default
     * @return mixed|null
     */
    public static function getAttribute(array $data, $attribute = null, $default = null)
    {
        return (new Arrays(['data' => $data, 'attribute' => $attribute, 'default' => $default]))->doGetAttribute();
    }

    /**
     * Check for key in array, return default is not found
     * @return mixed
     */
    public function doGetAttribute()
    {
        return array_key_exists($this->attribute, $this->data) ? $this->data[$this->attribute] : $this->default;
    }

    /**
     * Get the key from an array by value
     * @param array $data
     * @param $value
     * @return int|null|string
     */
    public static function getKey(array $data, $value, $default = null)
    {
        return (new Arrays(['data' => $data, 'value' => $value, 'default' => $default]))->doGetKey();
    }

    /** Get key from array by value
     * https://stackoverflow.com/a/26714857/405758
     * @return int|null|string
     */
    public function doGetKey()
    {
        foreach ($this->data as $key => $value) {
            if ($this->value === $value) {
                return $key;
            }
        }

        return $this->default;
    }
}
