<?php
// load in a bootstrap file
require_once __DIR__ . '/modules/bootstrap.php';
    // now that we have the $request variable created in modules/bootstrap.php
    // we can look for that item in the nav and get the correct page from it
    // default to home
$page = 'home';
// this is pretty much the same as above, just put on seperate lines so it's easier to read...
if (array_key_exists('p', $request)
        && in_array($request['p'], $navItems)
        && file_exists(__DIR__ . '/'. $request['p'].'.php')
    ) {
        $page = $request['p'];
    }
    $endpointSuffix = 'ordering_endpoint';
    // If the request is to an endpoint (p=something_endpoint for instance) we we should check and see if it exists and if it does then require it.
    if (array_key_exists('p', $request)
        && file_exists(__DIR__ . '/'. $request['p'].'.php')
        && substr($request['p'], (strlen($request['p'])-strlen($endpointSuffix)), strlen($request['p'])) === $endpointSuffix
    ) {
        require __DIR__ . '/'. $request['p'].'.php';
       // Optionally you could exit here also since the endpoints should only process and then return success or failure and redirecting
       // exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ordering Prints Endpoint</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <div class="form-result">
        <?php
        echo "<p class='message'>Success! Thank you for ordering your prints from the ordering prints form.</p>";
        ?>
            <table>
              <thead>
                   <tr>
                       <th></th>
                       <th></th>
                   </tr>
               </thead>
               <tbody>
     <?php
        foreach($_GET as $key => $value) {
              if ($key === 'method' || $key === 'submit') {
                    continue;
                        }
                        echo "<tr>
                                <td></td>
                                <td></td>
                              </tr>";
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </body>
            </html>
