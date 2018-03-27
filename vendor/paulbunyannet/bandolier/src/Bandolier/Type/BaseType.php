<?php
/**
 * BaseType
 *
 * Base helper type
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type;

class BaseType
{

    /**
     * Arrays constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->initialize($params);
    }

    /**
     * @param array $params
     * @return $this
     */
    protected function initialize(array $params = [])
    {
        $this->hydrate($params);
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    private function hydrate(array $data = array())
    {
        if (!empty($data)) {
            foreach ($data as $field => $value) {
                $this->setData($field, $value);
            }
        }

        return $this;
    }


    /**
     * @param $field
     * @param $value
     * @return $this
     * @throws Collection\Exception\KeyInvalidException
     */
    protected function setData($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->{$field} = $value;
        } else {
            throw new Collection\Exception\KeyInvalidException("Property \"{$field}\" does not exist on \"". get_class($this) ."\".");
        }

        return $this;
    }
}
