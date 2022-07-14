<?php
  include 'db.php';
  include 'config.php';

  header("Cache-Control: no-cache, no-store", true);
  session_start();

  if (!isset($_SESSION['owner_id'])){
    header('Location:' .URL. 'login.php');
  } 
  $image_url=$_SESSION["owner_url"];
  if(!$image_url) $image_url = "images/upload/defultimage.jpg";
?>
<?php

    $query = "SELECT *
    FROM tbl_ownerdog_207 WHERE tbl_ownerdog_207.owner_id =".$_SESSION['owner_id'].";";  

    $result = mysqli_query($connection, $query);
    if(!$result) {
        die("DB query failed.");
    }
    $row = mysqli_fetch_assoc($result); 
    $state = "edit";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Mulish"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Dog - profile</title>
    <link rel="stylesheet" href="includes/css/style.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/e2ac9cc532.js" crossorigin="anonymous"></script><link rel="stylesheet" href="./style.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src= "https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="includes/js/scripts.js"></script>
</head>
<body id="edit">

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
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="<?php  echo $image_url ?>"><span class="font-weight-bold"><?php echo  $row['owner_name'] ?></span><span class="text-black-50"><?php echo  $row['owner_email'] ?></span><span> </span></div>
                    </div>
                <div class="col-md-5 border-right">
                        <form action="http://se.shenkar.ac.il/students/2021-2022/web1/dev_207/profile.php" method="GET">

                            <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Profile Settings</h4>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12"><label class="labels">Username</label><input type="text" name="owner_name" class="form-control"  placeholder="enter Your Name" value="<?php echo $row['owner_name'] ?>" required></div>
                                        <div class="col-md-12"><label class="labels">Email</label><input type="text" name="owner_email" class="form-control" placeholder="enter Your Email" value="<?php echo $row['owner_email'] ?>" required></div>
                                        <div class="col-md-12"><label class="labels">Address</label><input type="text" name="owner_address" class="form-control" placeholder="enter Your Address" value="<?php echo $row['owner_address'] ?>" required></div>
                                        <div class="col-md-12"><label class="labels">City</label><input type="text" name="owner_city" class="form-control" placeholder="enter Your City" value="<?php echo $row['owner_city'] ?>" required></div>
                                        <div class="col-md-12"><label class="labels">Phone</label><input type="tel" name="owner_phone" class="form-control" placeholder="enter phone number" value="<?php echo $row['owner_phone'] ?>" required></div>
                                        <div class="col-md-12"><label class="labels">Post Code</label><input type="text" name="post_code" class="form-control" placeholder="enter Your Post Code" value="<?php echo $row['post_code'] ?>" required></div>
                                        <div class="col-md-12"><label class="labels">Picture</label>
                                        <select class="form-select"  name="owner_picture" data-selected="<?php echo $row['owner_picture'];?>">

                                                <option >images/upload/waled.jpg</option>

                                                <option >images/upload/hade.jpg</option>

                                                <option >images/upload/defultimage.jpg</option>

                                                <option >images/upload/Sarah-modified.png</option>

                                        </select>
                                       

                                    </div>
                                    <input type="hidden" name="state" value="edit">

                                    <div class="mt-5 text-center">
                                    <input class="btn btn-primary profile-button" type="submit" value="Save Change">
                                </div>
                            
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
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