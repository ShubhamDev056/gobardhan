<?= $this->extend('layouts/layout'); ?>



<?= $this->section('content'); ?>
<style>
	.fa-user, .fa-phone, .fa-envelope{
		font-size: 30px;
		color: green;
		border-radius: 50%;
		height: 40px;
		width: 40px;
		text-align: center;
	}
	.rs-process.style3 .rs-addon-number {
		margin: 0px -10px 0px 0px;
		padding: 17px 10px 17px 18px;
		background-color: #FFFFFF;
		border-left: 7px solid #4caf50;
		border-bottom: 0px solid #095fd0;
	}
	.rs-addon-number{
		min-height: 263px;
	}
	.list-group-item h3 {
	font-size: 20px;
	}
	.list-group-item {
    position: relative;
    display: block;
    padding: 0.25rem 0.75rem;
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
}


</style>

<!-- Process Section Start -->
            <div class="rs-process style3 gray-color pt-20 pb-120 md-pt-75 md-pb-80">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 pl-35 md-pt-40 md-pl-15">
                            <div class="row">
								<div class="col-sm-12">
									<h3>State Nodal Officers</h3>
									<a href="javascript:void(0)" onclick="window.history.back()" > <i class="fa fa-arrow-left" ></i> Back </a>
								</div>
								
								<?php 
									foreach($stateOfficers as $satatOfficer){ ?>
										<div class="col-md-6 mb-20">
											<div class="rs-addon-number">
												<div class="number-text">
													<ul class="list-group list-group-flush">
														<li class="list-group-item"><h3 class="title"> <?=$satatOfficer['state_name']?> </h3></li>
														<li class="list-group-item">
															<i class="fa fa-user"></i>
															<strong><?=$satatOfficer['designation']?></strong>
														</li>
														<li class="list-group-item">
															<i class="fa fa-phone"></i> 
															<strong><?=$satatOfficer['phone_number']?></strong>
														</li>
														<li class="list-group-item">
															<i class="fa fa-envelope"></i>
															<strong><?=$satatOfficer['email']?></strong>
														</li>
													</ul>
												</div>
											</div>
										</div>
									<?php	
									}
								?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Process Section End -->

<?= $this->endSection(); ?>