<?php
if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{
    ############ Edit settings ##############
    $UploadDirectory    = 'D:/xampp/htdocs/administration/grupp5/csv/'; //specify upload directory ends with / (slash)
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
    
    
    $File_Name          = strtolower($_FILES['FileInput']['name']);
    $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
    $Time_Number      = time();
    $NewFileName        = $Time_Number.$File_Ext; //new file name
    
    if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
       {
        // do other stuff 
               die('Success! File Uploaded.');
    }else{
        die('error uploading File!');
    }
    
}
else
{
    die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}