<?php
$showAlert = false;
$showError=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
   
    $existSql="SELECT * FROM `user` WHERE username='$username'";
    $result=mysqli_query($conn, $existSql);
    $numExistRows=mysqli_num_rows($result);
    if($numExistRows>0){
        $showError="Username Already exists.";
    }
    else{
      if (($password == $cpassword)) {
        $sql = "INSERT INTO `user` (`username`, `password`, `date`) VALUES ('$username', '$password', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
    }
    else{
        $showError="Passwords do not match";
    }
   }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/nav.php' ?>
    <?php
    if($showAlert){
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Success!</strong> Your account is now created and you can login
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        ';
    }

    if($showError){
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Error!</strong> '.$showError.'
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        ';
    }
   
       
    ?>
    
    <div class="container">
        <h1 class="text-center">Signup to our website</h1>
        <form action="/loginsystem/signup.php" method='post'>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
         </div>
         <div class="mb-3">
           <label for="password" class="form-label">Password</label>
           <input type="password" class="form-control" id="password" name="password">
         </div>
         <div class="mb-3">
           <label for="cpassword" class="form-label">Confirm Password</label>
           <input type="password" class="form-control" id="cpassword" name="cpassword">
           <div id="emailHelp" class="form-text">Make sure to type the same password</div>
         </div>
         <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>