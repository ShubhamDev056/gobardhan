<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LoginLog;
use App\Models\Role;

class LoginController extends BaseController
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
        return view('index');
    }

    public function login()
    {
		$data['logincaptcha'] = $this->LoginCaptchaImage();
		if ($session->isLoggedIn()) {
            $session->destroy();
        }
		
		
		
		$session->regenerate();
        return view('login',$data);
    }
	
	public function auth()
    {
        $session = session();
        $model = new UserModel();
        $LoginLog = new LoginLog();
        $roleModel = new Role();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $captcha = $this->request->getVar('captcha');
        $passKey = $this->request->getVar('passKey');
		$captcha_string = $session->get('captcha_string');
		$resArr=['status'=>1];
		if($captcha==$captcha_string){
		    //$password = base64_decode($password);
		    $password = cryptoJsAesDecrypt(ENC_KEY, $password);
			$data = $model->where('username', $username)->first();
			if($data){
				$pass = $data['password'];
				$password_version = $data['password_version'];
				if($password_version=="V2"){
					$storedpass = hash('sha256',$password);
					$verify_pass = hash_equals($storedpass,$pass);
				}else{
					$verify_pass = password_verify($password, $pass);
				}
				
				if($verify_pass){
					
					$session->regenerate();
					$role_id = $data['role_id'];
					$roleData = $roleModel->where('id', $role_id)->first();
					$ses_data = [
						'user_id'       => $data['user_id'],
						'name'       => trim($data['name']),
						'username'     => $data['username'],
						'email'    => $data['email'],
						'contact_no'    => $data['contact_no'],
						'role_id'    => $data['role_id'],
						'state_id'    => $data['state_id'],
						'ministry'    => $data['reg_permanent_no'],
						'rolename' => $roleData['name'],
						'role' => $roleData['role'],
						'logged_in'     => TRUE
					];
					
					if($password_version=="V1"){
						$log_data = [
							'password' => hash('sha256',$password),
							'password_version'    => 'V2',
						];
						$model->update($data['user_id'], $log_data);
					}
					
					$log_data = [
						'user_id'       => $data['user_id'],
						'ip_address'     => $_SERVER['REMOTE_ADDR'],
						'login_time'    => date('Y-m-d H:i:s'),
					];
					$LoginLog->insert($log_data);
					
					$session->set($ses_data);
					if($data['role_id']==1 || $data['role_id']==4){
				        //return redirect()->to(base_url().'dashboard');
				        $redirectUrl=base_url().'dashboard';
						$resArr=['status'=>200,'message'=>'success','redirect_url'=>$redirectUrl];
					}else if($data['role_id']==5 || $data['role_id']==6){
				        //return redirect()->to(base_url().'applied-loan');
						$redirectUrl=base_url().'applied-loan';
						$resArr=['status'=>200,'message'=>'success','redirect_url'=>$redirectUrl];
					}else if($data['role_id']==7){
						//return redirect()->to(base_url().'cbg-plants');
						$redirectUrl=base_url().'cbg-plants';
						$resArr=['status'=>200,'message'=>'success','redirect_url'=>$redirectUrl];
					}else if($data['role_id']==8){
						//return redirect()->to(base_url().'mda-issues');
						$redirectUrl=base_url().'mda-issues';
						$resArr=['status'=>200,'message'=>'success','redirect_url'=>$redirectUrl];
					}else if($data['role_id']==2){
						//return redirect()->to(base_url().'state-dashboard');
						$redirectUrl=base_url().'state-dashboard';
						$resArr=['status'=>200,'message'=>'success','redirect_url'=>$redirectUrl];
					}else{
    					//return redirect()->to(base_url().'profile');
    					$redirectUrl=base_url().'profile';
    					$resArr=['status'=>200,'message'=>'success','redirect_url'=>$redirectUrl];
					}
				}else{
				// 	$session->setFlashdata('msg', 'Invalid Login Details.');
				// 	return redirect()->to(base_url().'login');
					$resArr=['status'=>0,'message'=>'failed','error'=>'Invalid Login Details.'];
				}
			}else{
				// $session->setFlashdata('msg', 'Invalid Login Details.');
				// return redirect()->to(base_url().'login');
				$resArr=['status'=>0,'message'=>'failed','error'=>'Invalid Login Details.'];
			}
		}
		else{
			//$session->setFlashdata('msg', 'Invalid Captcha.');
            // return redirect()->to(base_url().'login');
            $resArr=['status'=>0,'message'=>'failed','error'=>'Invalid Captcha.'];
		}
		
		echo json_encode($resArr);
    }
	
	public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url());
    }
	
	
	public function test(){
		
		echo "<pre>";
		/*
		$benefits = [253,254,256,257,258,255,259,260];
		
		foreach($benefits as $benefit){
			echo $benefit."<br><br>"; 
			$query = $this->db->query("SELECT status, COUNT(id) as totPlants FROM project_benefits WHERE option_list_id='".$benefit."' GROUP BY status ORDER BY status; ");
			$res = $query->getResultArray();
			
			if($benefit==255 || $benefit==260){
				$apld = array("status"=>"applied","totPlants"=>0);
				array_unshift($res,$apld);
				$res[] = array("status"=>"required","totPlants"=>0);
			}
			print_r($res);
		}
		$bnfStatus = ['applied','availed','required'];
		*/
		
		$benefits = [253,254,256,257,258,259,255,260];
		$bnfStatuss = ['applied','availed','required'];
		$seriesData = "";
		foreach($bnfStatuss as $bnfStatus){
			$seriesData.="{ name: '".$bnfStatus."',  data: [ ";
			foreach($benefits as $benefit){ 
				$query = $this->db->query("SELECT COUNT(id) as totPlants FROM project_benefits INNER JOIN project_details ON project_details.project_id=project_benefits.project_id WHERE option_list_id='".$benefit."' AND status='".$bnfStatus."' ; ");
				$res = $query->getRow();
				$seriesData.=$res->totPlants.",";
			}
			$seriesData.="] },";
		}
		
		echo $seriesData;
		die;
		
		return view('test');
	}
	
	
	
	public function LoginCaptchaImage(){
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

		$allowed_letters = 'ABCDEFGHIJKLMNPRTUVWXYZabcdefghijklmnopqrstuvwxyz12346789';
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

		$_SESSION['captcha_string'] = $word;
		imagepng($image);
		$imgData=ob_get_clean();
		$data['image'] ='<img src="data:image/png;base64,'.base64_encode($imgData).'" />';
		// echo $data['image'];
		return $data['image'];
		
	}
	
}
