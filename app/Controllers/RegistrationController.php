<?php

namespace App\Controllers;
use App\Models\OrganizationModel;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\MDAIssue;
use App\Models\OfftakeIssue;
use App\Models\ChangePasswordLog;


class RegistrationController extends BaseController
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
		$session = session();
		$sesdata=['emailVerification'=>'failed'];
		$session->set($sesdata);
    	$data['captcha'] = $this->captchaImage();
        return view('registration',$data);
    }
	
	public function saveRegistration(){
		$name = $this->request->getVar('name');
		$designation = $this->request->getVar('designation');
		$email = $this->request->getVar('email');
		$contact_number = $this->request->getVar('contact_number');
		$username = trim($this->request->getVar('username'));
		//$password = cryptoJsAesDecrypt(ENC_KEY, $password);
		$password = trim(cryptoJsAesDecrypt(ENC_KEY, $this->request->getVar('password')));
		$confirm_password = trim(cryptoJsAesDecrypt(ENC_KEY, $this->request->getVar('confirm_password')));
		$captcha = $this->request->getVar('captcha');
		
		$session = session();
		$emailVerification = $session->get('emailVerification');
		
		$validation =  \Config\Services::validation();
		
		$rules = [
            "name" => [
                "label" => "Name", 
                "rules" => "required|min_length[3]|max_length[50]"
            ],
            "email" => [
                "label" => "Email", 
                "rules" => "required|is_unique[users.email]"
            ],
			"designation" => [
                "label" => "designation", 
                "rules" => "required"
            ],
			"contact_number" => [
                "label" => "Contact Number", 
                "rules" => "required|min_length[10]|max_length[10]"
            ],
            "username" => [
                "label" => "Username", 
                "rules" => "required|min_length[3]|max_length[20]|is_unique[users.username]"
            ],
            "password" => [
                "label" => "Password", 
                "rules" => "required|min_length[8]"
            ],
            "confirm_password" => [
                "label" => "Confirm Password", 
                "rules" => "matches[password]"
            ]
        ];
		
		
		$captcha_string = $session->get('captcha_string_registration');
		if($captcha_string==$captcha){
			if ($this->validate($rules)) {
				//$password = password_hash($password, PASSWORD_DEFAULT);
				$password = hash('sha256', $password);
				$userInfo = [
					'name'=>$name,
					'designation'=>$designation,
					'contact_no'=>$contact_number,
					'email'=>$email,
					'username'=>$username,
					'password'=>$password,
					'password_version'=>'V2',
					'role_id' => 3,
				];
				if($emailVerification=="verified"){
					
					$User = new UserModel();
					$result=$User->insert($userInfo);
					$user_id = $User->insertID;
					if($user_id){
						$ChangePasswordLog = new ChangePasswordLog();
						$passlog=[
							'user_id' => $user_id,
							'password' => $password,
							'created_at' => date('Y-m-d H:i:s'),
						];
						$ChangePasswordLog->insert($passlog);
						$regno = $this->uniqueId('REG',$user_id);
						$regnoArr = ['reg_temp_no'=>$regno];
						$res = $User->update($user_id, $regnoArr);
						return redirect()->to(base_url().'login'); 
					}else{
						$errorsmsg['server_error'] = "Internal Server Error.";
						$data["errors"] = $errorsmsg;
					}
				}else{
					$errorsmsg['verify_email'] = "Please verify your email address";
					$data["errors"] = $errorsmsg; 
				}
			}
			else{
				//echo "All fields are required.";
				$errorsmsg = $validation->getErrors();
				$data["errors"] = $errorsmsg;
			}
		}else{
			$errorsmsg['captcha'] = "Please enter valid captcha";
			$data["errors"] = $errorsmsg; 
		}
		
		$session = session();
		$sesdata=['emailVerification'=>'failed'];
		$session->set($sesdata);
    	$data['captcha'] = $this->captchaImage();
        return view('registration',$data);
	}
	
	function updateProfile()
	{
		$session = session(); 
		//$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		
		$name = $this->request->getVar('name');
		$designation = $this->request->getVar('designation');
		$contact_number = $this->request->getVar('contact_number');
		$validation =  \Config\Services::validation();
		
		$rules = [
            "name" => [
                "label" => "Name", 
                "rules" => "required|min_length[3]|max_length[50]"
            ],
			"designation" => [
                "label" => "designation", 
                "rules" => "required"
            ],
			"contact_number" => [
                "label" => "Contact Number", 
                "rules" => "required"
            ]
        ];
		if ($this->validate($rules)) {
			$uInfo = [
				'name'=>$name,
				'designation'=>$designation,
				'contact_no'=>$contact_number
			];
			$user = new UserModel();
			$res = $user->update($userId,$uInfo);
			if($res){
				return redirect()->to(base_url().'profile'); 
			}
		}
		
	}
	
	function changePass(){
	    $session = session(); 
		//$roleId = $session->get('role_id');
		$userId = $session->get('user_id');
		
	    $resArr = [];
	    $oldPass = base64_decode($this->request->getVar('oldPass'));
	    $newPass = base64_decode($this->request->getVar('newPass'));
	    $cnfPass = base64_decode($this->request->getVar('cnfPass'));
	    $validation =  \Config\Services::validation();
		
		$rules = [
            "oldPass" => [
                "label" => "oldPass", 
                "rules" => "required"
            ],
			"newPass" => [
                "label" => "newPass", 
                "rules" => "required|min_length[8]|max_length[50]"
            ],
			"cnfPass" => [
                "label" => "Confirm Password", 
                "rules" => "matches[newPass]"
            ]
        ];
		if ($this->validate($rules)) {
		    $user = new UserModel();
			$ChangePasswordLog = new ChangePasswordLog();
		    $data = $user->where('user_id', $userId)->first();
		    if($data){
		        $pass = $data['password'];
				
				$logPass=[];
				$passwordLogs = $ChangePasswordLog->where('user_id',$userId)->orderBy('id','desc')->limit(3)->findAll();
				
				foreach($passwordLogs as $passwordLog){
					$logPass[] = $passwordLog['password'];
				}
				if(!in_array($oldPass,$logPass)){
					//$verify_pass = password_verify($oldPass, $pass);
					$password_version = $data['password_version'];
					if($password_version=="V2"){
						$storedpass = hash('sha256',$oldPass);
						$verify_pass = hash_equals($storedpass,$pass);
					}else{
						$verify_pass = password_verify($oldPass, $pass);
					}
					
					if($verify_pass){
						$newPassword = hash('sha256', $newPass);
						$userInfo = [
							'password'=>$newPassword,
							'password_version'=>'V2',
						];
						$res = $user->update($userId,$userInfo);
						if($res){
							
							$passlog=[
								'user_id' => $userId,
								'password' => $newPass,
								'created_at' => date('Y-m-d H:i:s'),
							];
							$ChangePasswordLog->insert($passlog);
							$resArr = ['status'=>200,'message'=>'Password change successfully.'];
						}else{
							$resArr = ['status'=>500,'message'=>'Internal server error'];
						}
					}else{
						$resArr = ['status'=>403,'message'=>'Invalid old password.'];
					}
				}else{
					$resArr = ['status'=>403,'message'=>'You can not use last 3 old password.'];
				}
		        
		    }else{
		        $resArr = ['status'=>403,'message'=>'Invalid user.'];
		    }
		}else{
		    $errorsmsg = $validation->getErrors();
		    $resArr = ['status'=>2,'message'=>$errorsmsg];
		}
	    
	    echo json_encode($resArr);
	}
	
	public function registrationSuccess()
	{
		return view('registration-complete');
	}
	
	public function uniqueId($str,$id){
		$str = trim($str);
		$uid = str_pad($id,6,'0',STR_PAD_LEFT);
		return $uniquecode = $str . $uid;
	}

    public function regOverview()
    {
        $data['title'] = "How To Register";
        return view('registration-overview',$data);
    }

    public function profile()
    {
		$session = session();
		$user_id = $session->get('user_id');
		
		$User = new UserModel();
		$organizationModel = new OrganizationModel();
		$MDAIssue = new MDAIssue();
		$OfftakeIssue = new OfftakeIssue();
		$projectModel = new ProjectModel();
		$data['userdata'] = $User->where('user_id', $user_id)->first();
		$data['projects'] = $projectModel->where('user_id',$user_id)->orderBy('project_id','DESC')->findAll();
		
		// $projectModel->select('project_details.project_registration_no,project_details.organization_id,project_details.project_name,project_details.project_name, option_list.title ');
		// $projectModel->join('option_list', 'project_details.entity_type_id=option_list.id', 'left' );
		// $projectModel->where('project_details.user_id', $user_id);
		// $projectModel->orderBy('project_details.project_id', 'DESC');
		// $data['projects'] = $projectModel->paginate($this->per_page);
		
		$MDAIssue->select("mda_issues.*, project_details.project_name ");
		$MDAIssue->join('project_details','mda_issues.project_id=project_details.project_id');
		$MDAIssue->where('added_by',$user_id);
		$query = $MDAIssue->where('status','1');
		$data['mdaissues'] = $query->findAll();
		
		$OfftakeIssue->select("offtake_issues.*, project_details.project_name ");
		$OfftakeIssue->join('project_details','offtake_issues.project_id=project_details.project_id');
		$OfftakeIssue->where('added_by',$user_id);
		$query = $OfftakeIssue->where('offtake_issues.status','1');
		$data['offtakeissues'] = $query->findAll();
		
		
        $data['org'] = $organizationModel->where('user_id', $user_id)->where('status','0')->first();
		$data['conn'] = $this->db;
        return view('profile',$data);
    }



	public function sendOTP()
    {
		$session = session();
		$session_id = session_id();
		$_SESSION[$session_id][] = date('Y-m-d H:i:s');
		$nofSend = $_SESSION[$session_id];
		$startTime = $nofSend[0];
		$endTime = date('Y-m-d H:i:s');
		$requestTime = (strtotime($startTime) - strtotime($endTime)) / 60;
		$resArr = [];
		
		if($requestTime==0 || $requestTime>3){
			
			if(count($nofSend)>3){
				$_SESSION['block'][] = date('Y-m-d H:i:s');
				$date2 = date('Y-m-d H:i:s');
				$date1 = $_SESSION['block'][0];
				$mins = (strtotime($date2) - strtotime($date1)) / 60;
				if($mins>1){
					$_SESSION['block'] = [];
				}
				$resArr = ['status'=>false,'message'=>'Your account has been blocked for 30 minutes.'];
			}else{
				
				// echo "send OTP";
				// $message = "Please activate the account ".anchor('user/activate/'.$data['u_link'],'Activate Now','');
				$to = base64_decode($this->request->getVar('email'));
				$digits = 6;
				$unique_id = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);10;
				$message= "GOBARdhan Unified Registration Portal Verification. Your OTP is ".$unique_id;
				//$message.= "Your OTP is ".$unique_id;
				$email = \Config\Services::email();
				$email->setFrom('admin@gobardhan.co.in', 'Email Verification');
				//$email->setFrom('ss.snm1503@gmail.com', 'Email Verification');
				// $email->setTo('satyendrasinghbca777@gmail.com');
				$email->setTo($to);
				$email->setSubject('GOBARdhan Unified Registration Portal Verification.');
				$email->setMessage($message);//your message here
				
				// $email->setCC('another@emailHere');//CC
				// $email->setBCC('thirdEmail@emialHere');// and BCC
				// $filename = '/img/yourPhoto.jpg'; //you can use the App patch 
				// $email->attach($filename);
				$sesdata = [
					'email_otp'       => $unique_id
				];
				
				$session->set($sesdata);
				if($email->send()){
					//return "success";
					$resArr = ['status'=>true,'message'=>'Mail send on email.'];
				}else{
					//$email->printDebugger(['headers']);
					$resArr = ['status'=>false,'message'=>'failed.','error'=>$email->printDebugger(['headers'])];
				}
			}
		}else{
			$resArr = ['status'=>false,'message'=>'failed.','error'=>'Please try again after 3 minutes'];
		}
		echo json_encode($resArr);
    }
	
	public function verifyOTP(){
		$emailOTP = $this->request->getVar('emailOTP');
		$session = session();
		$email_otp = base64_decode($session->get('email_otp'));
		$sesdata=['emailVerification'=>'failed'];
		$session->set($sesdata);
		if($emailOTP==$email_otp){
			$sesdata=['emailVerification'=>'verified'];
			$res = ['status'=>1,'message'=>'Email OTP Verified'];
		}else{
			$res = ['status'=>0,'message'=>'Invalid OTP'];
		}
		$session->set($sesdata);
		echo json_encode($res);
	}
	
	public function forgotDetails()
	{
		if($this->request->getMethod() === 'post'){
			$email = $this->request->getVar('email');
			$password = $this->request->getVar('password');
			
// 			$session = session();
// 			$captcha_string = $session->get('captcha_string_registration');
// 		    if($captcha_string==$captcha)
// 		    {
		        
    			$validation =  \Config\Services::validation();
    			$rules = [
    				"email" => [
    					"label" => "email", 
    					"rules" => "required"
    				],
    				"password" => [
    					"label" => "password", 
    					"rules" => "required"
    				],
    				"cnfpassword" => [
    					"label" => "Confirm Password", 
    					"rules" => "matches[password]"
    				]
    			];
    			if ($this->validate($rules)) {
    				$session = session();
    				$verifiedEmail = $session->get('forgtemail');
    				if($email==$verifiedEmail){
    					$User = new UserModel();
    					$ChangePasswordLog = new ChangePasswordLog();
    					$userdata = $User->where('email', $email)->first();
    					if($userdata){
    						//$password = password_hash($password, PASSWORD_DEFAULT);
							$userId=$userdata['user_id'];
							
							$logPass=[];
							$passwordLogs = $ChangePasswordLog->where('user_id',$userId)->orderBy('id','desc')->limit(3)->findAll();
							
							foreach($passwordLogs as $passwordLog){
								$logPass[] = $passwordLog['password'];
							}
							
							if(!in_array($password,$logPass)){
								$password = hash('sha256', $password);
								$userInfo = [
									'password'=>$password,
									'password_version'=>'V2',
								];
								$result = $User->update($userdata['user_id'],$userInfo);
								if($result){
									return redirect()->to(base_url().'login'); 
								}
							}else{
								$data["errors"] = "You can not use last 3 old password.";
							}
    					}
    				}
    				
    			}else{
    				$errorsmsg = $validation->getErrors();
    				$data["errors"] = $errorsmsg;
    			}
		  //  }else{
		  //      $data["errors"] = 'Invalid captcha';
		  //  }
		}
		$data['captchaImg']=$this->captchaImage();
		return view('forgot-details',$data);
	}
	
	
	
	public function forgotUsername()
	{
	    $data['captchaImg']=$this->captchaImage();
		return view('forgot-username',$data);
	}
	
	
	///SEND OTP FOR FORGOT LOGIN DETAILS
	public function sendOTPForgot()
	{
	    $session = session();
		$to = base64_decode($this->request->getVar('emailId'));
		$captcha = $this->request->getVar('fcaptcha');
		$captcha_string = $session->get('captcha_string_registration');
		if($captcha_string==$captcha){
		
    		$User = new UserModel();
    		$userdata = $User->where('email', $to)->first();
    		if($userdata){
    			$to = $userdata['email'];
    			$digits = 6;
    			$unique_id = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);10;
    			$message= "GOBARdhan Unified Registration Portal Verification. Your OTP is ".$unique_id;
    			$email = \Config\Services::email();
    			$email->setFrom('admin@gobardhan.co.in', 'Email Verification');
    			$email->setTo($to);
    			$email->setSubject('GOBARdhan Unified Registration Portal Forgot Password.');
    			$email->setMessage($message);//your message here
    			$sesdata = [
    				'forgtOtp'       => $unique_id,
    				'forgtemail' => $to
    			];
    			$session = session();
    			$session->set($sesdata);
    			if($email->send()){
    				$res = array('status'=>200,'msg'=>'OTP Send on Email.');
    			}else{
    				$res = array('status'=>500,'msg'=>'Internal server error.');
    				$email->printDebugger(['headers']);
    			}
    		}else{
    			$res = array('status'=>404,'msg'=>'Invalid Email.');
    		}
		
		}else{
		    $res = array('status'=>403,'msg'=>'Invalid captcha.--'.$captcha_string);
		}
		return json_encode($res);
		
	}
	
	public function verifyForgotOTP(){
		$enteredOTP = $this->request->getVar('enteredOTP');
		$session = session();
		$forgtOtp = $session->get('forgtOtp');
		if($enteredOTP==$forgtOtp){
			$res = ['status'=>1,'message'=>'Email OTP Verified'];
		}else{
			$res = ['status'=>0,'message'=>'Invalid OTP'];
		}
		echo json_encode($res);
	}

	
	public function verifyForgotOTPUsername(){
		$enteredOTP = $this->request->getVar('enteredOTP');
		$session = session();
		$forgtOtp = $session->get('forgtOtp');
		if($enteredOTP==$forgtOtp){
			$session = session();
			$forgtemail = $session->get('forgtemail');
			$User = new UserModel();
			$userdata = $User->where('email', $forgtemail)->first();
			if($userdata)
			{
				$name = $userdata['name'];
				$uname = $userdata['username'];
				$to = $userdata['email'];
				$message= "Dear $name, <br><br> Your username is: $uname ";
				$email = \Config\Services::email();
				$email->setFrom('admin@gobardhan.co.in', 'Forgot Username');
				$email->setTo($to);
				$email->setSubject('GOBARdhan Unified Registration Portal Forgot Username.');
				$email->setMessage($message);//your message here
				if($email->send()){
					$res = ['status'=>1,'message'=>'Please check your email id'];
				}
			}else{
				$res = ['status'=>0,'message'=>'errr'];
			}
			
		}else{
			$res = ['status'=>0,'message'=>'Invalid OTP'];
		}
		echo json_encode($res);
	}

	
	
	public function seccessMsg()
	{
		$type = $this->request->getVar('s');
		$data['heading']='Thank You!';
		$data['message']='You have successfully registered on the Unified Registration Portal of GOBARdhan.';
		
		if($type=='username'){
			$data['heading']='Success';
			$data['message']= 'Please Check Your Email Id';
		}
		
		return view('successpage',$data);
	}



    public function captchaImage(){
    	$image = imagecreatetruecolor(100, 40);       
        // $background_color = imagecolorallocate($image, 	255, 255, 255);  
        $background_color = imagecolorallocate($image, 	0, 255, 255);  
        imagefilledrectangle($image,0,0,100,100,$background_color); 
        $line_color = imagecolorallocate($image, 64,64,64);
        $number_of_lines=rand(3,7);
 
        for($i=0;$i<$number_of_lines;$i++)
        {
          // imageline($image,0,rand()%50,250,rand()%50,$line_color);
        }
 
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
 
        $_SESSION['captcha_string_registration'] = $word;
		imagepng($image);
		$imgData=ob_get_clean();
		$data['image'] ='<img src="data:image/png;base64,'.base64_encode($imgData).'" />';
		// echo $data['image'];
		return $data['image'];
    }

}
