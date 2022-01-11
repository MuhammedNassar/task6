<?php
require 'db.php';
$SqlQuery = 'Select   * from blog ';
$dataObj = mysqli_query($con, $SqlQuery);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Blog</title>
</head>

<body style=" padding-top:100px">

    <div class="container " style="width: 80%;">
        <?php
        if (isset($_SESSION['msg'])) {?>
        <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Attention!</strong> <?php echo $_SESSION['msg'] ?>
        </div>
        <?php } ?>
        
        <a href="./create.php">Add New </a>>
        <table class="table table-striped table-hover table border ">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            <?php while ($data = mysqli_fetch_assoc($dataObj)) { ?>
                <tr>
                    <td><?php echo $data['id'] ?></td>
                    <td><?php echo $data['title'] ?></td>
                    <td><?php echo $data['content'] ?></td>
                    <td><?php echo $data['c_date'] ?></td>
                    <td>
                        <a class="btn btn-primary" href="edit.php?id=<?php echo $data['id'] ?>">Edit</a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $data['id'] ?>">Remove</a>
                    </td>
                </tr>
            <?php } unset( $_SESSION['msg']); ?>
        </table>

       

        <script>
            $('#myButton').on('click', function() {
                var $btn = $(this).button('loading')
                // business logic...
                $btn.button('reset')
            })
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>

    </div>
</body>

</html>