<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_NAME", "berzanapp");
define("DB_PASSWORD", "");

$dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_SERVER . ';charset=utf8', DB_USER, DB_PASSWORD);


if (isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"] == UPLOAD_ERR_OK) {
    ############ Edit settings ##############
    $UploadDirectory = 'D:/xampp/htdocs/administration/grupp5/csv/'; //specify upload directory ends with / (slash)
    ##########################################

    /*
      Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini".
      Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit
      and set them adequately, also check "post_max_size".
     */

    //Is file size is less than allowed size.
    if ($_FILES["FileInput"]["size"] > 5242880) {
        die("File size is too big!");
    }

    switch (strtolower($_FILES['FileInput']['type'])) {
        //allowed file types
        case 'text/csv':
        case 'application/vnd.ms-excel':
            break;


        default:

            die('Unsupported File!'); //output error
    }

    //skapar fil att spara
    $File_Name = strtolower($_FILES['FileInput']['name']);
    $File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
    $Time_Number = time();
    $NewFileName = date("dmy", $Time_Number) . $File_Ext; //new file name

    if (move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory . $NewFileName)) {
        // do other stuff 
//      
        //laddar upp fil till SQL-db
        $file = fopen($UploadDirectory . $NewFileName, "r");

        $sql = "select anvnamn from users";
//    echo $sqcl;
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $gamla = $stmt->fetchAll();
        var_dump($gamla);

        //Skriver ut innehåll i databsen
        while (!feof($file)) {

            $arr = fgetcsv($file, 1000, ";");


            echo "<br>";
            echo "<tt>fornamn   : " . $arr[0] . "<br>";
            echo "     efternamn: " . $arr[1] . "<br>";
            echo "     anvnamn: " . $arr[2] . "<br>";
            echo "   klass: " . $arr[3] . "<br><br></tt>";
            $sql = "INSERT INTO `users`(`fornamn`, `efternamn`, `anvnamn`, `klass`) "
                    . "VALUES ('" . $arr[0] . "','" . $arr[1] . "','" . $arr[2] . "','" . $arr[3] . "')"
                    . " ON DUPLICATE KEY UPDATE anvnamn = '" . $arr[2] . "', efternamn = '" . $arr[1] . "', fornamn = '" . $arr[0] . "'";

            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        }
        fclose($file);

        exit();
    } else {
        die('error uploading File!');
    }
} else {
    die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}

