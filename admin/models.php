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

include 'api/models.php';
include 'api/makes.php';
$models = get_car_models();
$makes = get_car_makes();
error_reporting(0);

include 'includes/header.php';
?>

  <script>
    var models = {
  <?php foreach ($models as $model): ?>
    <?php echo $model["id"]; ?> : {
        name : "<?php echo $model["model_name"]; ?>",
        make : "<?php echo $model["make_name"]; ?>",
        makeId : "<?php echo $model["make_id"]; ?>"
      }<?php if($model !== end($models)){ echo ","; }; ?>
  <?php endforeach ?>
    }
  </script>
    <section class="content">
      <div class="container-fluid">
        <div class="block-header">
        <?php if($_SESSION["role"] != "su"): ?>
      		<a href="#addmodelform" class="btn btn-success uppercase" data-toggle="modal" data-dismiss="modal">Add Model</a>
        <?php endif ?>
      	</div>
        <div id="feedbackDiv" class="alert hidden">
		    </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>
                  REGISTERED MODELS
                </h2>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                      <tr>
                        <th>Model</th>
                        <th>Make</th>
                      <?php if ($_SESSION["role"] == "su"): ?>
                        <th>Action</th>
                      <?php endif ?>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Model</th>
                        <th>Make</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                  	<?php foreach ($models as $model): ?>
                      <tr>
                        <td><?php echo $model["model_name"]; ?></td>
                        <td><?php echo $model["make_name"]; ?></td>
                        <td>
                          <button class="btn btn-success btn-xs" id="<?php echo $model["id"] ?>" onclick="editModel(this.id)">Edit</button>
                      <?php if ($_SESSION["role"] == "su"): ?>
                          <button class="btn btn-danger btn-xs" id="<?php echo $model["id"] ?>" onclick="deleteModel(this.id)">Delete</button>
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

    <!-- Add Model Form -->
		<div class="modal fade" id="addmodelform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Add Model</h3>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		          <div>
                <div id="feedbackContainer" class="alert hidden">
		            </div>
		            <!-- <div class="col-md-6 col-sm-6"> -->
		              <form id="addModelForm">
		                <div class="col-sm-12">
		                	<div class="row">
		                		<div class="col-sm-6">
		                			<div class="form-group form-float">
		                        <div class="form-line">
		                          <input type="text" class="form-control" name="modelname" id="modelname">
		                          <label class="form-label">Model Name</label>
		                        </div>
		                      </div>
		                		</div>
		                		<div class="col-sm-6">
		                			<select class="form-control show-tick" id="makeSelect">
                            <option value="0">-- Select Make --</option>
                          <?php foreach ($makes as $make): ?>
                            <option value="<?php echo $make["id"] ?>"><?php echo $make["make_name"]; ?></option>
                          <?php endforeach ?>
                          </select>
		                		</div>
		                	</div>
                      
                      <div class="form-group">
			                  <input type="submit" value="Add Model" class="btn btn-primary btn-block">
			                </div>
                    </div>
		              </form>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- /Add Model Form  -->

    <!-- Edit Model Form -->
		<div class="modal fade" id="editmodelform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Edit Model</h3>
		      </div>
		      <div class="modal-body">
		        <div class="row">
		          <div>
                <div id="editFeedbackContainer" class="alert hidden">
		            </div>
		              <form id="editModelForm">
		                <div class="col-sm-12">
		                	<div class="row">
		                		<div class="col-sm-6">
                          <span class="form-label">Model</span>
		                			<div class="form-group">
		                        <div class="form-line">
		                          <input type="text" class="form-control" name="edit_modelname" id="edit_modelname">
		                          <input type="hidden" name="edit_modelid" id="edit_modelid">
		                        </div>
		                      </div>
		                		</div>
		                		<div class="col-sm-6">
                          <span class="form-label">Make</span>
		                			<select class="form-control show-tick" id="edit_makeSelect">
                            <option value="0">-- Select Make --</option>
                          <?php foreach ($makes as $make): ?>
                            <option value="<?php echo $make["id"] ?>"><?php echo $make["make_name"]; ?></option>
                          <?php endforeach ?>
                          </select>
		                		</div>
		                	</div>
                      
                      <div class="form-group">
			                  <input type="submit" value="Edit Model" class="btn btn-primary btn-block">
			                </div>
                    </div>
		              </form>
		          </div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
    <!-- /Edit Model Form  -->
    
    <script>
      $("#editModelForm").submit((e)=>{
        e.preventDefault();
        editModelComplete();
      });
    </script>

<?php  

include 'includes/footer.php';

?>