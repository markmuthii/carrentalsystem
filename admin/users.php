<?php 
session_start();
error_reporting(0);

if (!isset($_SESSION["username"]) || $_SESSION["role"] != "su") {
  header("Location: ../");
  exit();
}

include 'api/users.php';
include 'api/company.php';
include 'includes/header.php';
$clients = get_clients();
$super_admins = get_super_admins();
$admins = get_admins();
$companies = get_companies();
?>

 <section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <a href="#addadminform" class="btn btn-success uppercase" data-toggle="modal" data-dismiss="modal">Add Admin</a>
    </div>
    
    <!-- Exportable Table -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              SUPER ADMINISTRATORS
            </h2>
          </div>
          <div id="feedbackContainer" class="alert hidden"></div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                  <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>USERNAME</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>USERNAME</th>
                    <th>ACTION</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php foreach ($super_admins as $super_admin): ?>
                  <tr>
                    <td><?php echo $super_admin["fname"] . " " . $super_admin["lname"]; ?></td>
                    <td><?php echo $super_admin["email"] ?></td>
                    <td><?php echo $super_admin["phonenumber"] ?></td>
                    <td><?php echo $super_admin["username"] ?></td>
                    <td>
                    <?php if ($super_admin["user_id"] != $_SESSION["user_id"]): ?>
                      <button class="btn btn-success btn-xs" id="<?php echo $super_admin["user_id"] ?>" onclick="demoteAdmin(this.id)">Demote</button>
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
    
    <!-- Exportable Table -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              ADMINISTRATORS
            </h2>
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                  <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>USERNAME</th>
                    <th>COMPANY</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>USERNAME</th>
                    <th>COMPANY</th>
                    <th>ACTION</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php foreach ($admins as $admin): ?>
                  <tr>
                    <td><?php echo $admin["fname"] . " " . $admin["lname"]; ?></td>
                    <td><?php echo $admin["email"] ?></td>
                    <td><?php echo $admin["phonenumber"] ?></td>
                    <td><?php echo $admin["username"] ?></td>
                    <td><?php echo $admin["company"] ?></td>
                    <td>
                      <button class="btn btn-success btn-xs" id="<?php echo $admin["user_id"] ?>" onclick="demoteAdmin(this.id)">Demote</button>
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

    <!-- Exportable Table -->
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              CLIENTS
            </h2>
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                  <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>USERNAME</th>
                  </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>USERNAME</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php foreach ($clients as $client): ?>
                  <tr>
                    <td><?php echo $client["fname"] . " " . $client["lname"]; ?></td>
                    <td><?php echo $client["email"] ?></td>
                    <td><?php echo $client["phonenumber"] ?></td>
                    <td><?php echo $client["username"] ?></td>
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

<!-- Add Admin Form -->
<div class="modal fade" id="addadminform">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h3 class="modal-title">Add Admin</h3>
		      </div>
		      <div class="modal-body">
		        <!-- <div class="row"> -->
		          <div>
		            <div id="feedbackContainer" class="alert hidden">
		            </div>
		            <!-- <div class="col-md-6 col-sm-6"> -->
		              <form id="addAdminForm" name="addAdminForm">
		                <div class="col-sm-12">
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="firstname" id="firstname" required>
                          <label class="form-label">First Name</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="lastname" id="lastname" required>
                          <label class="form-label">Last Name</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="email" class="form-control" name="email" id="email" required>
                          <label class="form-label">Email</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="tel" class="form-control" name="phonenumber" id="phonenumber" required>
                          <label class="form-label">Phone Number</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="text" class="form-control" name="username" id="username" required>
                          <label class="form-label">Username</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line">
                          <input type="password" class="form-control" name="password" id="password" required>
                          <label class="form-label">Password</label>
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <select class="form-control show-tick" name="adminrole" id="adminrole" onchange="adminRoleChanged()">
                          <option value="0">-- Select Role --</option>
                          <option value="admin">Company Admin</option>
                          <option value="su">Super Admin</option>
                        </select>
                      </div>
                      <div class="form-group form-float hidden" id="companySelectDiv">
                        <select class="form-control show-tick" name="companyid" id="companyid">
                          <option value="0">-- Select Company --</option>
                        <?php foreach ($companies as $company): ?>
                          <option value="<?php echo $company["id"]; ?>"><?php echo $company["name"]; ?></option>
                        <?php endforeach ?>
                        </select>
                      </div>
                      <div class="form-group">
			                  <input type="submit" value="Add Admin" class="btn btn-primary btn-block">
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
		<!-- /Add Admin Form  -->

<?php 

include 'includes/footer.php';

?>