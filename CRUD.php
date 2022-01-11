<?php
require 'db.php';//database connection
if (!session_start()) {
    session_start();
}
;


function insertData($strQuery) // pass query as param then method return inserted or error
{
    global $con;
    $Messege='';
    $excute= mysqli_query($con,$strQuery);
    if (!$excute) {
          $Messege= 'Error happend while insert data '.mysqli_error($con);
    }else{
           $Messege = 'Data inserted ';
    }
    return $Messege;
}


function updateData($strQuery) // pass query as param then method return Updated or error
{
    global $con;
    $Messege='';
    $excute= mysqli_query($con,$strQuery);
    if (! $excute) {
        $Messege= 'Error happend while updating data '.mysqli_error($con);
    }else{
        $Messege = 'Data Updated ';
    }
    return $Messege;
}



function deleteData($strQuery) // pass query as param then method return Deleted or error
{
    global $con;
    $Messege='';
    $excute= mysqli_query($con,$strQuery);
    if (! $excute) {
         $Messege= 'Error happend while Deleting data '.mysqli_error($con);
    }else{
         $Messege = 'Data Deleted ';
    }
    return $Messege;
}


function clear($strToConvert)
{
    if (!empty($strToConvert)) {
        return $strToConvert = trim(strip_tags(($strToConvert)));
    }
}



function UplaodPics()
{
    if (!empty($_FILES['image']['name'])) {
        $ImageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageExt = explode('.', $ImageName);
        $finalExt = clear(strtolower(end($imageExt)));
        $allowedExt = ['gif', 'jgp', 'png'];
        if (in_array($finalExt, $allowedExt)) {
            $finalname = rand() . time() . '.' . $finalExt;
            $distnationFolder = './uploads/' . $finalname;
            if (move_uploaded_file($imageTemp, $distnationFolder)) {
                return $distnationFolder;
            } else {
                $errors['whileUpload'] = 'Upload faild please try again'; // pass Error
            }
        } else {

            $errors['formatnotAllowed'] = 'Selected Format Not allowed'; // pass Error
        }
    } else {
        global $errors;
        $errors['emptyImage'] = 'Image Field Is Requird';                // pass Error
    }
}