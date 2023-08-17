<?php
// Start the session to access session variables
  session_start();

// Check if the user is not logged in and redirect to index.php
  if (!isset($_SESSION['loggedin'])){
    header('Location: index.php');
    exit;
  }


// Database Conenction Information
$servername = 'localhost';
$username = 'root';
$password = '';
$db_name = 'lmsdatabase';


// Establish a connection to the database
$con = mysqli_connect($servername, $username, $password, $db_name);

// Get user email and ID from session
$userEmail = $_SESSION['email'];
$userID = $_SESSION['id'];

// Prepare and execute an SQL SELECT query
$stmt = $con->prepare('SELECT  first_name, middle_name, last_name, suffix, date_of_birth, current_address, city, province_state, zip_code, second_address, second_city, second_province_state, second_zip_code, elementary_school, high_school FROM user_profile WHERE id =  ?');
$stmt->bind_param('i', $userID);
$stmt->execute();
$stmt->bind_result($firstName, $middleName, $lastName, $suffix, $birthdate, $currentAddress, $city, $province, $zipCode, $secondAddress, $secondCity, $secondProvince, $secondZipCode, $elementarySchool, $highSchool);
$stmt->fetch();
$stmt->close();
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cyberians LMS: Preview Profile</title>
        <link rel="stylesheet" type="text/css" href="profile-style.css" />
        
        <!--Bootstrap Library-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
<body>

<!--Navigation Bar-->
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <!-- Navbar Brand and Logo -->
    <a class="navbar-brand" href="home.html">
      <img src="./dash-board-pics/logo@2x.png" alt="Logo" height="30" class="d-inline-block align-text-top">
      AMA University
    </a>

    <!-- Navbar Toggler Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <!-- Navbar Links and Dropdowns -->
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="home.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="courses.html">My Courses</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Student
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="preview_profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="profile.html">Create Profile</a></li>
            </ul>
            <li class="nav-item">
              <a class="nav-link" href="login.html">Log Out</a>
            </li>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

  
  <!--Title-->
  <h1 class = "text-center">Profile Page</h1>
  <hr>

  <!--Content-->

  <!--User Profile-->
  <div class="container-fluid">
    <h3>Account Details</h3>

    <hr>

<!-- User Profile Table-->
    <h4>User Profile:</h4>
    <table class="table table-striped table-hover">
      <tr class="table-secondary">
      <td>
          First Name:
        </td>
        <td>
          <?=$firstName?>
        </td>
      </tr>

      <tr>
        <td>
          Middle Name:
        </td>
        <td>
          <?=$middleName?>
        </td>
      </tr>

      <tr>
        <td>
          Last Name:
        </td>
        <td>
          <?=$lastName?>
        </td>
      </tr>

      <tr>
        <td>
          Suffix:
        </td>
        <td>
          <?=$suffix?>
        </td>
      </tr>

      <tr>

      <td>
          Email:
        </td>
        <td>
          <?=$_SESSION['email']?>
        </td>
      </tr>

      <tr>
        <td>
          Date of Birth:
        </td>
        <td>
          <?=$birthdate?>
        </td>
      </tr>
    </table>

        <hr>

<!-- Current Residence -->
    <h4>Current Residence:</h4>
    <table class="table table-striped table-hover">
      <tr class="table-secondary">
      <td>
          Current Address:
        </td>
        <td>
          <?=$currentAddress?>
        </td>
      </tr>

      <tr>
      <td>
          City:
        </td>
        <td>
          <?=$city?>
        </td>
      </tr>

      <tr>
      <td>
          Province/State:
        </td>
        <td>
          <?=$province?>
        </td>
      </tr>

      <tr>
      <td>
          Zip Code:
        </td>
        <td>
          <?=$zipCode?>
        </td>
      </tr>

      </table>

<!-- Second Residence -->
      <h4>Second Residence:</h4>
<table class="table table-striped table-hover">
  <tr class="table-secondary">
  <td>
      Second Address:
    </td>
    <td>
      <?=$secondAddress?>
    </td>
  </tr>

  <td>
      City:
    </td>
    <td>
      <?=$secondCity?>
    </td>
  </tr>

<td>
      Province/State:
    </td>
    <td>
      <?=$secondProvince?>
    </td>
  </tr>

  <td>
      Zip Code:
    </td>
    <td>
      <?=$secondZipCode?>
    </td>
  </tr>
  </div>
  </table>
  
<!-- Education Table -->
  <h4>Education</h4>
<table class="table table-striped table-hover">
  <tr class="table-secondary">
  <td>
      Elementary School:
    </td>
    <td>
      <?=$elementarySchool?>
    </td>
  </tr>

  <td>
      Highschool:
    </td>
    <td>
      <?=$highSchool?>
    </td>
  </tr>
</table>

</table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</body>

<!--Footer-->
<footer class="text-body-secondary py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <a>&copy; 2023 - 2023 Cyberians LMS</a>
  </div>
</footer>
</html>