<?php 
  include '../connectdb.php';

  if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    echo '<hr />';
  }

  if(!isset($_SESSION['isLoggedin']) || !isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
  }
  if(isset($_SESSION['user_id'])) {
    $user_query = "select * from users where id=".$_SESSION['user_id'];
    $result = mysqli_query($conn, $user_query);
    if (mysqli_num_rows($result) == 1) {
      $user = mysqli_fetch_assoc($result);
    }
    $qual_query = "select * from qualification where uid=".$_SESSION['user_id'];
    $res = mysqli_query($conn, $qual_query);
    if (mysqli_num_rows($result) == 1) {
      $qualification = mysqli_fetch_assoc($res);
    }
  }
?>


<?php
if(isset($_REQUEST["update"])) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // users table
    $fname = strtolower($_POST["fname"]);
    $lname = strtolower($_POST["lname"]);
    $email =  $_POST["email"];
    $mobile =  $_POST["mobile"];
    $dob =  $_POST["dob"];
    $age =  $_POST["age"];
    $domain =  $_POST["domain"];
    $address =  $_POST["address"];
    $bio =  $_POST["bio"];
    $programming =  $_POST["programming"];
    $framework =  $_POST["framework"];
    $pro1_title =  $_POST["pro1_title"];
    $pro2_title =  $_POST["pro2_title"];
    $pro3_title =  $_POST["pro3_title"];
    $pro1_link =  $_POST["pro1_link"];
    $pro2_link =  $_POST["pro2_link"];
    $pro3_link =  $_POST["pro3_link"];

    // cv upload
    $cv = $_FILES['cv'];
    if($cv) {
      $milliseconds = round(microtime(true) * 1000);
      $cv_name =  $_FILES['cv']['name'];
      $cv_tmp =  $_FILES['cv']['tmp_name'];
      $enc_cv_name = $milliseconds.$cv_name;
      $target_dir = "../portfolio/assets/docs/".$enc_cv_name;
    }


    // qualification table
    $uid = $_SESSION['user_id'];
    $master_year = $_POST['master_year'];
    $master_clg = $_POST['master_clg'];
    $master_branch = $_POST['master_branch'];
    $grad_year = $_POST['grad_year'];
    $grad_clg = $_POST['grad_clg'];
    $grad_branch = $_POST['grad_branch'];
    $inter_year = $_POST['inter_year'];
    $inter_clg = $_POST['inter_clg'];
    $inter_branch = $_POST['inter_branch'];

    $res_user = $upd_qual = $res_user = $crt_qual = '';
    
    $user_update_query = "UPDATE users SET fname='$fname',lname='$lname',email='$email',bio='$bio',mobile='$mobile',dob='$dob',age='$age',domain='$domain',address='$address',programming='$programming',framework='$framework',pro1_title='$pro1_title',pro2_title='$pro2_title',pro3_title='$pro3_title',pro1_link='$pro1_link',pro2_link='$pro2_link',pro3_link='$pro3_link',cv='$enc_cv_name' WHERE id='$uid'";

    $res_user = mysqli_query($conn, $user_update_query);
    if (!$res_user) {
      echo 'Could not update data';
    }

    $chk_qual_query = "select * from qualification where uid=".$_SESSION['user_id'];
    $res_qual = mysqli_query($conn, $chk_qual_query);
    if (mysqli_num_rows($res_qual) == 1) {

      $upd_qual_qry = "UPDATE qualification SET grad_year='$grad_year',grad_clg='$grad_clg',grad_branch='$grad_branch',inter_year='$inter_year',inter_clg='$inter_clg',inter_branch='$inter_branch',master_year='$master_year',master_clg='$master_clg',master_branch='$master_branch' WHERE uid='$uid'";

      $upd_qual = mysqli_query($conn, $upd_qual_qry);
      if (!$upd_qual) {
        echo 'Could not update data';
      }
    } else {

      $crt_qual_qry = "INSERT INTO qualification(uid, grad_year, grad_clg, grad_branch, inter_year, inter_clg, inter_branch, master_year, master_clg, master_branch) VALUES('$uid','$grad_year','$grad_clg','$grad_branch','$inter_year','$inter_clg','$inter_branch','$master_year','$master_clg','$master_branch')";

      $crt_qual = mysqli_query($conn, $crt_qual_qry);
      if(!$crt_qual) {
        echo ' Could not insert update info.';
      }
    }

    if($cv) {
      $allowed = array('pdf', 'png', 'jpg');
      $ext = pathinfo($cv_name, PATHINFO_EXTENSION);
      if (!in_array($ext, $allowed)) {
          echo 'error';
      }
      move_uploaded_file($cv_tmp, $target_dir);
    }


    header("Refresh:0");
    exit();
  } 

  // Connection closed
  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="portfolio_form.css">
    
    <title>portfolio_form</title>
</head>
<body>
    <section>
        <div class="container h-80 p-5">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
              <h2 class="mb-4 text-center"><i><b>Please Fill Up Portfolio Form.</b></i></h2>
                <form method="POST" enctype="multipart/form-data">
                  <div class="card" style="border-radius: 15px;">
                    <div class="card-body">

                      <!-- First NAME-->          
                      <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="f_name"><b>First Name *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="text" name="fname" value="<?php if(isset($user['fname'])) echo $user['fname']; ?>" id="l_name" class="form-control form-control-lg" placeholder="" required />
                        </div>
                      </div>

                      <!-- Last NAME-->          
                      <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="l_name"><b>Last Name *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="text" name="lname" value="<?php if(isset($user['lname'])) echo $user['lname']; ?>" id="l_name" class="form-control form-control-lg" placeholder="" required />
                        </div>
                      </div>

                      <!-- EMAIL-->          
                      <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="email"><b>Email *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="email" name="email" value="<?php if(isset($user['email'])) echo $user['email']; ?>" id="email" class="form-control form-control-lg" placeholder="" required />
                        </div>
                      </div>
                      
                      <!-- MOBILE-->          
                      <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="mobile"><b>Mobile(+91) *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="number" name="mobile" value="<?php if(isset($user['mobile'])) echo $user['mobile']; ?>" id="mobile" class="form-control form-control-lg" minlength="10" placeholder="8249034982" required />
                        </div>
                      </div>

                      <!-- AGE-->          
                      <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="age"><b>Age *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="number" name="age" value="<?php if(isset($user['age'])) echo $user['age']; ?>" id="age" class="form-control form-control-lg" placeholder="" required />
                        </div>
                      </div>

                      <!-- AGE-->          
                      <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="dob"><b>Date of Birth *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="text" name="dob" value="<?php if(isset($user['dob'])) echo $user['dob']; ?>" id="dob" class="form-control form-control-lg" placeholder="20-04-1998" required />
                        </div>
                      </div>

                      <!-- DOMAINS-->          
                      <div class="row align-items-center pt-4 pb-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="domain"><b>Domain *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="text" name="domain" value="<?php if(isset($user['domain'])) echo $user['domain']; ?>" id="domain" class="form-control form-control-lg" placeholder="E.g- Web developer, UI/UX designer" required />
                        </div>
                      </div>

                       <!-- ADDRESS-->
                       <div class="row align-items-center py-3">
                        <div class="col-md-3 ps-5">
                          <label class="mb-0" for="address"><b>Address *</b></label> 
                        </div>
                        <div class="col-md-9 pe-5">
                          <input type="text" name="address" value="<?php if(isset($user['address'])) echo $user['address']; ?>" id="address" class="form-control form-control-lg"  placeholder="" required />
                        </div>
                      </div>

                      <!-- BIO -->
                      <label for="">Bio</label>
                      <textarea type="text" name="bio" maxlength="200" class="form-control form-control-lg" placeholder="About yourself..." required><?php if(isset($user['bio'])) echo $user['bio']; ?></textarea><br>
  
                      <!-- QUALIFICATION-->
                      <div class="row align-items-center py-3">
                        <div class="col-md-3 ps-5">
                          <h5 class="mb-0" for="qualification"><b>Qualification </b></h5>
                        </div>
                        <div class="col-md-9 pe-5">
                        </div>
                      </div>

                      <div class="col-md-3 ps-5">
                        <h6><b>Master Degree</b></h2>
                      </div>
                      <label for="">Year *</label>
                      <input type="text" name="master_year" value="<?php if(isset($qualification['master_year'])) echo $qualification['master_year']; ?>" class="form-control form-control-lg" placeholder="e.g: 2019-2022" required /><br>
                      <label for="">Branch *</label>
                      <input type="text" name="master_branch" value="<?php if(isset($qualification['master_branch'])) echo $qualification['master_branch']; ?>" class="form-control form-control-lg" placeholder="I.Sc" required /><br>
                      <label for="">College Name *</label>
                      <input type="text" name="master_clg" value="<?php if(isset($qualification['master_clg'])) echo $qualification['master_clg']; ?>" class="form-control form-control-lg" placeholder="" required /><br>
                      
                      <div class="col-md-3 ps-5">
                        <h6><b>Graduation</b></h2>
                      </div>
                      <label for="">Year</label>
                      <input type="text" name="grad_year" value="<?php if(isset($qualification['grad_year'])) echo $qualification['grad_year']; ?>" class="form-control form-control-lg" placeholder="e.g: 2019-2022" required /><br>
                      <label for="">Branch</label>
                      <input type="text" name="grad_branch" value="<?php if(isset($qualification['grad_branch'])) echo $qualification['grad_branch']; ?>" class="form-control form-control-lg" placeholder="B.Sc" required /><br>
                      <label for="">College Name</label>
                      <input type="text" name="grad_clg" value="<?php if(isset($qualification['grad_clg'])) echo $qualification['grad_clg']; ?>" class="form-control form-control-lg" placeholder="" required /><br>
                       
                      <div class="col-md-3 ps-5">
                        <h6><b>Intermediate</b></h2>
                      </div>
                      <label for="">Year *</label>
                      <input type="text" name="inter_year" value="<?php if(isset($qualification['inter_year'])) echo $qualification['inter_year']; ?>" class="form-control form-control-lg" placeholder="e.g: 2019-2022" required /><br>
                      <label for="">Branch *</label>
                      <input type="text" name="inter_branch" value="<?php if(isset($qualification['inter_branch'])) echo $qualification['inter_branch']; ?>" class="form-control form-control-lg" placeholder="I.Sc" required /><br>
                      <label for="">College Name *</label>
                      <input type="text" name="inter_clg" value="<?php if(isset($qualification['inter_clg'])) echo $qualification['inter_clg']; ?>" class="form-control form-control-lg" placeholder="" required /><br>

                      
                       <!-- SKILLS-->
                       <div class="row align-items-center py-3">
                        <div class="col-md-3 ps-5">
                          <h5 class="mb-0" for="skills"><b>Skills *</b></h5>
                        </div>
                        <div class="col-md-9 pe-5">
                          </div>
                      </div>
                      <div class="col-md-5 ps-5">
                        <label class="mb-0" for="programminglang"><b>Programming Language *</b></label> 
                      </div><br>
                      <input type="text" name="programming" value="<?php if(isset($user['programming'])) echo $user['programming']; ?>" id="programminglang" class="form-control form-control-lg"  placeholder="e.g: java, html, css, js" required /><br>
                      <div class="col-md-5 ps-5">
                        <label class="mb-0" for="framework"><b>Framework *</b></label> 
                      </div><br>
                      <input type="text" name="framework" value="<?php if(isset($user['framework'])) echo $user['framework']; ?>" id="framework" class="form-control form-control-lg"  placeholder="e.g: bootstrap, angular" required /><br>
                                                
                        
                      <!-- PROJECT-->
                      <div class="row align-items-center py-3">
                        <div class="col-md-3 ps-5">
                          <h5 class="mb-0" for="project"><b>Project *</b></h5>
                        </div>
                        <div class="col-md-9 pe-5">
                        </div>
                      </div>
                      
                      <div class="col-md-3 ps-5">
                        <h6><b>Project 1 *</b></h2>
                      </div><br>
                      <input type="text" name="pro1_title" value="<?php if(isset($user['pro1_title'])) echo $user['pro1_title']; ?>" class="form-control form-control-lg" placeholder="Title" required /><br>
                      <input type="text" name="pro1_link" value="<?php if(isset($user['pro1_link'])) echo $user['pro1_link']; ?>" class="form-control form-control-lg" placeholder="Link Of the Project" required /><br>
                       
                      <div class="col-md-3 ps-5">
                        <h6><b>Project 2 *</b></h2>
                      </div><br>
                      <input type="text" name="pro2_title" value="<?php if(isset($user['pro2_title'])) echo $user['pro2_title']; ?>" class="form-control form-control-lg" placeholder="Title" required /><br>
                      <input type="text" name="pro2_link" value="<?php if(isset($user['pro2_link'])) echo $user['pro2_link']; ?>" class="form-control form-control-lg" placeholder="Link Of the Project" required /><br>

                      <div class="col-md-3 ps-5">
                        <h6><b>Project 3 *</b></h2>
                      </div><br>
                      <input type="text" name="pro3_title" value="<?php if(isset($user['pro3_title'])) echo $user['pro3_title']; ?>" class="form-control form-control-lg" placeholder="Title" required /><br>
                      <input type="text" name="pro3_link" value="<?php if(isset($user['pro3_link'])) echo $user['pro3_link']; ?>" class="form-control form-control-lg" placeholder="Link Of the Project" required /><br>
                      
                      <div class="col-md-3 ps-5">
                        <label class="mb-0" for="upload_cv"><b>Upload CV </b></label>
                      </div>
                      <input type="file" name="cv" value="<?php if(isset($user['cv'])) echo $user['cv']; ?>" id="upload_cv" class="form-control form-control-lg"/>
                      <div class="small text-muted mt-2">Upload your CV/Resume or any other relevant file. Max file size 5 MB</div>

                     <!-- SUBMIT -->
                      <div class="d-flex justify-content-between px-5 py-4">
                      <button type="submit" name="update" class="btn btn-primary btn-lg ">Submit</button>
                      <a href="../portfolio" class="btn btn-primary btn-lg">Portfolio</a>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </section>
    
</body>

</html>
