<?php
  include 'db.php';
  include 'config.php';

  header("Cache-Control: no-cache, no-store", true);
  session_start();

  if (!isset($_SESSION['owner_id'])){
    header('location:'.URL.'login.php');
  } 
  $image_url=$_SESSION["owner_url"];
  if(!$image_url) $image_url = "images/upload/defultimage.jpg";
?>
<?php
    if(isset($_GET['dogid'])&isset($_GET['repoid']))
    {
      $iddog=$_GET['dogid'];
      $rtid=$_GET['repoid'];
      $query_update="update `tbl_dog_207` set 
      dog_id='$iddog',
      dog_lost='$rtid' where dog_id=$iddog";
      $resultupdate = mysqli_query($connection,  $query_update);
      
      if($resultupdate){
        echo "<script>alert('Data Reporting successfully')</script>";
        header('location:'.URL.'lostDog.php');
      }
      else{
          die("DB query failed.");
      }
    }
    
    elseif(!isset($_GET['repoid'])&isset($_GET['dogid'])&$_GET['flag']=2){
      $iddog=$_GET['dogid'];
      $rtid=$_GET['repoid'];
      $query_update="update `tbl_dog_207` set 
      dog_id='$iddog',
      dog_lost='$rtid' where dog_id=$iddog";
      $resultupdate = mysqli_query($connection,  $query_update);
      if($resultupdate){
        echo "<script>alert('Yay! we found a dog a message sent to the owner.')</script>";
        header('location: lostDog.php');
      }
      else{
          die("DB query failed.");
      }
    }
  

    else{
      $query="SELECT *
      FROM tbl_ownerdog_207 o
      RIGHT JOIN tbl_dog_207 d ON d.owner_id = o.owner_id
      Where d.dog_lost=1";
      
      $result = mysqli_query($connection, $query);
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Mulish"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Dog - Home</title>
    <link rel="stylesheet" href="includes/css/style.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/e2ac9cc532.js" crossorigin="anonymous"></script><link rel="stylesheet" href="./style.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src= "https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="includes/js/scripts.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark nav-dark mb-4">
        <div class="container-fluid">
          <section><a href="index.php" id="logo"></a></section>
          <section><img src="<?php  echo $image_url ?>" onClick="parent.location='profile.php'"  class="persona" alt="icon-image"></section>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">My Dogs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="lostDog.php">Lost Dogs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="#">Report Found dog</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Nearby PetShop</a>
                  </li>
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-info btn-lg">
                    <i class="fas fa-arrow-right"></i>&nbsp;
                      <span class="glyphicon glyphicon-log-out"></span> Log out
                    </a>
                    <section >
                    <section><img src="<?php  echo $image_url ?>" onClick="parent.location='profile.php'"  class="persona"  alt="Username" ></section>

                    </section>
                </div>
            </div>
        </div>
    </nav>
    <div id="wrapper"> 
        <div class="label-yourdog1">
          <section class="Your-dog"><h2>List of lost dogs</h2></section>
          
        </div>
        <main>
          <?php 
            $location="parent.location='page2.php'";
            
            while($row = mysqli_fetch_assoc($result)){  
              $iddog=$row['dog_id'];
              $ownername=$row['owner_name'];
              $dog_name = $row["dog_name"];
              $dog_pic = $row["dog_picture"];
              echo   '<div class="card-img1">';
              echo      '<img src="'.$dog_pic.'" onClick="parent.location='.$location.'" class="card-img-top1" alt='.$dog_name.'" title="Charlie">';
              echo        '<div class="card-body1">';
              echo          '<section> <p class="card-title1">'.$dog_name.'<br>Owned By: '.$ownername.'</a></p></section>';
              echo            '<button  class="button-one"><a href="lostDog.php?repoid=0&dogid='.$iddog.'&flag=2"><i class="fa-solid fa-shield-dog"></i>&nbsp;&nbsp;Report Found</a></button>';
              echo        '</div>';
              echo   '</div>';
          }?>
        </main>
        
    <footer class="text-center1 text-white" style="background-color: #f1f1f1;">
      
      <div class="container pt-4">
          <section class="mb-4">
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button" data-mdb-ripple-color="dark"><i class="fab fa-facebook-f"></i></a>
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button" data-mdb-ripple-color="dark"><i class="fab fa-twitter"></i></a>
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button" data-mdb-ripple-color="dark"><i class="fab fa-google"></i></a>
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button" data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button" data-mdb-ripple-color="dark"><i class="fab fa-linkedin"></i></a>
          <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#" role="button" data-mdb-ripple-color="dark"><i class="fab fa-github"></i></a>
          </section>
      </div>
      <div class="text-center text-dark p-3" >
          © 2022 Copyright :
          <a class="text-dark" href="#"> MR.DOG</a>
      </div>

  </footer>
  
  <?php
        mysqli_free_result($result);
    ?>

</body>
</html>
<?php

//close DB connection

mysqli_close($connection);

?>