<?php session_start();
require_once '../components/db_connect.php';

if (isset($_SESSION['user']) != "") {
    header("Location: ../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}
$sql = "SELECT * FROM cars JOIN rental ON rental.fk_car_id = cars.car_id JOIN users ON rental.fk_user_id = users.user_id";
$result = mysqli_query($connect, $sql);
$tbody = ''; //this variable will hold the body for the table
if (mysqli_num_rows($result)  > 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td>" . $row['fname'] . " " . $row['lname'] . "</td>
            <td>" . $row['brand'] . " " . $row['model'] . "</td>
            <td>" . $row['rental_date'] . "</td>
            <td><a href='delete.php?id=" . $row['rental_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
            </tr>";
    };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentals</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">
        .manageProduct {
            margin: auto;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="manageProduct w-75 mt-3">
        <div class='mb-3'>
            <a href="../dashboard.php"><button class='btn btn-success' type="button">Dashboard</button></a>
        </div>
        <p class='h2'>Rentals</p>
        <table class='table table-striped'>
            <thead class='table-success'>
                <tr>
                    <th>User</th>
                    <th>Car</th>
                    <th>Rental Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $tbody; ?>
            </tbody>
        </table>
    </div>
</body>
</html>