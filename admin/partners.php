<?php 
error_reporting(0);

session_start();

if (!isset($_SESSION["username"]) || $_SESSION["role"] != "su") {
  header("Location: ../");
  exit();
}

include 'api/company.php';
$companies = get_companies();

include 'includes/header.php';
?>

  <script>
    var companies = {
  <?php foreach ($companies as $company): ?>
    <?php echo $company["id"]; ?> : {
        name : "<?php echo $company["name"]; ?>"
      }<?php if(each($companies)){ echo ","; };?>
  <?php endforeach ?>
    }
  </script>
    <section class="content">
      <div class="container-fluid">
        <div class="block-header">
      		<a href="#addcompanyform" class="btn btn-success uppercase" data-toggle="modal" data-dismiss="modal">Add Company</a>
      	</div>
        <div id="feedbackDiv" class="alert hidden"></div>

        <!-- Exportable Table -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>
                  REGISTERED COMPANIES
                </h2>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                  	<?php foreach ($companies as $company): ?>
                      <tr>
                        <td><?php echo $company["id"]; ?></td>
                        <td><?php echo $company["name"]; ?></td>
                        <td>
                          <button class="btn btn-success btn-xs" id="<?php echo $company["id"] ?>" onclick="editCompany(this.id)">Edit</button>
                          <button class="btn btn-danger btn-xs" id="<?php echo $company["id"] ?>" onclick="deleteCompany(this.id)">Delete</button>
                        </td>
                      </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- #END# Exportable Table -->
      </div>
    </section>

    <!-- Add Company Form -->
		<div class="modal fade" id="addcompanyform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Add Company</h3>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		          <div>
                <div id="feedbackContainer" class="alert hidden">
		            </div>
		            <!-- <div class="col-md-6 col-sm-6"> -->
		              <form id="addCompanyForm">
		                <div class="col-sm-12">
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="companyname" id="companyname">
                          <label class="form-label">Company Name</label>
                        </div>
                      </div>
                      <div class="form-group">
			                  <input type="submit" value="Add Company" class="btn btn-primary btn-block">
			                </div>
                    </div>
		              </form>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- /Add Company Form  -->

    <!-- Edit Company Form -->
		<div class="modal fade" id="editcompanyform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Edit Company</h3>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		          <div>
                <div id="feedbackContainer" class="alert hidden">
		            </div>
                <form id="editCompanyForm">
                  <div class="col-sm-12">
                  <span class="form-label">Company Name</span>
                    <div class="form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" name="edit_companyname" id="edit_companyname">
                      </div>
                    </div>
                    <input type="hidden" name="edit_companyid" id="edit_companyid">
                    <div class="form-group">
                      <input type="submit" value="Edit Company" class="btn btn-primary btn-block">
                    </div>
                    <div id="editCompanyFeedbackDiv" class="alert hidden">
                    </div>
                  </div>
                </form>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- /Edit Company Form  -->

<?php  

include 'includes/footer.php';

?>