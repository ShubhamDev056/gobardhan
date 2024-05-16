<?php 
namespace App\Controllers;
use App\Models\MDAIssue;
use App\Models\OfftakeIssue;
use App\Models\State;
use App\Models\District;

class IssueController extends BaseController
{
	private $db;
    public $per_page;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
    }
	
   
	function createMdaIssue($pid)
	{
		
		if($this->request->getMethod() === 'post'){
			$abc = $this->request->getVar();
			
			$issue_related = $this->request->getVar('issue_related');
			$ifms = $this->request->getVar('ifms');
			$mous = $this->request->getVar('mous');
			$pos_machines = $this->request->getVar('pos_machines');
			$testingIssues = $this->request->getVar('testingIssues');
			
			$other_ifms = $this->request->getVar('other_ifms');
			$other_mou = $this->request->getVar('other_mou');
			$other_pos = $this->request->getVar('other_pos');
			$other_testing = $this->request->getVar('other_testing');
			
			$remarks = $this->request->getVar('remarks');
			$session = session();
			$user_id = $session->get('user_id');
			$validation =  \Config\Services::validation();
			
			$rules = [
				"issue_related" => [
					"label" => "issue_related", 
					"rules" => "required"
				],
				
				"remarks" => [
					"label" => "remarks", 
					"rules" => "required"
				]
			];
			
			if($this->validate($rules)){
				
				$issuerelated = implode(",", $issue_related);
				if(!empty($ifms)){
					$ifms = implode(",", $ifms);
				}
				
				if(!empty($mous)){
					$mous = implode(",", $mous);
				}
				if(!empty($pos_machines)){
					$pos_machines = implode(",", $pos_machines);
				}
				if(!empty($testingIssues)){
					$testingIssues = implode(",", $testingIssues);
				}
				
				$madIssueData = [
					'project_id'=>$pid,
					'related_issues'=>$issuerelated,
					'ifms'=>$ifms,
					'other_ifms'=>$other_ifms,
					'mous'=>$mous,
					'other_mou'=>$other_mou,
					'pos_machines'=>$pos_machines,
					'other_pos'=>$other_pos,
					'testingIssues'=>$testingIssues,
					'other_testing'=>$other_testing,
					'remarks'=>$remarks,
					'added_by'=>$user_id,
				];
				
				$MDAIssue = new MDAIssue();
				$result = $MDAIssue->insert($madIssueData);
				if($result){
					return redirect()->to(base_url().'profile');
				}
			}else{
				$errorsmsg = $validation->getErrors();
				$data["errors"] = $errorsmsg;
			}
		}
		$data['title']="";
		return view('backend/add-mda-issue',$data);
	}
	
	
	function mdaAllIssues()
	{
		$session = session();
		$user_id = $session->get('user_id'); 
		$MDAIssue = new MDAIssue();
		$stateModel = new State();
		
		$MDAIssue->select("mda_issues.*, project_details.project_name, states.state_name ");
		$MDAIssue->join('project_details','mda_issues.project_id=project_details.project_id'); 
		$MDAIssue->join('states','states.state_code=project_details.state_id'); 
		$MDAIssue->where('mda_issues.status','1');
		$MDAIssue->where('project_details.plant_status_id','24'); 
		$query = $MDAIssue->orderBy('mda_issues.created_at','Desc');
		$data['mdaissues'] = $query->findAll();
		
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		
		return view('backend/mda-issues',$data);
	}
	
	
	function mdaAllIssuesDetails($mdaIssueId)
	{
		$session = session();
		$user_id = $session->get('user_id');
		
		$MDAIssue = new MDAIssue();
		$stateModel = new State();
		$MDAIssue->select("mda_issues.*, project_details.project_name, states.state_name ");
		$MDAIssue->join('project_details','mda_issues.project_id=project_details.project_id');
		$MDAIssue->join('states','states.state_code=project_details.state_id');
		$MDAIssue->where('mda_issues.status','1');
		$MDAIssue->where('project_details.plant_status_id','24');
		$query = $MDAIssue->where('mda_issues.id',$mdaIssueId);
		$mdaissue = $query->first();
		
		$related_issue=$ifmsDataArr=$mousDataArr=$pos_machinesDataArr=$testingIssuesDataArr=[];
		$reissues = explode(",",$mdaissue['related_issues']);
		foreach($reissues as $reissue){
			$related_issue[]= getNameFromId('issues_related', $reissue);
		}
		
		$ifmsArr = explode(",",$mdaissue['ifms']);
		foreach($ifmsArr as $ifms){
			$ifmsDataArr[]= getNameFromId('ifms_issues', $ifms);
		}
		
		$mousArr = explode(",",$mdaissue['mous']);
		foreach($mousArr as $mous){
			$mousDataArr[]= getNameFromId('mou_issues', $mous);
		}
		$pos_machinesArr = explode(",",$mdaissue['pos_machines']);
		foreach($pos_machinesArr as $pos_machines){
			$pos_machinesDataArr[]= getNameFromId('pos_machine_issues', $pos_machines);
		}
		$testingIssuesArr = explode(",",$mdaissue['testingIssues']);
		foreach($testingIssuesArr as $testingIssues){
			$testingIssuesDataArr[]= getNameFromId('testing_issues', $testingIssues);
		}
		
		$mdaissue['related_issues'] = implode(", ",$related_issue);
		$mdaissue['ifms'] = implode(", ",$ifmsDataArr);
		$mdaissue['mous'] = implode(", ",$mousDataArr);
		$mdaissue['pos_machines'] = implode(", ",$pos_machinesDataArr);
		$mdaissue['testingIssues'] = implode(", ",$testingIssuesDataArr);
		$mdaissue['created_at'] = date('d-m-Y', strtotime($mdaissue['created_at']));
		
		$logSql = "SELECT `id`, `remarks`, `added_by`, `dof_remarks`, `updated_by`, `status`, `created_at` FROM mda_issues_log WHERE mda_issue_id='".$mdaIssueId."' ";
		$query = $this->db->query($logSql);
		$mdaIssuesLogs = $query->getResultArray();
		$logArr = [];
		foreach($mdaIssuesLogs as $mdaIssuesLog){
			$mdaIssuesLog['created_at'] = date('d-m-Y',strtotime($mdaIssuesLog['created_at']));
			$logArr[] = $mdaIssuesLog;
		}
		$mdaissue['issue_log'] = $logArr;
		echo json_encode($mdaissue);
	}
	
	function mdaIssuesRemarks()
	{
		$session = session();
		$user_id = $session->get('user_id');
		
		$MDAIssue = new MDAIssue();
		if($this->request->getMethod() === 'post'){
			$mda_issue_id = $this->request->getVar('mda_issue_id');
			$remarks = $this->request->getVar('remarks');
			$updated_by = $this->request->getVar('updated_by');
			$validation =  \Config\Services::validation();
			$rules = [
				"mda_issue_id" => [
					"label" => "mda_issue_id", 
					"rules" => "required"
				],
				"remarks" => [
					"label" => "remarks", 
					"rules" => "required"
				],
				"updated_by" => [
					"label" => "updated_by", 
					"rules" => "required"
				],
			];
			if($this->validate($rules)){
				$madIssueData = [
					'updated_by'=>$user_id
				];
				if($updated_by=="dof"){
					$madIssueData['dof_remarks']=$remarks;
				}
				if($updated_by=="user"){
					$madIssueData['remarks']=$remarks;
				} 
				$result = $MDAIssue->update($mda_issue_id, $madIssueData);
				if($result){
					$resArr = array("status"=>200,"message"=>"data save successfully.");
				} 
			}else{
				$errorsmsg = $validation->getErrors();
				$data["errors"] = $errorsmsg;
				$resArr = array("status"=>400,"message"=>"Bad Request.","data"=>$data);
			}
			echo json_encode($resArr);
		}else{
			$arr = array("status"=>405, "message"=>"Method Not Allowed");
			echo json_encode($arr);
		}
	}
	
	
	
	function createOfftakeIssue($pid)
	{
		
		if($this->request->getMethod() === 'post'){
			
			$satat_scheme = $this->request->getVar('satat_scheme');
			$ogmc = $this->request->getVar('ogmc');
			$gail = $this->request->getVar('gail');
			$prod_capacity = $this->request->getVar('prod_capacity');
			$com_agre_signed = $this->request->getVar('com_agre_signed');
			$com_agre_signed_cbg_cdg = $this->request->getVar('com_agre_signed_cbg_cdg');
			$avg_actual_prod = $this->request->getVar('avg_actual_prod');
			$actual_offtake = $this->request->getVar('actual_offtake');
			$cbg_supplied_sync = $this->request->getVar('cbg_supplied_sync');
			$other_sale = $this->request->getVar('other_sale');
			$internal_consumption = $this->request->getVar('internal_consumption');
			$flaring_wastage = $this->request->getVar('flaring_wastage');
			$remarks = $this->request->getVar('remarks');
			$session = session();
			$user_id = $session->get('user_id');
			$validation =  \Config\Services::validation();
			
			$rules = [
				"satat_scheme" => [
					"label" => "satat_scheme", 
					"rules" => "required"
				],
				
				"gail" => [
					"label" => "gail", 
					"rules" => "required"
				],
				"prod_capacity" => [
					"label" => "prod_capacity", 
					"rules" => "required"
				],
				
				"avg_actual_prod" => [
					"label" => "avg_actual_prod", 
					"rules" => "required"
				],
				"actual_offtake" => [
					"label" => "actual_offtake", 
					"rules" => "required"
				],
				"cbg_supplied_sync" => [
					"label" => "cbg_supplied_sync", 
					"rules" => "required"
				],
				"other_sale" => [
					"label" => "other_sale", 
					"rules" => "required"
				],
				"internal_consumption" => [
					"label" => "internal_consumption", 
					"rules" => "required"
				],
				"flaring_wastage" => [
					"label" => "flaring_wastage", 
					"rules" => "required"
				],
				"remarks" => [
					"label" => "remarks", 
					"rules" => "required"
				],
				
			];
			
			if($satat_scheme=="Yes"){
				$rules["ogmc"] = [
					"label" => "ogmc", 
					"rules" => "required"
				];
				
				$rules["com_agre_signed"] = [
					"label" => "com_agre_signed|numeric",
					"rules" => "required"
				];
			}
			
			if($gail=="Yes"){
				$rules["com_agre_signed_cbg_cdg"] = [
					"label" => "com_agre_signed_cbg_cdg|numeric",
					"rules" => "required"
				];
			}
			
			if($this->validate($rules)){
				
				$offtakeIssueData = [
					'project_id'=>$pid,
					'satat_scheme'=>$satat_scheme,
					'ogmc'=>$ogmc,
					'gail'=>$gail,
					'prod_capacity'=>$prod_capacity,
					'com_agre_signed'=>$com_agre_signed,
					'com_agre_signed_cbg_cdg'=>$com_agre_signed_cbg_cdg,
					'avg_actual_prod'=>$avg_actual_prod,
					'actual_offtake'=>$actual_offtake,
					'cbg_supplied_sync'=>$cbg_supplied_sync,
					'other_sale'=>$other_sale,
					'internal_consumption'=>$internal_consumption,
					'flaring_wastage'=>$flaring_wastage,
					'remarks'=>$remarks,
					'added_by'=>$user_id,
				];
				
				$OfftakeIssue = new OfftakeIssue();
				$result = $OfftakeIssue->insert($offtakeIssueData);
				if($result){
					return redirect()->to(base_url().'profile');
				}
			}else{
				$errorsmsg = $validation->getErrors();
				$data["errors"] = $errorsmsg;
			}
		}
		$data['title']="";
		return view('backend/add-offtake-issue',$data);
	}
	
	function OfftakeAllIssues()
	{
		$session = session();
		$user_id = $session->get('user_id'); 
		$OfftakeIssue = new OfftakeIssue();
		$stateModel = new State();
		
  
		$ogmc = match ($user_id) { 
		  '2408' => '1', 
		  '2409' => '2', 
		  '2410' => '3', 
		  '2411' => '4', 
		  '2412' => 'GAIL',
		  default => "",
		}; 
		
		
		$OfftakeIssue->select("offtake_issues.*, project_details.project_name, states.state_name ");
		$OfftakeIssue->join('project_details','offtake_issues.project_id=project_details.project_id'); 
		$OfftakeIssue->join('states','states.state_code=project_details.state_id'); 
		$OfftakeIssue->where('offtake_issues.status','1');
		if(!empty($ogmc) && $ogmc=="GAIL"){
			$OfftakeIssue->where('gail','Yes');
		}else{
			if(!empty($ogmc)){
				$OfftakeIssue->where('ogmc',$ogmc);
			}
		}
		
		$OfftakeIssue->where('project_details.plant_status_id','24'); 
		$query = $OfftakeIssue->orderBy('offtake_issues.created_at','Desc');
		$data['offtakeissues'] = $query->findAll();
		// echo $this->db->getLastQuery();
		// die;
		$data['states'] = $stateModel->orderBy('state_name','ASC')->findAll();
		
		return view('backend/offtake-issues',$data);
	}
	
	
	function offtakeAllIssuesDetails($offtakeIssueId)
	{
		$session = session();
		$user_id = $session->get('user_id');
		
		$OfftakeIssue = new OfftakeIssue();
		$stateModel = new State();
		$OfftakeIssue->select("offtake_issues.*, project_details.project_name, states.state_name ");
		$OfftakeIssue->join('project_details','offtake_issues.project_id=project_details.project_id');
		$OfftakeIssue->join('states','states.state_code=project_details.state_id');
		$OfftakeIssue->where('offtake_issues.status','1');
		$OfftakeIssue->where('project_details.plant_status_id','24');
		$query = $OfftakeIssue->where('offtake_issues.id',$offtakeIssueId);
		$oftakeissue = $query->first();
		
		$oftakeissue['ogmc'] = getNameFromId('satat_ogmc', $oftakeissue['ogmc']);
		$oftakeissue['created_at'] = date('d-m-Y', strtotime($oftakeissue['created_at']));
		
		$logSql = "SELECT `id`, `project_id`, `remarks`, `added_by`, `cbg_ogmc_remarks`, `gail_remarks`, `updated_by`, `created_at` FROM `offtake_issues_log` WHERE offtake_issues_id='".$offtakeIssueId."' ";
		$query = $this->db->query($logSql);
		$oftakeIssuesLogs = $query->getResultArray();
		$logArr = [];
		foreach($oftakeIssuesLogs as $oftakeIssuesLog){
			$oftakeIssuesLog['created_at'] = date('d-m-Y',strtotime($oftakeIssuesLog['created_at']));
			$logArr[] = $oftakeIssuesLog;
		}
		$oftakeissue['issue_log'] = $logArr;
		echo json_encode($oftakeissue);
	}
	
	function offtakeIssuesRemarks()
	{
		$session = session();
		$user_id = $session->get('user_id');
		
		$OfftakeIssue = new OfftakeIssue();
		if($this->request->getMethod() === 'post'){
			$offtake_issue_id = $this->request->getVar('offtake_issue_id');
			$remarks = $this->request->getVar('remarks');
			$updated_by = $this->request->getVar('updated_by');
			$validation =  \Config\Services::validation();
			$rules = [
				"offtake_issue_id" => [
					"label" => "offtake_issue_id", 
					"rules" => "required"
				],
				"remarks" => [
					"label" => "remarks", 
					"rules" => "required"
				],
				"updated_by" => [
					"label" => "updated_by", 
					"rules" => "required"
				],
			];
			if($this->validate($rules)){
				$offtkIssueData = [
					'updated_by'=>$user_id
				];
				if($user_id=="2412"){
					$offtkIssueData['gail_remarks']=$remarks;
				}else{
					if($updated_by=="CBG_OGMC"){
						$offtkIssueData['cbg_ogmc_remarks']=$remarks;
					}
					if($updated_by=="user"){
						$offtkIssueData['remarks']=$remarks;
					} 
				}
				
				
				$result = $OfftakeIssue->update($offtake_issue_id, $offtkIssueData);
				if($result){
					$resArr = array("status"=>200,"message"=>"data save successfully.");
				} 
			}else{
				$errorsmsg = $validation->getErrors();
				$data["errors"] = $errorsmsg;
				$resArr = array("status"=>400,"message"=>"Bad Request.","data"=>$data);
			}
			echo json_encode($resArr);
		}else{
			$arr = array("status"=>405, "message"=>"Method Not Allowed");
			echo json_encode($arr);
		}
	}
}
