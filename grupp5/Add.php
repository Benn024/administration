 

<?php
 define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_NAME", "login");
        define("DB_PASSWORD", "");

        $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);

$file = fopen("ant/phpcsvfil.csv", "r");

$sql = "select anvnam from inlog";
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
    
    $needle = 'marben431'; 

$flipped_haystack = array_flip($gamla); 

if ( isset($flipped_haystack[$needle]) ) 
{ 
  print "Yes it's there!"; 
} 
exit();
    
    echo "<br>";
    echo "<tt>namn   : " . $arr[0] . "<br>";
    echo "     enamn: " . $arr[1] . "<br>";
    echo "     anvnam: " . $arr[2] . "<br>";
    echo "   klass: " . $arr[3] . "<br><br></tt>";
    $sql = "INSERT INTO `inlog`(`id`,`namn`, `enamn`, `anvnam`, `klass`) VALUES ('','" . $arr[0] . "','" . $arr[1] . "','" . $arr[2] . "','" . $arr[3] . "')";
//    echo $sqcl;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
}
fclose($file);
?>