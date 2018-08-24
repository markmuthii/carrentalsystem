<!-- Login-Form -->
<div class="modal fade" id="ourPartners">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Our Partners</h3>
      </div>
      <div class="modal-body">
        <p>In order to provide you with the best in terms of car service, we partner with the best in the industry.</p>
        <p>The following are our current partners, offering you the cars you see on this website, all at friendly rates.</p>
        <div class="carousel slide" id="text-carousel" data-ride="carousel">
          <div class="row">
            <div class="col-xs-offset-3 col-xs-6">
              <div class="carousel-inner">
              <?php $i = 0; ?>
              <?php foreach ($companies as $company): ?>
                <div class="item <?php if($i === 0){ echo "active"; } ?>">
                  <div class="carousel-content">
                    <p style="font-size: 1.5em; font-weight: 700;text-align: center;"><?php echo $company["name"] ?></p>
                  </div>
                </div>
              <?php $i++; ?>
              <?php endforeach ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
      </div>
    </div>
  </div>
</div>
<!-- /Login-Form  -->