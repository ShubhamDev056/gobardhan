<?= $this->extend('layouts/layout'); ?>

<?= $this->section('breadcrum'); ?>
<div class="container">
	<div class="page-banner row align-items-center position-relative">

		<!-- Page Title -->
		<div class="col-lg-6 col-12">
			<h1 class="page-title">
                Organization Registration
			</h1>
		</div>

		<!-- Page Breadcrumb -->
		<div class="col-lg-6 col-12">
			<ul class="page-breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Profile</li>
			</ul>
		</div>

	</div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="<?=base_url();?>assets/css/icon-font.min.css">-->
<link rel="stylesheet" href="<?=base_url();?>assets/css/plugins.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap-multiselect.css">
<style>
    .customRequired{
		border-color: red !important;
	}
	.tblformat{
		margin:0px!important;
	}
	
	.table tr{
		vertical-align: middle;
	}
    .required{
		color: red;
	}

    .blocksec{
        background-color: #f7f7f7;
        pointer-events: none;
        border: 1px solid red!important;
        color: #d1d1d1;
		display:none;
    }
	
	.liErr{
		font-style: italic;
		font-size: 16px;
		font-weight: 600;
	}
</style>

<div class="container">
	<div class="row justify-content-center">
		
		<div class="col-12 col-md-6 col-sm-12">
			<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
				<?php \Config\Services::validation()->listErrors(); ?>
				<?php if (! empty($errors)): ?>
					<div class="alert alert-danger" role="alert">
						<ol>
						<?php foreach ($errors as $error): ?>
							<li class="liErr"><?= esc($error) ?></li>
						<?php endforeach ?>
						</ol>
					</div>
				<?php endif ?>
				
                <form  method="post"  enctype="multipart/form-data" >
                    <fieldset class="border p-4 py-1 mb-3 pb-4">
                        <legend  class="float-none w-auto p-2 text-primary">1. Organization details </legend>
                        <div class="row">
                            
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.1 Type of Organization: <span class="required">*</span></label>

                                <select class="form-select" name="entity_type" id="entity_type" required >									
                                    <option value="">select type of Organization</option>
                                    <?php 
                                        foreach($entities as $entity){ ?>
                                            <option value="<?=$entity['id']?>" <?php if($entity['id']==set_value('entity_type')){ echo "selected"; } ?> ><?=$entity['title']?></option>
                                        <?php 
                                        }	
                                    ?>
                                </select>
                            </div>
							<div class="col-sm-11111112 col-12 mb-2 " id="sub_entity_sec">
                                <label class="fieldlabels">1.2 Sub-type : <span class="required">*</span></label>
                                <select class="form-select" name="sub_entity" id="sub_entity"  >
                                    <option value="">Select Sub-Type Organization </option>
                                </select>
                            </div>
							
								<div class="col-sm-12 col-12 mb-2" id="other_subtype_sec">
									<br>
									<input type="text" name="other_subtype" value="<?=set_value('other_subtype') ?>" id="other_subtype" class="form-control float-end" placeholder="Please specify the sub-type">
								</div>
								
							<div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.3 Name of Organization: <span class="required">*</span></label>
                                <input type="text" class="form-control" name="entity_name" id="entity_name" placeholder="Organization Name"  value="<?=set_value('entity_name') ?>" required />
                            </div>
							
                       
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.4 Name of the Authorised Person. : </label>
                                <input type="text" name="authorised_person" readonly value="<?=$_SESSION['name'];?>" id="authorised_person" class="form-control" placeholder="Name of the Authorised Person " />
                            </div>
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.5 Mobile No of Authorised Person . : <span class="required"></span> </label>
                                <input type="number" name="mobile_number" readonly value="<?=$_SESSION['contact_no'];?>" id="mobile_number" class="form-control" placeholder="Mobile Number"  />
                            </div>
                       
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.6 Official Email Id of the Authorised Person: <span class="required">*</span></label>
                                <input type="email" name="entity_email" readonly value="<?=$_SESSION['email'];?>" id="entity_email" class="form-control" placeholder="Email Id" required />
                            </div>
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.7 Address of Organization: <span class="required">*</span></label>
                                <textarea name="entity_address" class="form-control" id="entity_address" placeholder="Address" rows="1" required ><?=set_value('entity_address') ?></textarea>
                            </div>
                        
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.8 State/ UT: <span class="required">*</span></label>
                                <select class="form-select" name="entity_state" id="entity_state" required >
                                    <option value="">Select State/ UT</option>
                                    <?php foreach($states as $state){ ?>
                                    <option value="<?=$state['state_code'] ?>" ><?=$state['state_name'] ?></option>
                                    <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.9 District: <span class="required">*</span></label>
                                <select class="form-select" name="entity_district" id="entity_district" required >
                                    <option value="">Select District</option>
                                </select>
                            </div>
							<div class="col-sm-12 col-12 mb-2" id="ulb_code_sec" >
								<label class="fieldlabels">Urban Local Body Code : <span class="required">*</span></label>
								
								<select class="form-select" name="ulb_code" id="ulb_code"  >
									<option value="">Select ULB</option>
								</select>
							</div>
                       
                            <div class="col-sm-12 col-12 mb-2">
                                <label class="fieldlabels">1.10 Pin code: <span class="required">*</span></label>
                                <input type="number" name="entity_pincode" value="<?=set_value('entity_pincode') ?>"  id="entity_pincode" class="form-control" placeholder="Pincode" required />
                            </div>
							
                            <div class="col-sm-12 col-12 mb-2 govt_optional">
                                <label class="fieldlabels">1.11 CIN / Registration No. : <span class="govt_optional1 required">*</span> </label>
                                <input type="text" name="entity_reg_no" value="<?=set_value('entity_reg_no') ?>" id="entity_reg_no" class="form-control" placeholder="Registration No" />
                            </div>
                        
                            <div class="col-sm-12 col-12 mb-2 govt_optional">
                                <label class="fieldlabels">1.12 Incorporation/ registration date : <span class="govt_optional1 required">*</span> </label>
                                <input type="date" name="entity_reg_date" value="<?=set_value('entity_reg_date') ?>" id="entity_reg_date" class="form-control"  />
                            </div>

                            <div class="col-sm-12 col-12 mb-2 govt_optional">
                                <label class="fieldlabels">1.13 PAN number : <span class="govt_optional1 required">*</span>  </label>
                                <input type="text" name="entity_pan_no" value="<?=set_value('entity_pan_no') ?>" id="entity_pan_no" class="form-control" placeholder="PAN number" />
                            </div>
                       
                            <div class="col-sm-12 col-12 mb-2 govt_optional">
                                <label class="fieldlabels">1.14 GST number : <span class="govt_optional1 required">*</span> </label>
                                <input type="text" name="entity_gst_no" value="<?=set_value('entity_gst_no') ?>" id="entity_gst_no" class="form-control" placeholder="GST number" />
                            </div>

                            
                        </div>
                    </fieldset>
					
					
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div> 
                </form>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>

<?=$this->section('script');?>

<script>
	$(document).ready(function(){
		
		///ENTER ONLY NUMBER 
		$(document).on("keypress keyup blur",'.ulbcode', function(){		
		   $(this).val($(this).val().replace(/[^\d].+/, ""));
			if ((event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});
		

        $("#other_subtype_sec").hide();
        $("#cooperativeOthers").hide();
		$("#ulb_code_sec").hide();
        ///1.2 TYPE OF ENTITY
        $("#entity_type").on("change", function(){
            let et = $(this).val();
			
			if(et==1){ 
                $(".govt_optional").hide();
                $("#directordetailsSec, #nof_director").addClass(' blocksec');

            }else{ 
                $(".govt_optional").show(); 
                $("#directordetailsSec, #nof_director").removeClass(' blocksec');
            }
			if(et==252){
				$("#cooperativeOthers").show();
				$("#sub_entity_sec").hide();
			}else{
				$("#cooperativeOthers").hide();
				$("#sub_entity_sec").show();
				$.ajax({
					url:"<?=base_url()?>get-subtype",
					type:"post",
					data:{entityType:et},
					success:function(res){
						$("#sub_entity").html(res);
					}
				});
			}
			
        });
		
		
        /// 1.3 Sub-type
        function inArray(myArray,myValue){
            var inArray = false;
            myArray.map(function(key){
                if (key === myValue){
                    inArray=true;
                }
            });
            return inArray;
        };
		
        $("#sub_entity").on("change", function(){
            var sid = $(this).val();
            let othrs = [11,16,39,45,53,63,70,77,81,88,96,101,107,112,117,132,169,176,187,192,195,201,206,212,217,276];
            sid = parseInt(sid);
            if(inArray(othrs, sid)){
                $("#other_subtype_sec").show();
            }else{
                $("#other_subtype_sec").hide();
            }
			
			if(sid=="5"){
				$("#ulb_code_sec").show();
			}else{
				$("#ulb_code_sec").hide();
			}
			
			let opts = [12,13,14];
			console.log(sid);
			if(inArray(opts, sid)){
                $(".govt_optional1").html('*');
            }else{
                $(".govt_optional1").html('Optional');
            }
        });

        /// 1.8 State:
        $("#entity_state").on("change", function(){
            let es = $(this).val();
            $.ajax({
				url:"<?=base_url()?>get-districts",
				type:"post",
				data:{scode:es},
				success:function(res){
					$("#entity_district").html(res);
				}
			});
        });
		
		$("#entity_district").on("change", function(){
            let ed = $(this).val();
            $.ajax({
				url:"<?=base_url()?>get-ulb",
				type:"post",
				data:{dcode:ed},
				success:function(res){
					console.log(res);
					$("#ulb_code").html(res);
				}
			});
        });

	})
</script>

<?= $this->endSection(); ?>