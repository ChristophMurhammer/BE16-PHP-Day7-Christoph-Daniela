<?php
    session_start();

    require_once '../components/db_connect.php';

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
        exit;
    }
    if(!isset($_SESSION["admin"]) && !isset($_SESSION["user"])){
        header("Location: ../index.php");
        exit;
    } 

    $sql = "SELECT * FROM users WHERE id = {$_SESSION['admin']}";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $status = 'admin';
    $sql2 = "SELECT * FROM rooms";
$result2 = mysqli_query($connect2, $sql2);

$tbody ="";

if(mysqli_num_rows($result2) > 0 ) {
    while($row2 = mysqli_fetch_assoc($result2)) {

        $tbody .= "
        
        <tr>
        
        <td><p class='text-muted mb-0'>".$row2['description']."</p></td>
         

        

        <td>
        <p class='text-muted mb-0'>Persons: ".$row2['capacity']."</p>
        </td>
        <td><p class='text-muted mb-0'>".$row2['statuss']."</p></td>

        <td><p class='text-muted mb-0'> ".$row2['price']."</p></td>

        <td>   <img
        src='pictures/".$row2['picture']."'
        alt=''
        style='width: 100px; height: 100px'
        class='rounded-circle'
        /></td>
        <td>
        <div class='container d-flex px-2'> 
        <a href='update.php?id=" .$row2['id']."'> <button type='button' class='btn btn-link btn-sm btn-rounded'>
        Edit
      </button>  </a>
      <a href='delete.php?id=" .$row2['id']."'>
      <button type='button' class='btn btn-link btn-sm btn-rounded'>
      Delete
    </button></a>
        
        </div>
        </td>
      </tr>
        
        ";

    }
} else{
    $tbody= "<h5 class='card-title'>No data available</h5>";
  }


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/boot.php" ?>
    <title>Welcome - <?= $row["f_name"] ?></title>
</head>
<body>
    <div class="container m-4">

        <div class="card border-warning mb-3 flex-row" style="width: 24.7rem;">
        <img src="../pictures/<?= $row["picture"] ?>" alt="" width="170">
            <div class="card-body   ">
              <h5 class="card-title text-warning font-italic">Admin</h5>
              <p class="card-text">Hello, <?= $row["f_name"] . " " . $row["l_name"] ?></p>
              <a href="../dashboard.php"class="btn btn-outline-dark">Dashboard</a>
              <a href="../logout.php?logout"class="btn btn-outline-dark">Logout</a>
       
   
             </div>
        </div>

    </div>

    <div class="container ">


    <div class="container d-flex justify-content-around ">


    <h6 class="">ROOMS DASHBOARD | </h6>

    <a href="create.php"><h6 class="">| ADD NEW ROOM </h6></a>

    </div>



     <table class="table align-middle my-5 py-3 mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Description</th>
      <th>Capacity</th>
      <th>Status</th>
      <th>Price</th>
      <th>Picture</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tbody>
  <?php echo $tbody?>
  </tbody>
</table>

    </div>

    
</body>
</html>