<?=$this->extend('layouts/layout');?>
<?=$this->section('content');?>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-md-12">
				<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
					<h2 id="heading">This is the blank page </h2>
				</div>
				
				<?php
					$sdata = json_decode(file_get_contents("assets/data/statewisebiogascbg.json"));
					$stateData = $sdata->Sheet1;
					//print_r($stateData); 
					foreach($stateData as $stateDatas){
						print_r($stateDatas);
					}
				?>
				
			</div>
		</div>
   </div>
	
<?=$this->endSection(); ?>