<!-- Register-Form -->
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <!-- <div class="row"> -->
          <div class="signup_wrap">
            <div id="signupError" class="alert alert-danger hidden">
              <span></span>
            </div>
            <div id="signupSuccess" class="alert alert-success hidden">
              <span></span>
            </div>
            <!-- <div class="col-md-6 col-sm-6"> -->
              <form id="registerForm">
                <div class="form-group">
                  <input type="text" class="form-control" id="reg_firstname" placeholder="First Name" name="firstname" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="reg_lastname" placeholder="Last Name" name="lastname" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="reg_email" placeholder="Email Address" name="email" required>
                </div>
                <div class="form-group">
                  <input type="tel" class="form-control" id="reg_phonenumber" placeholder="Phone Number" name="phonenumber" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="reg_username" placeholder="Username" name="username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="reg_password" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="reg_confirmPassword" placeholder="Confirm Password" name="confirmPassword">
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" class="btn btn-block">
                </div>
              </form>
            <!-- </div> -->
            <!-- <div class="col-md-6 col-sm-6">
              <h6 class="gray_text">Login the Quick Way</h6>
              <a href="#" class="btn btn-block facebook-btn"><i class="fa fa-facebook-square" aria-hidden="true"></i> Login with Facebook</a> <a href="#" class="btn btn-block twitter-btn"><i class="fa fa-twitter-square" aria-hidden="true"></i> Login with Twitter</a> <a href="#" class="btn btn-block googleplus-btn"><i class="fa fa-google-plus-square" aria-hidden="true"></i> Login with Google+</a> </div> -->
            <!-- <div class="mid_divider"></div> -->
          </div>
        <!-- </div> -->
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>
<!-- /Register-Form  -->