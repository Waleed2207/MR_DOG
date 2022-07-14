<?php
include 'db.php';
include 'config.php';

session_start();
error_reporting(0);
if (!isset($_SESSION['owner_id'])) {
  header('Location:' .URL. 'login.php');
}
$image_url = $_SESSION["owner_url"];
if (!$image_url) $image_url = "images/upload/defultimage.jpg";


  if(isset($_POST['submit']))
  {
    $ownerID = $_SESSION['owner_id'];
    $name = $_POST["name"];
    $dog_picture = $_POST["dog_picture"];
    if(!$dog_picture) $dog_picture="images/defultimgdog.png";
    $birthday = $_POST["birthday"];
    $gender = $_POST["pet-gender"];
    $pweight = $_POST["pet-weight"];
    $str = "lb";
    $type_dog = $_POST["type_breeds"];
    $spayed = $_POST["spayed-neutered"];
    $dogid =$_GET["dogid"];

    $sql = "INSERT INTO dbShnkr22studWeb1.tbl_dog_207(type_breed,dog_name, dog_birthday,dog_picture, dog_gender, dog_wieght, owner_id, dog_lost, dog_spayed)
    VALUES ('$type_dog ','$name', '$birthday','$dog_picture', '$gender', '$pweight $str', '$ownerID', 0, '$spayed');";
    $result = mysqli_query($connection, $sql);

      if($result)
      {
        echo"<script>alert('Dog added successfully!')</script>";
        $name = "";
        $breed = "";
        $dog_picture ="";
        $birthday = "";
        $gender = "";
        $weight = "";
      }
      else
      {
        echo"<script>alert('Something went wrong!')</script>";
      }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Mulish" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mr. Dog - Create</title>
  <link rel="stylesheet" href="includes/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/e2ac9cc532.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./style.css">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="includes/js/scripts.js"></script>
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
                <a class="nav-link active" aria-current="page" href="index.php ">Home</a>
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
      <div class="wrapper">
        <div class='signup-container'>
          <div class='left-container'>
            <h1>
              <i class='fas fa-paw'></i>
              PUPASSURE
            </h1>
            <div class='puppy'>
              <img src='images/puppy.png' alt="icon-img">
            </div>
          </div>
          <div class='right-container'>
            <header>
                <h1>Yay, puppies! Ensure your pup gets the best care!</h1>
                <!-------------------------------------------create-opject------------------------------------------------>
                <form action="" method="POST">
                    <div class='set'>
                      <div class='pets-name'>
                        <label for='pets-name'>Name</label>
                        <input id='pets-name' name="name" placeholder="dog name" type='text' value="<?php echo $name;?>" required>
                      </div>
                      <div class='set'>
                        <div class='pets-breed'>
                          <label for='pets-breed'>Upload a photo</label>
                          <select class="form-select"  name="dog_picture" data-selected="<?php echo $dog_picture;?>">

                              <option >images/defultimgdog.png</option>
                              
                              <option >images/Green-modified.png</option>

                              <option >images/Yellow-modified.png</option>

                              <option >images/Red-modified.png</option>

                              <option >images/Purple-modified.png</option>

                              <option >images/jacki.png</option>

                              <option >images/Blue-modified.png</option>

                              <option >images/carly.png</option>

                            </select>
                          
                        </div>

                      </div>
                    </div>
                    <div class='set'>
                      <div class='pets-breed'>
                        <label for='pets-breed'>Breed</label>
                        <select class="form-select" name="type_breeds">
                              <?php
                                    // Read the JSON file
                                    $json = file_get_contents('includes/js/type_breeds.json');

                                    // Decode the JSON file
                                    $json_data = json_decode($json,true);
                              ?>
                              <?php
                              foreach($json_data["type_breeds"] as $type_breeds){
                                echo "<option>".$type_breeds["tybe"] ."</option>";
                              }    
                              ?>
                            </select>
                      </div>
                      <div class='pets-birthday'>
                        <label for='pets-birthday'>Birthday</label>
                        <input id='pets-birthday' name="birthday" placeholder='MM/DD/YYYY' type='text'value="<?php echo $birthday;?>" required>
                      </div>
                    </div>
                    <div class='set'>
                      <div class='pets-gender'>
                        <label for='pet-gender-female'>Gender</label>
                        <div class='radio-container'>
                          <input checked='' id='pet-gender-female' name='pet-gender' type='radio' value='female' required>
                          <label for='pet-gender-female'>Female</label>
                          <input id='pet-gender-male' name='pet-gender' type='radio' value='male'>
                          <label for='pet-gender-male'>Male</label>
                        </div>
                      </div>
                      <div class='pets-spayed-neutered'>
                        <label for='pet-spayed'>Spayed or Neutered</label>
                        <div class='radio-container'>
                          <input checked='' id='pet-spayed' name='spayed-neutered' type='radio' value='spayed'>
                          <label for='pet-spayed'>Spayed</label>
                          <input id='pet-neutered' name='spayed-neutered' type='radio' value='neutered'>
                          <label for='pet-neutered'>Neutered</label>
                        </div>
                      </div>
                    </div>
                    <div class='pets-weight'>
                      <label for='pet-weight-0-25' name = 'pet-weight'>Weight</label>
                      <div class='radio-container'>
                        <input checked='' id='pet-weight-0-25' name='pet-weight' type='radio' value='0-25'>
                        <label for='pet-weight-0-25'>0-25 lbs</label>
                        <input id='pet-weight-25-50' name='pet-weight' type='radio' value='25-50'>
                        <label for='pet-weight-25-50'>25-50 lbs</label>
                        <input id='pet-weight-50-100' name='pet-weight' type='radio' value='50-100'>
                        <label for='pet-weight-50-100'>50-100 lbs</label>
                        <input id='pet-weight-100-plus' name='pet-weight'  type='radio' value='100+'>
                        <label for='pet-weight-100-plus'>100+ lbs</label>
                      </div>
                    </div>
              </header>
              <article class="back-next">
                <div class='set'>
                  <button id='back'><a href="index.php">Back</a></button>
                  <button id='next' type="submit" name="submit">Save</button>
                  
                </div>
              </article>
            </div>
          </div>
        </form>
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