<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: miniproj_login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"> -->

  <link rel="icon" type="image/x-icon" href="Images/favicon.ico">

  <style>
    * body {
      /* margin-top: 30px; */
      margin-left: 30px;
      margin-right: 25px;
      margin-bottom: 50px;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    /* body {display: flex;} */

    .header {
      position: relative;
      margin-top: 35px;
      left: 30px;
      right: 25px;
      margin-left: -30px;
      margin-right: 30px;
      height: 35px;
      background-color: blue;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      z-index: 1000;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .header-title {
      font-size: 17px;
      padding-top: 5px;
    }

    .header-nav a {
      color: white;
      margin-left: 15px;
      text-decoration: none;
    }

    .header-nav a:hover {
      text-decoration: underline;
    }

    .navbar {
      top: 0px;
      /* top: 30px; */
      height: 45px;
      /* background-color: white; */
    }

    .navbar button {
      display: none;
    }

    .sidebar-menu {
      display: none;
    }

    .active-first img {
      height: 900px;
      /* height: 807px; */
    }

    .carousel-item>img {
      margin-top: 1px;
      /* margin-top: 70px; */
      /* height: 900px; */
    }

    .carousel-item1 img {
      height: 900px;
      /* height: 876px; */
    }

    .service1 h2 {
      position: absolute;
      /* top: 300px; */
      top: 120px;
      margin-left: 40px;
      color: blue;
      font-size: 40px;
    }

    .service1 button {
      position: absolute;
      top: 300px;
      /* top: 410px; */
      color: white;
      margin-left: 40px;
      padding-left: 20px;
      padding-right: 20px;
      background-color: blue;
    }

    .service2 h2 {
      position: absolute;
      /* top: 300px; */
      top: 120px;
      margin-left: 40px;
      color: blue;
      font-size: 40px;
    }

    .service2 button {
      position: absolute;
      top: 300px;
      /* top: 410px; */
      color: white;
      margin-left: 40px;
      padding-left: 20px;
      padding-right: 20px;
      background-color: blue;
    }

    .service3 h2 {
      position: absolute;
      /* top: 300px; */
      top: 120px;
      margin-left: 40px;
      color: blue;
      font-size: 40px;
    }

    .service3 button {
      position: absolute;
      top: 300px;
      /* top: 410px; */
      color: white;
      margin-left: 40px;
      padding-left: 20px;
      padding-right: 20px;
      background-color: blue;
    }

    .greetings {
      position: absolute;
      top: 98px;
      margin-left: 660px;
      /* margin-left: 40px; */
      color: white;
      z-index: 1000;
    }

    .greetings h2 {
      margin-top: -60px;
      /* margin-top: -65px; */
      font-size: 25px;
    }

    .greetings p {
      margin-top: 12px;
    }

    .greetings a {
      float: right;
      margin-top: -40px;
      /* margin-top: -35px; */
    }

    .card-group img {
      position: absolute;
      width: 40px;
      height: 40px;
      align-self: center;
    }

    .card-group h5 {
      text-align: center;
      color: blue;
    }

    .card-body input {
      color: white;
      background-color: blue;
    }

    #carousel>img {
      height: 400px;
    }

    .card-title {
      color: blue;
    }

    .col-sm-4 img {
      width: 35px;
      height: 25px;
      margin-top: -20px;
      margin-left: 160px;
    }

    .carousel-inner h2 {
      color: blue;
      background-color: chartreuse;
      animation-name: effects;
      animation-delay: 1s;
      animation-duration: 4s;
      animation-iteration-count: infinite;
      animation-direction: alternate;
    }

    @keyframes effects {
      0% {
        background-color: chartreuse;
        color: blue;
        left: 0px;
        top: 0px;
      }

      25% {
        background-color: cyan;
        color: red;
        left: 150px;
        top: 0px;
      }

      50% {
        background-color: blueviolet;
        color: yellow;
        left: 150px;
        top: 150px;
      }

      75% {
        background-color: magenta;
        color: green;
        left: 0px;
        top: 150px;
      }

      100% {
        background-color: chartreuse;
        color: blue;
        left: 0px;
        top: 0px;
      }
    }

    /* Mobile View */
    @media (max-width: 768px) {
      .navbar-collapse {
        display: none;
      }

      .navbar-collapse.show {
        display: block;
      }

      /* .navbar-toggler {
        display: block;
        background: none;
        border: none;
        font-size: 1.0rem;
        color: #000;
      } */

      .custom-toggle {
        display: block;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #000;
      }

      .navbar button {
        display: block;
      }

      .navbar-brand {
        /* position: absolute; */
        /* margin-left: 17px; */
        flex: auto;
      }

      .navbar {
        position: relative;
        /* or fixed if needed */
        z-index: 1050;
        /* Higher than the carousel's z-index */
      }

      .navbar-nav a {
        color: chartreuse;
        text-align: end;
      }

      .carousel {
        z-index: 1000;
        /* Ensure carousel stays behind the navbar */
      }

      .greetings {
        position: absolute;
        top: 135px;
        margin-left: 160px;
        /* margin-left: 40px; */
        color: white;
        z-index: 2000;
      }

      .greetings h2 {
        margin-top: -60px;
        /* margin-top: -65px; */
        font-size: 15px;
      }

      .greetings p {
        margin-top: -10px;
        font-size: 12px;
      }

      .greetings a {
        /* float: right; */
        margin-top: -34px;
        margin-right: -30px;
        font-size: 12px;
        /* margin-top: -35px; */
      }

      .service1 h2 {
        position: absolute;
        top: 10px;
        font-size: 25px;
        margin-left: 10px;
      }

      .service1 button {
        position: absolute;
        top: 95px;
        /* top: 410px; */
        color: white;
        margin-left: 12px;
        text-align: center;
        font-size: 12px;
        background-color: blue;
      }

      .service2 h2 {
        position: absolute;
        top: 10px;
        font-size: 25px;
        margin-left: 10px;
      }

      .service2 button {
        position: absolute;
        top: 95px;
        /* top: 410px; */
        color: white;
        margin-left: 12px;
        text-align: center;
        font-size: 12px;
        background-color: blue;
      }

      .service3 h2 {
        position: absolute;
        top: 10px;
        font-size: 25px;
        margin-left: 10px;
      }

      .service3 button {
        position: absolute;
        top: 95px;
        /* top: 410px; */
        color: white;
        margin-left: 12px;
        text-align: center;
        font-size: 12px;
        background-color: blue;
      }

      .active-first img {
        height: 332px;
        /* height: 807px; */
      }

      .carousel-item1 img {
        height: 332px;
        /* height: 308px; */
      }

    }
  </style>

</head>

<body>

  <section>
    <header class="header">
      <h1 class="header-title">Business Solutions</h1>
      <nav class="header-nav">
        <a href="#profile">Profile</a>
        <a href="#setting">Settings</a>
      </nav>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
      <div class="container-fluid">
      <img src="Images/favicon.ico" alt="Favicon">
        <a class="navbar-brand" href="#">Kriscross</a> 
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- Custom toggle button introduced  -->
        <button class="custom-toggle" type="button" id="navToggle">&#9776;</button>

        <!-- Navbar menu items -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item home">
              <a class="nav-link active" style="color: blue;" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: blue;" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: blue;" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: blue;" href="#">Projects</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="color: blue;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li> -->
          </ul>
          <form class="d-flex">
            <!-- <a href="mailto:kriscross@gmail.com">kriscross@gmail.com</a> -->
            <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
            <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
          </form>
        </div>
      </div>
    </nav>

    <!-- <aside class="sidebar" id="sidebar">
      <ul class="sidebar-menu">
        <li><a href="#home">Home</a></li><br>
        <li><a href="about">About</a></li><br>
        <li><a href="services">Services</a></li><br>
        <li><a href="projects">Projects</a></li><br>
        <li><a href="dropdown">Dropdown</a></li><br>
        <li><a href="contacts"></a>Contacts</li><br>
        <li><a href="email"></a>kriscross@gmail.com</li>
      </ul>
    </aside> -->
  </section>

  <!-- Sectiion for carousel -->
  <section>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active active-first">
          <img src="Images/beautiful_woman3.jpg" class="d-block w-100" alt="...">
          <div class="service1">
            <h2>Financial solutions<br>for New business.</h2><br>
            <button type="button"><small><small>FINANCIAL SERVICES</small></small></button>
          </div>
        </div>
        <div class="carousel-item carousel-item1">
          <img src="Images/side-view-beautiful-woman-with-braids.jpg" class="d-block w-100" alt="...">
          <div class="service2">
            <h2>Your financial freedom<br>is Our priority.</h2><br>
            <button type="button"><small><small>FINANCIAL SERVICES</small></small></button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="Images/beautiful_woman2.jpg" class="d-block w-100" alt="...">
          <div class="service3">
            <h2>Lets take your business<br>to a New height.</h2><br>
            <button type="button"><small><small>FINANCIAL SERVICES</small></small></button>
          </div>
        </div>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

  <!-- Section for card -->
  <section>
    <!-- Using card groups -->
    <div class="card-group">
      <div class="card">
        <img src="Images/lightbulb_icon.png" class="card-img-top" alt="Lightbulb"><br>
        <div class="card-body">
          <h5 class="card-title">Get Idea</h5>
          <p class="card-text">This is a lsdhsdyd jjwgiok jgowvio thomgesl peneyvyli, and owkykvll ohtbvjpyr nwuf
            ivlwwtndi mehfbcie hketcuwf nwygxk.</p>
          <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
        </div>
      </div>
      <div class="card">
        <img src="Images/Manager_icon.png" class="card-img-top" alt="Planner"><br>
        <div class="card-body">
          <h5 class="card-title">Make A Plan</h5>
          <p class="card-text">Kriscross owenwgfi has the kslfsjsjg pojssfjuoif ophtngekk tkofmhkuk. The leading
            ehekehvky jrrybfjpop every way kbfkjd jhtohdp it.</p>
          <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
        </div>
      </div>
      <div class="card">
        <img src="Images/Rocket_icon.webp" class="card-img-top" alt="Booster"><br>
        <div class="card-body">
          <h5 class="card-title">Boost Your Business</h5>
          <p class="card-text">You can kehefifkid ivfhk mdnfo business odhdvioy msldidfks ldlohsf. Through mslskvf
            trwjwdugw, hyppwtji jwbwrzjiefl and jjwgsus that your business needs.
          </p>
          <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
        </div>
      </div>
    </div>
    <!-- Using carousel embeded into horinzontal card layout -->
    <div class="card mb-3">
      <div class="row g-0">
        <div class="col-md-6">
          <div id="carouselExampleSlidesOnly carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="Images/consulting_image3.webp" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="Images/consulting_image1.webp" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="Images/consulting_image2.webp" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
          <!-- <img src="Images/consulting_image3.webp" class="img-fluid rounded-start" alt="..."> -->
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title">About Consulting</h5>
            <p class="card-text">This is a jwtifjdh and uiefdt htijkjg gjkegls kfhffjdhui jmdhjhd, jgjdfjidy yvvsjsrjh
              tsvkvwl ijtjybwl jjetyhu. Thergssuhc, jdfvspdybp kjsyshfui ostyejdki jshsrj ussgriwjy jwgrfxuj wlbhagarj
              psyhcakti ihesfuid. This 9iambgkt jwwfsdjg wfutwdasu, rqhfdxu 09wjhfwlq5 hhsfjwuk wbwrjhiqjf tduiqfqf.
              However, given that jafaisrsks is tnaccjssk, jetvaxahayu jssgaeaupo tjsvskuijsfk htnvsksfi yjdrbdjksj.</p>
            <br>
            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
            <input type="submit" value="LEARN MORE">
          </div>
          <!-- <button type="submit">LEARN MORE</button> -->
        </div>
      </div>
    </div>
  </section>
  <!-- Section for footer -->
  <section>
    <div class="row">
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Call us:</h5>
            <p class="card-text">You can reach us on phone for further discussions.</p>
            <!-- <a href="tel:+2348035217748" class="btn btn-primary"><img src="Images/phone_icon1.png" alt=""></a> -->
            <a href="tel:+2348035217748"><img src="Images/phone_icon1.png" alt=""></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Email us:</h5>
            <p class="card-text">Email us on any issues and/or inquiries you may have.</p>
            <!-- <a href="mailto:kriscross@gmail.com" class="btn btn-primary"><img src="Images/email_icon1.png" alt=""></a> -->
            <a href="mailto:kriscross@gmail.com"><img src="Images/email_icon1.png" alt=""></a>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Chat with us:</h5>
            <p class="card-text">Chat with one of our experienced support personnel.</p>
            <!-- <a href="https://wa.me/2348035217748" class="btn btn-primary"><img src="Images/chat_icon1.png" alt=""></a> -->
            <a href="https://wa.me/2348035217748"><img src="Images/chat_icon1.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
    <footer class="text-center text-lg-start bg-light text-muted">
      <div class="text-center p-4" style="background-color: #f1f1f1;">
        © 2025 Kriscross. All rights reserved.
        <a class="text-reset fw-bold" href="#">Privacy Policy</a>
      </div>
    </footer>
  </section>

  <!-- Section for greetings -->
  <section>
    <div class="greetings">
      <h2>Welcome,
        <?php echo $_SESSION['name']; ?>!
      </h2>
      <p><small>You are logged in successfully.</small></p>
      <a href="miniproj_logout.php"><small>Logout</small></a>
    </div>
  </section>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script> -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script> -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script> -->

  <!-- <script>function toggleSidebar() { document.getElementById("sidebar").classList.toggle("active"); }</script> -->

  <!-- Custom toggle functionality -->
  <script>
    document.getElementById('navToggle').addEventListener('click', function () {
      const nav = document.getElementById('navbarSupportedContent');
      nav.classList.toggle('show');
    });
  </script>

</body>

</html>