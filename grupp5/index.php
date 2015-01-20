<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $file = fopen("ant/phpcsvfil.csv", "r");
            
            while(! feof($file)){
                print_r(fgetcsv($file, 1000, ";"));
            }
            
            fclose($file);
        ?>
    </body>
</html>
