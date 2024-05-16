<?php

namespace App\Controllers;
use App\Models\OptionList;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use App\Models\GramPanchayat;
use App\Models\Village;
use App\Models\ProjectModel;
use App\Models\ProjectBenefitsModel;
use App\Models\ProjectFeedstockModel;
use App\Models\ProjectLinkageModel;
use App\Models\ProjectFundingSourceModel;
use App\Models\ProjectRuralAddress;
use App\Models\MinistryModel;
use App\Models\OrganizationModel;
use App\Models\UlbModel;
use App\Models\ChangeStatusModel;


class AjaxController extends BaseController
{
	private $db;
    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
    }

    public function gasLinkage()
    {
    	return view('ajax_gas_linkage.php');
    }

    public function sendOTP()
    {
        // echo "send OTP";
        // $message = "Please activate the account ".anchor('user/activate/'.$data['u_link'],'Activate Now','');
        $message = "This is the testing mail";
        $email = \Config\Services::email();
        $email->setFrom('ss.snm1503@gmail.com', 'your Title Here');
        $email->setTo('satyendrasinghbca777@gmail.com');
        $email->setSubject('Your Subject here | sss.com');
        $email->setMessage($message);//your message here
        
        // $email->setCC('another@emailHere');//CC
        // $email->setBCC('thirdEmail@emialHere');// and BCC
        // $filename = '/img/yourPhoto.jpg'; //you can use the App patch 
        // $email->attach($filename);
        
        $email->send();
        $email->printDebugger(['headers']);
		
    }
	
	public function sendMail()
    {
        // echo "send OTP";
        // $message = "Please activate the account ".anchor('user/activate/'.$data['u_link'],'Activate Now','');
        $message = "This is the testing mail";
        $email = \Config\Services::email();
        $email->setFrom('ss.snm1503@gmail.com', 'your Title Here');
        $email->setTo('satyendrasinghbca777@gmail.com');
        $email->setSubject('Your Subject here | sss.com');
        $email->setMessage($message);//your message here
        
        // $email->setCC('another@emailHere');//CC
        // $email->setBCC('thirdEmail@emialHere');// and BCC
        // $filename = '/img/yourPhoto.jpg'; //you can use the App patch 
        // $email->attach($filename);
        
        $email->send();
        $email->printDebugger(['headers']);
		
    }
	public function sendCertificateMail()
    {
		echo "hello";
		//die();
		
    }

    public function subType()
    {
        $optionList = new OptionList();
        $entityType = $this->request->getVar('entityType');
        $subTypeEntites = $optionList->where('parent','sub_entity')->where('status','0')->where('dependency',$entityType)->orderBy('sequence','ASC')->findAll();
        echo '<option value="">Sub-Type Entity </option>';
        foreach($subTypeEntites as $subTypeEntity){
            $title = $subTypeEntity['title'];
            $id = $subTypeEntity['id'];
            echo '<option value="'.$id.'">'.$title.'</option>';
        }
    }

    public function plantType()
    {
        $optionList = new OptionList();
        $gasOutput = $this->request->getVar('gasOutput');
        $plantTypes = $optionList->where('parent','plant_type')->where('dependency',$gasOutput)->orderBy('sequence','ASC')->findAll();
        echo '<option value="">Plant Type </option>';
        foreach($plantTypes as $plantType){
            $title = $plantType['title'];
            $id = $plantType['id'];
            echo '<option value="'.$id.'">'.$title.'</option>';
        }
    }
    
    public function agencyType()
    {
        $optionList = new OptionList();
        $gasOutput = $this->request->getVar('gasOutput');
        $agencyTypes = $optionList->where('parent','ulb_agency_type')->where('dependency',$gasOutput)->orderBy('sequence','ASC')->findAll();
        echo '<option value="">Agency Type </option>';
        foreach($agencyTypes as $agencyType){
            $title = $agencyType['title'];
            $id = $agencyType['id'];
            echo '<option value="'.$id.'">'.$title.'</option>';
        }
    }
	
	public function getDistricts()
    {
        $districtModel = new District();
        $scode = $this->request->getVar('scode');
        $districts = $districtModel->where('state_code',$scode)->orderBy('district_name','ASC')->findAll();
        echo '<option value="">Select District </option>';
        foreach($districts as $district){
            $district_name = $district['district_name'];
            $id = $district['district_code'];
            echo '<option value="'.$id.'">'.$district_name.'</option>';
        }
    }
	
	public function getBlocks()
    {
        $blockModel = new Block();
        $dcode = $this->request->getVar('dcode');
        $blocks = $blockModel->where('district_code',$dcode)->where('block_code!=0')->orderBy('block_name','ASC')->findAll();
        echo '<option value="">Select Block </option>';
        foreach($blocks as $block){
            $block_name = $block['block_name'];
            $id = $block['block_code'];
            echo '<option value="'.$id.'">'.$block_name.'</option>';
        }
    }
	
	public function getGPs()
    {
        $gramPanchayat = new GramPanchayat();
        $bcode = $this->request->getVar('bcode');
        $gps = $gramPanchayat->where('block_code',$bcode)->where('gp_code!=0')->orderBy('gp_name','ASC')->findAll();
        echo '<option value="">Select GP </option>';
        foreach($gps as $gp){
            $gp_name = $gp['gp_name'];
            $id = $gp['gp_code'];
            echo '<option value="'.$id.'">'.$gp_name.'</option>';
        }
    }
	
	public function getVillages()
    {
        $villageModel = new Village();
        $gcode = $this->request->getVar('gcode');
        $villages = $villageModel->where('gp_code',$gcode)->where('village_code!=0')->orderBy('village_name','ASC')->findAll();
		//print_r($villages);
        echo '<option value="">Select village </option>';
        foreach($villages as $village){
            $village_name = $village['village_name'];
            $id = $village['village_code'];
            echo '<option value="'.$id.'">'.$village_name.'</option>';
        }
    }
	
	public function getULB()
    {
        $ulbModel = new UlbModel();
        $dcode = $this->request->getVar('dcode');
        $ulbs = $ulbModel->where('district_code',$dcode)->orderBy('ulb_name','ASC')->findAll();
		//print_r($villages);
        echo '<option value="">Select ULB </option>';
        foreach($ulbs as $ulb){
            $ulb_name = $ulb['ulb_name'];
            $id = $ulb['ulb_code'];
            echo '<option value="'.$id.'">'.$ulb_name.' ('.$id.')</option>';
        }
    }
	
	
	
	public function getProjects()
    {
        $projectModel = new ProjectModel();
        $dcode = $this->request->getVar('dcode');
        $bcode = $this->request->getVar('bcode');
        $entityType = $this->request->getVar('entityType');
		if(!empty($dcode)){
			$projects = $projectModel->where('district_id',$dcode)->where('entity_type_id',$entityType)->orderBy('project_name','ASC')->findAll();
		}
		
		if(!empty($bcode)){
			$projects = $projectModel->where('block_id',$bcode)->where('entity_type_id',$entityType)->orderBy('project_name','ASC')->findAll();
		}
        
        echo '<option value="0">Select Project </option>';
        echo '<option value="0">Not Applicable </option>';
        foreach($projects as $project){
            $project_name = $project['project_name'];
            $id = $project['project_id'];
            echo '<option value="'.$id.'">'.$project_name.'</option>';
        }
    }
	
	
	
	
	
	public function saveRegPurposeData(){
		$purposedata = $this->request->getVar('purposedata');
		$organization_id = $purposedata['organization_id'];
		$project_id = $purposedata['project_id'];
		$plant_name = $purposedata['plant_name'];
		$reg_purposes = $purposedata['reg_purposes']; //Arr
		$purpose_status = isset($purposedata['purpose_status']) ? $purposedata['purpose_status'] : ''; //$purposedata['purpose_status']; //Arr
		$otherPurposes = $purposedata['otherPurposes']; //Arr
		
		$projectModel = new ProjectModel();
		$projectBenefitsModel = new ProjectBenefitsModel();
		
		$session = session();
		$user_id = $session->get('user_id');
		
		$projectDetails = [
			'project_name'=> $plant_name,
			'organization_id'=> $organization_id,
			'user_id' => $user_id,
			'form_completion' => 20
		];
		
		$pid=$project_id;
		if(empty($project_id) || $project_id=="0"){
			$result=$projectModel->insert($projectDetails);
			$pid = $projectModel->insertID;
		}else{
			$projectDetails = [
				'project_name'=> $plant_name,
				//'organization_id'=> $organization_id
			];
			$projectModel->update($pid,$projectDetails);
		}
		
		if($pid){
			$hasOthers=false;
			if(in_array(260,$reg_purposes)){
				$hasOthers=true;
				array_pop($reg_purposes);
			}
			
			$projectBenefitsModel->where('project_id', $pid)->delete();
			foreach($reg_purposes as $key=>$reg_purpose){
				$pstatus = $purpose_status[$key];
				$prBenefits = [
					'option_list_id'=> $reg_purpose,
					'status'=> $pstatus,
					'project_id'=> $pid,
					'organization_id'=> $organization_id
				];
				$result=$projectBenefitsModel->insert($prBenefits);
			}; 
			if($hasOthers){
				//$projectBenefitsModel->where('project_id', $pid)->delete();
				foreach($otherPurposes as $otherPurpose){
					if($otherPurpose!=""){
						$purposeOthers = [
							'option_list_id'=> 260,
							'status'=> 'availed',
							'project_id'=> $pid,
							'organization_id'=> $organization_id,
							'other'=> $otherPurpose
						];
						$projectBenefitsModel->insert($purposeOthers);
					}
				}
			}
			$resultArr = array("status"=>1,"message"=>"Insert Success","project_id"=>$pid);
			//echo "success";
		}else{
			$resultArr = array("status"=>0,"message"=>"Something went wrong.");
			//echo "failed";
		}
		echo json_encode($resultArr);
	}
	
	
	public function saveProjectData(){
		
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		
		$projectData = $this->request->getVar('projectData');
		$organization_id = $projectData['organization_id'];
		$project_id = $projectData['project_id'];
		$gas_output = $projectData['gas_output'];
		$plant_type = $projectData['plant_type'];
		$plant_status = $projectData['plant_status'];
		$production_capacity = $projectData['production_capacity'];
		$feedstockSolid_capacity = $projectData['feedstockSolid_capacity'];
		$feedstockLiquid_capacity = $projectData['feedstockLiquid_capacity'];
		$design_bioslurry = $projectData['design_bioslurry'];
		$design_FOM = $projectData['design_FOM'];
		$design_LFOM = $projectData['design_LFOM'];
		$total_feedstock = $projectData['total_feedstock'];
		$total_feedstock_unit = $projectData['total_feedstock_unit'];
		$total_feedstockLiquid = $projectData['total_feedstockLiquid'];
		$total_feedstockLiquid_unit = $projectData['total_feedstockLiquid_unit'];
		$loiDetails = $projectData['loiDetails'];
		$distance_grid = $projectData['distance_grid'];
		$loi_obtain_details = $projectData['loi_obtain_details'];
		$solidFeedStockType = isset($projectData['solidFeedStockType']) ? $projectData['solidFeedStockType'] : ''; //$projectData['solidFeedStockType']; //Arr
		//$solidFeedStockType_unit = $projectData['solidFeedStockType_unit']; //Arr
		$production_capacity_unit = $projectData['production_capacity_unit'];
		$feedstockSolid_capacity_unit = $projectData['feedstockSolid_capacity_unit'];
		$feedstockLiquid_capacity_unit = $projectData['feedstockLiquid_capacity_unit'];
		$design_bioslurry_unit = $projectData['design_bioslurry_unit'];
		$design_FOM_unit = $projectData['design_FOM_unit'];
		$design_LFOM_unit = $projectData['design_LFOM_unit'];
		$bioslurry_tech = $projectData['bioslurry_tech']; 
		$other_technologybioSlurry = $projectData['other_technologybioSlurry'];
		// $solidFeedStockType_number = $projectData['solidFeedStockType_number']; //Arr
		// $solidFeedStockSourceData = $projectData['solidFeedStockSourceData']; //Arr
		// $solidFeedStockOtherSource = $projectData['solidFeedStockOtherSource']; //Arr
		
		$solidOtherFs = isset($projectData['solidOtherFs']) ? $projectData['solidOtherFs'] : ''; //$projectData['solidOtherFs']; //Arr
		$solidFsOtherNo = isset($projectData['solidFsOtherNo']) ? $projectData['solidFsOtherNo'] : ''; //$projectData['solidFsOtherNo']; //Arr 
		$feedstock_type_other_unit = isset($projectData['feedstock_type_other_unit']) ? $projectData['feedstock_type_other_unit'] : ''; //$projectData['feedstock_type_other_unit']; //Arr 
		
		$solidOtherFsSoData = isset($projectData['solidOtherFsSoData']) ? $projectData['solidOtherFsSoData'] : ''; //$projectData['solidOtherFsSoData']; //Arr
		$solidOtherFsSoOther = isset($projectData['solidOtherFsSoOther']) ? $projectData['solidOtherFsSoOther'] : ''; //$projectData['solidOtherFsSoOther']; //Arr
		
		
		$liquidFeedStockType =isset($projectData['liquidFeedStockType']) ? $projectData['liquidFeedStockType'] : ''; // $projectData['liquidFeedStockType']; //Arr
		//$liquidFeedStockType_number = $projectData['liquidFeedStockType_number']; //Arr
		// $liquidFeedStockType_unit = $projectData['liquidFeedStockType_unit']; //Arr
		// $liquidFeedStockSourceData = $projectData['liquidFeedStockSourceData']; //Arr
		// $liquidFeedStockOtherSource = $projectData['liquidFeedStockOtherSource']; //Arr
		
		$liquidOtherFs = isset($projectData['liquidOtherFs']) ? $projectData['liquidOtherFs'] : ''; //$projectData['liquidOtherFs']; //Arr
		$liquidFsOtherNo = isset($projectData['liquidFsOtherNo']) ? $projectData['liquidFsOtherNo'] : ''; //$projectData['liquidFsOtherNo']; //Arr
		$feedstock_type_other_unit_liquid = isset($projectData['feedstock_type_other_unit_liquid']) ? $projectData['feedstock_type_other_unit_liquid'] : ''; //$projectData['feedstock_type_other_unit_liquid']; //Arr
		$liquidOtherFsSoData = isset($projectData['liquidOtherFsSoData']) ? $projectData['liquidOtherFsSoData'] : ''; //$projectData['liquidOtherFsSoData']; //Arr
		$liquidOtherFsSoOther = isset($projectData['liquidOtherFsSoOther']) ? $projectData['liquidOtherFsSoOther'] : ''; //$projectData['liquidOtherFsSoOther']; //Arr
		//$liquidOtherFsSoOther = $projectData['liquidOtherFsSoOther']; //Arr
		
		
		$biogasForwardLinkages = isset($projectData['biogasForwardLinkages']) ? $projectData['biogasForwardLinkages'] : ''; //$projectData['biogasForwardLinkages']; //Arr
		$biogas_numbers = isset($projectData['biogas_numbers']) ? $projectData['biogas_numbers'] : '';  //$projectData['biogas_numbers']; //Arr
		$cbgForwardLinkages = isset($projectData['cbgForwardLinkages']) ? $projectData['cbgForwardLinkages'] : '';  //$projectData['cbgForwardLinkages']; //Arr
		$cbg_numbers = isset($projectData['cbg_numbers']) ? $projectData['cbg_numbers'] : ''; //$projectData['cbg_numbers']; //Arr
		$plant_status_date = date("Y-m-d", strtotime($projectData['plant_status_date'])); 
		
		
		$projectModel = new ProjectModel();
		$projectFeedstockModel = new ProjectFeedstockModel();
		$projectLinkageModel = new ProjectLinkageModel();
		$changeStatusModel = new ChangeStatusModel();
		
		$projectDetails = [
			'entity_type_id'=> $gas_output,
			'plant_type_id'=> $plant_type,
			'plant_status_id'=> $plant_status,
			'gas_production_capacity'=> $production_capacity,
			'gpc_unit'=> $production_capacity_unit,
			'solid_feedstock_capacity'=> $feedstockSolid_capacity,
			'sfc_unit'=> $feedstockSolid_capacity_unit,
			'liquid_feedstock_capacity'=> $feedstockLiquid_capacity,
			'lfc_unit'=> $feedstockLiquid_capacity_unit,
			'bio_slurry_output'=> $design_bioslurry,
			'bso_unit'=> $design_bioslurry_unit,
			'FOM_output'=> $design_FOM,
			'FOM_unit'=> $design_FOM_unit,
			'LFOM_output'=> $design_LFOM,
			'LFOM_unit'=> $design_LFOM_unit,
			'total_solid_feedstock'=> $total_feedstock,
			'tsfs_unit'=> $total_feedstock_unit,
			'total_liquid_feedstock'=> $total_feedstockLiquid,
			'tlfs_unit'=> $total_feedstockLiquid_unit,
			'loi_detail_id'=> $loiDetails,
			'distance_grid'=> $distance_grid,
			'loi_obtain_details'=> $loi_obtain_details,
			'bioslurry_tech'=> $bioslurry_tech,
			'bioslurry_tech_other'=> $other_technologybioSlurry,
			'plant_status_date'=> $plant_status_date,
			'form_completion' => 40
			
		];
		
		
		$result = $projectModel->update($project_id,$projectDetails);
		if($result){
			date_default_timezone_set("Asia/Calcutta");
			$created_at = date('Y-m-d H:i:s');
			$statusLogArr = ['project_id'=>$project_id,'status_id'=>$plant_status,'updated_by'=>$userId,'created_at'=>$created_at];
			$changeStatusModel->insert($statusLogArr);
			
			if(!empty($solidFeedStockType)){
				$solidFeedStockType_number = isset($projectData['solidFeedStockType_number']) ? $projectData['solidFeedStockType_number'] : ''; //Arr
				$solidFeedStockType_unit = isset($projectData['solidFeedStockType_unit']) ? $projectData['solidFeedStockType_unit'] : ''; //Arr
				$solidFeedStockSourceData = isset($projectData['solidFeedStockSourceData']) ? $projectData['solidFeedStockSourceData'] : ''; //Arr
				$solidFeedStockOtherSource = isset($projectData['solidFeedStockOtherSource']) ? $projectData['solidFeedStockOtherSource'] : ''; //Arr
				$hasSolidOthers=false;
				if(in_array(45,$solidFeedStockType)){
					$hasSolidOthers=true;
					array_pop($solidFeedStockType);
				}
				///SOLID FEEDSTOCK
				$projectFeedstockModel->where('project_id', $project_id)->delete();
				foreach($solidFeedStockType as $key=>$solidFeedStockTypev){
					$solidTypeNo = $solidFeedStockType_number[$key];
					$solidTypeUnit = $solidFeedStockType_unit[$key];
					$solidFeedStockSourceData1 = $solidFeedStockSourceData[$key];
					$solidFeedStockOtherSource1 = $solidFeedStockOtherSource[$key];
						
					$solidFeedStockDetails = [
						'option_list_id'=> $solidFeedStockTypev,
						'project_id'=> $project_id,
						'organization_id'=> $organization_id,
						'quantity'=> $solidTypeNo,
						'qty_unit'=> $solidTypeUnit,
						'source_type'=>'solid',
						'feedstock_source'=>$solidFeedStockSourceData1,
						'others_fedstock_source'=>$solidFeedStockOtherSource1,
					];
					$projectFeedstockModel->insert($solidFeedStockDetails);
				}
				if($hasSolidOthers){
					foreach($solidOtherFs as $key2=>$solidOtherFsv){
						$solidOtherNo = $solidFsOtherNo[$key2];
						$solidOtherFsSoData1 = $solidOtherFsSoData[$key2];
						$solidOtherFsSoOther1 = $solidOtherFsSoOther[$key2];
						$feedstock_typeotherunit = $feedstock_type_other_unit[$key2];
						$solidFeedStockOtherDetails = [
							'option_list_id'=> 45,
							'project_id'=> $project_id,
							'organization_id'=> $organization_id,
							'quantity'=> $solidOtherNo,
							'qty_unit'=> $feedstock_typeotherunit,
							'others_category'=>$solidOtherFsv,
							'feedstock_source'=>$solidOtherFsSoData1,
							'others_fedstock_source'=>$solidOtherFsSoOther1,
							'source_type'=>'solid',
						];
						$projectFeedstockModel->insert($solidFeedStockOtherDetails);
					}
				}
			}
			
			
			
			
			///LIQUID FEEDSTOCK
			if(!empty($liquidFeedStockType)){
				$liquidFeedStockType_number = isset($projectData['liquidFeedStockType_number']) ? $projectData['liquidFeedStockType_number'] : ''; //Arr
				$liquidFeedStockType_unit = isset($projectData['liquidFeedStockType_unit']) ? $projectData['liquidFeedStockType_unit'] : ''; //Arr
				$liquidFeedStockSourceData = isset($projectData['liquidFeedStockSourceData']) ? $projectData['liquidFeedStockSourceData'] : ''; //Arr
				$liquidFeedStockOtherSource = isset($projectData['liquidFeedStockOtherSource']) ? $projectData['liquidFeedStockOtherSource'] : ''; //Arr
				$hasLiquidOthers=false;
				if(in_array(241,$liquidFeedStockType)){
					$hasLiquidOthers=true;
					array_pop($liquidFeedStockType);
				}
				
				foreach($liquidFeedStockType as $key=>$liquidFeedStockTypev){
					$liquidTypeNo = $liquidFeedStockType_number[$key];
					$liquidTypeUnit = $liquidFeedStockType_unit[$key];
					$liquidFeedStockSourceData1 = $liquidFeedStockSourceData[$key];
					$liquidFeedStockOtherSource1 = $liquidFeedStockOtherSource[$key];
						
					$liquidFeedStockDetails = [
						'option_list_id'=> $liquidFeedStockTypev,
						'project_id'=> $project_id,
						'organization_id'=> $organization_id,
						'quantity'=> $liquidTypeNo,
						'qty_unit'=> $liquidTypeUnit,
						'source_type'=>'liquid',
						'feedstock_source'=>$liquidFeedStockSourceData1,
						'others_fedstock_source'=>$liquidFeedStockOtherSource1,
					];
					$projectFeedstockModel->insert($liquidFeedStockDetails);
				}
				
				if($hasLiquidOthers){
					foreach($liquidOtherFs as $key2=>$liquidOtherFsv){
						$liquidOtherNo = $liquidFsOtherNo[$key2];
						$liquidOtherFsSoData1 = $liquidOtherFsSoData[$key2];
						$liquidOtherFsSoOther1 = $liquidOtherFsSoOther[$key2];
						$feedstock_typeotherunitl = $feedstock_type_other_unit_liquid[$key2];
						$liquidFeedStockOtherDetails = [
							'option_list_id'=> 241,
							'project_id'=> $project_id,
							'organization_id'=> $organization_id,
							'quantity'=> $liquidOtherNo,
							'qty_unit'=> $feedstock_typeotherunitl,
							'others_category'=>$liquidOtherFsv,
							'feedstock_source'=>$liquidOtherFsSoData1,
							'others_fedstock_source'=>$liquidOtherFsSoOther1,
							'source_type'=>'liquid',
						];
						$projectFeedstockModel->insert($liquidFeedStockOtherDetails);
					}
				}
			
			}
			
			///BIOGAS LINKAGE
			$projectLinkageModel->where('project_id', $project_id)->delete();
			if(!empty($biogasForwardLinkages)){
				
				foreach($biogasForwardLinkages as $key=>$biogasForwardLinkage){
					$biogas_number = $biogas_numbers[$key];
					$biogasLinkageData = [
						'option_list_id' => $biogasForwardLinkage,
						'quantity' => $biogas_number,
						'project_id' => $project_id,
						'organization_id' => $organization_id,
						'linkage_type' => 'Biogas',
					];
					$projectLinkageModel->insert($biogasLinkageData);
				}
				
				
			}
			
			
			///CBG LINKAGE   
			if(!empty($cbgForwardLinkages)){
				$hasOtherCBGs=false;
				if(in_array(39,$cbgForwardLinkages)){
					$hasOtherCBGs=true;
					array_pop($cbgForwardLinkages);
				}
				foreach($cbgForwardLinkages as $key=>$cbgForwardLinkage){
					$cbg_number = $cbg_numbers[$key];
					$cbgLinkageData = [
						'option_list_id' => $cbgForwardLinkage,
						'quantity' => $cbg_number,
						'project_id' => $project_id,
						'organization_id' => $organization_id,
						'linkage_type' => 'CBG',
					];
					$projectLinkageModel->insert($cbgLinkageData);
				}
				
				if($hasOtherCBGs){ 
					$other_cbglinkages = $projectData['other_cbglinkages'];
					foreach($other_cbglinkages as $key=>$other_cbglinkage){
						//$cbg_number = $cbg_numbers[$key];
						$cbgLinkageData = [
							'option_list_id' => 39,
							'other_specify' => $other_cbglinkage,
							// 'quantity' => $cbg_number,
							'project_id' => $project_id,
							'organization_id' => $organization_id,
							'linkage_type' => 'CBG',
						];
						$projectLinkageModel->insert($cbgLinkageData);
					}
				}
			}
			echo "success";
		}
		else{
			echo "failed";
		}
		
		//print_r($projectData);
	}
	
	
	public function saveLocationData(){
		$locationData = $this->request->getVar('locationData');
		$organization_id = $locationData['organization_id'];
		$project_id = $locationData['project_id'];
		$plant_location = $locationData['plant_location'];
		$plant_area = $locationData['plant_area'];
		$landOwnership = $locationData['landOwnership'];
		$landOwnership_other = $locationData['landOwnership_other'];
		$latitude = $locationData['latitude'];
		$longitude = $locationData['longitude'];
		
		
		$projectModel = new ProjectModel();
		$projectRuralAddressModel = new ProjectRuralAddress();
		$stateModel = new State();
		
		
		$projectDetails = [
			'plant_location_id'=> $plant_location,
			'plant_area'=> $plant_area,
			'land_ownership_id'=> $landOwnership,
			'other_ownership'=> $landOwnership_other,
			'latitude'=> $latitude,
			'longitude'=> $longitude,
			'form_completion' => 60
		];
		
		///URBAN  ADDRESS
		if($plant_location==82){
			$urbanAddress = $this->request->getVar('urbanAddress');
			$urban_state = $urbanAddress['urban_state'];
			
			$projectDetails['state_id']=$urbanAddress['urban_state'];
			$projectDetails['district_id']=$urbanAddress['urban_district'];
			$projectDetails['city']=$urbanAddress['urban_city'];
			$projectDetails['ward_no']=$urbanAddress['urban_ward_number'];
			$projectDetails['pincode']=$urbanAddress['urban_pin_code'];
			$projectDetails['street_area_address']=$urbanAddress['urban_street_area'];
			$projectDetails['plot_number']=$urbanAddress['urban_plot_number'];
			//$projectDetails['parent_project']=$urbanAddress['urban_project'];
			
			$state = $stateModel->where('state_code',$urban_state)->first();
			
		}
		
		/// INDUSTRIAL AREA  ADDRESS
		if($plant_location==224){
			$industrialAddress = $this->request->getVar('industrialAddress');
			$industrial_state = $industrialAddress['industrial_state'];
			$projectDetails['state_id']=$industrialAddress['industrial_state'];
			$projectDetails['district_id']=$industrialAddress['industrial_district'];
			$projectDetails['pincode']=$industrialAddress['industrial_pincode'];
			$projectDetails['street_area_address']=$industrialAddress['industrial_address'];
			
			$state = $stateModel->where('state_code',$industrial_state)->first();
		}
		
		/// RURAL  ADDRESS
		if($plant_location==83){
			$ruralAdrsDatas = $this->request->getVar('ruralAdrsDatas');
			
			$projectDetails['state_id']=$ruralAdrsDatas['rural_state'];
			$projectDetails['district_id']=$ruralAdrsDatas['rural_district'];
			$projectDetails['block_id']=$ruralAdrsDatas['rural_block'];
			
			$stateId = $ruralAdrsDatas['rural_state'];
			$districtId = $ruralAdrsDatas['rural_district'];
			$blockId = $ruralAdrsDatas['rural_block'];
			$rural_gps = $ruralAdrsDatas['rural_gp']; ///arr
			$rural_villages = $ruralAdrsDatas['rural_village']; ///arr
			$rural_pincodes = $ruralAdrsDatas['rural_pincode']; ///arr
			
			$state = $stateModel->where('state_code',$stateId)->first();
			//print_r($rural_gps);
			$projectRuralAddressModel->where('project_id', $project_id)->delete();
			foreach($rural_gps as $key=>$rural_gp)
			{
				$rural_village = $rural_villages[$key];
				$rural_pincode = $rural_pincodes[$key];
				
				if($key==0){
					$projectDetails['gp_id']=$rural_gp;
					$projectDetails['village_id']=$rural_village;
					$projectDetails['pincode']=$rural_pincode;
				}
				
				$pRuralAddress = [
					'state_id'=> $stateId,
					'district_id'=> $districtId,
					'block_id'=> $blockId,
					'gp_id'=> $rural_gp,
					'village_id'=> $rural_village,
					'pincode'=> $rural_pincode,
					'project_id'=> $project_id,
					'organization_id'=> $organization_id,
				];
				//print_r($projectDetails);
				$projectRuralAddressModel->insert($pRuralAddress);
			}
		}
		
		$abbreviation = $state['abbreviation'];
		$pdeatil = $projectModel->where('project_id',$project_id)->first();
		$plant_status_id = $pdeatil['plant_status_id'];
		$entity_type_id = $pdeatil['entity_type_id'];
		$temp=true;
		if($plant_status_id=="24" || $plant_status_id=="290"){
			$temp=false;
		}
		$isBiogas="02";
		if($entity_type_id=="17"){ $isBiogas="01"; }
		$pregNumber = uniqueId($abbreviation,$project_id, $temp,$isBiogas);
		$projectDetails['project_registration_no']= $pregNumber;
		$result = $projectModel->update($project_id,$projectDetails);
		if($result){
			echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function savePhysicalData(){
		$physicalData = $this->request->getVar('physicalData');
		$organization_id = $physicalData['organization_id'];
		$project_id = $physicalData['project_id'];
		$capex_number = $physicalData['capex_number'];
		$date_of_commissioning = $physicalData['date_of_commissioning'];
		$proposed_date = $physicalData['proposed_date'];
		$construction_date = $physicalData['construction_date'];
		
		$fundingSources = $physicalData['fundingSources'];
		$fundingSource_numbers = $physicalData['fundingSource_numbers'];
		
		$fundingSourceOthers = $physicalData['fundingSourceOthers'];
		$fundingSourceOtherNos = $physicalData['fundingSourceOtherNos'];
		
		
		$projectModel = new ProjectModel();
		$projectFundingSourceModel = new ProjectFundingSourceModel();
		
		
		$projectDetails = [
			'total_capex'=> $capex_number,
			'date_of_commissioning'=> $date_of_commissioning,
			'proposed_date'=> $proposed_date,
			'construction_date'=> $construction_date,
			'form_completion' => 80
		];
		
		$result = $projectModel->update($project_id,$projectDetails);
		if($result){
			
			$hasOtherFunding=false;
			if(in_array(132,$fundingSources)){
				$hasOtherFunding=true;
				array_pop($fundingSources);
			}
			
			$projectFundingSourceModel->where('project_id', $project_id)->delete();
			foreach($fundingSources as $key=>$fundingSource){
				$fundingSource_number = $fundingSource_numbers[$key];
				$fundingSourceDetails = [
					'option_list_id' => $fundingSource,
					'quantity' => $fundingSource_number,
					'project_id' => $project_id,
					'organization_id' => $organization_id,
				];
				$projectFundingSourceModel->insert($fundingSourceDetails);
			}
			
			if($hasOtherFunding){
				foreach($fundingSourceOthers as $key=>$fundingSourceOther){
					$fundingSourceOtherNo = $fundingSourceOtherNos[$key];
					$fundingSourceDetailsOthers = [
						'option_list_id' => 132,
						'quantity' => $fundingSourceOtherNo,
						'project_id' => $project_id,
						'organization_id' => $organization_id,
						'other_specify' => $fundingSourceOther,
					];
					$projectFundingSourceModel->insert($fundingSourceDetailsOthers);
				}
				
			}
			echo "success";
		}else{
			echo "failed";
		}
	}
	
	
	
	public function plantDetails()
	{
		$stateCode = $this->request->getVar('stateCode');
		$districtCode = $this->request->getVar('districtCode');
		$gpCode = $this->request->getVar('gpCode');
		$bgstatus = $this->request->getVar('bgstatus');
		$etype = $this->request->getVar('etype');
		$ministry = $this->request->getVar('m');
		$fdate = $this->request->getVar('fdate');
		$tdate = $this->request->getVar('tdate');
		$mnst = " project_id IN(SELECT DISTINCT(project_id) FROM project_benefits WHERE option_list_id='255' )";
		$plant_status_id='';
		if($bgstatus=="yettostart"){
			$plant_status_id=22;
		}
		if($bgstatus=="underconstct"){
			$plant_status_id=23;
		}
		if($bgstatus=="functional"){
			$plant_status_id=24;
		}
		if($bgstatus=="completed"){
			$plant_status_id=290;
		}
		$projectModel = new ProjectModel();
		$dd=[];
		if(!empty($stateCode)){
			$projectModel->select("project_name, project_status, organizations.entity_name, districts.district_name, blocks.block_name,gp_name, villages.village_name ,project_id,organization_id, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->join('districts', 'project_details.district_id=districts.district_code');
			$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
			$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
			$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
			$projectModel->where('project_details.entity_type_id', $etype);
			$projectModel->where('project_details.state_id', $stateCode);
			if(!empty($plant_status_id)){
				$projectModel->where('project_details.plant_status_id', $plant_status_id);
			}
			if($ministry=='ddws'){
				if(!empty($fdate) && !empty($tdate) ){
					$mnst.=" and plant_status_date>='".$fdate."' and plant_status_date<='".$tdate."' ";
				}
				$projectModel->where('organizations.entity_type', '1');
				$projectModel->where($mnst);
				
			}
			
			$projectModel->groupBy('project_details.village_id,project_details.created_at');
			$dd=$projectModel->findAll();
		}
		if(!empty($districtCode)){
			$projectModel->select("project_name, project_status, organizations.entity_name, districts.district_name, blocks.block_name,gp_name, villages.village_name ,project_id,organization_id, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->join('districts', 'project_details.district_id=districts.district_code');
			$projectModel->join('blocks', 'project_details.block_id=blocks.block_code','left');
			$projectModel->join('gram_panchayat', 'project_details.gp_id=gram_panchayat.gp_code','left');
			$projectModel->join('villages', 'project_details.village_id=villages.village_code','left');
			$projectModel->where('project_details.entity_type_id', $etype);
			$projectModel->where('project_details.district_id', $districtCode);
			if(!empty($plant_status_id)){
				$projectModel->where('project_details.plant_status_id', $plant_status_id);
			}
			if($ministry=='ddws'){
				if(!empty($fdate) && !empty($tdate) ){
					$mnst.=" and plant_status_date>='".$fdate."' and plant_status_date<='".$tdate."' ";
				}
				$projectModel->where('organizations.entity_type', '1');
				$projectModel->where($mnst);
			}
			$projectModel->groupBy('project_details.village_id,project_details.created_at');
			$dd=$projectModel->findAll();
		}
		
		if(!empty($gpCode)){
			$projectModel->select("organizations.entity_name, project_status ,project_id,organization_id, project_name, project_status, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output, block_id, village_id, street_area_address ");
			$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
			$projectModel->where('project_details.entity_type_id', $etype);
			$projectModel->where('project_details.gp_id', $gpCode);
			$dd=$projectModel->findAll();
		}
		
		return json_encode($dd);
	}
	
	
}
