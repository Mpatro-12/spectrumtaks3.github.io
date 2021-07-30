<?php 
  include 'connectdb.php';

  if(isset($_SESSION['isLoggedin']) && $_SESSION['isLoggedin'] == true) {
    header("Location: index.php");
  }
  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    echo '<hr />';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">
    <title>signup</title>
</head>
<body>
    <main class=" d-flex justify-content-between align-items-center">
      <div class="container p-5">
         
       <div class="row shadow-lg rows ">
       <div class="col-md-5 col-12 order-md-1 order-2 image ">
          <div class="signup_image">
          <img class="img-fluid" src="images/register.jpg">
          </div>
        </div>
          <div class="col-md-7 col-12  order-md-2 order-1 form p-5" >
              <div class="signup_container">
                  <h2 class="mb-3 text-center"><i><b>Welcome to Spectrum Club</b></i></h2>
            <form method="POST">
              <div class="form-group">
                <label for="name">First Name *</label>
                <input type="text" name="fname" class="form-control form-control-sm" id="name" aria-describedby="emailHelp" required>
              </div>
              <div class="form-group">
                <label for="name">Last Name *</label>
                <input type="text" name="lname" class="form-control form-control-sm" id="name" aria-describedby="emailHelp" required>
              </div>
              <div class="form-group">
                <label for="email">Email address *</label>
                <input type="email" name="email" class="form-control form-control-sm" id="email" aria-describedby="emailHelp" required>
                
              </div>
              <div class="form-group">
                <label for="mobile">Mobile Number *</label>
                <input type="number" name="mobile" class="form-control form-control-sm" minlength="10" id="mobile" aria-describedby="emailHelp" required>
                
              </div>
              <div class="form-group">
                <label for="pass">Password *</label>
                <input type="password" name="password" minlength="4" class="form-control form-control-sm" id="pass" required>
              </div>
              <div class="form-group">
                <label for="cpass">Confirm Password *</label>
                <input type="text" name="con-password" class="form-control form-control-sm" id="cpass" required>
              </div>
              <div class="row justify-content-center my-3 px-3">
                 <button type="submit" name="signup" class="btn-block btn-color">Signup</button>
              </div>
              </form><br><br>
              <div class="bottom text-center mb-5">
                    <p href="#" class="sm-text mx-auto mb-3">have an account?<button class="btn btn-primary ml-2">  <a class="text-white" href="login.php">Login</a></button></p>
                </div>
            </form>
            </div>
          </div>
       </div>
      </div>
    </main>
</body>
</html>


<?php
if(isset($_REQUEST["signup"])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = strtolower($_POST["fname"]);
    $last_name = strtolower($_POST["lname"]);
    $user_email =  $_POST["email"];
    $mobile =  $_POST["mobile"];
    $pass =  $_POST["password"];
    $conpass =  $_POST["con-password"];
    $pass_hash = md5($pass);

    if ($pass == $conpass) {
      $findByEmail = "SELECT * FROM users WHERE email='$user_email'";
      $chkUser = mysqli_query($conn, $findByEmail);
      if(mysqli_num_rows($chkUser) > 0) {
        $_SESSION["msg"] = "This email is already in use.";
        $_SESSION["isLoggedin"] = false;
        header("Refresh:0");
        exit();
      } else {
        $submit_form_sql = "INSERT INTO users (fname, lname, email, password, mobile) VALUES ('$first_name', '$last_name', '$user_email', '$pass_hash', '$mobile')";
        $result = mysqli_query($conn, $submit_form_sql);
        if ($result) {
            $sql = "SELECT id FROM users WHERE email='$user_email'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            unset($_SESSION["msg"]);
            $_SESSION["isLoggedin"] = true;
            $_SESSION['email'] = $user_email;
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php?signup=success");
            exit();
        } else {
          $_SESSION["msg"] = "Something error happened in signup.";
          $_SESSION["isLoggedin"] = false;
          header("Refresh:0");
          exit();
        }
      }
    } else {
      $_SESSION["msg"] = "Password did not match!";
      $_SESSION["isLoggedin"] = false;
      header("Refresh:0");
    }
  }
}

// Connection closed
  mysqli_close($conn);
?>


