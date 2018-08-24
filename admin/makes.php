<?php 

session_start();

if (!isset($_SESSION["username"])) {
  header("Location: ../");
  exit();
} else if ($_SESSION["role"] == "su" || $_SESSION["role"] == "admin") {
  
} else {
  header("Location: ../");
  exit();
}

include 'api/makes.php';
$makes = get_car_makes();
error_reporting(0);

include 'includes/header.php';
?>

  <script>
    var makes = {
  <?php foreach ($makes as $make): ?>
    <?php echo $make["id"]; ?> : {
        name : "<?php echo $make["make_name"]; ?>"
      }<?php if(each($makes)){ echo ","; };?>
  <?php endforeach ?>
    }
  </script>
    <section class="content">
      <div class="container-fluid">
        <div class="block-header">
        <?php if($_SESSION["role"] != "su"): ?>
      		<a href="#addmakeform" class="btn btn-success uppercase" data-toggle="modal" data-dismiss="modal">Add Make</a>
      	<?php endif ?>
        </div>
        <div id="feedbackDiv" class="alert hidden"></div>

        <!-- Exportable Table -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>
                  REGISTERED MAKES
                </h2>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>MAKE</th>
                      <?php if ($_SESSION["role"] == "su"): ?>
                        <th>Action</th>
                      <?php endif ?>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>MAKE</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                  	<?php foreach ($makes as $make): ?>
                      <tr>
                        <td><?php echo $make["id"]; ?></td>
                        <td><?php echo $make["make_name"]; ?></td>
                        <td>
                          <button class="btn btn-success btn-xs" id="<?php echo $make["id"] ?>" onclick="editMake(this.id)">Edit</button>
                      <?php if ($_SESSION["role"] == "su"): ?>
                          <button class="btn btn-danger btn-xs" id="<?php echo $make["id"] ?>" onclick="deleteMake(this.id)">Delete</button>
                      <?php endif ?>
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

    <!-- Add Make Form -->
		<div class="modal fade" id="addmakeform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Add Make</h3>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		          <div>
                <div id="feedbackContainer" class="alert hidden">
		            </div>
		            <!-- <div class="col-md-6 col-sm-6"> -->
		              <form id="addMakeForm">
		                <div class="col-sm-12">
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="makename" id="makename">
                          <label class="form-label">Make</label>
                        </div>
                      </div>
                      <div class="form-group">
			                  <input type="submit" value="Add Make" class="btn btn-primary btn-block">
			                </div>
                    </div>
		              </form>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- /Add Make Form  -->

    <!-- Edit Make Form -->
		<div class="modal fade" id="editmakeform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Edit Make</h3>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		          <div>
                <div id="editFeedbackContainer" class="alert hidden">
		            </div>
                <form id="editMakeForm">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <span class="form-label">Make</span>
                      <div class="form-line">
                        <input type="text" class="form-control" name="edit_makename" id="edit_makename">
                        <input type="hidden" name="edit_makeid" id="edit_makeid">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Edit Make" class="btn btn-primary btn-block">
                    </div>
                  </div>
                </form>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
    <!-- /Edit Make Form  -->
    
    <script>
      $("#editMakeForm").submit((e)=>{
        e.preventDefault();
        editMakeComplete();
      });
    </script>

<?php  

include 'includes/footer.php';

?>