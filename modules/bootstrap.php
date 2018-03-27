<?php
// to any functionality needed for the site here...

// Let's make a request variable and add any requests passed to the index to it:
$request = [];
// if we're running in command line, get requests like p=home
if (php_sapi_name() == "cli") {
    array_walk($argv, function($item) use (&$request){
        if (strpos($item, '=') !== false) {
            $parts = explode('=', $item);
            $key = array_shift($parts);
            $request[$key] = implode('=', $parts);
        }
        return null;
    });
// otherwise just get the requests from the $_REQUEST array
} else {
    array_walk($_REQUEST, function($value, $key) use (&$request){
        $request[$key] = $value;
    });
}
// filter out any empty array items
$request = array_filter($request);

// navigation is extracted to it's own module
require __DIR__ . '/navigation.php';
