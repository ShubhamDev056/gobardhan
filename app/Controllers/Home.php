<?php

namespace App\Controllers;
use App\Models\PlantstatewiseModel;
use App\Models\ProjectModel;
use App\Models\SatatOfficer;
use App\Models\StateOfficer;

class Home extends BaseController
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

        $model = new PlantstatewiseModel();
        $projectModel = new ProjectModel();
		$date = "2023-05-03";
		$olddate = "2023-03-31";
        $data['plantData'] = $model->where('status','1')->where('date(created_on)',$date)->findAll();
        
		
		$query = $this->db->query("SELECT COUNT(project_id) AS totyettostart FROM project_details WHERE project_details.plant_status_id='22'  AND entity_type_id='17' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['yettostart'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(project_id) AS totunderconstruction FROM project_details WHERE project_details.plant_status_id='23'  AND entity_type_id='17' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['underconstruction'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(project_id) AS totfunctional FROM project_details WHERE project_details.plant_status_id='24'  AND entity_type_id='17' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['functional'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(project_id) AS totcompleted FROM project_details WHERE project_details.plant_status_id='290'  AND entity_type_id='17' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['completed'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(DISTINCT(district_id)) AS totdistrictCovered FROM project_details WHERE entity_type_id='17' and plant_status_id!='22'  and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['districtCovered'] = $query->getRow();
		
		$query = $this->db->query("SELECT COUNT(project_id) AS totyettostart FROM project_details WHERE project_details.plant_status_id='22'  AND entity_type_id='18' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['cbgyettostart'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(project_id) AS totunderconstruction FROM project_details WHERE project_details.plant_status_id='23'  AND entity_type_id='18' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['cbgunderconstruction'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(project_id) AS totfunctional FROM project_details WHERE project_details.plant_status_id='24'  AND entity_type_id='18' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['cbgfunctional'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(project_id) AS totcompleted FROM project_details WHERE project_details.plant_status_id='290'  AND entity_type_id='18' and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['cbgcompleted'] = $query->getRow();
		$query = $this->db->query("SELECT COUNT(DISTINCT(district_id)) AS totdistrictCovered FROM project_details WHERE entity_type_id='18' and plant_status_id!='22'  and state_id!='' and district_id!='' AND deleted_at IS null ");
		$data['cbgdistrictCovered'] = $query->getRow();
		
		// 
		
		//$query = $this->db->query("SELECT states.state_code, states.state_name, noofdistricts, (SELECT COUNT(DISTINCT(district_id)) FROM project_details WHERE project_details.state_id=states.state_code and project_details.entity_type_id='17' AND project_details.deleted_at IS null  ) AS totdCovered FROM states ");
		$query = $this->db->query("SELECT states.state_code, states.state_name, noofdistricts, (SELECT COUNT(DISTINCT(district_id)) FROM project_details WHERE project_details.state_id=states.state_code and project_details.entity_type_id='17' AND project_details.plant_status_id!='22' AND project_details.deleted_at IS null  ) AS totdCovered, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=states.state_code AND project_details.entity_type_id='17' AND project_details.plant_status_id='22'  AND project_details.deleted_at IS null ) as totYetToStart, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=states.state_code AND project_details.entity_type_id='17' AND project_details.plant_status_id='23'  AND project_details.deleted_at IS null ) as totUnderConstruction, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=states.state_code AND project_details.entity_type_id='17' AND project_details.plant_status_id='24'  AND project_details.deleted_at IS null ) as totFunctional FROM states ");
		$data['stateWiseBiogass'] = $query->getResult(); 
		
		$query = $this->db->query("SELECT states.state_code, states.state_name, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=states.state_code and project_details.entity_type_id='18' AND project_details.plant_status_id='24' AND project_details.deleted_at IS null ) AS totProjects,  (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=states.state_code AND project_details.entity_type_id='18' AND project_details.plant_status_id='22'  AND project_details.deleted_at IS null ) as totYetToStart, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=states.state_code AND project_details.entity_type_id='18' AND project_details.plant_status_id='23'  AND project_details.deleted_at IS null ) as totUnderConstruction, (SELECT COUNT(project_id) FROM project_details WHERE project_details.state_id=states.state_code AND project_details.entity_type_id='18' AND project_details.plant_status_id='24'  AND project_details.deleted_at IS null ) as totFunctional FROM states ");
		$data['stateWiseCBGs'] = $query->getResult();
		
		
		
		$model->where('status','1')->where('date(created_on)',$olddate)->findAll();
		
		
        return view('index',$data);
        // return view('login');
    }
	
	public function aboutUs()
    {
        return view('about-us');
    }
	
	public function contact()
    {
        return view('contact');
    }
	
	public function accessDenied()
    {
        return view('access-denied');
    }
    
	public function designV2()
    {
        return view('contactv2');
    }
	public function designV3()
    {
        return view('contactv3');
    }
	
	public function satatContact()
    {
		$satatOfficer = new SatatOfficer();
		$data['satatOfficers'] = $satatOfficer->where('status','0')->orderBy('state_name')->findAll();
        return view('satat-nodal-officer-contact', $data);
    }
	
	public function stateContact()
    {
		$stateOfficer = new StateOfficer();
		$data['stateOfficers'] = $stateOfficer->where('status','0')->orderBy('state_name')->findAll();
        return view('state-nodal-officer-contact', $data);
    }
	

	public function benefits()
    {
        return view('benefits');
    }

}
