<!-- Login-Form -->
<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <!-- <div class="row"> -->
          <div class="login_wrap">
            <div id="loginError" class="alert alert-danger hidden">
              <span></span>
            </div>
            <div id="loginSuccess" class="alert alert-success hidden">
              <span></span>
            </div>
            <!-- <div class="col-md-6 col-sm-6"> -->
              <form id="loginForm">
                <div class="form-group">
                  <input type="text" id="log_username" class="form-control" placeholder="Email address" name="username" required>
                </div>
                <div class="form-group">
                  <input type="password" id="log_password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="form-group">
                  <input type="submit" value="Login" class="btn btn-block">
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
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <!-- <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p> -->
      </div>
    </div>
  </div>
</div>
<!-- /Login-Form  -->