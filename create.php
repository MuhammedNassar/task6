<?php
require './CRUD.php';
$errors = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    global $errors;
    $title =  strip_tags($_POST['title']);
    $content = strip_tags($_POST['content']);
    $date = strip_tags($_POST['date']);
    $imgUrl = UplaodPics();

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

        $Message = insertData("insert into blog (title,content,c_date,image) values ('$title','$content','$date','$imgUrl')");
        $_SESSION['msg'] = $Message;
        header("Location:Task6.php");
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
    <title>Add new Content</title>
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title"><b>Title : </b></label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="form-group">
                <label for="conte"><b>Content : </b></label>
                <input type="text" name="content" class="form-control">
            </div>
            <div class="form-group">
                <label for="conte"><b>Date : </b></label>
                <input type="date" name="date" value="2022-01-11" class="form-control">
            </div>
            <div class="form-group">
                <input type="file" name="image">
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
</body>

</html>