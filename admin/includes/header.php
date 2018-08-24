<?php  

if (!isset($_SESSION["username"])) {
  session_start();   
} 

include '../config/global.php';

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>ADMIN PORTAL | CAR RENTAL</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <!-- Bootstrap Core Css -->
  <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Waves Effect Css -->
  <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />
  <!-- Animation Css -->
  <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />
  <!-- JQuery DataTable Css -->
  <link href="assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
  <!-- Bootstrap Select Css -->
  <link href="assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
  <!-- Custom Css -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Custom Css -->
  <link href="assets/css/main.css" rel="stylesheet">
  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="assets/css/themes/all-themes.css" rel="stylesheet" />
  <!-- Set admin base url -->
  <script>
    var adminBaseUrl = "<?php echo BASE_URL . 'admin/' ?>";
  </script>
  <!-- Jquery Core Js -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootbox Js -->
  <script src="../assets/js/bootbox.min.js"></script>
  <!-- CKEditor -->
  <script src="assets/plugins/ckeditor-classic/ckeditor.js"></script>
</head>

<body class="theme-red">
  <!-- Page Loader -->
  <div class="page-loader-wrapper">
    <div class="loader">
      <div class="preloader">
        <div class="spinner-layer pl-red">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
      <p>Please wait...</p>
    </div>
  </div>
  <!-- #END# Page Loader -->
  <!-- Overlay For Sidebars -->
  <div class="overlay"></div>
  <!-- #END# Overlay For Sidebars -->
  <!-- Search Bar -->
  <div class="search-bar">
    <div class="search-icon">
      <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
      <i class="material-icons">close</i>
    </div>
  </div>
  <!-- #END# Search Bar -->
  <!-- Top Bar -->
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand" href="index.html">ADMIN PORTAL | CAR RENTAL</a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <!-- Call Search -->
          <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
          <!-- #END# Call Search -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- #Top Bar -->
  <section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
      <!-- User Info -->
      <div class="user-info" style="height: 90px;">
        <!-- <div class="image">
          <img src="assets/images/user.png" width="48" height="48" alt="User" />
        </div> -->
        <div class="info-container">
          <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></div>
          <div class="email"><?php echo $_SESSION["email"]; ?></div>
          <div class="btn-group user-helper-dropdown">
            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
            <ul class="dropdown-menu pull-right">
              <li><a href="../profile.php"><i class="material-icons">person</i>Profile</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="../logout.php"><i class="material-icons">input</i>Sign Out</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- #User Info -->
      <!-- Menu -->
      <div class="menu">
        <ul class="list">
          <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
            <ul class="ml-menu">
              <li>
                <a href="./">Admin Homepage</a>
              </li>
              <li>
                <a href="../">Site Homepage</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="makes.php">
                <i class="material-icons">layers</i>
                <span>Makes</span>
            </a>
          </li>
          <li>
            <a href="models.php">
                <i class="material-icons">layers</i>
                <span>Models</span>
            </a>
          </li>
        <?php if ($_SESSION["role"] == "su"): ?>
          <li>
            <a href="company.php">
                <i class="material-icons">layers</i>
                <span>Company</span>
            </a>
          </li>
          <li>
            <a href="users.php">
                <i class="material-icons">layers</i>
                <span>Users</span>
            </a>
          </li>
          <li>
            <a href="partners.php">
                <i class="material-icons">layers</i>
                <span>Partners</span>
            </a>
          </li>
        <?php endif ?>
          <li>
            <a href="../profile.php">
                <i class="material-icons">layers</i>
                <span>Profile</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- #Menu -->
      <!-- Sidebar Footer -->
      <div class="legal">
        <div class="copyright">
          <a href="javascript:void(0);"><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?></a>.
        </div>
      </div>
      <!-- #Sidebar Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
  </section>
