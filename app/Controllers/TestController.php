<?php 
namespace App\Controllers;
use App\Models\State;
use App\Models\District;
use App\Models\ProjectModel;

class TestController extends BaseController
{
	private $db;
    public $per_page;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session(); 
        $this->per_page = 10;
    }
	
    public function index() 
	{
		
		$message = "This is the testing mail";
        $email = \Config\Services::email();
        $email->setFrom('admin@gobardhan.co.in', 'your Title Here');
        //$email->setFrom('ss.snm1503@gmail.com', 'your Title Here');
        $email->setTo('satyendrasinghbca777@gmail.com');
        //$email->setTo('rajeev.j@nic.in');
        $email->setSubject('Test Mail');
        $email->setMessage($message);//your message here
		//$email->setCC('satyendrasinghbca777@gmail.com');//CC
		//$email->setCC('karanjit.ngangbam@gov.in');//CC
		//$email->send();
		if($email->send()){
			echo "send successfully";
		}
        //$email->printDebugger(['headers']);
        $email->printDebugger();
		
        //return view('ss_certificate');
    }
	
	function sendmailMultiple()
	{
		$contactPersonsArr = array(
			array(
				'emailid' => 'satyendrasinghbca777@gmail.com',
				'person_name' => 'Satyendra Singh'
			),
			array(
				'emailid' => 'kumar.satyendrasingh9@gmail.com',
				'person_name' => 'Satyendra Kumar Singh'
			),
		);
		
		foreach($contactPersonsArr as $contactPersons)
		{
			$emailid = $contactPersons['emailid'];
			$person_name = $contactPersons['person_name'];
			
			$message = "Dear $person_name, <br><br> Please find the below the login details for GOBARdhan Portal. Please log in and update your organization details and project details. <br><br> URL: <a href='https://gobardhan.co.in/'> https://gobardhan.co.in/ </a> <br> Username: test <br> Password: test@123 <br><br> Regards <br> Admin, GOBARdhan <br> Department of Drinking Water and Sanitation <br> Ministry of Jal Shakti";
			$email = \Config\Services::email();
			$email->setFrom('admin@gobardhan.co.in', 'Update Project Details');
			$email->setTo($emailid);
			//$email->setTo('satyendrasinghbca777@gmail.com');
			$email->setSubject('Update Project Details');
			$email->setMessage($message);
			$email->send();
		}
		
		echo "mail sent to all";
	}
	
	public function sendMailToSS($message="SS")
	{
		//$message = "This is the testing mail";
        $email = \Config\Services::email();
        $email->setFrom('admin@gobardhan.co.in', 'your Title Here');
        //$email->setFrom('ss.snm1503@gmail.com', 'your Title Here');
        $email->setTo('satyendrasinghbca777@gmail.com');
        $email->setSubject('GOBARdhan Portal Error');
        $email->setMessage($message);//your message here
		//$email->setCC('satyendrasinghbca777@gmail.com');//CC
		//$email->setCC('karanjit.ngangbam@gov.in');//CC
		$email->send();
	}
	
	function htmlToPDF(){
        $dompdf = new \Dompdf\Dompdf(); 
		//$html="<h1 class='btn btn-success'>Raju Kumar</h1>";
		
        //$dompdf->loadHtml($html);
		$dompdf->loadHtml(view('final_certificate'));
        $dompdf->setPaper('A4', 'portrait');
        
		//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/certificates.css');
		//$dompdf->set_base_path('https://gobardhan.co.in/assets/cert-logo/style.css');
		$dompdf->render();
        $dompdf->stream();
    }
	
	//72.125.168.184.host.secureserver.net
	
	public function sendMailByServer()
	{
		// $message = "This is the testing mail";
        // $email = \Config\Services::email();
        // $email->setFrom('ss.snm1503@gmail.com', 'your Title Here');
        // $email->setTo('satyendrasinghbca777@gmail.com');
        // $email->setSubject('Your Subject here | sss.com');
        // $email->setMessage($message);//your message here
		// $email->send();
        // $email->printDebugger(['headers']);
	}
	
	public function checkCaptcha()
	{
		echo LoginCaptchaImage();
	}
	
	function exportdata()
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
		
		
		if($roleId==1){
			$stateId = $this->request->getVar('state');
		}
		$district = $this->request->getVar('district');
		$plant_type = $this->request->getVar('plant_type');
		$plant_status = $this->request->getVar('plant_status');
		$completion = $this->request->getVar('completion');
		$project_name = $this->request->getVar('project_name');
		
		//$projects=$projectModel->where('state_id',$stateId)->findAll();
		$projectModel->select("organizations.entity_name, project_name, form_completion, entity_type_id, plant_type_id, plant_status_id, gas_production_capacity, solid_feedstock_capacity, liquid_feedstock_capacity, bio_slurry_output, FOM_output, LFOM_output ");
		$projectModel->join('organizations', 'project_details.organization_id=organizations.id');
		if(!empty($stateId)){
			$projectModel->where('project_details.state_id', $stateId);
		}
		if(!empty($district)){
			$projectModel->where('project_details.district_id', $district);
		}
		if(!empty($plant_type)){
			$projectModel->where('project_details.entity_type_id', $plant_type);
		}
		if(!empty($plant_status)){
			$projectModel->where('project_details.plant_status_id', $plant_status);
		}
		if(!empty($completion)){
			$projectModel->where('project_details.form_completion', $completion);
		}
		if(!empty($project_name)){
			$projectModel->like('project_details.project_name', $project_name,'both');
		}
		
		$projects = $projectModel->findAll();
		// echo "<pre>";
		// print_r($projects);
		// die;
		
		
		header('Content-Type: text/csv; charset=utf-8');  
		header('Content-Disposition: attachment; filename=data.csv');  
		$output = fopen("php://output", "w");  
		fputcsv($output, array('entity_name', 'project_name', 'form_completion', 'entity_type_id', 'plant_type_id', 'plant_status_id', 'gas_production_capacity', 'solid_feedstock_capacity', 'liquid_feedstock_capacity', 'bio_slurry_output', 'FOM_output', 'LFOM_output'));  
		//$query = "SELECT * from employeeinfo ORDER BY emp_id DESC";  
		//$result = mysqli_query($con, $query);  
		foreach($projects as $project)  
		{  
			fputcsv($output, $project);  
		}  
		fclose($output);
		die;
	}
	
	
	
	function downloadData()
	{
		
		$tabledata = $this->request->getVar('data');
		//$table = '<table><tr><th>Name</th></tr> <tr><td>Satyendra</td></tr></table>';
		
		$file = "excel.xls";
		header("Content-type: application/xls");
		//header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$file");
		echo $tabledata; 
		exit;
	}
	
	function ddwsBiogasReport()
	{
		$sql= "SELECT project_details.*, organizations.entity_name, organizations.entity_type, states.state_name, districts.district_name, blocks.block_name, gram_panchayat.gp_name, villages.village_name  FROM project_details INNER JOIN organizations ON project_details.organization_id= organizations.id 
		INNER JOIN states ON project_details.state_id = states.state_code INNER JOIN districts ON project_details.district_id = districts.district_code 
		LEFT JOIN blocks ON project_details.block_id = blocks.block_code
		LEFT JOIN gram_panchayat ON project_details.gp_id = gram_panchayat.gp_code
		LEFT JOIN villages ON project_details.village_id = villages.village_code
		WHERE organizations.entity_type='1' AND entity_type_id='17' and project_id IN (SELECT DISTINCT(project_id) FROM project_benefits WHERE project_benefits.option_list_id='255' )  GROUP BY project_details.project_id;";
		$query = $this->db->query($sql);
		$res = $query->getResultArray();
		$data['ddwsbiogasreports'] = $res;
		return view('backend/test-report',$data);
		
	}
	
	
}
