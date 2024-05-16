<?php 
namespace App\Controllers;
use App\Models\GrievanceModel;

class GrievanceController extends BaseController
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
        $email->setTo('satyendrasinghbca777@gmail.com');
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
	
	function sendmail($to, $subject, $message="test")
	{
		if(empty($to)){ $to = 'satyendrasinghbca777@gmail.com';  }
		//$message = "This is the testing mail";
        $email = \Config\Services::email();
        $email->setFrom('admin@gobardhan.co.in', 'GOBARdhan Portal');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
		$email->setCC('kumar.satyendrasingh9@gmail.com');
		$email->send();
		/* if(!$email->send()){
			$email->printDebugger();
		} */
		
	}
	
	function grievanceList()
	{
		$session = session();
		$role_id = $session->get('role_id');
		$ministry = $session->get('ministry');
		if($role_id!=4 && $role_id!=1){
			return redirect()->to(base_url()); 
		}
		
		
		$GrievanceModel = new GrievanceModel();
		$GrievanceModel->where('status','0');
		if($role_id==4){
			$GrievanceModel->where('status','0')->where('ministry',$ministry);
		}
		
		$grievances = $GrievanceModel->findAll();
		$data['grievances'] = $grievances;
		return view('backend/grievance-list',$data);
	}
	
	
	function grievance()
	{
		if($this->request->getMethod() === 'post'){
			$name = $this->request->getVar('name');
			$contact_number = $this->request->getVar('contact_number');
			$email = $this->request->getVar('email');
			$ministry = $this->request->getVar('ministry');
			$message = $this->request->getVar('message');
			$grcaptcha = $this->request->getVar('grcaptcha');
			$session = session();
			$grievance_captcha_string = $session->get('grievance_captcha_string');
			$validation =  \Config\Services::validation();
			$rules = [
				"name" => [
					"label" => "Name", 
					"rules" => "required|min_length[3]|max_length[50]"
				],
				"email" => [
					"label" => "Email", 
					"rules" => "required|valid_email"
				],
				"ministry" => [
					"label" => "ministry", 
					"rules" => "required"
				],
				"contact_number" => [
					"label" => "Contact Number", 
					"rules" => "required|min_length[10]|max_length[10]"
				],
				"message" => [
					"label" => "message", 
					"rules" => "required"
				]
			];
			
			if($grcaptcha==$grievance_captcha_string){
				if($this->validate($rules)){
					$_SESSION['grievance_captcha_string']='';
					$randomName='';
					$file = $this->request->getFile('grievancedocument');
					if(!empty($file->getName())){
						$randomName = $file->getRandomName();
						// $data['fileName'] = $file->getName();
						// $data['randomName'] = $randomName;
						// $data['fileType'] = $file->getClientMimeType();
						// $data['fileSize'] = $file->getSize();
						$file->move(ROOTPATH.'public/uploads/grievances', $randomName);
					}
					$digits = 10;
					$grievance_code = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);10;
					$grievanceData = [
						'name'=>$name,
						'grievance_code'=>$grievance_code,
						'contact_no'=>$contact_number,
						'ministry'=>$ministry,
						'email'=>$email,
						'message'=>$message,
						'grievance_doc' => $randomName
					];
					
					$GrievanceModel = new GrievanceModel();
					$result = $GrievanceModel->insert($grievanceData);
					if($result){
						$subject='Grievance';
						$msg = 'A grievance received.';
						$this->sendmail("satyendrasinghbca777@gmail.com", $subject, $msg);
						//return redirect()->to(base_url().'login');
						$data['heading'] = 'Your grievance has been submitted.';
						$data['message'] =  'The Ministry will reply to your email ID in the last 7 days.';
						return view('successpage',$data);
					}
					
				}else{
					$errorsmsg = $validation->getErrors();
					$data["errors"] = $errorsmsg;
				}
				
			}else{
				$data["errors"]['captcha'] = "Please enter valid captcha";
			}
			
			//$data['formdata'] = $this->request->getVar();
		}
		$data['gcaptcha'] = $this->captchaImage();
		return view('grievance-form',$data);
	}
	
	function grievanceDetails($id)
	{
		$GrievanceModel = new GrievanceModel();
		$grievaanceDeatails = $GrievanceModel->where('grievance_id',$id)->where('status','0')->first();
		$data['grievance'] = $grievaanceDeatails;
		return view('backend/grievance-details',$data);
	}
	
	
	public function captchaImage(){
    	$image = imagecreatetruecolor(100, 40);       
        // $background_color = imagecolorallocate($image, 	255, 255, 255);  
        $background_color = imagecolorallocate($image, 	0, 255, 255);  
        imagefilledrectangle($image,0,0,100,100,$background_color); 
        $line_color = imagecolorallocate($image, 64,64,64);
        $number_of_lines=rand(3,7);
 
        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%1,rand()%1,$pixel);
        }  
        $allowed_letters = 'ABCDEFGHIJKLMNPRTUVWXYZabcdefghmnpqrstuvwxyz12346789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        $text_color = imagecolorallocate($image, 	16.1, 50.2, 72.5);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagestring($image, 5,  5+($i*15), 10, $letter, $text_color);
            $word.=$letter;
        }
        $_SESSION['grievance_captcha_string'] = $word;
		imagepng($image);
		$imgData=ob_get_clean();
		$data['image'] ='<img src="data:image/png;base64,'.base64_encode($imgData).'" height="36" />';
		return $data['image'];
    }
	
}
