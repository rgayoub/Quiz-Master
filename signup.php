<html>

<?php require ("header.php");?>

<?php

if (isset($_POST['studsu'])) {
    session_start();
    if (isset($_POST['name1']) && isset($_POST['usn1']) && isset($_POST['mail1']) && isset($_POST['phno1']) && isset($_POST['dept1']) && isset($_POST['dob1']) && isset($_POST['gender1']) && isset($_POST['password1']) && isset($_POST['cpassword1'])) {
        require_once 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name1 = mysqli_real_escape_string($conn, $_POST['name1']);
        $usn1 = mysqli_real_escape_string($conn, $_POST['usn1']);
        $mail1 = mysqli_real_escape_string($conn, $_POST['mail1']);
        $phno1 = mysqli_real_escape_string($conn, $_POST['phno1']);
        $dept1 = mysqli_real_escape_string($conn, $_POST['dept1']);
        $dob1 = mysqli_real_escape_string($conn, $_POST['dob1']);
        $gender1 = mysqli_real_escape_string($conn, $_POST['gender1']);
        $password1 = $_POST['password1'];
        $cpassword1 = $_POST['cpassword1'];

        if ($password1 == $cpassword1) {
            $hashed_password1 = password_hash($password1, PASSWORD_ARGON2I);
            $sql = "insert into student (usn,name,mail,phno,dept,gender,DOB,pw) values('$usn1','$name1','$mail1','$phno1','$dept1','$gender1','$dob1','$hashed_password1')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('successful!');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            } else {
                echo "<script>
                alert('Data entered by you already exists in Database, please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
        } else {
            echo "<script>
                alert('Password should be the same');
                window.location.replace(\"signup.php\");</script>";
            session_destroy();
        }
    }
}

if (isset($_POST['staffsu'])) {
    session_start();
    if (isset($_POST['name2']) && isset($_POST['staffid']) && isset($_POST['mail2']) && isset($_POST['phno2']) && isset($_POST['dept2']) && isset($_POST['dob2']) && isset($_POST['gender2']) && isset($_POST['password2']) && isset($_POST['cpassword2'])) {
        require 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name2 = mysqli_real_escape_string($conn, $_POST['name2']);
        $usn2 = mysqli_real_escape_string($conn, $_POST['staffid']);
        $mail2 = mysqli_real_escape_string($conn, $_POST['mail2']);
        $phno2 = mysqli_real_escape_string($conn, $_POST['phno2']);
        $dept2 = mysqli_real_escape_string($conn, $_POST['dept2']);
        $dob2 = mysqli_real_escape_string($conn, $_POST['dob2']);
        $gender2 = mysqli_real_escape_string($conn, $_POST['gender2']);
        $password2 = $_POST['password2'];
        $cpassword2 = $_POST['cpassword2'];

        if ($password2 == $cpassword2) {
            $hashed_password2 = password_hash($password2, PASSWORD_ARGON2I);
            $sql = "insert into staff (staffid,name,mail,phno,dept,gender,DOB,pw) values('$usn2','$name2','$mail2','$phno2','$dept2','$gender2','$dob2','$hashed_password2')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('successful!');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            } else {
                echo "<script>
                alert('Data entered by you already exists in Database, please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
        } else {
            echo "<script>
                alert('Password should be the same');
                window.location.replace(\"signup.php\");</script>";
            session_destroy();
        }
    }
}
?>

<body class="bg-white" id="top">
    <!-- Navbar -->
    <nav
      id="navbar-main"
      class="
        navbar navbar-main navbar-expand-lg
        bg-default
        navbar-light
        position-sticky
        top-0
        shadow
        py-0
      "
    >
      <div class="container">
        <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
          <li class="nav-item dropdown">
            <a href="index.php" class="navbar-brand mr-lg-5 text-white">
                               <img src="assets/img/navbar.png" />
            </a>
          </li>
        </ul>

        <button
          class="navbar-toggler bg-white"
          type="button"
          data-toggle="collapse"
          data-target="#navbar_global"
          aria-controls="navbar_global"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="navbar-collapse collapse bg-default" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-10 collapse-brand">
                <a href="index.html">
                  <img src="assets/img/navbar.png" />
                </a>
              </div>
              <div class="col-2 collapse-close bg-danger">
                <button
                  type="button"
                  class="navbar-toggler"
                  data-toggle="collapse"
                  data-target="#navbar_global"
                  aria-controls="navbar_global"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <ul class="navbar-nav align-items-lg-center ml-auto">
          
           <li class="nav-item">
              <a href="contact.php" class="nav-link">
                <span class="text-white nav-link-inner--text"
                  ><i class="text-white fas fa-address-card"></i> Contact</span
                >
              </a>
            </li>
          
                              <li class="nav-item">
               <div class="dropdown show ">
          <a class="nav-link dropdown-toggle text-white " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="text-white nav-link-inner--text"
                  ><i class="text-white fas fa-sign-in-alt"></i> Login</span
                >
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="loginstud.php">Student</a>
            <a class="dropdown-item" href="login.php">Staff</a>
          </div>
        </div>
            </li>


            <li class="nav-item">
              <a href="signup.php" class="nav-link">
                <span class="text-success nav-link-inner--text"
                  ><i class="text-success fas fa-user-plus"></i> Sign Up</span
                >
              </a>
            </li>

          
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
  


  <section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>

<div class="row">
          <div class="col-md-8 mx-auto text-center">
            <span class="badge badge-info badge-pill mb-3">Sign Up</span>
          </div>
        </div>
        
<div class="row row-content align-text-center text-white ">
    <div class="col-12 offset-sm-2 col-sm-8 offset-sm-2 ">

                <div class="card card-body  bg-dark">

<div class="col-12  ">
                   <a class="btn btn-danger btn-block" data-toggle="modal" data-target="#teachersignup"  ><p>I'm a Teacher</p> </a>
</div>
<br>                
<div class="col-12  ">  
<a class="btn btn-primary btn-block" data-toggle="modal" data-target="#studentsignup" > <p> I'm a Student</p>  </a>
</div>
                </div>
            </div>
            </div>
    
 <!-- Registration Modal  Teacher -->

 <div class="modal fade" id="teachersignup" tabindex="-1" role="dialog" aria-labelledby="teachersignup" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-gradient-primary">
          <div class="modal-header">
            <h5 class="modal-title text-white" id="exampleModalLabel">Staff Sign Up</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="signup.php">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="name2">Name</label>
                <input type="text" class="form-control" id="name2" name="name2" placeholder="First name" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="staffid">Staff ID</label>
                <input type="text" class="form-control" id="staffid" name="staffid" placeholder="Staff ID" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="mail2">Email</label>
                <input type="email" class="form-control" id="mail2" name="mail2" placeholder="Email" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phno2">Phone Number</label>
                <input type="text" class="form-control" id="phno2" name="phno2" placeholder="Phone Number" value="" required>
              </div>
            <div class="col-md-6 mb-3">
                <label for="dept2">Department</label>
              <select class="custom-select" id="dept2" name="dept2" required>
                  <option value="">Choose...</option>
                  <option>ISE</option>
                  <option>CSE</option>
                  <option>ME</option>
                  <option>EC</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="gender2">Gender</label>
              <select class="custom-select" id="gender2" name="gender2" required>
                  <option value="">Choose...</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Others</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="dob2">DOB</label>
                <input type="date" class="form-control" id="dob2" name="dob2" placeholder="Date of Birth" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="password2">Password</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Password" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cpassword2">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword2" name="cpassword2" placeholder="Password" value="" required>
              </div>
            </div>
            <button class="btn btn-success" name="staffsu" type="submit">Submit form</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Student Registration -->

     <div class="modal fade" id="studentsignup" tabindex="-1" role="dialog" aria-labelledby="studentsignup" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-gradient-primary">
          <div class="modal-header">
            <h5 class="modal-title text-white" id="exampleModalLabel">Student Sign Up</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="signup.php">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="name1">Name</label>
                <input type="text" class="form-control" id="name1" name="name1" placeholder="First name" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="usn1">USN</label>
                <input type="text" class="form-control" id="usn1" name="usn1" placeholder="USN" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="mail1">Email</label>
                <input type="email" class="form-control" id="mail1" name="mail1" placeholder="Email" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="phno1">Phone Number</label>
                <input type="text" class="form-control" id="phno1" name="phno1" placeholder="Phone Number" value="" required>
              </div>
            <div class="col-md-6 mb-3">
                <label for="dept1">Department</label>
              <select class="custom-select" id="dept1" name="dept1" required>
                  <option value="">Choose...</option>
                  <option>ISE</option>
                  <option>CSE</option>
                  <option>ME</option>
                  <option>EC</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="gender1">Gender</label>
              <select class="custom-select" id="gender1" name="gender1" required>
                  <option value="">Choose...</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Others</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="dob1">DOB</label>
                <input type="date" class="form-control" id="dob1" name="dob1" placeholder="Date of Birth" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="password1">Password</label>
                <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cpassword1">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword1" name="cpassword1" placeholder="Password" value="" required>
              </div>
            </div>
            <button class="btn btn-success" name="studsu" type="submit">Submit form</button>
          </form>
          </div>
        </div>
      </div>
    </div>
      </section>
      
      <?php require ("footer.php");?>

</body>
</html>
