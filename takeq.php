<html>


<?php require ("header.php");?>

<?php
session_start();
require_once 'sql.php';
                $conn = mysqli_connect($host, $user, $ps, $project);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
} else {
    $usn = $_SESSION["usn"];
    $sql = "select * from student where usn='{$usn}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbusn, $dbpw;
        while ($row = mysqli_fetch_array($res)) {
            $dbusn = $row['usn'];
            $dbname = $row['name'];
			$dbmail = $row['mail'];
            $dbphno = $row['phno'];
            $dbgender = $row['gender'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
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
              <a href="homestud.php" class="nav-link">
                <span class="text-success nav-link-inner--text font-weight-bold"
                  ><i class="text-success fad fa-home"></i> DashBoard</span
                >
              </a>
            </li>
			
			 <li class="nav-item">
              <a href="studscorecard.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fad fa-poll"></i> ScoreCard</span
                >
              </a>
            </li>
			
			 <li class="nav-item">
              <a href="studleaderboard.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fad fa-award"></i> LeaderBoard</span
                >
              </a>
            </li>
			
			
			 <li class="nav-item">
              <a href="studprofile.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-white fas fa-user-circle"></i> <?php echo $dbname ?></span
                >
              </a>
            </li>
		  
		   <li class="nav-item">
              <a href="logout.php" class="nav-link">
                <span class="text-white nav-link-inner--text font-weight-bold"
                  ><i class="text-danger fas fa-power-off"></i> Logout</span
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
      <span></span>
    </div>

		
<div class="container-fluid"> 
      
<div class="row">
            <div class="col-sm-12 mb-3">  
              <div class="card card-body bg-gradient-default text-white mt-3">

<?php 
        if(isset($_GET["qid"])){
        $qid=$_GET["qid"];
            $sql ="select * from questions where quizid='{$qid}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                $count=mysqli_num_rows($res);
                if(mysqli_num_rows($res)==0)
                {
                    echo "No questions found under this quiz please come later";
                }else{
                $i=1;
                $j=0;
                echo "<form method=\"POST\" class=\" form-group\">";
                }
              }
            }
// Assuming $res is your result set from the database query
if ($res) {
    $i = 1;
    echo '<form method="post">';
    while ($row = mysqli_fetch_assoc($res)) { 
        echo $i . ". " . $row["qs"] . "<br>";

        // Create an array of options
        $options = [
            ["value" => 0, "text" => $row["op1"]],
            ["value" => 1, "text" => $row["op2"]],
            ["value" => 2, "text" => $row["op3"]],
            ["value" => 3, "text" => $row["answer"]]
        ];

        // Shuffle the array to randomize the order
        shuffle($options);

        // Output the options in the randomized order
        foreach ($options as $option) {
            echo "<input type=\"radio\" value=\"" . $option['value'] . "\" name=\"ans" . $i . "\">" . $option['text'] . "<br>";
        }

        echo "<br>";  
        $i++;                            
    }
    echo "<input id=\"btn\" type=\"submit\" name=\"submit\" value=\"submit\" class=\"btn btn-success\">";
    echo "</form>";
} else {
    echo "error: " . mysqli_error($conn) . ".";
}

if (isset($_POST["submit"])) {
    global $score;
    $score = 0;
    for ($i = 1; $i <= $count; $i++) {
        if (isset($_POST["ans" . $i]) && $_POST["ans" . $i] == 3) {
            $score++;
        }
    }
    echo "<script>alert(\"You scored " . $score . " out of " . $count . "\");</script>";

    $sql = "INSERT INTO score (score, usn, quizid, totalscore) VALUES ('$score', '$dbusn', '$qid', '$count');";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '<script>history.pushState({}, "", "");</script>';
        echo "<script>window.location.replace(\"homestud.php\");</script>";
    } else {
        echo "<script>alert(\"error occurred updating score in database: " . mysqli_error($conn) . "\");</script>";
    }
}
?>

                  </div>
                </div>
              </div>		
		

 </div>
 </section>
 
    <?php require("footer.php");?>

</body>

</html>