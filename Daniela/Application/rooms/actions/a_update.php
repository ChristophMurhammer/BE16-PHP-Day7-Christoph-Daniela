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
    $picture = $_POST['picture'];
    $id = $_POST['id'];
    //variable for upload pictures errors is initialised
    $uploadError = '';

    $picture = file_upload($_FILES['picture'], 'room'); //file_upload() called  
    if ($picture->error === 0) {
        ($_POST["picture"] == "room.jpg") ?: unlink("../pictures/$_POST[picture]");
        $sql = "UPDATE rooms SET description = '$description', capacity = '$capacity', statuss = '$statuss', price = $price, picture = '$picture->fileName' WHERE id = {$id}";
    } else {
        $sql = "UPDATE rooms SET description = '$description', capacity = '$capacity', statuss = '$statuss', price = $price WHERE id = {$id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../../dashboard.php'><button class="btn btn-success" type='button'>Dashboard</button></a>
        </div>
    </div>
</body>
</html>