<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_NAME", "login");
        define("DB_PASSWORD", "");

        $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);


//        $namn = filter_input(INPUT_POST, 'namn', FILTER_SANITIZE_SPECIAL_CHARS);
//        $enamn = filter_input(INPUT_POST, 'enamn', FILTER_SANITIZE_SPECIAL_CHARS);
//        $usr = filter_input(INPUT_POST, 'usr', FILTER_SANITIZE_SPECIAL_CHARS);
//        $klass = filter_input(INPUT_POST, 'klass', FILTER_SANITIZE_SPECIAL_CHARS);
//        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $file = fopen("ant/phpcsvfil.csv", "r");

        while (!feof($file)) {
            //print_r(fgetcsv($file, 1000, ";"));
            $arr = fgetcsv($file, 1000, ";");
            //var_dump($arr);
            echo "<br>";
            echo "<tt>namn   : " . $arr[0] . "<br>";
            echo "     enamn: " . $arr[1] . "<br>";
            echo "     usr: " . $arr[2] . "<br>";
            echo "   klass: " . $arr[3] . "<br><br></tt>";
            
            
            $sql = "INSERT INTO `testsak`(`id`,`namn`, `enamn`, `usr`, `klass`) VALUES ('','" . $arr[0] . "','" . $arr[1] . "','" . $arr[2] . "','" . $arr[3] . "')";
            echo $sql;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        }
        fclose($file);
        ?>


    </body>
</html>
