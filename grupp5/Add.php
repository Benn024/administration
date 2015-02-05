 

<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_NAME", "berzanapp");
define("DB_PASSWORD", "");

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

$file = fopen("ant/phpcsvfil.csv", "r");

$sql = "select anvnamn from users";
//    echo $sqcl;
$stmt = $dbh->prepare($sql);
$stmt->execute();
$gamla = $stmt->fetchAll();
var_dump($gamla);


while (!feof($file)) {

    $arr = fgetcsv($file, 1000, ";");


//    if (in_array($arr[2], $gamla)){
//        echo $arr[2] . " sant. finns";
//        exit();
//    } else {
//      echo $arr[2] . " finns ej. lägger till.";
//      exit();
//    }
//exit();

    echo "<br>";
    echo "<tt>fornamn   : " . $arr[0] . "<br>";
    echo "     efternamn: " . $arr[1] . "<br>";
    echo "     anvnamn: " . $arr[2] . "<br>";
    echo "   klass: " . $arr[3] . "<br><br></tt>";
    $sql = "INSERT INTO `users`(`fornamn`, `efternamn`, `anvnamn`, `klass`) VALUES ('" . $arr[0] . "','" . $arr[1] . "','" . $arr[2] . "','" . $arr[3] . "')";
    
    VALUES ('johkel123', 'Albin', 'Johansson')
    ON DUPLICATE KEY UPDATE
    username = "johke123",
    surname = "uppdaterad",
    name = "uppdaterad"
    
//    echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
}
fclose($file);
?>