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

    
// edit
if (isset($_GET["state"])) 
{
    $state  = "edit";
    $userName     = mysqli_real_escape_string($connection, $_GET['owner_name']);
    $userMail     = mysqli_real_escape_string($connection, $_GET['owner_email']);
    $userPhone    = mysqli_real_escape_string($connection, $_GET['owner_phone']);
    $userCity    = mysqli_real_escape_string($connection, $_GET['owner_city']);
    $userAddress    = mysqli_real_escape_string($connection, $_GET['owner_address']);
    $userPostCode    = mysqli_real_escape_string($connection, $_GET['post_code']);
    $userUrl    = mysqli_real_escape_string($connection, $_GET['owner_picture']);
    $query_update = " UPDATE tbl_ownerdog_207 SET 
    owner_name ='$userName',
    owner_email ='$userMail',
    owner_phone ='$userPhone',
    owner_city ='$userCity',
    owner_address ='$userAddress',
    post_code ='$userPostCode',
    owner_picture ='$userUrl'
    WHERE tbl_ownerdog_207.owner_id =".$_SESSION['owner_id'].";";  

    $resultupdate = mysqli_query($connection,  $query_update);

    if(!$resultupdate) {
        die("DB query failed.");
    }

}


  $query = "SELECT *
  FROM tbl_ownerdog_207 where  owner_id= '". $_SESSION['owner_id'] . "'";
  $result = mysqli_query($connection, $query);
  if(!$result) {
      die("DB query failed.");
  }
  $row = mysqli_fetch_assoc($result); 
  $_SESSION['owner_url']=$row['owner_picture'];
  $_SESSION['owner_email']=$row['owner_email'];
  $image_defult=$_SESSION["owner_url"];
  if(!$image_defult) $image_defult = "images/upload/defultimage.jpg";

  mysqli_free_result($result);
 /* mysqli_close($connection);*/
 /*$_SESSION["owner_url"]=$row["owner_picture"];*/

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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="<?php  echo $image_defult ?>"><span class="font-weight-bold"><?php echo  $row['owner_name'] ?></span><span class="text-black-50"><?php echo  $row['owner_email'] ?></span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Username</label><span type="text" class="form-control" placeholder="enter phone number" value=""><?php echo $row['owner_name'] ?></span></div>
                            <div class="col-md-12"><label class="labels">Email</label><span type="text" class="form-control" placeholder="enter phone number" value=""><?php echo  $row['owner_email'] ?></span></div>
                            <div class="col-md-12"><label class="labels">Address</label><span type="text" class="form-control" placeholder="enter phone number" value=""><?php echo $row['owner_address'] ?></span></div>
                            <div class="col-md-12"><label class="labels">City</label><span type="text" class="form-control" placeholder="enter phone number" value=""><?php echo $row['owner_city'] ?></span></div>
                            <div class="col-md-12"><label class="labels">Phone</label><span type="text" class="form-control" placeholder="enter phone number" value=""><?php echo $row['owner_phone'] ?></span></div>
                            <div class="col-md-12"><label class="labels">Post Code</label><span type="text" class="form-control" placeholder="enter phone number" value=""><?php echo $row['post_code'] ?></span></div>
                            <div class="col-md-12"><label class="labels">Picture</label><span type="text" class="form-control" placeholder="upload picture..." value=""><?php echo $image_defult ?></span></div>
                        </div>

                        <div class="mt-5 text-center">
                          
                          <div class="text-center">
                              <!-- Button HTML (to Trigger Modal) -->
                              <a class="btn btn-primary profile-button" target="_self" href="edit.php" ><i class="fa-solid fa-pen">&nbsp;&nbsp;</i>Edit</a>
                              <a href="#myModal" class="btn1 btn-primary1 profile-button1" data-toggle="modal"><i class="fa-solid fa-trash-can">&nbsp;&nbsp;</i>Delete</a>
                          </div>
                          <!-- Modal HTML -->
                          <div id="myModal" class="modal fade">
                            <div class="modal-dialog modal-confirm">
                              <div class="modal-content">
                                <div class="modal-header flex-column">
                                  <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i>
                                  </div>						
                                  <h4 class="modal-title w-100">Are you sure to delete this account?</h4>	
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <p>Do you really want to delete this account? This process cannot be undone.</p>
                                </div>
                                <div class="modal-footer justify-content-center">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                  <a type="button" class="btn btn-danger" target="_self" href="login.php?deleteaccount=1" id="deleteAccount">Delete</a>
                                </div>
                              </div>
                            </div>
                          </div> 
                          
                      </div>
                        

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
</body>
</html>
<?php

//close DB connection

mysqli_close($connection);

?>