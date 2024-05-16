<?= $this->extend('layouts/layout'); ?>

<?= $this->section('content'); ?>


<div class="container">
	<div class="row">
	
		<div class="col-sm-12 mt-4  d-flex justify-content-center">
		    <div class="alert alert-danger text-center">
              <strong>Access Denied</strong> 
              <p>You don't have permission to access this route.</p>
            </div>
		</div>
		
	</div>
</div>

<?= $this->endSection(); ?>


<?=$this->section('script');?>


<?=$this->endSection(); ?>