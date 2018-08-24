<!--Footer -->
<footer>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <div class="footer_widget">
            <p>Connect with Us:</p>
            <ul>
              <li><a href="<?php echo FACEBOOK_URL; ?><?php echo $company["facebook"]; ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="<?php echo TWITTER_URL; ?><?php echo $company["twitter"]; ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="<?php echo GOOGLE_PLUS_URL; ?><?php echo $company["googleplus"]; ?>"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
              <li><a href="<?php echo INSTAGRAM_URL; ?><?php echo $company["instagram"]; ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <p class="copy-right">Copyright &copy; 2017 CarForYou. All Rights Reserved. <a href="terms-of-service.php">Terms of Service</a> | <a href="privacy-policy.php">Privacy Policy</a></p>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /Footer-->

<?php  

include 'login-form.php';
include 'register-form.php';
include 'forgot-password-form.php';
include 'companies.php';
include 'scripts.php';

?>