<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}

require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';


if ($_POST) {
    $description = $_POST['description'];
    $capacity = $_POST['capacity'];
    $statuss = $_POST['statuss'];
    $price = $_POST['price'];
    $picture = file_upload($_FILES['picture'], "room");

    $sql = "INSERT INTO rooms (description, capacity, statuss, price, picture) VALUES ('$description', '$capacity', '$statuss', '$price', '$picture->fileName')";


    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $description</td>
            <td> $price </td>
            </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);

}else {
    header("location: ../error.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../../components/boot.php" ?>
    <title>Create response</title>
</head>
<body>
    


<div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../../dashboard.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
</div>



</body>
</html>