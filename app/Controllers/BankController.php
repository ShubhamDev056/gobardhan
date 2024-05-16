<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Role;
use App\Models\ProjectBankModel;
use App\Models\State;

class BankController extends BaseController
{
	private $db;
	public $per_page;
	public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session(); 
		$this->per_page = 10;
	}
	
    public function addBank($projectId)
    {
		$data['ss'] = "";
		if($this->request->getMethod() === 'post'){
			$bankloan_applied = $this->request->getVar('bankloan_applied');
			$ifsc_code = $this->request->getVar('ifsc_code');
			$loan_status = $this->request->getVar('loan_status');
			$requested_data = $this->request->getVar();
			$validation =  \Config\Services::validation();
			$rules = [
				"bankloan_applied" => [
						"label" => "Have You Applied For Bank Loan", 
						"rules" => "required"
					]
			];
			if($bankloan_applied=="Yes"){
				
				$rules = [
					"ifsc_code" => [
						"label" => "IFSC Code", 
						"rules" => "required"
					],
					"bank_branch" => [
						"label" => "Branch Name", 
						"rules" => "required"
					],
					"loan_ammount" => [
						"label" => "Loan Ammount", 
						"rules" => "required"
					],
					"loan_apply_date" => [
						"label" => "Date Of Loan Application Submission", 
						"rules" => "required"
					],
					"loan_status" => [
						"label" => "Status Of Loan Application", 
						"rules" => "required"
					]
					
				];
				
			}
			
			
			if ($this->validate($rules)) {
				
				$randomName='';
				$file = $this->request->getFile('sanctioned_doc');
				if(isset($file) && !empty($file->getName())){
					$randomName = $projectId."_".$file->getRandomName();
					// $data['fileName'] = $file->getName();
					// $data['randomName'] = $randomName;
					// $data['fileType'] = $file->getClientMimeType();
					// $data['fileSize'] = $file->getSize();
					$file->move(ROOTPATH.'sanctioned_docs/', $randomName);
					$requested_data['sanctioned_doc'] = $randomName;
				}
				
				$requested_data['ifsc_code'] = strtoupper($ifsc_code);
				$requested_data['project_id'] = $projectId;
				
				
				$projectBankModel = new ProjectBankModel();
				$result=$projectBankModel->insert($requested_data);
				$inserted_id = $projectBankModel->insertID;
				if($inserted_id){
					session()->setFlashData("success","Your bank details submitted successfully.");
					return redirect()->to(base_url().'profile'); 
				}
				
			}else {
				$errorsmsg = $validation->getErrors();
			}
			$data["errors"] = $errorsmsg;
		}
		
        return view('backend/add-bank-details',$data);
    }
	
	
	function appliedLoans()
	{
		$session = session();
		$userId = $session->get('user_id');
		$name = $session->get('name');
		$role_id = $session->get('role_id');
		
		
		
		$stateModel = new State();
		$projectBankModel = new ProjectBankModel();
		$bank_name = $this->request->getVar('bank_name');
		$state_name = $this->request->getVar('state_name');
		$loan_application_status = $this->request->getVar('loan_application_status');
		$ifsc_code = $this->request->getVar('ifsc_code');
		
		$qry="";
		if($role_id=="5"){
			$bank_name = $name;
		}
		
		$projectBankModel->select('project_bank_details.*, project_details.project_name, project_details.user_id, states.state_name, districts.district_name  ');
		$projectBankModel->join('project_details','project_bank_details.project_id = project_details.project_id');
		$projectBankModel->join('states','project_details.state_id = states.state_code');
		$projectBankModel->join('districts','project_details.district_id = districts.district_code');
		$projectBankModel->where('bankloan_applied','Yes');
		if(!empty($bank_name)){
			$projectBankModel->where('bank_name',$bank_name);
			$qry=" and bank_name='".$bank_name."' ";
		}
		if(!empty($state_name)){
			$projectBankModel->where('project_details.state_id',$state_name);
		}
		if(!empty($loan_application_status)){
			if($loan_application_status=="3"){
				$projectBankModel->whereIn('loan_status',[2,3,5]);
			}else{
				$projectBankModel->where('loan_status',$loan_application_status);
			}
		}
		if(!empty($ifsc_code)){
			$projectBankModel->where('ifsc_code',$ifsc_code);
		}
		
		if(!empty($name) && $role_id=="5"){
			$projectBankModel->where('bank_name',$name);
		}
		
		$projectBankModel->orderBy('created_at','desc');
		
		$data['appliedLoans'] = $projectBankModel->where('project_bank_details.status','1')->findAll();
		if($role_id==6){
			$data['banks'] = $projectBankModel->select('distinct(bank_name)')->where('status','1')->findAll();
		}
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		// $data['districts'] = $projectBankModel->select('distinct(bank_district)')->where('status','1')->findAll();
		
		$query=$this->db->query("select COUNT(project_bank_id) as totalApllied, 
								(SELECT COUNT(project_bank_id) FROM project_bank_details WHERE bankloan_applied='Yes' AND loan_status='1' AND status='1' $qry ) as sanctioned,
								(SELECT COUNT(project_bank_id) FROM project_bank_details WHERE bankloan_applied='Yes' AND loan_status IN(2,3,5) AND status='1' $qry ) as pending,
								(SELECT COUNT(project_bank_id) FROM project_bank_details WHERE bankloan_applied='Yes' AND loan_status='4' AND status='1' $qry ) as rejected,
								(SELECT COUNT(project_bank_id) FROM project_bank_details WHERE bankloan_applied='Yes' AND updated_by>0 AND status='1' $qry ) as bankrevw FROM project_bank_details WHERE bankloan_applied='Yes' AND status='1' $qry ");
		
		$data['summary']=$query->getRow();
		
		
		return view('backend/applied-loan',$data);
	}
	
	function updateLoanRemarks()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$projectBankModel = new ProjectBankModel();
		
		$rmks = $this->request->getVar('rmks');
		$pbId = $this->request->getVar('pbId');
		$usrId = $this->request->getVar('usrId');
		$validation =  \Config\Services::validation();
		$rules = [
			"rmks" => [
				"label" => "rmks", 
				"rules" => "required"
			],
			"pbId" => [
				"label" => "pbId", 
				"rules" => "required"
			]
		];
		
		
		$userModel = new UserModel();
		$userModel->select("user_id,name,email");
		$userModel->where("user_id",$usrId);
		$userModel->where("role_id",'3');
		$userDetails = $userModel->first();
		$user_name = $userDetails['name'];
		$user_email = $userDetails['email'];
		
		
		if ($this->validate($rules)) {
			
			if(!empty($rmks)){
				$rmks = $rmks.' <span class="updatedon">'.date('d-m-Y').'</span>';
			}
			$projArrs = [ 
				'bank_remarks' => $rmks, 
				'updated_by' => $userId
			];
			
			$res = $projectBankModel->update($pbId,$projArrs);
			if($res){
				$resArray = array('status'=>200,'message'=>'Status Upadte Successfully.');
				$this->sendMailBankRemarks($user_name, $user_email);
			}else{
				$resArray = array('status'=>500,'message'=>'Something Went Wrong.');
			}
		}else{
			$errorsmsg = $validation->getErrors();
			$resArray = array('status'=>0,'message'=>'Something Went Wrong.','errers'=>$errorsmsg);
		}
		echo json_encode($resArray);
		
		
	}
	
	
	function updateLoanRemarksPlant()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$projectBankModel = new ProjectBankModel();
		
		$rmks = $this->request->getVar('rmks');
		$bnkId = $this->request->getVar('bnkId');
		$validation =  \Config\Services::validation();
		$rules = [
			"rmks" => [
				"label" => "rmks", 
				"rules" => "required"
			],
			"bnkId" => [
				"label" => "bnkId", 
				"rules" => "required"
			]
		];
		
		
		if ($this->validate($rules)) {
			
			if(!empty($rmks)){
				$rmks = $rmks.' <span class="updatedon">'.date('d-m-Y').'</span>';
			}
			$projArrs = [ 
				'remarks' => $rmks
			];
			
			$res = $projectBankModel->update($bnkId,$projArrs);
			if($res){
				$resArray = array('status'=>200,'message'=>'Status Upadte Successfully.');
			}else{
				$resArray = array('status'=>500,'message'=>'Something Went Wrong.');
			}
		}else{
			$errorsmsg = $validation->getErrors();
			$resArray = array('status'=>0,'message'=>'Something Went Wrong.','errers'=>$errorsmsg);
		}
		echo json_encode($resArray);
		
		
	}
	
	
	function updateLoanStatus()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		
		
		$projectBankModel = new ProjectBankModel();
		$userModel = new UserModel();
		
		$loan_application_status = $this->request->getVar('ls');
		$reason = $this->request->getVar('r');
		$rmks = $this->request->getVar('rmks');
		$pbId = $this->request->getVar('pbId');
		$userId = $this->request->getVar('usrId');
		$sanctioned_amount = $this->request->getVar('sanctioned_amount');
		$sanctioned_date = $this->request->getVar('sanctioned_date');
		$bank_reason = $this->request->getVar('bank_reason');
		$reject_date = $this->request->getVar('reject_date');
		
		$userModel->select("user_id,name,email");
		$userModel->where("user_id",$userId);
		$userModel->where("role_id",'3');
		$userDetails = $userModel->first();
		$user_name = $userDetails['name'];
		$user_email = $userDetails['email'];
		
		
		
		
		$validation =  \Config\Services::validation();
		$rules = [
			"ls" => [
				"label" => "loan_application_status", 
				"rules" => "required"
			],
			
			"pbId" => [
				"label" => "pbId", 
				"rules" => "required"
			]
		];
		if ($this->validate($rules)) {
			if(!empty($bank_reason)){
				$bank_reason = $bank_reason.' <span class="updatedon">'.date('d-m-Y').'</span>';
			}
			
			if(!empty($rmks)){
				$rmks = $rmks.' <span class="updatedon">'.date('d-m-Y').'</span>';
			}
			
			$projArrs = [
				'loan_status' => $loan_application_status,
				//'reason' => $reason,
				'bank_remarks' => $rmks,
				'sanctioned_date' => $sanctioned_date,
				'sanctioned_amount' => $sanctioned_amount,
				'bank_reason' => $bank_reason,
				'reject_date' => $reject_date,
				'updated_by' => $userId
			];
			
			$randomName='';
			$file = $this->request->getFile('sanctioned_doc');
			if(isset($file) && !empty($file->getName())){
				$randomName = $pbId."_".$file->getRandomName();
				$file->move(ROOTPATH.'sanctioned_docs/', $randomName);
				$projArrs['sanctioned_doc'] = $randomName;
			}
			
			$res = $projectBankModel->update($pbId,$projArrs);
			if($res){
				$resArray = array('status'=>200,'message'=>'Status Upadte Successfully.');
				$this->sendMailBankRemarks($user_name, $user_email);
			}else{
				$resArray = array('status'=>500,'message'=>'Something Went Wrong.');
			}
		}else{
			$errorsmsg = $validation->getErrors();
			$resArray = array('status'=>0,'message'=>'Something Went Wrong.','errers'=>$errorsmsg);
		}
		echo json_encode($resArray);
		
	}
	
	
	
	function sendMailBankRemarks($name, $emailId)
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$bankName = $session->get('name');
		$bank='Bank';
		if($roleId=="5"){
			$bank=$bankName;
		}
		
		$message = "Dear $name, <br><br> This is to inform you that the <b>$bank</b> has updated the status against your pending loan application. <br> You are requested to review the status provided by the bank and provide comments if any.  <br><br> Regards <br> 
					GOBARdhan <br/>
					Department of Drinking Water and Sanitation <br/>
					Ministry of Jal Shakti <br/> ";
        $email = \Config\Services::email();
        $email->setFrom('admin@gobardhan.co.in', 'GOBARdhan Portal Remarks');
        $email->setTo($emailId);
        //$email->setTo('satyendrasinghbca777@gmail.com');
        $email->setSubject('GOBARdhan Portal Bank Review');
        $email->setMessage($message);
		//$email->setCC('satyendrasinghbca777@gmail.com');
		$email->send();
		// if($email->send()){
			// echo "send successfully";
		// }
	}
}
