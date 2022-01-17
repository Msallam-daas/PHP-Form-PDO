<?php
define('BASEPATH', true); //access connection script if you omit this line file will be blank
require 'db.php'; //require connection script

 if(isset($_POST['submit'])){  
        try {
            $dsn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  
         $user = $_POST['username'];
         $email = $_POST['email'];
         $pass = $_POST['password'];

         $pass = password_hash($pass, PASSWORD_BCRYPT, array("cost" => 12));
          
         //Check if username exists
         $sql = "SELECT COUNT(username) AS num FROM admin WHERE username =      :username";
         $stmt = $pdo->prepare($sql);

         $stmt->bindValue(':username', $user);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         if($row['num'] > 0){
             echo '<script>alert("Username already exists")</script>';
        }
        
       else{

    $stmt = $dsn->prepare("INSERT INTO admin (username, email, password) 
    VALUES (:username,:email, :password)");
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $pass);
    
    

   if($stmt->execute()){
    echo '<script>alert("New account created.")</script>';
    //redirect to another page
    echo '<script>window.location.replace("home.php")</script>';
     
   }else{
       echo '<script>alert("An error occurred")</script>';
   }
}
}catch(PDOException $e){
    $error = "Error: " . $e->getMessage();
    echo '<script type="text/javascript">alert("'.$error.'");</script>';
}
     }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
  <div id="container">
      <div class="form-wrap">
        <h1>Join Us</h1>
        <p>Register Your Own User</p>

   <form  id="RegisterForm" action="register.php" method="post">
   <div class="form-group">
   <label for="username"> Username<span class="text-danger">*</span></label>
  <input type="text" required="required" name="username" placeholder="Username">
  </div>
  <div class="form-group">
   <label for="email"> Email<span class="text-danger">*</span></label>
  <input  type="email" name="email" placeholder="Email">
  </div>
  <div class="form-group">
   <label for="password"> Password<span class="text-danger">*</span></label>
  <input  type="password" name="password" id="pass" placeholder="Password">
  </div>  
  <div class="form-group">
            <label for="password2">confirm Password<span class="text-danger">*</span></label>
            <input id="confirmPass" type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required />
          </div>                
  <button name="submit" type="submit">register</button>
  <p id="formEnding-text">
            BY click Joining us means you agree to our
            <a href="#">Terms & Conditions</a> and our
            <a href="#">Privacy policy</a>
          </p>
          <p id="ErrMsg"></p>
  </form>
  </div>
  <footer>
        <p>you have an account?<a href="login.php">Login</a></p>
      </footer>
  </div>
  <script >
    document.getElementById("RegisterForm").addEventListener("submit", (event) => {
  let passsword = document.getElementById("pass");
  let confirmPassword = document.getElementById("confirmPass");
  let Error = document.getElementById("ErrMsg");
  if (passsword.value.length < 6) {
    event.preventDefault();
    Error.innerHTML = "Passwords at least 6 characters ";
  }
  if (passsword.value.length != confirmPassword.value.length) {
    event.preventDefault();
    Error.innerHTML += "<br> passwords do not match!";
  }
});
  </script>
  </body>
</html>


