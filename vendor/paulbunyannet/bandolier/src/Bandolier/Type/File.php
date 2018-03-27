<?php
/**
 * File
 *
 * Created 9/30/15 4:19 PM
 * Description of this file here....
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type;

/**
 * Class File
 * @package Pbc\Bandolier\Type
 */
class File
{

    /**
     * Recursively List All Files In Directory
     * http://stackoverflow.com/a/24784144/405758
     *
     * @param $dir
     * @param array $results
     * @return array
     */
    public static function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else {
                if (is_dir($path) && $value != "." && $value != "..") {
                    File::getDirContents($path, $results);
                    $results[] = $path;
                }
            }
        }

        return $results;
    }
}
