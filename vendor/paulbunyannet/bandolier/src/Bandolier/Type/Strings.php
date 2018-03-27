<?php

namespace Pbc\Bandolier\Type;

/**
 * Class Strings
 * @package Pbc\Bandolier\Type
 */
/**
 * Class Strings
 * @package Pbc\Bandolier\Type
 */
/**
 * Class Strings
 * @package Pbc\Bandolier\Type
 */
class Strings
{

    /**
     * The cache of stripped slashes strings
     *
     * @var array
     */
    protected static $stripSlashesCache = [];

    /**
     * The cache of title formatted strings
     *
     * @var array
     */
    protected static $formatForTitleCache = [];

    /**
     * The cache of title case strings
     *
     * @var array
     */
    protected static $titleCaseCache = [];

    /**
     * The cache of strip outer quotes
     *
     * @var array
     */
    protected static $stripOuterQuotesCache =  [];

    /**
     * The cache of words to numbers
     *
     * @var array
     */
    protected static $wordsToNumberCache = [];

    /**
     * The cache of studly
     *
     * @var array
     */
    protected static $studlyCache = [];

    /**
     * The cache of camel
     *
     * @var array
     */
    protected static $camelCache = [];

    /**
     * The cache of snake
     *
     * @var array
     */
    protected static $snakeCache;

    /**
     * Convert the given string to lower-case.
     *
     * @param  string  $value
     * @return string
     */
    public static function lower($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * Convert a string to kebab case.
     * @see https://github.com/illuminate/support/blob/master/Str.php#L191
     * @param  string  $value
     * @return string
     */
    public static function kebab($value)
    {
        return static::snake($value, '-');
    }

    /**
     * Convert a string to snake case.
     * @see https://github.com/illuminate/support/blob/master/Str.php#L446
     * @param  string  $value
     * @param  string  $delimiter
     * @return string
     */
    public static function snake($value, $delimiter = '_')
    {
        $key = $value;
        if (isset(static::$snakeCache[$key][$delimiter])) {
            return static::$snakeCache[$key][$delimiter];
        }
        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = static::lower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value));
        }
        return static::$snakeCache[$key][$delimiter] = $value;
    }

    /**
     * Convert a value to camel case.
     * @ see https://github.com/illuminate/support/blob/master/Str.php#L88
     * @param  string  $value
     * @return string
     */
    public static function camel($value)
    {
        if (isset(static::$camelCache[$value])) {
            return static::$camelCache[$value];
        }
        return static::$camelCache[$value] = lcfirst(static::studly($value));
    }

    /**
     * Convert a value to studly caps case.
     * @see https://github.com/illuminate/support/blob/master/Str.php#L487
     * @param  string  $value
     * @return string
     */
    public static function studly($value)
    {
        $key = $value;
        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return static::$studlyCache[$key] = str_replace(' ', '', $value);
    }

    /**
     * Strip wild slashes in strings, with up to triple slash stripping (anymore than that should be handled elsewhere)
     * Example:
     * use Pbc\Bandolier\Type\String;
     * $string = String::stripSlashes('A string with a bunch of \\\ slashes in it');
     *
     * @param $value
     * @return mixed
     */
    public static function stripSlashes($value)
    {
        // if value passed as empty or is not a string then return false
        if (!is_string($value) || strlen($value) === 0) {
            return false;
        }

        /** @var string $cache Cache Value */
        $cache = self::cacheString($value);

        // check for cache
        if (isset(static::$stripSlashesCache[$cache])) {
            return static::$stripSlashesCache[$cache];
        }

        $value = stripslashes($value);
        $value = str_replace("\\\\", "\\", $value);
        $value = str_replace("\\\"", "\"", $value);
        $value = str_replace("\\'", "'", $value);
        $value = str_replace("\\\'", "'", $value);
        $value = str_replace('\\\"', '"', $value);

        return static::$stripSlashesCache[$cache] = $value;
    }

    /**
     * @param $value
     * @return bool|mixed|string
     */
    public static function formatForTitle($value, $delimiters=['-','_'])
    {
        // if value passed as empty or is not a string then return false
        if (!is_string($value) || strlen($value) === 0) {
            return false;
        }

        /** @var string $cache Cache Value */
        $cache = self::cacheString($value, $delimiters);

        // check for cache
        if (isset(static::$formatForTitleCache[$cache])) {
            return static::$formatForTitleCache[$cache];
        }

        // change underscores to spaces
        $stripDelimiters = str_replace($delimiters, array_fill(0, count($delimiters), ' '), $value);

        return static::$formatForTitleCache[$cache] = Strings::titleCase($stripDelimiters);
    }

    /**
     * Convert a string to Title Case
     *
     * @param string $value String to convert
     * @param array $delimiters Delimiters to break into apart words
     * @param array $exceptions strings to skip when capitalizing
     * @return bool|mixed|string
     */
    public static function titleCase(
        $value,
        $delimiters = [" ", "-", ".", "'", "O'", "Mc"],
        $exceptions = ["and", "to", "of", "das", "dos", "I", "II", "III", "IV", "V", "VI"]
    ) {
        // if value passed as empty or is not a string then return false
        if (!is_string($value) || strlen($value) === 0) {
            return false;
        }

        /** @var string $cache Cache Value */
        $cache = self::cacheString($value, $delimiters, $exceptions);

        // check for cache
        if (isset(static::$titleCaseCache[$cache])) {
            return static::$titleCaseCache[$cache];
        }

        /*
         * Exceptions in lower case are words you don't want converted
         * Exceptions all in upper case are any words you don't want converted to title case
         *   but should be converted to upper case, e.g.:
         *   king henry viii or king henry Viii should be King Henry VIII
         */
        $value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $delimiter) {
            $words = explode($delimiter, $value);
            $newWords = [];
            foreach ($words as $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newWords, $word);
            }
            $value = join($delimiter, $newWords);
        }
        return static::$formatForTitleCache[$cache] = $value;
    }

    /**
     * If string starts with
     * http://stackoverflow.com/a/834355/405758
     *
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    /**
     * If string ends with
     * http://stackoverflow.com/a/834355/405758
     *
     * @param $haystack
     * @param $needle
     * @return bool
     * @throws \Exception
     */
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            throw new \Exception("Needle must be one or more characters");
        }

        return (substr($haystack, -$length) === $needle);
    }

    /**
     * @param string $haystack
     * @param mixed $needle
     * @param bool $caseSensitive
     * @return bool
     */
    public static function contains($haystack, $needle, $caseSensitive = true)
    {
        // if needle is an array then check is one of it's values is in the haystack
        if (is_array($needle)) {
            for ($i = 0, $iCount = count($needle); $i < $iCount; $i++) {
                if (self::contains($haystack, $needle[$i], $caseSensitive) === true) {
                    return true;
                }
            }

            return false;
        }

        if ($caseSensitive) {
            return strlen(strstr($haystack, $needle)) > 0;
        } else {
            return strlen(stristr($haystack, $needle)) > 0;
        }
    }

    /**
     * Strip outer quotes from a string
     * @param $value
     * @return bool|string
     */
    public static function stripOuterQuotes($value)
    {
        // if value passed as empty or is not a string then return false
        if (!is_string($value) || strlen($value) === 0) {
            return false;
        }

        /** @var string $cache Cache Value */
        $cache = self::cacheString($value);

        // check for cache
        if (isset(static::$stripOuterQuotesCache[$cache])) {
            return static::$stripOuterQuotesCache[$cache];
        }

        $start = (strlen($value) > 1 && self::startsWith($value, '"'))
            || (strlen($value) > 1 && self::startsWith($value, '\''));

        $end = (strlen($value) > 1 && self::endsWith($value, '"'))
            || (strlen($value) > 1 && self::endsWith($value, '\''));

        if ($start && $end) {
            return static::$stripOuterQuotesCache[$cache] = substr($value, 1, -1);
        }
        return static::$stripOuterQuotesCache[$cache] = $value;
    }

    /**
     * Convert a string such as "one hundred thousand" to 100000.00.
     * https://stackoverflow.com/a/11219737/405758
     *
     * @param string $value The numeric string.
     *
     * @return float|bool
     */
    public static function wordsToNumber($value) {

        // if value passed as empty or is not a string then return false
        if (!is_string($value) || strlen($value) === 0) {
            return false;
        }

        /** @var string $cache Cache Value */
        $cache = self::cacheString($value);

        // check for cache
        if (isset(static::$wordsToNumberCache[$cache])) {
            return static::$wordsToNumberCache[$cache];
        }

        // Replace all number words with an equivalent numeric value
        $value = strtr(
            $value, array_merge(array_flip(Numbers::toWordDictionary()), ['and' => ''])
        );

        // Coerce all tokens to numbers
        $parts = array_map(
            function ($val) {
                return floatval($val);
            },
            preg_split('/[\s-]+/', $value)
        );

        $stack = new \SplStack; // Current work stack
        $sum   = 0; // Running total
        $last  = null;
        foreach ($parts as $part) {
            if (!$stack->isEmpty()) {
                // We're part way through a phrase
                if ($stack->top() > $part) {
                    // Decreasing step, e.g. from hundreds to ones
                    if ($last >= 1000) {
                        // If we drop from more than 1000 then we've finished the phrase
                        $sum += $stack->pop();
                        // This is the first element of a new phrase
                        $stack->push($part);
                    } else {
                        // Drop down from less than 1000, just addition
                        // e.g. "seventy one" -> "70 1" -> "70 + 1"
                        $stack->push($stack->pop() + $part);
                    }
                } else {
                    // Increasing step, e.g ones to hundreds
                    $stack->push($stack->pop() * $part);
                }
            } else {
                // This is the first element of a new phrase
                $stack->push($part);
            }

            // Store the last processed part
            $last = $part;
        }
        return static::$wordsToNumberCache[$cache] = $sum + $stack->pop();
    }

    /**
     * Create a cache string from function attributes
     *
     * @return null|string
     */
    protected static function cacheString()
    {
        $string = null;
        foreach (func_get_args() as $functionArgument) {
            $string .= md5(serialize($functionArgument));
        }

        return $string;
    }
}
