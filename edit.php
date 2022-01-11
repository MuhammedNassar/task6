<?php

require './db.php';
require './CRUD.php';
$errors = [];
$id = $_GET['id'];
$selectQuery= "select * from blog where id ='$id'";
$dataObj = mysqli_query($con,$selectQuery);
if (mysqli_num_rows($dataObj) == 1) {   
 $userData = mysqli_fetch_assoc($dataObj);
}
else{
    $_SESSION['msg']='No Rows affect , Id invalid';
    header("Location:Task6.php");
}


function RemoveSpaces($strToConvert)
{
    if (!empty($strToConvert)) {
        return $strToConvert = trim(strip_tags(($strToConvert)));
    }
}


function UplaodPic()
{   
    global $errors;
    if (!empty($_FILES['image']['name'])) {
        $ImageName = $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageExt = explode('.', $ImageName);
        $finalExt = RemoveSpaces(strtolower(end($imageExt)));
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
     
        $errors['emptyImage'] = 'Image Field Is Requird';                // pass Error
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    global $errors;
    global $id;
    $title =  strip_tags($_POST['title']);
    $content = strip_tags($_POST['content']);
    $date = strip_tags($_POST['date']);
    $imgUrl = UplaodPic();

    if (empty($title)) {
        $errors['EmptyTitle'] = 'Title Field Requird';
    }
    if (!is_string($title)) {
        $errors['strName'] = 'only Alphabets allowed';
    }

    if (!empty($content)) {
        if (strlen($content) < 50) {
            $errors['shortContent'] = 'Content Field most contains 50 Chars at least';
        }
    } else {
        $errors['EmptyContent'] = 'Content Field Requird';
    }

    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo '<b> * : ' . $key . ' | ' . $value . '<b><br>';
      
        }
    } else {

        $Message = updateData("update blog set title='$title',content='$content',c_date='$date',image='$imgUrl' where id =$id");
        $_SESSION['msg'] = $Message;
        
    }
   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <title>Edit content</title>
</head>
<style>
  .container {
    position: absolute;
    top:0;
    bottom: 0;
    left: 0;
    right: 0;
    
    margin: auto;
}

</style>
<body>
    <div class="container" style="padding-top: 100px;">
    <div style="height: 400px ; width:500px">
    
    <a href="./task6.php"><<<< Back </a>>
    <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <img style="width: 450px;" src="<?php echo $userData['image'];?>">
            </div>
            <div class="form-group">
                <label for="title"><b>Title : </b></label>
                <input type="text" name="title" value="<?php echo $userData['title'];?>" maxlength="20" class="form-control">
            </div>

            <div class="form-group">
                <label for="conte"><b>Content : </b></label>
                <input type="text" minlength="50" name="content" value="<?php echo $userData['content'];?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="conte"><b>Date : </b></label>
                <input type="date" name="date" value="<?php echo $userData['c_date'];?>" class="form-control">
            </div>
            <div class="form-group">
                <input type="file" name="image">
            </div>
            <input type="submit" value="Submit">


        </form>
        </div>
    </div>
</body>

</html>