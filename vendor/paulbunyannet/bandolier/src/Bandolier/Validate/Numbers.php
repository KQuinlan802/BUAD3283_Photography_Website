<?php
/**
 * Numbers
 *
 * Created 11/3/17 10:22 AM
 * Validations for numbers
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Validate
 */

namespace Pbc\Bandolier\Validate;


class Numbers
{
    /**
     *
     * @param $number
     * @param $divisibleBy
     * @return bool
     */
    public static function divisible($number, $divisibleBy) {
        return \Pbc\Bandolier\Type\Numbers::divisible($number, $divisibleBy);
    }
}