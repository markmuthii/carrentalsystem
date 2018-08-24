<?php  

include 'includes/header.php';
include 'api/makes.php';
include 'api/models.php';
include 'api/cars.php';
$cars = get_all_cars();
$makes = get_car_makes();
$models = get_car_models();
$limits = get_limits();
$counter = 0;
$car_limit = 6; //limit for the number of cars that logged out users can view on either category
?>

<script>
  var modelsObj = {},
      modelsArr = [],
      imageDir = "<?php echo IMAGE_DIRECTORY; ?>";

  <?php foreach ($models as $model): ?>
    modelsObj["<?php echo $model["model_name"] ?>"] = [<?php echo $model["id"]; ?>, <?php echo $model["make_id"]; ?>, "<?php echo $model["make_name"]; ?>"]
  <?php endforeach ?>

  modelsArr.push(modelsObj);
  console.log(modelsObj);
</script>

<!-- Banners -->
<section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content">
            <h1>Find the right car for you.</h1>
            <p>We have more than a thousand cars for you to choose. </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Banners --> 
<!-- Recent Cars-->
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Find the Best <span>Car For You</span></h2>
      <p>We offer a variation of new and used cars, all at friendly prices.</p>
    </div>
    <div class="row" id="carDisplayDiv"> 
      
      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#recentnewcars" role="tab" data-toggle="tab">New Cars</a></li>
          <li role="presentation"><a href="#recentusedcars" role="tab" data-toggle="tab">Used Cars</a></li>
        </ul>
      </div>
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="recentnewcars">
        <?php foreach ($cars as $car): ?>
        <?php if ($car["new"] == 1): ?>
          <div class="col-list-3">
            <div class="recent-car-list">
              <div class="car-info-box"> <a href="#"><img src="<?php echo IMAGE_DIRECTORY . $car["image"]; ?>" class="img-responsive" alt=""></a>
              <?php if (isset($_SESSION["username"])):  ?>
                <ul>
                  <li><i class="fas fa-gas-pump" aria-hidden="true"></i><?php echo $car["fuel_type"]; ?></li>
                  <li><i class="fas fa-palette" aria-hidden="true"></i><?php echo $car["color"]; ?></li>
                  <li><i class="fas fa-fast-forward" aria-hidden="true"></i><?php echo $car["speed"]; ?></li>
                </ul>
              <?php endif ?>
              </div>
              <div class="car-title-m">
                <h6><a href="#"><?php echo $car["make"] . "  " . $car["model"]; ?></a></h6>
              <?php if (isset($_SESSION["username"])): ?>
                <span class="price">$<?php echo $car["hiring_price"] ?></span> 
              <?php endif ?>
              </div>
              <?php if (isset($_SESSION["username"])): ?>
              <div class="inventory_info_m">
                <p><?php echo $car["description"]; ?></p>
                <a href="<?php echo $car["link"]; ?>" class="btn btn-xs uppercase" >Hire this car</a>
              </div>
              <?php endif ?>
            </div>
          </div>
        <?php 
          $counter++; 
          if (!isset($_SESSION["username"])) {
            if ($counter == $car_limit) {
              $counter = 0;
              break;
            }; 
          }; 
        endif; 
        ?>
        <?php endforeach ?>
        </div>
          
        
        <!-- Recently Listed Used Cars -->
        <div role="tabpanel" class="tab-pane" id="recentusedcars">
        <?php foreach ($cars as $car): ?>
        <?php if ($car["new"] == 0): ?>
          <div class="col-list-3">
            <div class="recent-car-list">
              <div class="car-info-box"> <a href="#"><img src="<?php echo IMAGE_DIRECTORY . $car["image"]; ?>" class="img-responsive" alt=""></a>
              <?php if (isset($_SESSION["username"])):  ?>
                <ul>
                  <li><i class="fas fa-gas-pump" aria-hidden="true"></i><?php echo $car["fuel_type"]; ?></li>
                  <li><i class="fas fa-palette" aria-hidden="true"></i><?php echo $car["color"]; ?></li>
                  <li><i class="fas fa-fast-forward" aria-hidden="true"></i><?php echo $car["speed"]; ?></li>
                </ul>
              <?php endif ?>
              </div>
              <div class="car-title-m">
                <h6><a href="#"><?php echo $car["make"] . "  " . $car["model"]; ?></a></h6>
              <?php if (isset($_SESSION["username"])): ?>
                <span class="price">$<?php echo $car["hiring_price"]; ?></span> 
              <?php endif ?>
              </div>
              <?php if (isset($_SESSION["username"])): ?>
              <div class="inventory_info_m">
                <p><?php echo $car["description"]; ?></p>
                <a href="<?php echo $car["link"]; ?>" class="btn btn-xs uppercase" >Hire this car</a>
              </div>
              <?php endif ?>
            </div>
          </div>
        <?php 
          $counter++; 
          if (!isset($_SESSION["username"])) {
            if ($counter == $car_limit) {
              $counter = 0;
              break;
            }; 
          };
        endif; 
        ?>
        <?php endforeach ?>

        </div>
      </div>

    </div>
    <?php if (!isset($_SESSION["username"])): ?>
      <div class="container" style="margin-top: 60px;">
        <div class="section-header text-center">
          <p><a href="#loginform" data-toggle="modal" data-dismiss="modal" class="btn btn-xs uppercase">Login</a> to view all available cars and their details.</p>
        </div> 
      </div>
    <?php endif ?>
  </div>
</section>
<!-- /Recent Cars -->  
<?php if (isset($_SESSION["username"])): ?>
<!-- Filter-Form -->
<section id="filter_form" class="gray-bg">
  <div class="container">
    <h3>Looking for a specific car? <span>(Easy search from here)</span></h3>
    <div class="row">
      <form id="carFilterForm">
        <div class="form-group col-md-4 col-sm-6 black_input">
          <div class="select">
            <select class="form-control" name="makeSelect" id="makeSelect" onchange="makeSelectChanged()">
              <option value="0">Select Make</option>
            <?php foreach ($makes as $make): ?>
              <option value="<?php echo $make["id"]; ?>"><?php echo $make["make_name"]; ?></option>
            <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="form-group col-md-4 col-sm-6 black_input">
          <div class="select">
            <select class="form-control" name="modelSelect" id="modelSelect">
              <option value="0">Select Model</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-4 col-sm-6 black_input">
          <div class="select">
            <select class="form-control" name="carTypeSelect" id="carTypeSelect">
              <option value="0">Type of Car </option>
              <option value="1">New Car</option>
              <option value="2">Used Car</option>
            </select>
          </div>
        </div>
        <div class="form-group col-md-6 col-sm-6 black_input">
          <label class="form-label">Price Range ($)</label>
          <input id="price_range" type="text" class="span2" value="" data-slider-min="<?php echo $limits[0]["min"]; ?>" data-slider-max="<?php echo $limits[0]["max"]; ?>" data-slider-step="5" data-slider-value="[<?php echo $limits[0]["min"]; ?>,<?php echo $limits[0]["max"]; ?>]"/>
        </div>
        <div class="form-group col-md-6 col-sm-6">
        <a href="#carDisplayDiv"><button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car </button></a>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- /Filter-Form --> 
<?php endif ?>
<script>
  function makeSelectChanged(){
    var makeId = $("#makeSelect").val(),
        modelSelect = $("#modelSelect");
        options = '<option value="0">Select Model</option>';
    // console.log(makeId);
    $.each(modelsObj, (i, e) => {
      // console.log(i, e);
      if (e[1] == makeId) {
        // console.log(i, e);
        options += `<option value="${e[0]}">${i}</option>`;
      }
    });
    // console.log(options);
    modelSelect.html(options);
  }
</script>

<?php  

include 'includes/footer.php';

?> 