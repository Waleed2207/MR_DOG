<?php
  include 'db.php';
  include 'config.php';

  header("Cache-Control: no-cache, no-store", true);
  error_reporting(0);
  session_start();

  if (!isset($_SESSION['owner_id'])){

    header("Location: login.php");
  } 
  $image_url=$_SESSION["owner_url"];
  if(!$image_url) $image_url = "images/upload/defultimage.jpg";
?>

<?php
    if(isset($_GET['deletedog'])){
      $dogdelete=$_GET['deletedog'];
      $query_delete="DELETE FROM tbl_dog_207 WHERE dog_id=".$dogdelete;
      $result_delete= mysqli_query($connection, $query_delete);
      echo "<script>alert('Deleted successfully!')</script>";

      if(!$result_delete) {
          die("DB query failed.");
      }
    }
?>
<?php 
 
  $query="SELECT *
  FROM tbl_ownerdog_207 o
  RIGHT JOIN tbl_dog_207 d ON d.owner_id = o.owner_id
  WHERE o.owner_id=".$_SESSION['owner_id'];

  $result = mysqli_query($connection, $query);
  
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Mulish"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Dog - Home</title>
        <!-- CSS only -->
        <script src="https://kit.fontawesome.com/e2ac9cc532.js" crossorigin="anonymous"></script><link rel="stylesheet" href="./style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="includes/css/style.css"/>
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
      <section class="headline">
        <h1>Welcome, <?php echo $_SESSION['owner_name'];?>! </h1>
        <p><i>Welcome to your Mr.Dog - Reuniting you with your dogs.</i></p>
      </section>
      <div id="wrapper"> 
        <div class="label-yourdog">
          <section class="Your-dog"><h2>Your Dogs</h2></section>
          <section><p id="add" onClick="parent.location='create-object.php'" ></p></section>

        </div>
      <main>
        <?php 
          while($row = mysqli_fetch_assoc($result)){  
            $location="'page2.php?dogid=".$row['dog_id']."'";
            $dog_name = $row["dog_name"];
            $dog_pic = $row["dog_picture"];
            echo   '<div class="card-img">';
            echo      '<img src="'.$dog_pic.'" onClick="parent.location='.$location.'" class="card-img-top" alt='.$dog_name.'" title="Charlie">';
            echo        '<div class="card-body1">';
            echo          '<section> <p class="card-title"><a href="page2.php?dogid='.$row['dog_id'].'">'.$dog_name.'</a></p></section>';
            echo        '</div>';
            echo   '</div>';
        }?>
        
        
        
      </main>
      <div class="label-yourdog">
          <section class="Your-dog"><h2>Plans</h2></section>
          </div>
          <div class='container'>
            <div class="flex-box">
                <div>
                  <img src="images/Purple-modified.png" class='iconDetails1' alt="icon-img">
                </div>	
                <section>
                  <p>20 FEB</p>
                  <div>Going for a walk</div>
                </section>
            </div>
            <div class="flex-box">
              <div>
                <img src="images/Green-modified.png" class='iconDetails1' alt="icon-img">
              </div>	
              <section >
                <p>13 AUG</p>
                <div>Visit the vet</div>
              </section>
          </div>
          </div>
          <div class="label-yourdog">
            <section class="Your-dog"><h2>News</h2></section>
          </div>
          <div  class="flex-contner">
              <div>
                <img src="images/Jack-2.jpg"  alt="icon-img">
                <p>Looking for a home!
                </p>
                <section><a href="#" >Read more<img src="images/Vector.png"></a></section>
            </div>
            <div>
              <img src="images/Jack.jpg"  alt="icon-img">
              <p>Brown Puppy Found
              </p>
              <section><a href="#" >Read more<img src="images/Vector.png" alt="icon-img"></a></section>
              
            </div>
          </div>
      </div> 

  <footer class="text-center text-white" style="background-color: #f1f1f1;">
      
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