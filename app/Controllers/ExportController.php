<?php 
namespace App\Controllers;
use App\Models\State;
use App\Models\District;
use App\Models\ProjectModel;
use App\Models\ProjectBankModel;
use App\Models\MonthlyReportingModel;

use CodeIgniter\HTTP\RequestInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DateTime;


class ExportController extends BaseController
{
	private $db;
    public $per_page;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
    }
	
	function abc()
	{
		ini_set('memory_limit', '-1');
		$optionSql = "SELECT id, title FROM option_list";
		$query = $this->db->query($optionSql);
		$options = $query->getResult();
		$allOptions = [];
		$allOptions['']='';
		$allOptions[0]='';
		foreach($options as $option){
			$allOptions[$option->id] = $option->title;
		}
		
		$orgSql = "SELECT organizations.id, `entity_name`, `entity_type`, `entity_subtype`, `ulb_code`, `entity_subtype_other`, `authorised_person`, `mobile_no`, `email`, `address`, `state_id`, `district_id`, `pincode`, `cin_reg_no`, `reg_date`, `pan_no`, `gst_no`, `user_id`, `created_at`, states.state_name, districts.district_name FROM `organizations` INNER JOIN states ON organizations.state_id = states.state_code INNER JOIN districts ON organizations.district_id = districts.district_code ";
		$query = $this->db->query($orgSql);
		$orgs = $query->getResult();
		$fileName = 'project-raw-data.xlsx';  
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Entity Name');
		$sheet->setCellValue('B1', 'Entity Type');
		$sheet->setCellValue('C1', 'Entity Subtype');
		$sheet->setCellValue('D1', 'Entity Subtype Other');
		$sheet->setCellValue('E1', 'ULB Code');
		$sheet->setCellValue('F1', 'Authorised Person');
		$sheet->setCellValue('G1', 'Mobile No.');
		$sheet->setCellValue('H1', 'Email');
		$sheet->setCellValue('I1', 'Address');
		$sheet->setCellValue('J1', 'State Name');
		$sheet->setCellValue('K1', 'District Name');
		$sheet->setCellValue('L1', 'pincode');
		$sheet->setCellValue('M1', 'CIN Reg No.');
		$sheet->setCellValue('N1', 'Reg Date');
		$sheet->setCellValue('O1', 'PAN No.');
		$sheet->setCellValue('P1', 'GST No.');
		$sheet->setCellValue('Q1', 'Created At');
		$rows = 2;

		foreach ($orgs as $org){
			$sheet->setCellValue('A' . $rows, $org->entity_name);
			$sheet->setCellValue('B' . $rows, $allOptions[$org->entity_type]);
			$sheet->setCellValue('C' . $rows, $allOptions[$org->entity_subtype]);
			$sheet->setCellValue('D' . $rows, $org->entity_subtype_other);
			$sheet->setCellValue('E' . $rows, $org->ulb_code);
			$sheet->setCellValue('F' . $rows, $org->authorised_person);
			$sheet->setCellValue('G' . $rows, $org->mobile_no);
			$sheet->setCellValue('H' . $rows, $org->email);
			$sheet->setCellValue('I' . $rows, $org->address);
			$sheet->setCellValue('J' . $rows, $org->state_name);
			$sheet->setCellValue('K' . $rows, $org->district_name);
			$sheet->setCellValue('L' . $rows, $org->pincode);
			$sheet->setCellValue('M' . $rows, $org->cin_reg_no);
			$sheet->setCellValue('N' . $rows, $org->reg_date);
			$sheet->setCellValue('O' . $rows, $org->pan_no);
			$sheet->setCellValue('P' . $rows, $org->gst_no);
			$sheet->setCellValue('Q' . $rows, $org->created_at);
			$rows++;
		} 
		
		$spreadsheet->getActiveSheet(0)->setTitle('Organizations');
		
		///PROJECT DETAILS
		$projectSql = "SELECT states.state_name, districts.district_name, `project_id`, `project_registration_no`, `organization_id`, organizations.entity_name, `project_name`, `entity_type_id`, `plant_type_id`, `plant_status_id`, `plant_status_date`, `gas_production_capacity`, `gpc_unit`, `solid_feedstock_capacity`, `sfc_unit`, `liquid_feedstock_capacity`, `lfc_unit`, `bio_slurry_output`, `bso_unit`, `FOM_output`, `FOM_unit`, `LFOM_output`, `LFOM_unit`, `total_solid_feedstock`, `tsfs_unit`, `total_liquid_feedstock`, `tlfs_unit`, `loi_detail_id`, `distance_grid`, `loi_obtain_details`, `bioslurry_tech`, `bioslurry_tech_other`, `plant_location_id`, `plant_area`, `land_ownership_id`, `other_ownership`, `latitude`, `longitude`, `total_capex`, `city`, `ward_no`, project_details.pincode, `date_of_commissioning`, `proposed_date`, `construction_date`, `street_area_address`, `plot_number`,  `updated_at`, project_details.created_at FROM project_details 
			INNER JOIN organizations ON project_details.organization_id = organizations.id 
			INNER JOIN states ON project_details.state_id=states.state_code
			INNER JOIN districts ON project_details.district_id=districts.district_code
			WHERE 1=1 GROUP BY project_details.project_id ORDER BY project_details.project_id;";
		$query = $this->db->query($projectSql);
		$projects = $query->getResult();
		
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(1);
		$sheet = $spreadsheet->getActiveSheet(1);
		$sheet->setCellValue('A1', 'State Name');
		$sheet->setCellValue('B1', 'District Name');
		$sheet->setCellValue('C1', 'Entity Name');
		$sheet->setCellValue('D1', 'Certificate No.');
		$sheet->setCellValue('E1', 'Project Name');
		$sheet->setCellValue('F1', 'Entity Type');       
		$sheet->setCellValue('G1', 'Plant Type');
		$sheet->setCellValue('H1', 'Plant Status');
		$sheet->setCellValue('I1', 'Plant Status Date');
		$sheet->setCellValue('J1', 'Gas Production Capacity');
		$sheet->setCellValue('K1', 'Solid Feedstock Capacity');
		$sheet->setCellValue('L1', 'Liquid Feedstock Capacity');
		$sheet->setCellValue('M1', 'Bio Slurry Output');
		$sheet->setCellValue('N1', 'FOM Output');
		$sheet->setCellValue('O1', 'LFOM Output');
		$sheet->setCellValue('P1', 'LoI Details');
		$sheet->setCellValue('Q1', 'Distance Grid');
		$sheet->setCellValue('R1', 'LoI Obtain Details');
		$sheet->setCellValue('S1', 'Bio Slurry Technology Management');
		$sheet->setCellValue('T1', 'Other Bio Slurry Technology');
		$sheet->setCellValue('U1', 'Plant Location');
		$sheet->setCellValue('V1', 'Plant Area');
		$sheet->setCellValue('W1', 'Land Ownership');
		$sheet->setCellValue('X1', 'Land Other Ownership');
		$sheet->setCellValue('Y1', 'Latitude');
		$sheet->setCellValue('Z1', 'Longitude');
		$sheet->setCellValue('AA1', 'Total Capex');
		$sheet->setCellValue('AB1', 'City');
		$sheet->setCellValue('AC1', 'Ward No.');
		$sheet->setCellValue('AD1', 'Pincode');
		$sheet->setCellValue('AE1', 'Date Of Commissioning');
		$sheet->setCellValue('AF1', 'Proposed Date');
		$sheet->setCellValue('AG1', 'Construction Date');
		$sheet->setCellValue('AH1', 'Street Area Address');
		$sheet->setCellValue('AI1', 'Plot No.');
		$sheet->setCellValue('AJ1', 'Created At');
		$rows = 2;

		foreach ($projects as $project){ 
			$bioslurry_tech = $this->findData($allOptions,$project->bioslurry_tech);
			$sheet->setCellValue('A' . $rows, $project->state_name);
			$sheet->setCellValue('B' . $rows, $project->district_name);
			$sheet->setCellValue('C' . $rows, $project->entity_name);
			$sheet->setCellValue('D' . $rows, $project->project_registration_no);
			$sheet->setCellValue('E' . $rows, $project->project_name);
			$sheet->setCellValue('F' . $rows, $allOptions[$project->entity_type_id]);
			$sheet->setCellValue('G' . $rows, $allOptions[$project->plant_type_id]);
			$sheet->setCellValue('H' . $rows, $allOptions[$project->plant_status_id]);
			$sheet->setCellValue('I' . $rows, $project->plant_status_date);
			$sheet->setCellValue('J' . $rows, $project->gas_production_capacity.' '.$project->gpc_unit);
			$sheet->setCellValue('K' . $rows, $project->solid_feedstock_capacity.' '.$project->sfc_unit);
			$sheet->setCellValue('L' . $rows, $project->liquid_feedstock_capacity.' '.$project->lfc_unit);
			$sheet->setCellValue('M' . $rows, $project->bio_slurry_output.' '.$project->bso_unit);
			$sheet->setCellValue('N' . $rows, $project->FOM_output.' '.$project->FOM_unit);
			$sheet->setCellValue('O' . $rows, $project->LFOM_output.' '.$project->LFOM_unit);
			$sheet->setCellValue('P' . $rows, $allOptions[$project->loi_detail_id]);
			$sheet->setCellValue('Q' . $rows, $project->distance_grid);
			$sheet->setCellValue('R' . $rows, $project->loi_obtain_details);
			$sheet->setCellValue('S' . $rows, $bioslurry_tech);
			$sheet->setCellValue('T' . $rows, $project->bioslurry_tech_other);
			$sheet->setCellValue('U' . $rows, $allOptions[$project->plant_location_id]);
			$sheet->setCellValue('V' . $rows, $project->plant_area);
			$sheet->setCellValue('W' . $rows, $allOptions[$project->land_ownership_id]);
			$sheet->setCellValue('X' . $rows, $project->other_ownership);
			$sheet->setCellValue('Y' . $rows, $project->latitude);
			$sheet->setCellValue('Z' . $rows, $project->longitude);
			$sheet->setCellValue('AA' . $rows, $project->total_capex);
			$sheet->setCellValue('AB' . $rows, $project->city);
			$sheet->setCellValue('AC' . $rows, $project->ward_no);
			$sheet->setCellValue('AD' . $rows, $project->pincode);
			$sheet->setCellValue('AE' . $rows, $project->date_of_commissioning);
			$sheet->setCellValue('AF' . $rows, $project->proposed_date);
			$sheet->setCellValue('AG' . $rows, $project->construction_date);
			$sheet->setCellValue('AH' . $rows, $project->street_area_address);
			$sheet->setCellValue('AI' . $rows, $project->plot_number);
			$sheet->setCellValue('AJ' . $rows, $project->created_at);
			$rows++;
		} 
		$spreadsheet->getActiveSheet(1)->setTitle('Project Details');
		
		
		/// PROJECT BENEFITS
		$benefitsSql = "SELECT id, option_list_id, status, other, project_details.project_name FROM project_benefits INNER JOIN project_details ON project_benefits.project_id = project_details.project_id";
		$query = $this->db->query($benefitsSql);
		$projectsBnfts = $query->getResult();
		
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(2);
		$sheet = $spreadsheet->getActiveSheet(2);
		$sheet->setCellValue('A1', 'Project Name');
		$sheet->setCellValue('B1', 'Benefits');
		$sheet->setCellValue('C1', 'Status');
		$sheet->setCellValue('D1', 'Other Benefits');;       
		$rows = 2;

		foreach ($projectsBnfts as $projectsBnft){
			$sheet->setCellValue('A' . $rows, $projectsBnft->project_name);
			$sheet->setCellValue('B' . $rows, $allOptions[$projectsBnft->option_list_id]);
			$sheet->setCellValue('C' . $rows, $projectsBnft->status);
			$sheet->setCellValue('D' . $rows, $projectsBnft->other);
			$rows++;
		} 
		
		$spreadsheet->getActiveSheet(2)->setTitle('Benefits');
		
		
		
		/// PROJECT FEEDSTOCKS
		$feedstockSql = "SELECT id, option_list_id, quantity, qty_unit, feedstock_source, source_type, others_category, others_fedstock_source, project_details.project_name FROM source_type_feedstocks INNER JOIN project_details ON project_details.project_id = source_type_feedstocks.project_id ORDER BY project_details.project_id";
		$query = $this->db->query($feedstockSql);
		$projectsFeedstocks = $query->getResult();
		
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(3);
		$sheet = $spreadsheet->getActiveSheet(3);
		$sheet->setCellValue('A1', 'Project Name');
		$sheet->setCellValue('B1', 'Feedstock');
		$sheet->setCellValue('C1', 'Other Feedstock');
		$sheet->setCellValue('D1', 'Source Type');
		$sheet->setCellValue('E1', 'Quantity');
		$sheet->setCellValue('F1', 'Feedstock Source');
		$sheet->setCellValue('G1', 'Other Feedstock Source');
		$rows = 2;

		foreach ($projectsFeedstocks as $projectsFeedstock){
			$feedstock_sources = $this->findData($allOptions,$projectsFeedstock->feedstock_source);
			$sheet->setCellValue('A' . $rows, $projectsFeedstock->project_name);
			$sheet->setCellValue('B' . $rows, $allOptions[$projectsFeedstock->option_list_id]);
			$sheet->setCellValue('C' . $rows, $projectsFeedstock->others_category);
			$sheet->setCellValue('D' . $rows, $projectsFeedstock->source_type);
			$sheet->setCellValue('E' . $rows, $projectsFeedstock->quantity.' '.$projectsFeedstock->qty_unit);
			$sheet->setCellValue('F' . $rows, $feedstock_sources);
			$sheet->setCellValue('G' . $rows, $projectsFeedstock->others_fedstock_source);
			$rows++;
		} 
		
		$spreadsheet->getActiveSheet(3)->setTitle('Feedstocks');
		
		
		/// PROJECT FORWARD LINKAGES
		$forwarLinkageSql = "SELECT id, option_list_id, quantity, linkage_type, other_specify, project_details.project_name FROM forward_linkages INNER JOIN project_details ON forward_linkages.project_id = project_details.project_id ORDER BY project_details.project_id ";
		$query = $this->db->query($forwarLinkageSql);
		$projectsForwardLinkages = $query->getResult();
		
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(4);
		$sheet = $spreadsheet->getActiveSheet(4);
		$sheet->setCellValue('A1', 'Project Name');
		$sheet->setCellValue('B1', 'Forward Linkages');
		$sheet->setCellValue('C1', 'Other Linkages');
		$sheet->setCellValue('D1', 'Linkages Type');
		$sheet->setCellValue('E1', 'Quantity');
		$rows = 2;

		foreach ($projectsForwardLinkages as $projectsForwardLinkage){
			$sheet->setCellValue('A' . $rows, $projectsForwardLinkage->project_name);
			$sheet->setCellValue('B' . $rows, $allOptions[$projectsForwardLinkage->option_list_id]);
			$sheet->setCellValue('C' . $rows, $projectsForwardLinkage->other_specify);
			$sheet->setCellValue('D' . $rows, $projectsForwardLinkage->linkage_type);
			$sheet->setCellValue('E' . $rows, $projectsForwardLinkage->quantity);
			$rows++;
		}
		
		$spreadsheet->getActiveSheet(4)->setTitle('Forward-Linkages');
		
		/// PROJECT FUNDING SOURCE
		$fundingSourceSql = "SELECT id, option_list_id, quantity,other_specify, project_details.project_name FROM project_funding_source INNER JOIN project_details ON project_funding_source.project_id = project_details.project_id";
		
		$query = $this->db->query($fundingSourceSql);
		$projectsFundingSources = $query->getResult();
		
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(5);
		$sheet = $spreadsheet->getActiveSheet(5);
		$sheet->setCellValue('A1', 'Project Name');
		$sheet->setCellValue('B1', 'Funding Source');
		$sheet->setCellValue('C1', 'Other funding Source');
		$sheet->setCellValue('D1', 'Quantity');
		$rows = 2;

		foreach ($projectsFundingSources as $fundingSource){
			$sheet->setCellValue('A' . $rows, $fundingSource->project_name);
			$sheet->setCellValue('B' . $rows, $allOptions[$fundingSource->option_list_id]);
			$sheet->setCellValue('C' . $rows, $fundingSource->other_specify);
			$sheet->setCellValue('D' . $rows, $fundingSource->quantity);
			$rows++;
		}
		
		$spreadsheet->getActiveSheet(5)->setTitle('Funding-Source');
		
		//PROJECT RURAL ADDRESS
		$ruralAdrssSql = "SELECT a.id, a.pincode, states.state_name, districts.district_name, blocks.block_name, gram_panchayat.gp_name, villages.village_name, project_details.project_name FROM project_rural_address a 
			INNER JOIN project_details ON a.project_id = project_details.project_id
			INNER JOIN states ON a.state_id = states.state_code
			INNER JOIN districts ON a.district_id = districts.district_code
			INNER JOIN blocks ON a.block_id =blocks.block_code
			INNER JOIN gram_panchayat ON a.gp_id = gram_panchayat.gp_code
			INNER JOIN villages ON a.village_id = villages.village_code
			GROUP BY a.id";
		
		$query = $this->db->query($ruralAdrssSql);
		$projectsRuralAddress = $query->getResult();
		
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(6);
		$sheet = $spreadsheet->getActiveSheet(6);
		$sheet->setCellValue('A1', 'Project Name');
		$sheet->setCellValue('B1', 'State Name');
		$sheet->setCellValue('C1', 'District Name');
		$sheet->setCellValue('D1', 'Block Name');
		$sheet->setCellValue('E1', 'GP Name');
		$sheet->setCellValue('F1', 'Village Name');
		$sheet->setCellValue('G1', 'Pincode');
		$rows = 2;

		foreach ($projectsRuralAddress as $ruralAddress){
			$sheet->setCellValue('A' . $rows, $ruralAddress->project_name);
			$sheet->setCellValue('B' . $rows, $ruralAddress->state_name);
			$sheet->setCellValue('C' . $rows, $ruralAddress->district_name);
			$sheet->setCellValue('D' . $rows, $ruralAddress->block_name);
			$sheet->setCellValue('E' . $rows, $ruralAddress->gp_name);
			$sheet->setCellValue('F' . $rows, $ruralAddress->village_name);
			$sheet->setCellValue('G' . $rows, $ruralAddress->pincode);
			$rows++;
		}
		
		$spreadsheet->getActiveSheet(6)->setTitle('Rural-Project-Address');
		
		
		/// PROJECT STATUS CHANGE LOG
		
		$plantStatusLogSql = "SELECT p.project_id, p.project_name, p.plant_status_id as pstatus_id, p.plant_status_date as pstatus_date, slog.plant_status_id, slog.plant_status_date, slog.created_at FROM statusChangeLogDates slog INNER JOIN project_details p ON slog.project_id=p.project_id;";
		$query = $this->db->query($plantStatusLogSql);
		$psLogs = $query->getResult();
		
		$spreadsheet->createSheet();
		$spreadsheet->setActiveSheetIndex(7);
		$sheet = $spreadsheet->getActiveSheet(7);
		$sheet->setCellValue('A1', 'Project Name');
		$sheet->setCellValue('B1', 'Status');
		$sheet->setCellValue('C1', 'Status Date');
		$sheet->setCellValue('D1', 'Created At');;       
		$rows = 2;

		foreach ($psLogs as $psLog){
			$plntStatus = [''=>'','22'=>'Yet to start construction','23'=>'Under Construction','24'=>'Functional','290'=>'Completed','292'=>'Temporary Nonfunctional','293'=>'Defunct'];
			$plantStatus = $plntStatus[$psLog->plant_status_id];
			$sheet->setCellValue('A' . $rows, $psLog->project_name.' ('.$psLog->project_id.')');
			$sheet->setCellValue('B' . $rows, $plantStatus);
			$sheet->setCellValue('C' . $rows, $psLog->plant_status_date);
			$sheet->setCellValue('D' . $rows, $psLog->created_at);
			$rows++;
		} 
		
		$spreadsheet->getActiveSheet(7)->setTitle('Project Status Log');
		
		
		
		
		
		
		
		$spreadsheet->setActiveSheetIndex(0);
		$writer = new Xlsx($spreadsheet);
		$writer->save("public/uploads/".$fileName);
		header("Content-Type: application/vnd.ms-excel");
		//redirect(base_url()."/public/uploads/".$fileName); 
		$path = base_url()."/public/uploads/".$fileName;
		$resArr = array('status'=>200,'path'=>$path);
		echo json_encode($resArr);
	}
	
   
	function findData($arr,$numbers)
	{
		$numArr = explode(",",$numbers);
		$str = '';
		foreach($numArr as $num){
			$str.=$arr[$num];
		}
		return $str;
	}
	
	
	
	function appliedLoanExport()
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
		
		$projectBankModel->select('project_bank_details.*, project_details.project_name, states.state_name, districts.district_name  ');
		$projectBankModel->join('project_details','project_bank_details.project_id = project_details.project_id');
		$projectBankModel->join('states','project_details.state_id = states.state_code');
		$projectBankModel->join('districts','project_details.district_id = districts.district_code');
		$projectBankModel->where('bankloan_applied','Yes');
		if(!empty($bank_name)){
			$projectBankModel->where('bank_name',$bank_name);
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
		
		$appliedLoans = $projectBankModel->where('project_bank_details.status','1')->findAll();
		//echo "<pre>";
		$finalData=[];
		foreach($appliedLoans as $appliedLoan){
			$loan_apply_date="";
			if(!empty($appliedLoan['loan_apply_date'])){ $loan_apply_date = date('d-m-Y', strtotime($appliedLoan['loan_apply_date'])); }
			$appliedLoan['loan_apply_date'] = $loan_apply_date;
			$appliedLoan['created_at'] = date('d-m-Y', strtotime($appliedLoan['created_at']));
			$appliedLoan['loan_status'] = getNameFromId('loan_application_status', $appliedLoan['loan_status']);
			$finalData[] = $appliedLoan;
		}
		
		$header = ['State Name','District Name','Project Name','Bank Name','Branch Name','IFSC Code','Loan Status','Apply Date','Submission Date'];
		$jsonKeys = ['state_name','district_name','project_name','bank_name','bank_branch','ifsc_code','loan_status','loan_apply_date','created_at'];
		
		/*  EXAMPLE
		$header = array('Name','Country','Mobile Number');
		$jsonKeys = array('name','country','mobile');
		$abcdata = array(
			'data'=>array(
				array('name'=>'Satyendra','country'=>'India','mobile'=>'987654432','completion_status'=>'2/5','read_count'=>'2'),
				array('name'=>'Satyendra-1','country'=>'India','mobile'=>'987654432','completion_status'=>'2/5','read_count'=>'2'),
				array('name'=>'Satyendra-2','country'=>'India','mobile'=>'987654432','completion_status'=>'2/5','read_count'=>'2')
			)
		);
		*/
		$expData['data'] = $finalData;
		$header = json_encode($header);
		$jsonKeys = json_encode($jsonKeys);
		$jsondata = json_encode($expData);
		
		$this->jsonToExcel($header,$jsonKeys,$jsondata);
		
	}
	
	
	
	function monthlyUpdtateReportExport()
	{
		$session = session();
		$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		$stateId = $session->get('state_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		
		$stateModel = new State();
		$districtModel = new District();
		$projectModel = new ProjectModel();
		$monthlyReportingModel = new MonthlyReportingModel();
		
		$month_ini = new DateTime("first day of last month"); 
		$reportingMonth = $month_ini->format('Y-m');
		
		$state = $this->request->getVar('state');
		$district = $this->request->getVar('district');
		$plant_status = $this->request->getVar('plant_status');
		$reporting_month = $this->request->getVar('reporting_month');
		if(!empty($reporting_month)){
			$reportingMonth = $reporting_month;
		}
		$alldistrict=[];
		
		$monthlyReportingModel->select("monthly_monitoring_id, project_monthly_monitoring.updated_at, pre_status, current_status, nofunctional_days, feedstock, biogas_generation, bioslurry_generation, fuctional_doc, verify_doc, reporting_date, project_details.project_name, project_details.gas_production_capacity, states.state_name, districts.district_name ");
		$monthlyReportingModel->join('project_details','project_details.project_id=project_monthly_monitoring.project_id');
		$monthlyReportingModel->join('states', 'project_details.state_id=states.state_code');
		$monthlyReportingModel->join('districts', 'project_details.district_id=districts.district_code');		
		$monthlyReportingModel->where('reporting_month',$reportingMonth);
		if(!empty($plant_status)){
			$monthlyReportingModel->where('current_status',$plant_status);
		}
		if(!empty($district)){
			$monthlyReportingModel->where('project_details.district_id',$district);
		}
		if(!empty($state)){
			$monthlyReportingModel->where('project_details.state_id',$state);
			//$alldistrict = $districtModel->where('state_code',$state)->findAll();
		}
		$monthlyReportingModel->where('project_monthly_monitoring.status','1');
		$reports = $monthlyReportingModel->findAll();
		$reportingData=[];
		$cstatus = ['24'=>'Functional','292'=>'Temporary Nonfunctional','293'=>'Defunct',''=>'','0'=>'',];
		foreach($reports as $report){
			$avgFeedstock=$avgBiogas_generation=$avgBioslurry_generation=0;
			if($report['nofunctional_days']>0){
				if($report['feedstock']>0){
					$avgFeedstock = $report['feedstock']/$report['nofunctional_days'];
				}
				if($report['biogas_generation']>0){
					$avgBiogas_generation = $report['biogas_generation']/$report['nofunctional_days'];
				}
				if($report['bioslurry_generation']>0){
					$avgBioslurry_generation = $report['bioslurry_generation']/$report['nofunctional_days'];
				}
			}
			$report['feedstock'] = round($avgFeedstock,2);
			$report['biogas_generation'] = round($avgBiogas_generation,2);
			$report['bioslurry_generation'] = round($avgBioslurry_generation,2);
			$report['gas_production_capacity'] = $report['gas_production_capacity'].' m³/day';
			$report['pre_status'] = $cstatus[$report['pre_status']];
			$report['current_status'] = $cstatus[$report['current_status']];
			$report['reporting_date'] = date('d-m-Y',strtotime($report['reporting_date']));
			$reportingData[]=$report;
		}
		
		//echo json_encode($reportingData);
		$header = ['State Name','District Name','Project Name','Gas Production Capacity','Previous Status','Current Status','Reporting Date','No. of working days','Avg. Feedstock','Avg. Biogas','Avg. Slurry'];
		$jsonKeys = ['state_name','district_name','project_name','gas_production_capacity','pre_status','current_status','reporting_date','nofunctional_days','feedstock','biogas_generation','bioslurry_generation'];
		
		$expData['data'] = $reportingData;
		$header = json_encode($header);
		$jsonKeys = json_encode($jsonKeys);
		$jsondata = json_encode($expData);
		
		$this->jsonToExcel($header,$jsonKeys,$jsondata);
		
	}
	
	
	
	
	
	
	
	
	function jsonToExcel($header,$jsonKeys,$jsondata)
	{
		ini_set('memory_limit', '-1');
		$objPHPExcel = new Spreadsheet();
		$data = json_decode($jsondata);
		$key = "data"; 
		$header = json_decode($header);
		$cols = json_decode($jsonKeys);
		
		$objPHPExcel->setActiveSheetIndex(0);
		$activeSheet = $objPHPExcel->getActiveSheet();
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);
		
		function getColLetter ($i) {
			$COLS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$ct = ($i > 25) ? floor($i / 26) : 0;
			$ret = $COLS[$i % 26];
				while ($ct--)
					$ret .= $ret;
			return $ret;
		}
		
		// prepare header row
		foreach ($header as $i=>$col) {
			$activeSheet->setCellValue(getColLetter($i) . 1, $col);
		}
		
		// prepare the rest
		foreach ($data->$key as $i=>$row) {
			foreach ($cols as $j=>$col) {
				$activeSheet->setCellValue(getColLetter($j) . ($i + 2), $row->$col);
			}
		}
		$objPHPExcel->getActiveSheet()->setTitle('Sheet-1');
		
		$writer = new Xlsx($objPHPExcel);
		// $writer->save('public/uploads/applied-loan.xlsx');
		// $filename = base_url().'public/uploads/applied-loan.xlsx';
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=exported-data.xlsx");
		$writer->save('php://output');
	}
	
}
