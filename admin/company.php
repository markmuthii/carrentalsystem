<?php 
error_reporting(0);

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: ../");
  exit();
} else if ($_SESSION["role"] == "su" || $_SESSION["role"] == "admin") {
  
} else {
  header("Location: ../");
  exit();
}

include 'api/company.php';
$company = get_company_contact_about();

include 'includes/header.php';
?>

    <section class="content">
      <div class="container-fluid">
        <div class="block-header">
        </div>
        <div id="feedbackDiv" class="alert hidden"></div>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>
                  ADD COMPANY INFORMATION
                </h2>
              </div>
              <div class="body">
                <div id="feedbackContainer" class="alert hidden"></div>
                <form id="addCompanyAbout">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Facebook Username</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="facebook_link" value="<?php echo $company["facebook"] ?>" id="facebook_link">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Instagram Username</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="instagram_link" value="<?php echo $company["instagram"] ?>" id="instagram_link">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Twitter Username</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="twitter_username" value="<?php echo $company["twitter"] ?>" id="twitter_username">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Google+ Username</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="google_plus" value="<?php echo $company["googleplus"] ?>" id="google_plus">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Email</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="contact_email" value="<?php echo $company["email"] ?>" id="contact_email">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Phone Number</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="contact_phonenumber" value="<?php echo $company["phonenumber"] ?>" id="contact_phonenumber">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">About Us Contents</span>
                        <textarea name="aboutcompanyeditor" id="aboutcompanyeditor">
                          <?php echo $company["about"] ?>
                        </textarea>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Terms of Service</span>
                        <textarea name="termscompanyeditor" id="termscompanyeditor">
                          <?php echo $company["terms"] ?>
                        </textarea>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <span class="form-label" style="font-size: 1.15em; font-weight:600;">Privacy Policy</span>
                        <textarea name="privacycompanyeditor" id="privacycompanyeditor">
                          <?php echo $company["privacy"] ?>
                        </textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Edit Company Information" class="btn btn-primary btn-block">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php  

include 'includes/footer.php';

?>