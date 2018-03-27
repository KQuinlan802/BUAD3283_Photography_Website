<?php
/**
 * Numbers
 *
 * Created 3/29/16 4:48 PM
 * Methods for working with numbers or number like strings
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Pbc\Bandolier\Type;

class Numbers
{

    /**
     * Check to see if a number is divisible by another
     * @param $number
     * @param $divisibleBy
     * @return bool
     */
    public static function divisible($number, $divisibleBy) {
        if($number % $divisibleBy === 0) {
            return true;
        }
        return false;
    }

    /**
     * Convert string to float
     * http://php.net/manual/en/function.floatval.php#114486
     *
     * $num = '1.999,369€';
     * var_dump(toFloat($num)); // float(1999.369)
     * $otherNum = '126,564,789.33 m²';
     * var_dump(toFloat($otherNum)); // float(126564789.33)
     *
     * @param mixed $num
     * @return mixed
     */
    public static function toFloat($num)
    {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
        );
    }



    /**
     * Convert number to word
     * http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/ (originally convert_number_to_words)
     *
     * Examples:
     * echo Numbers::toWord(123456789);
     * one hundred and twenty-three million, four hundred and fifty-six thousand, seven hundred and eighty-nine
     *
     * echo Numbers::toWord(123456789.123);
     * one hundred and twenty-three million, four hundred and
     * fifty-six thousand, seven hundred and eighty-nine point one two three
     *
     * echo Numbers::toWord(-1922685.477);
     * negative one million, nine hundred and twenty-two thousand, six hundred and eighty-five point four seven seven
     *
     * float rounding can be avoided by passing the number as a string
     * echo Numbers::toWord(123456789123.12345); // rounds the fractional part
     * one hundred and twenty-three billion, four hundred and fifty-six million, seven hundred and eighty-nine thousand,
     * one hundred and twenty-three point one two
     *
     * echo Numbers::toWord('123456789123.12345'); // does not round
     * one hundred and twenty-three billion, four hundred and fifty-six million, seven hundred and eighty-nine thousand,
     * one hundred and twenty-three point one two three four five
     *
     * @param $number
     * @return bool|mixed|null|string
     * @throws \Exception
     * @SuppressWarnings(PHPMD)
     */
    public static function toWord($number)
    {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary = self::toWordDictionary();

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            throw new \Exception(__METHOD__.' only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX);
        }

        if ($number < 0) {
            return $negative . Numbers::toWord(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Numbers::toWord($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Numbers::toWord($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Numbers::toWord($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

    /**
     * @return array
     */
    public static function toWordDictionary()
    {
        return array(
            0                       => 'zero',
            1                       => 'one',
            2                       => 'two',
            3                       => 'three',
            4                       => 'four',
            5                       => 'five',
            6                       => 'six',
            7                       => 'seven',
            8                       => 'eight',
            9                       => 'nine',
            10                      => 'ten',
            11                      => 'eleven',
            12                      => 'twelve',
            13                      => 'thirteen',
            14                      => 'fourteen',
            15                      => 'fifteen',
            16                      => 'sixteen',
            17                      => 'seventeen',
            18                      => 'eighteen',
            19                      => 'nineteen',
            20                      => 'twenty',
            30                      => 'thirty',
            40                      => 'forty',
            50                      => 'fifty',
            60                      => 'sixty',
            70                      => 'seventy',
            80                      => 'eighty',
            90                      => 'ninety',
            100                     => 'hundred',
            1000                    => 'thousand',
            1000000                 => 'million',
            1000000000              => 'billion',
            1000000000000           => 'trillion',
            1000000000000000        => 'quadrillion',
            1000000000000000000     => 'quintillion',
        );
    }
}
