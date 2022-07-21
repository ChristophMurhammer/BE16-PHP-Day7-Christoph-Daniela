<?php
    session_start();
    require_once "components/db_connect.php";

    if(isset($_SESSION["admin"])){
        header("Location: dashboard.php");
        exit;
    }

    if(!isset($_SESSION["user"])){
        header("Location: index.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

  




$sql2 = "SELECT * FROM rooms where statuss LIKE '%available%'";
$result2 = mysqli_query($connect, $sql2);

$card ="";

if(mysqli_num_rows($result2) > 0) {

  while($row2 = mysqli_fetch_assoc($result2)) {

   

    $card .= "
    
    <div class='col-12 col-md-6 col-lg-4 '>
<div class='card' style='width: 25rem;'>
  <img class='card-img-top' style='height: 17rem;' src='rooms/pictures/".$row2['picture']."' alt='Car image'>
  <div class='card-body'>
    
    <p class='card-text'>".$row2['description']." </p>
    <h5 class='card-title text-muted'><b>Persons </b>: ".$row2['capacity']."</h5>
    <h5 class='card-title text-muted'><b>Price </b>: ".$row2['price']."</h5>
    <h5 class='card-title text-muted'><b>Status</b>: ".$row2['statuss']."</h5>
    <a href='#' class='btn btn-outline-dark m-2 p-2'>Book now</a>
  </div>
</div>
</div>

    ";

  
    
 
} }
else{
  $tbody= "<h5 class='card-title'>No data available</h5>";
}

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "components/boot.php" ?>
    <title>Welcome - <?= $row["f_name"] ?></title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
<img src="pictures/<?= $row["picture"] ?>" alt="" width="50">  &nbsp;
<a class="navbar-brand" >Hi, <?= $row["f_name"] . " " . $row["l_name"] ?></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
      <a  class="nav-link" href="account.php?id=<?= $row["id"]?>">Account</a>
      </li>
      <li class="nav-item">
      <a class="nav-link"  href="logout.php?logout">Logout</a>
      </li>
     
    </ul>
  </div>
</nav>





    <div class="container my-5 py-5">
        <h5 class="text-center text-muted" >PORTOBAY FALESIA</h5>
        <h6 class="text-center text-info">Book one of our rooms </h6>
    </div>

<div class="container my-5 justify-content-center ">
    <div class="row">
    <?php  echo $card ?> 
    </div>
</div>

</body>
</html>