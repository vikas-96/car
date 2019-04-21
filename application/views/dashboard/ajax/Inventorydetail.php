<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title"><?= $data[0]->model_name ?></h4>
</div>
<div class="modal-body">
  <div class="container">
<?php foreach ($data as $value) { ?>
	
        <div class="panel panel-default panelwidth">
	      <div class="panel-body">
	      	<div class="col-sm-2 carimages">
	      		<?php
	                $overViewImages = base64_decode($value->car_images);
	                $allImages = unserialize($overViewImages);
	                $imageCount = count($allImages);
	            ?>
	            <?php
	                $count = 0;
	                for ($i = 0; $i < $imageCount; $i++) { ?>
	                    <img src="<?php echo base_url('assets/upload/' . $allImages[$i]); ?>" class="img-thumbnail"><br>
	            <?php } ?>
	      	</div>
	      	<div class="col-sm-9">
	      		<span class="revenge"  rev="<?= base64_encode($value->model_id) ?>"></span>
	      		<table class="table table-bordered">
				    <tbody>
				        <tr>
				          <th>Manufacturing Year</th>
				            <td><?= $value->manufacturing_year ?></td>
				        </tr>
				        <tr>
				          <th>Color</th>
				            <td><?= $value->color ?></td>
				        </tr>
				        <tr>
				          <th>Registration No.</th>
				            <td><?= $value->registration_no ?></td>
				        </tr>
				        <tr>
				          <th>Note</th>
				            <td><?= $value->note ?></td>
				        </tr>
				    </tbody>
				</table>
				<button class="btn btn-warning soldbtn">Sold</button>
	      	</div>
	      </div>
	    </div>
<?php } ?>
  </div>
</div>