<?php

function getNameFromId($key = '', $id = ''){
	if(empty($id) || $id=="0"){ return ""; }
	$data = allOptions($key);
	return $data[$id];
}
function allOptions($key){
	$data['units'] = [
		'0' => 'N/A',
		'1' => 'm3 per day',
		'2' => 'KG per day',
		'3' => 'Tons per day',
		'4' => 'Liters per day',
		'5' => 'KLD'
	];
	$data['cast_category'] = [
		'0' => 'N/A',
		'1' => 'General',
		'2' => 'SC',
		'3' => 'ST',
		'4' => 'OBC'
	];
	
	$data['loan_application_status'] = [
		'0'=>'',  
		'1' => 'Sanctioned',
		'2' => 'Under Process',
		'3' => 'Pending with bank',
		'4' => 'Rejected',
		'5' => 'Documents Awaited'
	];
	
	$data['ministry'] = [
		'0' => '',
		'1' => 'DAHD',
		'2' => 'DA&FW',
		'3' => 'MNRE',
		'4' => 'MoHUA',
		'5' => 'MoPNG',
		'6' => 'DoF',
		'7' => 'DDWS',
		'9' => 'DARE/ICAR',
		'8' => 'Others',
		'10' => 'MoEFCC',
	];
	
	$data['defunct_reason'] = [ 
		'1' => 'Got damaged by natural disaster',
		'2' => 'Got damaged by human intervention',
		'3' => 'Lack of awareness and interest of households',
		'4' => 'Lack of skilled manpower',
		'5' => 'Non-availability of electricity',
		'6' => 'Non-availability/Insufficient feedstock',
		'7' => 'Poor construction & O&M leading to leakage in plants',
		'8' => 'Main pipeline is broken',
		'9' => 'Main digester is broken',
		'10' => 'Beneficiaries are not interested in O&M of the plants',
		'11' => 'Issue with bio-slurry disposal',
		'13' => 'Disputes between beneficiaries for O&M',
		'14' => 'Lack of funds for maintenance',
		'15' => 'Households preferred LPG over biogas',
		'16' => 'Others',
	];
	
	$data['issues_related'] = [
		'1' => 'iFMS',
		'2' => 'MoU',
		'3' => 'PoS Machine',
		'4' => 'Testing of FOM/LFOM'
	];
	$data['ifms_issues'] = [
		'1' => 'Issues with login credentials',
		'2' => 'Issues with data entry',
		'4' => 'Issues with report generation',
		'3' => 'Other',
		
	];
	$data['mou_issues'] = [
		'4' => 'Tender related issues',
		'1' => 'Delay in MoU Signing',
		'2' => 'FMCs are not off taking FOM/LFOM',
		'3' => 'Other'
	];
	
	$data['pos_machine_issues'] = [
		'1' => 'Issues with PoS machine operation',
		'2' => 'Issues with Authorization in PoS machine',
		'3' => 'Issues with stock transfer',
		'4' => 'Issues with data entry/uploading',
		'5' => 'Issues with bill generation',
		'6' => 'Other',
	];
	
	$data['testing_issues'] = [ 
		'1' => 'Authorized labs for testing FOM/LFOM not available',
		'2' => 'NABL accredited labs not giving report as per FCO standards',
		'3' => 'NABL accredited labs not testing report as per FCO standards',
		'4' => 'Other',
	];
	
	$data['satat_ogmc'] = [ 
		'0' => '',
		'1' => 'IOCL',
		'2' => 'HPCL',
		'3' => 'BPCL',
		'4' => 'IGL',
	];
	
	return $data[$key];
}

function uniqueId($str,$id, $temp=false, $isBiogas){
	$str = trim($str);
	$uid = str_pad($id,6,'0',STR_PAD_LEFT);
	$uniquecode = $str.$isBiogas. $uid;
	if($temp){
		$uniquecode = $str.$isBiogas. $uid."TEMP";
	} 
	return $uniquecode;
}

function getUnits($name, $key='',$id=''){
	$data = [
		'solid' => '<span class="input-group-text '.$name.' solid_output" id="'.$name.$id.'" >Kg/day</span>',
		'liquid' => '<span class="input-group-text l'.$name.' liquid_output" id="'.$name.$id.'" >Litres/day</span>',
		'other' => '<select class="form-select" name="'.$name.'[]" id="'.$name.$id.'" disabled >
						<option value="2">Kg/day</option>
						<option value="4">Litres/day</option>
					</select>',
	];
	
	return $data[$key];
}

function uniquedetails($conn, $tablename, $field = '*', $qryfeild = '', $value = ''){
    $builder = $conn->table($tablename);
    $builder->select($field);
    if($value != ""){
        $builder->where($qryfeild, $value);
    }else{
		return "NA";
	}
    $query = $builder->get();
    $data=$query->getRow();
	//echo $value;
	if($data){
		return $data->$field;
	}else{
		return "NA";
	}
    
}

function getMultiple($conn, $tablename, $field = '*', $qryfeild = '', $values = []){
    $builder = $conn->table($tablename);
    $builder->select($field);
    if(count($values)>0){
        $builder->whereIn($qryfeild, $values);
    }else{
		return "NA";
	}
    $query = $builder->get();
    $data=$query->getResult();
    return $data;
}

function searchData($array, $search){
	$result = array();
	foreach ($array as $key => $value){
	  foreach ($search as $k => $v){
		if (!isset($value[$k]) || $value[$k] != $v){
		  continue 2;
		}
	  }
	  $result[] = $key;
	}
	
	if(count($result)==0){
		$result = array('0'=>'ss'); 
	}
	return $result;
}

function encrypt_url($string) {
	$output = false;
	$secret_iv = "1234567891011121";
	$secret_key = "Satyendra";
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	$encrypt_method = "AES-256-CBC";
	$result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($result);
	return $output;
}

function decrypt_url($string) {
	$output = false;
	$secret_iv = "1234567891011121";
	$secret_key = "Satyendra";
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	$encrypt_method = "AES-256-CBC";
	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	return $output;
}




function LoginCaptchaImage(){
	
	
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

function cryptoJsAesDecrypt($passphrase, $jsonString){
    $jsondata = json_decode($jsonString, true);
    $salt = hex2bin($jsondata["s"]);
    $ct = base64_decode($jsondata["ct"]);
    $iv  = hex2bin($jsondata["iv"]);
    $concatedPassphrase = $passphrase.$salt;
    $md5 = array();
    $md5[0] = md5($concatedPassphrase, true);
    $result = $md5[0];
    for ($i = 1; $i < 3; $i++) {
        $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
        $result .= $md5[$i];
    }
    $key = substr($result, 0, 32);
    $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
    return json_decode($data, true);
}

function cryptoJsAesEncrypt($passphrase, $value){
    $salt = openssl_random_pseudo_bytes(8);
    $salted = '';
    $dx = '';
    while (strlen($salted) < 48) {
        $dx = md5($dx.$passphrase.$salt, true);
        $salted .= $dx;
    }
    $key = substr($salted, 0, 32);
    $iv  = substr($salted, 32,16);
    $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
    $data = array("ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt));
    return json_encode($data);
}


?>