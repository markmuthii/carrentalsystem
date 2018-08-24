<?php 

include "./includes/header.php";
// include "./api/company.php";

$company = get_company_contact_about();

?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2" style="padding-top: 30px; padding-bottom: 30px;">
      <?php echo $company["terms"] ?>
    </div>
  </div>
</div>


<?php  

include 'includes/footer.php';

?>