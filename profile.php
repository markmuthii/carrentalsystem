<?php  

session_start();

if (!isset($_SESSION["username"])) {

  include 'config/global.php';
  header("Location: " . BASE_URL);

}

include 'includes/header.php';

?>

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Your Profile</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Profile</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Profile-setting-->
<section class="user_profile inner_pages">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <div class="profile_nav">
          <ul>
            <li class="active">
              <a href="<?php echo BASE_URL; ?>profile.php">Profile Settings</a>
            </li>
            <li>
              <a href="<?php echo BASE_URL; ?>logout.php">Sign Out</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">General Settings</h5>
          <form id="profileForm">
            <div class="form-group">
              <label class="control-label">First Name</label>
              <input class="form-control white_bg" id="firstname" type="text" name="firstname" value="<?php echo $_SESSION["firstname"]; ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Last Name</label>
              <input class="form-control white_bg" id="lastname" type="text" name="lastname" value="<?php echo $_SESSION["lastname"]; ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Email Address</label>
              <input class="form-control white_bg" id="email" type="email" name="email" value="<?php echo $_SESSION["email"]; ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Phone Number</label>
              <input class="form-control white_bg" id="phonenumber" type="tel" name="phonenumber" value="<?php echo $_SESSION["phonenumber"]; ?>" required>
            </div>
            <div class="form-group">
              <label class="control-label">Username</label>
              <input class="form-control white_bg" id="username" type="text" name="username" value="<?php echo $_SESSION["username"]; ?>" required>
            </div>
            <div class="gray-bg field-title">
              <h6>Update password</h6>
            </div>
            <div class="form-group">
              <label class="control-label">Current Password</label>
              <input class="form-control white_bg" id="currentPassword" type="password" name="currentPassword">
            </div>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input class="form-control white_bg" id="newPassword" name="newPassword" type="password">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input class="form-control white_bg" id="confirmPassword" name="confirmPassword" type="password">
            </div>
            <input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION["user_id"]; ?>">
            <!-- <div class="gray-bg field-title">
              <h6>Social Links</h6>
            </div>
            <div class="form-group">
              <label class="control-label">Facebook ID</label>
              <input class="form-control white_bg" id="facebook" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Twitter ID</label>
              <input class="form-control white_bg" id="twitter" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Linkedin ID</label>
              <input class="form-control white_bg" id="linkedin" type="text">
            </div>
            <div class="form-group">
              <label class="control-label">Google+ ID</label>
              <input class="form-control white_bg" id="google" type="text">
            </div> -->
            <div id="feedbackContainer" class="alert hidden">
            </div>
            <div class="form-group">
              <button type="submit" class="btn">Save Changes <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
            
          </form>
          <div class="field-title" style="background-color: red;">
            <h6>Danger Zone</h6>
          </div>
          <div class="container">
            <button class="btn btn-danger" style="background-color: red" onclick="deleteAccount()">Delete Account</button>
          </div>
          
          

        </div>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 

<?php  

include 'includes/footer.php';

?>