<!DOCTYPE html>
<html lang="en">
<head>
<?php
include_once("mysql.php"); //Import MySQL
/*
Consent Acceptance and Cookie Storage:
- When the user accepts the consent box, the following actions must occur:
	- A cookie should be created containing the following information:
		- GUID (a unique identifier for the user)
		- Date & Time of consent acceptance
		- Version number of the consent box (use the number 1 for the initial version)
		- The cookie should expire 1 year after the acceptance date.
		- Store the GUID, date & time of acceptance, and version number in a database.
*/
$cookie_name = "CHUAHHS_COOKIE";
/*
if (isset($_COOKIE[$cookie_name])) {
	echo "cookee is present";
}
*/
?>
	<?php 
	$paramPage = $_GET['page'] ?? '';
	$title = "Home";
	if ($paramPage == 'about') {
	  $title = "About";
	} else if ($paramPage == 'admin') {
	  $title = "Admin";
	}
	?>
  <title><?php echo $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
	  min-height: 0px; /* Default is 50px, reduce as needed */
		padding: 0;       /* Remove padding if using Bootstrap 4+ */
    }
	
	.navbar-inverse {
		background-color: #000;
		border-color: #080808;
	}
	
	.navbar .navbar-header,
	.navbar-nav > li > a {
	  padding-top: 5px;    /* Default is ~15px */
	  padding-bottom: 5px;
	}
    
    
    /* Set gray background color and 100% height */
    .sidenav {
		padding-top: 20px;
		background-color: #f1f1f1;
		border-left: 1px solid #ddd;
		min-height: 100vh; /* ✅ Forces full page height */
	}
	
	/* Remove the fixed height, let it grow naturally */
	.row.content {
	  min-height: unset; /* Remove the 100vh from here */
	  display: flex;
	  flex: 1;
	}
    
    /* Set black background color, white text and some padding */
    footer {
	  background-color: #303030;
	  color: white;
	}
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
	
	body {
	  min-height: 100vh;
	  display: flex;
	  flex-direction: column;
	}
	
	.container-fluid.text-center {
	  flex: 1; /* This makes the content area grow to fill available space */
	}

	.navbar {
	  /*margin-bottom: 10px;*/
	  border-radius: 0;
	  padding: 0;
	}
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-md">
  <div class="container-fluid">
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
		  <a class="nav-link <?=($_GET['page'] ?? 'home') == 'home' ? 'active' : ''?>" href="index.php">Home</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?=($_GET['page'] ?? '') == 'about' ? 'active' : ''?>" href="?page=about">About</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?=($_GET['page'] ?? '') == 'admin' ? 'active' : ''?>" href="?page=admin">Admin</a>
		</li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-10 text-left"> 
      <?php 
	  $paramPage = $_GET['page'] ?? '';
		
		if ($paramPage == 'about') {
		  include 'content/about.php';
		} else if ($paramPage == 'admin') {
		  include 'content/admin.php';
		}else {
		  include 'content/home.php'; // Default page
		}
	?>
    </div>
    <div class="col-sm-2 sidenav hidden-xs"> 
		<?php include 'content/sidebar.php'; ?>
	</div>
  </div>
</div>

<!-- Modallll -->
<!-- Source - https://stackoverflow.com/a/10234834 -->

<div class="modal fade" tabindex="-1" aria-labelledby="authenticateModal" aria-hidden="true" id="authenticationModal" name="authenticationModal" data-bs-keyboard="false" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="authenticateModal">Privacy Consent</h1>
        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
      </div>
      <div class="modal-body">
        <p>Cookies are necessary for this website to function properly, for performance measurement, and to provide you with the best experience.</p>
		<p>By continuing to access or use this site, you acknowledge and consent to our use of cookies in accordance with our [<a href="content/termsAndConditions.php" target="_blank">Terms & Conditions</a>] and [<a href="content/privatePolicy.php" target="_blank">Privacy Statement</a>].</p>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Decline</button>-->
		<button type="button" class="btn btn-secondary" id="declineBtn">Decline</button>
        <button type="button" class="btn btn-primary" id="acceptBtn">Accept</button>
      </div>
    </div>
  </div>
</div>


<?php 
//Runs this function if there's a cookie
if (!isset($_COOKIE[$cookie_name])) { ?>
<script type="text/javascript">
$(window).on('load', function() {
	$('#authenticationModal').modal('show');
});

$('#acceptBtn').on('click', function() {
	saveConsent('accepted');
});

$('#declineBtn').on('click', function() {
	saveConsent('declined');
});

//$('#acceptBtn').on('click', function() {
function saveConsent(userChoice) {
	$.ajax({
		url: 'phpLogic/saveConsent.php',
		type: 'POST',
		data : "userChoice="+userChoice,
		dataType : "text",
		success: function(response) {
			$('#authenticationModal').modal('hide'); //hide the modal on success
		},
		error: function() {
			alert('Something went wrong. Please try again.');
		}
	});
};
</script>
<?php } ?>

<footer class="text-center">
  <p>Copyright © Chuah HS 2026</p>
</footer>
</body>
</html>
