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
include 'api/cars.php';
$models = get_car_models();
$makes = get_car_makes();
if ($_SESSION["role"] == "admin") {
  $cars = get_cars($_SESSION["companyid"]);
} else {
  $cars = get_all_cars();
}

$cars_length = count($cars);
error_reporting(0);

include 'includes/header.php';

$counter = 0;
$cars_number = count($cars);

?>
  <script>
    var modelsObj = {},
        modelsArr = [];

  <?php foreach ($models as $model): ?>
    modelsObj["<?php echo $model["id"] ?>"] = [<?php echo $model["make_id"]; ?>, "<?php echo $model["make_name"]; ?>"]
  <?php endforeach ?>
    

    var cars = {
  <?php foreach ($cars as $car): ?>
    <?php echo $car["id"]; ?> : {
        hiringPrice : "<?php echo $car["hiring_price"]; ?>",
        fuel : "<?php echo $car["fuel_type"]; ?>",
        color : "<?php echo $car["color"]; ?>",
        description : "<?php echo $car["description"]; ?>",
        speed : "<?php echo $car["speed"]; ?>",
        make : "<?php echo $car["make"]; ?>",
        makeId : "<?php echo $car["make_id"]; ?>",
        model : "<?php echo $car["model"]; ?>",
        modelId : "<?php echo $car["model_id"]; ?>",
      <?php if ($_SESSION["role"] == "admin"): ?>
        companyId : "<?php echo $_SESSION["companyid"]; ?>",
      <?php endif ?>
        link : "<?php echo $car["link"]; ?>",
        image : "<?php echo $car["image"]; ?>",
        new : "<?php echo $car["new"]; ?>"
      }<?php  echo ",";?>
  <?php endforeach ?>
    } // end cars object

    modelsArr.push(modelsObj);
    console.log(cars);
  </script>
    <section class="content">
      <div class="container-fluid">
      	<div class="block-header">
        <?php if($_SESSION["role"] != "su"): ?>
      		<a href="#addcarform" class="btn btn-success uppercase" data-toggle="modal" data-dismiss="modal">Add Car</a>
      	<?php endif ?>
      	</div>
        <div id="feedbackDiv" class="alert hidden"></div>
        <!-- Exportable Table -->
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2>
                  REGISTERED VEHICLES
                </h2>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                      <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Fuel Type</th>
                        <th>Link</th>
                        <th>Hiring Price</th>
                      <?php if ($_SESSION["role"] == "su"): ?>
                        <th>Company</th>
                      <?php endif ?>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Fuel Type</th>
                        <th>Link</th>
                        <th>Hiring Price</th>
                      <?php if ($_SESSION["role"] == "su"): ?>
                        <th>Company</th>
                      <?php endif ?>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($cars as $car): ?>
                      <tr>
                        <td><?php echo $car["make"] ?></td>
                        <td><?php echo $car["model"] ?></td>
                        <td><?php echo $car["color"] ?></td>
                        <td><?php echo $car["fuel_type"] ?></td>
                        <td><?php echo $car["link"] ?></td>
                        <td><?php echo $car["hiring_price"] ?></td>
                      <?php if ($_SESSION["role"] == "su"): ?>
                        <td><?php echo $car["company"] ?></td>
                      <?php endif ?>
                        <td>
                        <?php if ($_SESSION["role"] != "su"): ?>
                          <button class="btn btn-success btn-xs" id="<?php echo $car["id"] ?>" onclick="editCar(this.id)">Edit</button>
                        <?php endif ?>
                          <button class="btn btn-danger btn-xs" id="<?php echo $car["id"] ?>" onclick="deleteCar(this.id)">Delete</button>
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

    <!-- Add Car Form -->
		<div class="modal fade" id="addcarform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Add Car</h3>
		      </div>
		      <div class="modal-body">
		        <!-- <div class="row"> -->
		          <div>
		            
		            <!-- <div class="col-md-6 col-sm-6"> -->
		              <form id="addCarForm" enctype="multipart/form-data" name="addCarForm">
		                <div class="col-sm-12">
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="number" class="form-control" name="hiringprice" id="hiringprice" required>
                          <label class="form-label">Hiring Price</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="fueltype" id="fueltype" required>
                          <label class="form-label">Fuel Type</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="color" id="color" required>
                          <label class="form-label">Color</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <select class="form-control show-tick" name="modelid" id="carModelSelect" onchange="modelSelectChanged()">
                          <option value="0">-- Select Model --</option>
                        <?php foreach ($models as $model): ?>
                          <option value="<?php echo $model["id"]; ?>"><?php echo $model["model_name"]; ?></option>
                        <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="make_name" id="make_name" value="Select Model" disabled>
                          <label class="form-label">Make</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="number" class="form-control" name="speed" id="speed" required>
                          <label class="form-label">Max Speed</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <textarea type="text" class="form-control" name="description" id="description" required></textarea>
                          <label class="form-label">Description</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="link" id="link" required>
                          <label class="form-label">Link</label>
                        </div>
                      </div>
                      
                      <span class="form-label">Car type</span>
                      <div class="row" style="margin: 10px 0;">
                        <div class="col-md-6">
                          <input name="cartype" type="radio" id="new" class="with-gap radio-col-blue" value="1" checked>
                          <label for="new">New</label>
                        </div>
                        <div class="col-md-6">
                          <input name="cartype" type="radio" id="used" class="with-gap radio-col-blue" value="0">
                          <label for="used">Used</label>
                        </div>
                      </div>
                      <div class="file-upload">
                        <div class="file-select">
                          <div class="file-select-button" id="fileName">Choose Car Image</div>
                          <div class="file-select-name" id="noFile">No image chosen...</div> 
                          <input type="file" name="carimage" id="chooseCarImage" required>
                        </div>
                      </div>
                      <input type="hidden" name="companyid" id="companyid" value="<?php echo isset($_SESSION["companyid"]) ? $_SESSION["companyid"] : ""; ?>">
                      <input type="hidden" name="makeid" id="makeid" value="">
                      <div class="form-group">
			                  <input type="submit" value="Add Car" id="addCarSubmitBtn" class="btn btn-primary btn-block">
			                </div>
                      <div id="feedbackContainer" class="alert hidden">
		                  </div>
                    </div>
		              </form>
		          </div>
		        <!-- </div> -->
		      </div>
          <!-- Modal Footer. Do not remove -->
		      <div class="modal-footer text-center">
		      </div>
          <!-- /Modal Footer -->
		    </div>
		  </div>
		</div>
		<!-- /Add Car Form  -->

    <!-- Edit Car Form -->
		<div class="modal fade" id="editcarform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Edit Car</h3>
		      </div>
		      <div class="modal-body">
		        <!-- <div class="row"> -->
		          <div>
		            
		            <!-- <div class="col-md-6 col-sm-6"> -->
		              <form id="editCarForm" enctype="multipart/form-data" name="editCarForm">
		                <div class="col-sm-12">
                      <div class="form-group">
                      <span class="form-label">Hiring Price</span>
                        <div class="form-line">
                          <input type="number" class="form-control" name="edit_hiringprice" id="edit_hiringprice" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <span class="form-label">Fuel Type</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="edit_fueltype" id="edit_fueltype" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <span class="form-label">Color</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="edit_color" id="edit_color" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <span class="form-label">Model</span>
                        <select class="form-control show-tick" name="edit_modelid" id="edit_carModelSelect" onchange="editModelSelectChanged()">
                          <option value="0">-- Select Model --</option>
                        <?php foreach ($models as $model): ?>
                          <option value="<?php echo $model["id"]; ?>"><?php echo $model["model_name"]; ?></option>
                        <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <span class="form-label">Make</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="edit_make_name" id="edit_make_name" value="Select Model" disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <span class="form-label">Max Speed</span>
                        <div class="form-line">
                          <input type="number" class="form-control" name="edit_speed" id="edit_speed" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <span class="form-label">Description</span>
                        <div class="form-line">
                          <textarea type="text" class="form-control" name="edit_description" id="edit_description" required></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <span class="form-label">Link</span>
                        <div class="form-line">
                          <input type="text" class="form-control" name="edit_link" id="edit_link" required>
                        </div>
                      </div>
                      
                      <span class="form-label">Car type</span>
                      <div class="row" style="margin: 10px 0;">
                        <div class="col-md-6">
                          <input name="edit_cartype" type="radio" id="edit_new" class="with-gap radio-col-blue" value="1" checked>
                          <label for="new">New</label>
                        </div>
                        <div class="col-md-6">
                          <input name="edit_cartype" type="radio" id="edit_used" class="with-gap radio-col-blue" value="0">
                          <label for="edit_used">Used</label>
                        </div>
                      </div>
                      <span class="form-label">Car Image</span>
                      <div class="form-group row"  style="margin-top: 10px;">
                        <div class="col-md-4 col-sm-4">
                          <div style="text-align:center;">
                            <img width="150px" id="currentcarimage" src="<?php echo BASE_URL . "assets/images/" ?>" alt="Current Car Image">
                          </div>
                        </div>
                        <div class="col-md-8 col-sm-8" style="margin: auto 0;">
                          <div class="file-upload">
                            <div class="file-select">
                              <div class="file-select-button" id="edit_fileName">Choose A New Car Image</div>
                              <div class="file-select-name" id="edit_noFile">No image chosen...</div> 
                              <input type="file" name="carimage" id="edit_chooseCarImage">
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <input type="hidden" name="edit_companyid" id="edit_companyid" value="<?php echo isset($_SESSION["companyid"]) ? $_SESSION["companyid"] : ""; ?>">
                      <input type="hidden" name="edit_makeid" id="edit_makeid" value="">
                      <input type="hidden" name="car_id" id="car_id" value="">
                      <div class="form-group">
			                  <input type="submit" value="Edit Car" id="editCarSubmitBtn" class="btn btn-primary btn-block">
			                </div>
                      <div id="editCarFeedbackDiv" class="alert hidden">
		                  </div>
                    </div>
		              </form>
		          </div>
		        <!-- </div> -->
		      </div>
          <!-- Modal Footer. Do not remove -->
		      <div class="modal-footer text-center">
		      </div>
          <!-- /Modal Footer -->
		    </div>
		  </div>
		</div>
		<!-- /Edit Car Form  -->

<?php  

include 'includes/footer.php';

?>