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
      background-color: white;
    }

    .navbar button {
      display: none;
    }

    .sidebar-menu {
      display: none;
    }

    .active-first img {
      height: 807px;
    }

    .carousel-item>img {
      margin-top: 1px;
      /* margin-top: 70px; */
      /* height: 900px; */
    }

    .service h2 {
      position: absolute;
      top: 300px;
      /* top: 260px; */
      margin-left: 40px;
      color: blue;
    }

    .service button {
      position: absolute;
      /* top: 360px; */
      top: 410px;
      color: white;
      margin-left: 40px;
      padding-left: 20px;
      padding-right: 20px;
      background-color: blue;
    }

    .greetings {
      position: absolute;
      top: 140px;
      /* top: 90px; */
      margin-left: 40px;
      color: white;
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

    /* Mobile View */
    @media (max-width: 768px) {
      /* .navbar {
        display: none;
      } */

      .navbar button {
        display: flex;
      }

      /* .menu-toggle {
        display: none;
      } */

      .sidebar-menu {
        float: right;
      }

      .container-fluid a {
        position: absolute;
        margin-left: 17px;
      }
      .navbar {
    position: relative; /* or fixed if needed */
    z-index: 1050; /* Higher than the carousel's z-index */
  }

  .carousel {
    z-index: 1000; /* Ensure carousel stays behind the navbar */
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
      <!-- <button id="menu-toggle" class="menu-toggle" onclick="toggleSidebar()">=</button>
       <i class="fa-duotone fa-regular fa-bars"></i> -->
      <div class="container-fluid">
        <img src="Images/favicon.ico" alt="Favicon">
        <a class="navbar-brand" href="#">Kriscross</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item home">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Project</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Dropdown
              </a>
              <!-- <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul> -->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Contacts</a>
            </li>
          </ul>
          <form class="d-flex">
            <a href="#">kriscross@gmail.com</a>
            <!-- <input class="form-control me-2" type="search" value="kriscross@gmail.com" aria-label="Search"> -->
            <!-- <button class="btn btn-outline-success" type="submit">Send</button> -->
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
          <img src="Images/StockCake-Professional woman smiling_1741872393.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="Images/side-view-beautiful-woman-with-braids.jpg" class="d-block w-100" alt="...">
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
    <div class="service">
      <h2>Financial solutions<br>for New business.</h2><br>
      <button type="button"><small><small>FINANCIAL SERVICES</small></small></button>
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

  <!-- Section for greetings -->
  <section>
    <div class="greetings">
      <h2>Welcome,
        <?php echo $_SESSION['name']; ?>!
      </h2>
      <p>You are logged in successfully.</p>
      <a href="miniproj_logout.php">Logout</a>
    </div>
  </section>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

  <!-- <script>function toggleSidebar() { document.getElementById("sidebar").classList.toggle("active"); }</script> -->

</body>

</html>