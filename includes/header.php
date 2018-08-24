<?php 

if (!isset($_SESSION["username"])) {
  session_start();   
 } 

include 'config/global.php';
include 'api/company.php';
$companies = get_companies();
$company = get_company_contact_about();

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Car Rental</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" type="text/css">
  <!--Custome Style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" type="text/css">
  <!--OWL Carousel slider-->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/owl.transitions.css" type="text/css">
  <!--slick-slider -->
  <link href="<?php echo BASE_URL; ?>assets/css/slick.css" rel="stylesheet">
  <!--bootstrap-slider -->
  <link href="<?php echo BASE_URL; ?>assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <!--FontAwesome Font Style -->
  <link href="<?php echo BASE_URL; ?>assets/css/font-awesome.min.css" rel="stylesheet">
  <!--custom styles-->
  <link href="<?php echo BASE_URL; ?>assets/css/custom.css" rel="stylesheet">
  <!-- SWITCHER -->
  <link rel="stylesheet" id="switcher-css" type="text/css" href="<?php echo BASE_URL; ?>assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/switcher/css/purple.css" title="purple" media="all" />
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo BASE_URL; ?>assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo BASE_URL; ?>assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo BASE_URL; ?>assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="<?php echo BASE_URL; ?>assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/favicon-icon/favicon.png">
  <!-- Google-Font-->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
  <!-- Start Switcher -->
  <div class="switcher-wrapper">
    <div class="demo_changer">
      <div class="demo-icon customBgColor"><i class="fa fa-cog fa-spin fa-2x"></i></div>
      <div class="form_holder">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="predefined_styles">
              <div class="skin-theme-switcher">
                <h4>Color</h4>
                <a href="#" data-switchcolor="red" class="styleswitch" style="background-color:#de302f;"> </a>
                <a href="#" data-switchcolor="orange" class="styleswitch" style="background-color:#f76d2b;"> </a>
                <a href="#" data-switchcolor="blue" class="styleswitch" style="background-color:#228dcb;"> </a>
                <a href="#" data-switchcolor="pink" class="styleswitch" style="background-color:#FF2761;"> </a>
                <a href="#" data-switchcolor="green" class="styleswitch" style="background-color:#2dcc70;"> </a>
                <a href="#" data-switchcolor="purple" class="styleswitch" style="background-color:#6054c2;"> </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /Switcher -->
  <!--Header-->
  <header>
    <div class="default-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-2">
            <div class="logo"> <a href="index.html"><img src="assets/images/logo.png" alt="image"/></a> </div>
          </div>
          <div class="col-sm-9 col-md-10">
            <div class="header_info">
              <div class="header_widgets">
                <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                <p class="uppercase_text">For Support Mail us : </p>
                <a href="<?php echo EMAIL_URL; ?><?php echo $company["email"]; ?>"><?php echo $company["email"]; ?></a> </div>
              <div class="header_widgets">
                <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                <p class="uppercase_text">Service Helpline Call Us: </p>
                <a href="<?php echo TEL_URL; ?><?php echo $company["phonenumber"]; ?>"><?php echo $company["phonenumber"]; ?></a> </div>
              <div class="social-follow">
                <ul>
                  <li><a href="<?php echo FACEBOOK_URL; ?><?php echo $company["facebook"]; ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                  <li><a href="<?php echo TWITTER_URL; ?><?php echo $company["twitter"]; ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                  <li><a href="<?php echo GOOGLE_PLUS_URL; ?><?php echo $company["googleplus"]; ?>"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                  <li><a href="<?php echo INSTAGRAM_URL; ?><?php echo $company["instagram"]; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
              </div>
              <div class="login_btn">
              <?php if (isset($_SESSION["username"])): ?>
                <a href="<?php echo BASE_URL; ?>logout.php" class="btn btn-xs uppercase">Logout</a>
              <?php else: ?>
                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a>
              <?php endif ?> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Navigation -->
    <nav id="navigation_bar" class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="header_wrap">
          <div class="user_login">
            <ul>
            <?php if (isset($_SESSION["username"])): ?>
              <li class="dropdown"> 
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle" aria-hidden="true"></i> 
                  <?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]; ?> 
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="profile.php">Profile</a></li>
                </ul>
              </li>
            <?php else: ?>
              <li> 
                <a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> Guest </a>
              </li>
            <?php endif ?>
            </ul>
          </div>
        </div>
        <div class="collapse navbar-collapse" id="navigation">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo BASE_URL; ?>">Home</a>
            </li>
            <li>
              <a href="<?php echo BASE_URL; ?>about-us.php">About Us</a>
            </li>
            <li>
              <a href="#ourPartners" data-toggle="modal" data-dismiss="modal">Our Partners</a>
            </li>
          <?php if (!empty($_SESSION) && ($_SESSION["role"] == "admin" || $_SESSION["role"] == "su")): ?>
            <li>
              <a href="admin/">Admin Dashboard</a>
            </li>
          <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navigation end -->
  </header>
  <!-- /Header -->