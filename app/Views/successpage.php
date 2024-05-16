<?=$this->extend('layouts/layout');?>

<?=$this->section('content');?>

	<!-- Services Section Start -->
	<div class="rs-services" style="min-height: 647px; background:url(assets/images/bg/biobg2.png)" >
		<div class="container">
			<div class="row">
				<div class="col-lg-12" >
					<div class="row">
						<?php /*?><div class="col-lg-12">
							<h3>Registration Complete</h3>
							
						</div><?php */?>
						<div class="col-12">
							<div class="screen green">
								<div class="border-overlay"></div>
								<div class="header__wrapper">
									<div class="header">
										<div class="sign"><span></span></div>
									</div>
								</div>
								<h3><?=$heading?></h3>
								<p><?=$message?></p>
								<a class="button-submit" href="<?=base_url()?>">Home</a>
								<a class="button-submit danger" href="#">Try Again</a>
							</div>
						</div>
					</div>
				</div>
				
			</div> 
		</div>
	</div>

	<!-- Services Section End -->
	
<?=$this->endSection(); ?>
