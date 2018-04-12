<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Endpoint</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <div class="form-result">
        <?php
        echo "<p class='message'>Hey {$_GET['name']}, thank you for scheduling your appointment from the {$_GET['method']} book an appointment form.</p>";
        ?>
            <table>
              <thead>
                   <tr>
                       <th>Field</th>
                       <th>Value</th>
                   </tr>
               </thead>
               <tbody>
     <?php
        foreach($_GET as $key => $value) {
              if ($key === 'method' || $key === 'submit') {
                    continue;
                        }
                        echo "<tr>
                                <td>{$key}</td>
                                <td>{$value}</td>
                              </tr>";
                    }
                    ?>
                            </tbody>
                        </table>
                    </div>
                </body>
            </html>
