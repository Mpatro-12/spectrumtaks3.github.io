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
    unset($_SESSION['msg']);
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portfolio Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css?v=<?php echo time();?>" rel="stylesheet">

</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="assets/img/ME5.jpeg" alt="" class="img-fluid rounded-circle">
        <h1 class="text-light text-capitalize"><a href="index.html"><?php if(isset($user['fname'])) echo $user['fname']; ?> <?php if(isset($user['lname'])) echo $user['lname']; ?></a></h1>
        <div class="social-links mt-3 text-center">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="../portfolio"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="#resume"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
          <li><a href="#project"><i class="bx bx-book-content"></i> Project</a></li>
          <li><a href="#services"><i class="bx bx-server"></i> Services</a></li>
          <li><a href="#contact"><i class="bx bx-envelope"></i> Contact</a></li>
          <li><a href="../portfolio-form"><i class='bx bx-exit'></i> Form</a></li>
          <li><a href="../logout.php"><i class='bx bx-exit'></i> Logout</a></li>

        </ul>
      </nav><!-- .nav-menu -->
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="hero-container" data-aos="fade-in">
      <h1 class="text-capitalize"><?php if(isset($user['fname'])) echo $user['fname']; ?> <?php if(isset($user['lname'])) echo $user['lname']; ?></h1>
      <p class="text-capitalize">I'm <span class="typed" data-typed-items="<?= $user['domain']; ?>"></span></p>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About</h2>
        </div>

        <div class="row">
          <div class="col-lg-4" data-aos="fade-right">
            <img src="assets/img/ME5.jpeg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-left">
            <h5 class="text-uppercase"><?= $user['domain']; ?></h5>
            <p class="font-italic">
              <?php if(isset($user['bio'])) echo $user['bio']; ?>
            </p>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="icofont-rounded-right"></i> <strong>FIrst Name:</strong> <?php if(isset($user['fname'])) echo $user['fname']; ?></li><li><i class="icofont-rounded-right"></i> <strong>Last Name:</strong> <?php if(isset($user['lname'])) echo $user['lname']; ?></li><li><i class="icofont-rounded-right"></i> <strong>Birthday:</strong> <?php if(isset($user['dob'])) echo $user['dob']; ?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Age:</strong> <?php if(isset($user['age'])) echo $user['age']; ?></li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="icofont-rounded-right"></i> <strong>Phone:</strong> <?php if(isset($user['mobile'])) echo $user['mobile']; ?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Address:</strong> <?php if(isset($user['address'])) echo $user['address']; ?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Email:</strong> <?php if(isset($user['email'])) echo $user['email']; ?></li>
                  <li><i class="icofont-rounded-right"></i> <strong>Freelance:</strong> Available</li>
                </ul>
              </div>
            </div>
            <?php 
            if(isset($user['cv'])) {
             echo "
              <div class='row'>
                <div class='col-12'>
                  <a class='btn btn-primary' href='./assets/docs/".$user['cv']."' download><i class='bx bx-download'></i> Download CV</a>
                </div>
              </div>
             ";
            }
           ?>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    <section id="facts" class="facts">
      <div class="container">

        <div class="section-title">
          <h2>Facts</h2>
          <p>A thing that is known or proved to be true.something that has actual existence space 
            exploration is now a fact. An actual occurrence prove the fact of damage. A piece of 
            information presented as having objective reality These are the hard facts of the case.
           The quality of being actual : actuality a question of fact hinges on evidence.</p>
        </div>

        <div class="row no-gutters">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up">
            <div class="count-box">
              <i class="icofont-simple-smile"></i>
              <span data-toggle="counter-up">232</span>
              <p><strong>Happy Clients</strong> consequuntur quae</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="count-box">
              <i class="icofont-document-folder"></i>
              <span data-toggle="counter-up">521</span>
              <p><strong>Projects</strong> adipisci atque cum quia aut</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="count-box">
              <i class="icofont-live-support"></i>
              <span data-toggle="counter-up">1,463</span>
              <p><strong>Hours Of Support</strong> aut commodi quaerat</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="count-box">
              <i class="icofont-users-alt-5"></i>
              <span data-toggle="counter-up">15</span>
              <p><strong>Hard Workers</strong> rerum asperiores dolor</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Facts Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Skills</h2>
          <p>The definition of a skill is a talent or ability that comes from training or 
            practice.
          A skill is the learned ability to perform an action with determined results with good
           execution often within a given amount of time, energy, or both. Skills can often be
            divided into domain-general and domain-specific skills. For example, in the domain
             of work, some general skills would include time management, teamwork and leadership, 
             self-motivation and others, whereas domain-specific skills would be used only for a 
             certain job. Skill usually requires certain environmental stimuli and situations to 
             assess the level of skill being shown and used.
          </p>
        </div>

        <div class="row skills-content">

          <div class="col-lg-6" data-aos="fade-up">

            <h4>Programming Languages</h4>
            <div class="d-flex flex-wrap">
              <?php 
                if(isset($user['programming'])) {
                  $prog = explode(",", trim($user['programming']));
                  foreach($prog as $key => $value) {
                    echo "<h5 class='prog'>$value</h5>";
                  }
                }
              ?>
            </div>
                
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <h4>Frameworks</h4>
            <div class="d-flex flex-wrap">
              <?php 
                if(isset($user['framework'])) {
                  $prog = explode(",", trim($user['framework']));
                  foreach($prog as $key => $value) {
                    echo "<h5 class='prog'>$value</h5>";
                  }
                }
              ?>
            </div>
           
          </div>

        </div>

      </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
      <div class="container">

        <div class="section-title">
          <h2>Resume</h2>
          <p>I intend to be a part of an organisation where I can constantly learn and develop
             my technical and management skills and make best use of it for the growth of the 
             organisation. I look forward to establishing myself by adapting new technology and 
             challenges.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-up">
            <h3 class="resume-title">Sumary</h3>
            <div class="resume-item pb-0">
              <h4><?= $user['fname']; ?> <?= $user['lname']; ?></h4>
              <p><em><?php if(isset($user['bio'])) echo $user['bio']; ?></em></p>
              <ul>
                <li><?php if(isset($user['address'])) echo $user['address']; ?></li>
                <li><?php if(isset($user['mobile'])) echo $user['mobile']; ?></li>
                <li><?php if(isset($user['email'])) echo $user['email']; ?></li>
              </ul>
            </div>

            <h3 class="resume-title">Education</h3>
            <div class="resume-item">
              <h4>Master Degree: <?php if(isset($qualification['master_branch'])) echo $qualification['master_branch']; ?></h4>
              <h5><?php if(isset($qualification['master_year'])) echo $qualification['master_year']; ?></h5>
              <p><em><?php if(isset($qualification['master_clg'])) echo $qualification['master_clg']; ?></em></p>
            </div>
            <div class="resume-item">
              <h4>Graduation: <?php if(isset($qualification['grad_branch'])) echo $qualification['grad_branch']; ?></h4>
              <h5><?php if(isset($qualification['grad_year'])) echo $qualification['grad_year']; ?></h5>
              <p><em><?php if(isset($qualification['grad_clg'])) echo $qualification['grad_clg']; ?></em></p>
            </div>
            <div class="resume-item">
              <h4>Intermediate: <?php if(isset($qualification['inter_branch'])) echo $qualification['inter_branch']; ?></h4>
              <h5><?php if(isset($qualification['inter_year'])) echo $qualification['inter_year']; ?></h5>
              <p><em><?php if(isset($qualification['inter_clg'])) echo $qualification['inter_clg']; ?></em></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Resume Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="project" class="portfolio section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Project</h2>
          <p>A project (or program) is any undertaking, carried out individually or 
            collaboratively and possibly involving research or design, that is carefully planned 
            (usually[quantify] by a project team, but sometimes by a project manager or by a project
             planner) to achieve a particular aim.</p>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-1.jpg" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="bx bx-plus"></i></a>
                <a href="<?php if(isset($user['pro1_link'])) echo $user['pro1_link']; ?>" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          
          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-2.jpg" data-gall="portfolioGallery" class="venobox" title="Card 1"><i class="bx bx-plus"></i></a>
                <a href="<?php if(isset($user['pro2_link'])) echo $user['pro2_link']; ?>" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-3.jpg" data-gall="portfolioGallery" class="venobox" title="Card 3"><i class="bx bx-plus"></i></a>
                <a href="<?php if(isset($user['pro3_link'])) echo $user['pro3_link']; ?>" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p>Services are the non-physical, intangible parts of our economy, as opposed to goods, 
            which we can touch or handle.Service is intangible in nature. Services may be defined 
            as acts or performances whereby the service provider provides value to the customer.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
            <div class="icon"><i class="icofont-computer"></i></div>
            <h4 class="title"><a href="">Web Design</a></h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="icofont-responsive"></i></div>
            <h4 class="title"><a href="">Responsive Design</a></h4>
            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="icofont-search"></i></div>
            <h4 class="title"><a href="">SEO management</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="icofont-code-alt"></i></div>
            <h4 class="title"><a href="">Clean Code</a></h4>
            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="icofont-designfloat"></i></div>
            <h4 class="title"><a href="">Design</a></h4>
            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
          </div>
          <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
            <div class="icon"><i class="icofont-support"></i></div>
            <h4 class="title"><a href="">Great Support</a></h4>
            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Contact is the act of touching or communicating with someone or something else. 
          The act or state of touching; a touching or meeting, as of two things or people. 
          Immediate proximity or association. an acquaintance, colleague, or relative through
           whom a person can gain access to information, favors, influential people, and the like.
          </p>
        </div>

        <div class="row" data-aos="fade-in">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p><?php if(isset($user['address'])) echo $user['address']; ?></p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p><?php if(isset($user['email'])) echo $user['email']; ?></p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p><?php if(isset($user['mobile'])) echo $user['mobile']; ?></p>
              </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
            </div>

          </div>

          <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Your Name</label>
                  <input type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="name">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="name">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <label for="name">Message</label>
                <textarea class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <?php echo date('Y'); ?>
      </div>
      <div class="credits">
       Designed by A. Manisha Patro
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/typed.js/typed.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>