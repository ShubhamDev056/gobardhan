<?php 
namespace App\Controllers;
use App\Models\CircularModel;

class CircularController extends BaseController
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
		$CircularModel = new CircularModel();
		$ministry_id = $this->request->getVar('ministry_id');
		if(!empty($ministry_id)){
			$CircularModel->where('ministry_id',$ministry_id);
		}
		
		$circulars = $CircularModel->where('status','1')->orderBy('circular_date','desc')->findAll();
		$data['circulars'] = $circulars;
		return view('circular',$data);
    }
	
	
	public function circularList()
	{
		$CircularModel = new CircularModel();
		$ministry_id = $this->request->getVar('ministry_id');
		$title = $this->request->getVar('title');
		if(!empty($ministry_id)){
			$CircularModel->where('ministry_id',$ministry_id);
		}
		if(!empty($title)){
			$CircularModel->like('title',$title);
		} 
		$circulars = $CircularModel->orderBy('circular_date','desc')->findAll();
		$data['circulars'] = $circulars;
		return view('backend/circular-list',$data);
	}
	
	function circularAdd()
	{
		if($this->request->getMethod() === 'post'){
			$title = $this->request->getVar('title');
			$ministry_id = $this->request->getVar('ministry_id');
			$circular_date = $this->request->getVar('circular_date');
			$validation =  \Config\Services::validation();
			$rules = [
				"title" => [
					"label" => "Title", 
					"rules" => "required"
				],
				"ministry_id" => [
					"label" => "Ministry", 
					"rules" => "required"
				],
				"circular_date" => [
					"label" => "circular_date", 
					"rules" => "required"
				],
				
			];
			
			if($this->validate($rules)){
				$randomName='';
				$file = $this->request->getFile('document');
				if(!empty($file->getName())){
					$randomName = $file->getRandomName();
					// $data['fileName'] = $file->getName();
					// $data['randomName'] = $randomName;
					// $data['fileType'] = $file->getClientMimeType();
					// $data['fileSize'] = $file->getSize();
					$file->move(ROOTPATH.'whats-new', $randomName);
				}
				
				$corcularData = [
					'title'=> $title,
					'ministry_id'=> $ministry_id,
					'circular_date'=> $circular_date,
					'file_path' => $randomName
				];
				
				$CircularModel = new CircularModel();
				$result = $CircularModel->insert($corcularData);
				if($result){
					return redirect()->to(base_url().'circular');
				}
			}else{
				$errorsmsg = $validation->getErrors();
				$data["errors"] = $errorsmsg;
			}
		}
		$data['circulars'] = "";
		return view('backend/circular-add',$data);
	}
	
	public function circularDelete($id = null)
	{
		$session = session();
		$userId = $session->get('user_id');
		$role = $session->get('role');
		if($role!="admin"){
			return redirect()->to(base_url());
		}
		
		$CircularModel = new CircularModel();
		
		$circular =  $CircularModel->where('important_circular_id', $id)->first();
		$file_path = $circular['file_path'];
		$file_location = ROOTPATH.'whats-new/'.$file_path;
		if(file_exists($file_location)){
			unlink($file_location);
		}
		
		$data['circular'] = $CircularModel->where('important_circular_id', $id)->delete();
		
		return redirect()->to(base_url().'circular'); 
	}
}
