<?php
require_once('../config.php');
require_once('../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Content extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	function capture_err()
	{
		if (!$this->conn->error)
			return false;
		else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	public function update()
	{
		extract($_POST);
		$content_file = "../" . $file . ".html";
		$update = file_put_contents($content_file, $content);
		if ($update) {
			return json_encode(array("status" => "success"));
			$this->settings->set_flashdata("success", ucfirst($file) . " website is successfuly updated");
			exit;
		}
	}

	/** REGISTRATION **/

	public function registration()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'firstname', 'lastname', 'address', 'email', 'password', 'confirmpassword'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$chk = $this->conn->query("SELECT * FROM `users` where  username = '{$email}' ")->num_rows;
		if($chk > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "The email is already exist. Please review and try again.";
			return json_encode($resp);
			exit;
		}

		$otp = rand(100000, 999999);
		$getOTP = $otp;

		$confirmpassword2 =  md5($confirmpassword);

		if (!empty($data)) $data .= ", ";
		$data .= "`firstname`='" . addslashes(htmlentities($firstname)) . "', `lastname` = '" . addslashes(htmlentities($lastname)) . "' , `address` = '" . addslashes(htmlentities($address)) . "', `username` = '" . addslashes(htmlentities($email)) . "', `password` = '" . addslashes(htmlentities($confirmpassword2)) . "', `otp_code` = '" . addslashes(htmlentities($getOTP)) . "'";

		$secretKey = 'your_secret_key';

		$data1 = [
			"user_email" => "$email",
			"otp_no" => $getOTP
		];

		

		if (empty($id)) {
			$sql = "INSERT INTO users set $data";
		} else {
			$sql = "UPDATE users set {$data} where id = {$id}";
		}
		$add_save = $this->conn->query($sql);
		if ($add_save) {
		    // Serialize the data as JSON
		$jsonData = json_encode($data1);

		$iv = openssl_random_pseudo_bytes(16);

		// Encrypt the JSON data
		$encryptedData = openssl_encrypt($jsonData, 'AES-256-CBC', $secretKey, 0, $iv);

		// Encode the encrypted data as a URL-safe string
		$token = base64_encode($iv . $encryptedData);

		// URL-encode the token for safe inclusion in a URL
		$encodedToken = urlencode($token);


		$otplinkk = base_url . "dashboard/register-confirmation.php?etoken=" . $encodedToken;


		$recipient_email = "$email"; // Change this to the recipient's Gmail address
		$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
		$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

		$mail = new PHPMailer(true);

		try {
			$mail->SMTPDebug = SMTP::DEBUG_OFF;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			$mail->Username = $sender_email;
			$mail->Password = $sender_password;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			$mail->setFrom($sender_email);
			$mail->addAddress($recipient_email);
			$mail->Subject = "otp JA1";
			$mail->Body = "Welcome to JA1 Church Mega Sanctuary Website <br>To continue your login,your One-Time-Password (OTP) is: <br><br><h3><b>" . $getOTP . "</b></h3><br><br>Or click this link below<br><b>" . $otplinkk . "</b>. Never share your OTP.";

			$mail->send();
			$emailsent = "Email sent successfully.";
		} catch (Exception $e) {
			$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
		}
		
			$resp['status'] = 'success';
			$directlink_otp = $otplinkk;
			$resp['link'] = $directlink_otp;

		} else {
			$resp['status'] = 'failed';
			$resp['emailsenterr']  = $emailsenterr;
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}


	public function register_confirmation()
	{
		extract($_POST);
		//$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'email', 'otp', 'first', 'second', 'third', 'fourth', 'fifth', 'sixth'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$data_otp_chk = $first . $second . $third . $fourth . $fifth . $sixth;
		//$data .= "`otp_code`='" . addslashes(htmlentities($first . $second . $third . $fourth . $fifth . $sixth)) . "'";
		//$data .= "`type`=2";
		$otpinput = addslashes(htmlentities($first . $second . $third . $fourth . $fifth . $sixth));

		$sqlchkotp = ("SELECT * FROM users WHERE otp_code = '$data_otp_chk' ");
		$sqlchkotpo1 = $this->conn->query($sqlchkotp);
		$sqlchkotp1 = mysqli_fetch_assoc($sqlchkotpo1);
		$sqltypef = $sqlchkotp1['type'];

		if ($sqltypef == 2) {
			$resp['status'] = 'failed';
			$directlink_login = base_url . "dashboard/login.php";
			$resp['link'] = $directlink_login;
			$resp['msg'] = 'THIS ALREADY TO LOGIN!';
			return json_encode($resp);
			exit;
		}

		$sql = "UPDATE users set type=2 where `otp_code` = '$otpinput'";
		$add_save = $this->conn->query($sql);

		if ($add_save) {
			$resp['status'] = 'success';
			$directlink_login = base_url . "dashboard/login.php";
			$resp['link'] = $directlink_login;
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}

		return json_encode($resp);
		exit;
	}

	public function forgot_pass()
	{
		extract($_POST);
		//$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'email'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$sqlchkotp = ("SELECT * FROM users WHERE username = '$email' ");
		$sqlchkotpo1 = $this->conn->query($sqlchkotp);
		$sqlchkotp1 = mysqli_fetch_assoc($sqlchkotpo1);
		$email = $sqlchkotp1['username'];
		$otpuser = $sqlchkotp1['otp_code'];

		$data1 = [
			"user_email" => "$email",
			"otp_no" => $otpuser
		];

		// Serialize the data as JSON
		$jsonData = json_encode($data1);

		$iv = openssl_random_pseudo_bytes(16);

		// Encrypt the JSON data
		$encryptedData = openssl_encrypt($jsonData, 'AES-256-CBC', $secretKey, 0, $iv);

		// Encode the encrypted data as a URL-safe string
		$token = base64_encode($iv . $encryptedData);

		// URL-encode the token for safe inclusion in a URL
		$encodedToken = urlencode($token);


		$otplinkk = base_url . "dashboard/reset-password.php?etoken=" . $encodedToken;


		$recipient_email = "$email"; // Change this to the recipient's Gmail address
		$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
		$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

		$mail = new PHPMailer(true);

		try {
			$mail->SMTPDebug = SMTP::DEBUG_OFF;
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			$mail->Username = $sender_email;
			$mail->Password = $sender_password;
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			$mail->setFrom($sender_email);
			$mail->addAddress($recipient_email);
			$mail->Subject = "JA1 Reset Password";
			$mail->Body = "Please proceed on this link to reset your password. Thank You <br>" . $otplinkk;

			$mail->send();
			$emailsent = "Email sent successfully.";
		} catch (Exception $e) {
			$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
		}



		$resp['status'] = 'success';
		$directlink_login = base_url . "dashboard/forgot-password-success.php";
		$resp['link'] = $directlink_login;


		return json_encode($resp);
		exit;
	}

	public function reset_pass()
	{
		extract($_POST);
		//$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id','password', 'confirmpassword','email','otp'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$sql = "UPDATE users set password=md5('" . addslashes(htmlentities($confirmpassword)) . "') where `otp_code` = '$otp' AND `username`='$email'";
    	$this->conn->query($sql);

		$resp['status'] = 'success';
		$directlink_login = base_url . "dashboard/login.php";
		$resp['link'] = $directlink_login;


		return json_encode($resp);
		exit;
	}

	/** =========== **/

	public function birthday_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'firstname', 'lastname', 'contactno', 'age', 'datewant', 'timewant', 'ttlguess', 'price', 'venueloc', 'gender', 'payment_type', 'birthdaytheme', 'off_minister'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$datetime = date("Y-m-d\\TH:i", strtotime($datewant . ' ' . $timewant));

		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name`='" . addslashes(htmlentities($firstname)) . "', `Celebrant_Name` = '" . addslashes(htmlentities($lastname)) . "' , `Contact_Number` = '" . addslashes(htmlentities($contactno)) . "' , `Age` = '" . addslashes(htmlentities($age)) . "' , `DateTime_Event` = '" . addslashes(htmlentities($datetime)) . "' , `Total_Guess` = '" . addslashes(htmlentities($ttlguess)) . "' , `Price` = '" . addslashes(htmlentities($price)) . "' , `Venue_Location` = '" . addslashes(htmlentities($venueloc)) . "' , `Gender` = '" . addslashes(htmlentities($gender)) . "', `Status` = '0', `Transaction_No` = '" . addslashes(htmlentities($Transaction_No)) . "', `Customer_Name` = '" . addslashes(htmlentities($Customer_Name)) . "' , `Birthday_Theme` = '" . addslashes(htmlentities($birthdaytheme)) . "' , `Officiating_Minister` = '" . addslashes(htmlentities($off_minister)) . "', `Event_Type` = 'Birthday Event', `customer_id` = '" . addslashes(htmlentities($Customer_ID)) . "' ";

		if (empty($id)) {
			$sql = "INSERT INTO tbl_birthday_event set $data";
		} else {
			$sql = "UPDATE tbl_birthday_event set {$data} where id = {$id}";
		}
		$add_save = $this->conn->query($sql);
		$action = empty($id) ? "added" : "updated";

		if ($payment_type == 'Walk-In') {
			if ($add_save) {
				$resp['status'] = 'success';
				$resp['event_type'] = 'Walk-In';
				$resp['message'] = " Birthday event successfully " . $action;
				$this->settings->set_flashdata('success', $resp['message']);
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		} else if ($payment_type == 'E-Wallet') {
			function generateRandomID($length = 10)
			{
				$characters = '0123456789aABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomID = '';

				for ($i = 0; $i < $length; $i++) {
					$randomID .= $characters[rand(0, strlen($characters) - 1)];
				}

				return $randomID;
			}

			$randomID = (string) generateRandomID(8);

			$eventType = 'Birthday Event';

			$directlink_return = "http://localhost/JA1/dashboard/?page=ja1_validation_payment&?Transaction_No=" . $Transaction_No . "&?Event_Type=" . $eventType;

			$client1 = new \GuzzleHttp\Client();

			$response1 = $client1->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
				'body' => '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":false,"payment_method_types":["gcash","grab_pay","paymaya","card"],"line_items":[{"currency":"PHP","amount":' . $price . '00,"name":"Donation","quantity":1,"description":"Payment for Birthday Event Jesus the Anointed One Church"}],"reference_number":"' . $randomID . '","success_url":"' . $directlink_return . '","description":"Payment for Birthday Event Jesus the Anointed One Church"}}}',
				'headers' => [
					'Content-Type' => 'application/json',
					'accept' => 'application/json',
					'authorization' => 'Basic c2tfdGVzdF9uRUhCY1V3MzdidEUybXZvNjZuVktzd0g6',
				],
			]);

			$dataasd = json_decode($response1->getBody(), true);
			if ($add_save) {
				$pmId = ($dataasd["data"]["id"]);
				$sqlpmId = "UPDATE tbl_birthday_event set `paymongo_id` = '$pmId' WHERE Transaction_No = '$Transaction_No'";
				$this->conn->query($sqlpmId);
				$resp['status'] = 'success';
				$urll = ($dataasd["data"]["attributes"]["checkout_url"]);
				$resp['link'] = $urll;
				$resp['event_type'] = 'E-Wallet';
				//header("Location: $urll");
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		}

		return json_encode($resp);
		exit;
	}

	public function pay_birthday_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Transaction_No', 'payment_type', 'price'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}
		/*if (!empty($data)) $data .= ", ";
		$data .= "`First_Name` = '" . addslashes(htmlentities($First_Name)) . "',`Last_Name` = '" . addslashes(htmlentities($Last_Name)) . "', `Contact_Number` = '" . addslashes(htmlentities($Contact_Number)) . "', `DateTime_Event` = '" . addslashes(htmlentities($date_created)) . "',`Catering_Service_Rent` = '" . addslashes(htmlentities($Catering_Service_Rent)) . "',`Food_Equipment_Rent` = '" . addslashes(htmlentities($Food_Equipment_Rent)) . "',`Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "',`Total_Guess` = '" . addslashes(htmlentities($Total_Guess)) . "', `Price` = '" . addslashes(htmlentities($price)) . "'";

		$sql = "UPDATE tbl_birthday_event set {$data} where id = {$id}";
		$add_save = $this->conn->query($sql);*/

		if ($payment_type == 'E-Wallet') {
			function generateRandomID($length = 10)
			{
				$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomID = '';

				for ($i = 0; $i < $length; $i++) {
					$randomID .= $characters[rand(0, strlen($characters) - 1)];
				}

				return $randomID;
			}

			$randomID = (string) generateRandomID(8);

			$eventType = 'Birthday Event';

			$directlink_return = base_url . "dashboard/?page=ja1_validation_payment&?Transaction_No=" . $Transaction_No . "&?Event_Type=" . $eventType;

			$client1 = new \GuzzleHttp\Client();

			$response1 = $client1->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
				'body' => '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":false,"payment_method_types":["gcash","grab_pay","paymaya","card"],"line_items":[{"currency":"PHP","amount":' . $price . '00,"name":"Donation","quantity":1,"description":"Payment for Birthday Event Jesus the Anointed One Church"}],"reference_number":"' . $randomID . '","success_url":"' . $directlink_return . '","description":"Payment for Birthday Event Jesus the Anointed One Church"}}}',
				'headers' => [
					'Content-Type' => 'application/json',
					'accept' => 'application/json',
					'authorization' => 'Basic c2tfdGVzdF9uRUhCY1V3MzdidEUybXZvNjZuVktzd0g6',
				],
			]);

			$dataasd = json_decode($response1->getBody(), true);
			if ($dataasd) {
				$pmId = ($dataasd["data"]["id"]);
				$sqlpmId = "UPDATE tbl_birthday_event set `paymongo_id` = '$pmId' WHERE Transaction_No = '$Transaction_No'";
				$this->conn->query($sqlpmId);
				$resp['status'] = 'success';
				$urll = ($dataasd["data"]["attributes"]["checkout_url"]);
				$resp['link'] = $urll;
				$resp['event_type'] = 'E-Wallet';
				//header("Location: $urll");
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		}
		return json_encode($resp);
		exit;
	}

	public function admin_birthday_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'status', 'Contact_Number', 'date_created', 'birthdaytheme', 'off_minister', 'Venue_Location', 'Total_Guess', 'price', 'gender'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}
		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name` = '" . addslashes(htmlentities($First_Name)) . "',`Celebrant_Name` = '" . addslashes(htmlentities($Last_Name)) . "', `Contact_Number` = '" . addslashes(htmlentities($Contact_Number)) . "', `DateTime_Event` = '" . addslashes(htmlentities($date_created)) . "',`Birthday_Theme` = '" . addslashes(htmlentities($birthdaytheme)) . "',`Officiating_Minister` = '" . addslashes(htmlentities($off_minister)) . "',`Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "',`Total_Guess` = '" . addslashes(htmlentities($Total_Guess)) . "', `Price` = '" . addslashes(htmlentities($price)) . "', `Gender` = '" . addslashes(htmlentities($gender)) . "',  `Status` = '" . addslashes(htmlentities($status)) . "', `tdy_rsrvtn_status`='1'";

		$sql = "UPDATE tbl_birthday_event set {$data} where id = {$id}";
		$add_save = $this->conn->query($sql);

		if ($add_save) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$Customer_ID'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Confirmation Event (Transaction No. :" . $Transaction_No . ")";
				$mail->Body = "Welcome to JA1 Church Mega Sanctuary <br><br> Your transaction no. <b>" . $Transaction_No . "</b> of birthday event was checked by the Staff of the JA1 Church. Please check at the Booking Details of your account in the website. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$resp['message'] = " Birthday event successfully updated";
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function user_birthday_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'Contact_Number', 'datewant', 'timewant', 'birthdaytheme', 'Venue_Location', 'Total_Guess', 'gender'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$datetime = date("Y-m-d\\TH:i", strtotime($datewant . ' ' . $timewant));

		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name` = '" . addslashes(htmlentities($First_Name)) . "',`Celebrant_Name` = '" . addslashes(htmlentities($Last_Name)) . "', `Contact_Number` = '" . addslashes(htmlentities($Contact_Number)) . "', `DateTime_Event` = '" . addslashes(htmlentities($datetime)) . "',`Birthday_Theme` = '" . addslashes(htmlentities($birthdaytheme)) . "',`Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "',`Total_Guess` = '" . addslashes(htmlentities($Total_Guess)) . "', `Gender` = '" . addslashes(htmlentities($gender)) . "'";

		$sql = "UPDATE tbl_birthday_event set {$data} where id = {$id}";
		$add_save = $this->conn->query($sql);

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Birthday event successfully updated";
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function wedding_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'Full_Name', 'Contact', 'target_marry_date', 'ques_inqs'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		//$Set_Appointment_Date = date("Y-m-d\\TH:i", strtotime($Set_Appointment_Date_Want . ' ' . $Set_Appointment_Time_Want));
		$target_marry_date = date("Y-m-d", strtotime($target_marry_date));
		

		if (!empty($data)) $data .= ", ";
		$data .= "`Contact`='" . addslashes(htmlentities($Contact)) . "', `Target_Marry_Date` = '" . addslashes(htmlentities($target_marry_date)) . "', `Status` = '0', `Transaction_No` = '" . addslashes(htmlentities($Transaction_No)) . "', `Customer_Name` = '" . addslashes(htmlentities($Full_Name)) . "', `Event_Type` = 'Wedding Event', `customer_id` = '" . addslashes(htmlentities($Customer_ID)) . "', `Ques_Inqs` = '" . addslashes(htmlentities($ques_inqs)) . "' ";

		if (empty($id)) {
			$sql = "INSERT INTO tbl_wedding_event set $data";
		} else {
			$sql = "UPDATE tbl_wedding_event set {$data} where id = {$id}";
		}
		$add_save = $this->conn->query($sql);
		$action = empty($id) ? "added" : "updated";

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Wedding event successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function admin_wedding_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'status', 'Bride_Name', 'Groom_Name', 'Set_Appointment_Date', 'address', 'price', 'Contact', 'target_marry_date', 'ques_inqs', 'off_minister'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}
		if (!empty($data)) $data .= ", ";
		$data .= "`Status` = '" . addslashes(htmlentities($status)) . "',`Bride_Name`='" . addslashes(htmlentities($Bride_Name)) . "', `Groom_Name` = '" . addslashes(htmlentities($Groom_Name)) . "' ,`Set_Appointment_Date` = '" . addslashes(htmlentities($Set_Appointment_Date)) . "', `Price` = '" . addslashes(htmlentities($price)) . "', `Address` = '" . addslashes(htmlentities($address)) . "', `tdy_rsrvtn_status`='1', `Contact` = '" . addslashes(htmlentities($Contact)) . "', `Target_Marry_Date` = '" . addslashes(htmlentities($target_marry_date)) . "', `Ques_Inqs` = '" . addslashes(htmlentities($ques_inqs)) . "', `Officiating_Minister` = '" . addslashes(htmlentities($off_minister)) . "' ";

		$sql = "UPDATE tbl_wedding_event set {$data} where id = {$id}";
		$add_save = $this->conn->query($sql);

		if ($add_save) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$Customer_ID'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Confirmation Event (Transaction No. :" . $Transaction_No . ")";
				$mail->Body = "Welcome to JA1 Church Mega Sanctuary <br><br> Your transaction no. <b>" . $Transaction_No . "</b> of wedding event was checked by the Staff of the JA1 Church. Please check at the Booking Details of your account in the website. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$resp['message'] = " Wedding event successfully updated";
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function user_wedding_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'Bride_Name', 'Groom_Name', 'Set_Appointment_Date_Want', 'Set_Appointment_Time_Want', 'Contact', 'target_marry_date', 'ques_inqs'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$Set_Appointment_Date = date("Y-m-d\\TH:i", strtotime($Set_Appointment_Date_Want . ' ' . $Set_Appointment_Time_Want));

		if (!empty($data)) $data .= ", ";
		$data .= "`Bride_Name`='" . addslashes(htmlentities($Bride_Name)) . "', `Groom_Name` = '" . addslashes(htmlentities($Groom_Name)) . "' ,`Set_Appointment_Date` = '" . addslashes(htmlentities($Set_Appointment_Date)) . "', `Contact` = '" . addslashes(htmlentities($Contact)) . "', `Target_Marry_Date` = '" . addslashes(htmlentities($target_marry_date)) . "', `Ques_Inqs` = '" . addslashes(htmlentities($ques_inqs)) . "' ";

		$sql = "UPDATE tbl_wedding_event set {$data} where id = {$id}";
		$add_save = $this->conn->query($sql);

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Wedding event successfully updated";
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function child_dedication_events()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'Contact_No', 'Address', 'Father_Name', 'Mother_Name', 'BirthCert_Child', 'MarriageCert_Guardian', 'Venue_Location','Set_Dedication_Date_Want','Set_Dedication_Time_Want', 'gender', 'Birthdate', 'Birthplace', 'Father_Province', 'Mother_Province', 'name_witnesses'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$Set_Appointment_Date = date("Y-m-d\\TH:i", strtotime($Set_Dedication_Date_Want . ' ' . $Set_Dedication_Time_Want));

		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name`='" . addslashes(htmlentities($First_Name)) . "', `Child_Name` = '" . addslashes(htmlentities($Last_Name)) . "' , `Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "' , `Address` = '" . addslashes(htmlentities($Address)) . "' , `GodFather_Name` = '" . addslashes(htmlentities($Father_Name)) . "' , `GodMother_Name`='" . addslashes(htmlentities($Mother_Name)) . "', `Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "' , `Gender` = '" . addslashes(htmlentities($gender)) . "', `Status` = '0', `Transaction_No` = '" . addslashes(htmlentities($Transaction_No)) . "', `DateTime_Event` = '" . addslashes(htmlentities($Set_Appointment_Date)) . "',`Customer_Name` = '" . addslashes(htmlentities($Customer_Name)) . "', `Event_Type` = 'Child Dedication Event', `customer_id` = '" . addslashes(htmlentities($Customer_ID)) . "', `Birthdate` = '" . addslashes(htmlentities($Birthdate)) . "' , `Birthplace` = '" . addslashes(htmlentities($Birthplace)) . "' , `Native_Prov_Father` = '" . addslashes(htmlentities($Father_Province)) . "' , `Native_Prov_Mother` = '" . addslashes(htmlentities($Mother_Province)) . "' , `Witnesses` = '" . addslashes(htmlentities($name_witnesses)) . "'  ";

		$birthcertpic = 'uploads/birth_certificate/' . time() . '_' . addslashes(htmlentities($First_Name)) . ' ' . addslashes(htmlentities($Last_Name)) . '-' . $_FILES['BirthCert_Child']['name'];
		$movebirth = move_uploaded_file($_FILES['BirthCert_Child']['tmp_name'], base_app . $birthcertpic);
		if ($movebirth) {
			$data .= " , `BirthCert_Child` = '{$birthcertpic}' ";
		}

		$marriagecertpic = 'uploads/marriage_certificate/' . time() . '_' . addslashes(htmlentities($First_Name)) . ' ' . addslashes(htmlentities($Last_Name)) . '-' . $_FILES['MarriageCert_Guardian']['name'];
		$movemarriage = move_uploaded_file($_FILES['MarriageCert_Guardian']['tmp_name'], base_app . $marriagecertpic);
		if ($movemarriage) {
			$data .= " , `MarriageCert_Guardian` = '{$marriagecertpic}' ";
		}

		if (empty($id)) {
			$sql = "INSERT INTO tbl_child_dedication_events set $data";
		} else {
			$sql = "UPDATE tbl_child_dedication_events set {$data} where id = {$id}";
		}
		$add_save = $this->conn->query($sql);
		$action = empty($id) ? "added" : "updated";

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Child Dedication Event successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function pay_child_dedication_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Transaction_No', 'payment_type', 'price'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		if ($payment_type == 'E-Wallet') {
			function generateRandomID($length = 10)
			{
				$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomID = '';

				for ($i = 0; $i < $length; $i++) {
					$randomID .= $characters[rand(0, strlen($characters) - 1)];
				}

				return $randomID;
			}

			$randomID = (string) generateRandomID(8);

			$eventType = 'Child Dedication Event';

			$directlink_return =  base_url . "dashboard/?page=ja1_validation_payment&?Transaction_No=" . $Transaction_No . "&?Event_Type=" . $eventType;

			$client1 = new \GuzzleHttp\Client();

			$response1 = $client1->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
				'body' => '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":false,"payment_method_types":["gcash","grab_pay","paymaya","card"],"line_items":[{"currency":"PHP","amount":' . $price . '00,"name":"Donation","quantity":1,"description":"Payment for Child Dedication Event Jesus the Anointed One Church"}],"reference_number":"' . $randomID . '","success_url":"' . $directlink_return . '","description":"Payment for Child Dedication Event Jesus the Anointed One Church"}}}',
				'headers' => [
					'Content-Type' => 'application/json',
					'accept' => 'application/json',
					'authorization' => 'Basic c2tfdGVzdF9uRUhCY1V3MzdidEUybXZvNjZuVktzd0g6',
				],
			]);

			$dataasd = json_decode($response1->getBody(), true);
			if ($dataasd) {
				$pmId = ($dataasd["data"]["id"]);
				$sqlpmId = "UPDATE tbl_child_dedication_events set `paymongo_id` = '$pmId' WHERE Transaction_No = '$Transaction_No'";
				$this->conn->query($sqlpmId);
				$resp['status'] = 'success';
				$urll = ($dataasd["data"]["attributes"]["checkout_url"]);
				$resp['link'] = $urll;
				$resp['event_type'] = 'E-Wallet';
				//header("Location: $urll");
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		}
		return json_encode($resp);
		exit;
	}


	public function admin_child_dedication_events()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'Contact_No', 'GodFather_Name', 'GodMother_Name', 'Venue_Location', 'Set_Event_Date', 'price', 'gender', 'Address', 'Birthdate', 'Birthplace', 'Father_Province', 'Mother_Province', 'name_witnesses', 'off_minister', 'status'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}
		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name`='" . addslashes(htmlentities($First_Name)) . "', `Child_Name` = '" . addslashes(htmlentities($Last_Name)) . "',`Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "' ,`GodFather_Name` = '" . addslashes(htmlentities($GodFather_Name)) . "' , `GodMother_Name`='" . addslashes(htmlentities($GodMother_Name)) . "', `Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "' , `DateTime_Event` = '" . addslashes(htmlentities($Set_Event_Date)) . "', `Price` = '" . addslashes(htmlentities($price)) . "', `Gender` = '" . addslashes(htmlentities($gender)) . "', `tdy_rsrvtn_status`='1', `Address` = '" . addslashes(htmlentities($Address)) . "', `Birthdate` = '" . addslashes(htmlentities($Birthdate)) . "' , `Birthplace` = '" . addslashes(htmlentities($Birthplace)) . "' , `Native_Prov_Father` = '" . addslashes(htmlentities($Father_Province)) . "' , `Native_Prov_Mother` = '" . addslashes(htmlentities($Mother_Province)) . "' , `Witnesses` = '" . addslashes(htmlentities($name_witnesses)) . "', `Officiating_Minister` = '" . addslashes(htmlentities($off_minister)) . "', `Status` = '" . addslashes(htmlentities($status)) . "'  ";

		$sql = "UPDATE tbl_child_dedication_events set {$data} where id = {$id}";
		$add_save = $this->conn->query($sql);

		if ($add_save) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$Customer_ID'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Confirmation Event (Transaction No. :" . $Transaction_No . ")";
				$mail->Body = "Welcome to JA1 Church Mega Sanctuary <br><br> Your transaction no. <b>" . $Transaction_No . "</b> of child dedication event was checked by the Staff of the JA1 Church. Please check at the Booking Details of your account in the website. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$resp['message'] = " Child Dedication event successfully updated";
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function user_child_dedication_events()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'Contact_No', 'GodFather_Name', 'GodMother_Name', 'BirthCert_Child', 'MarriageCert_Guardian', 'Venue_Location','Set_Dedication_Date_Want','Set_Dedication_Time_Want', 'gender', 'Address', 'Birthdate', 'Birthplace', 'Father_Province', 'Mother_Province', 'name_witnesses'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$Set_Appointment_Date = date("Y-m-d\\TH:i", strtotime($Set_Dedication_Date_Want . ' ' . $Set_Dedication_Time_Want));

		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name`='" . addslashes(htmlentities($First_Name)) . "', `Child_Name` = '" . addslashes(htmlentities($Last_Name)) . "',`Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "' ,`GodFather_Name` = '" . addslashes(htmlentities($GodFather_Name)) . "' , `GodMother_Name`='" . addslashes(htmlentities($GodMother_Name)) . "', `Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "', `DateTime_Event` = '" . addslashes(htmlentities($Set_Appointment_Date)) . "', `Gender` = '" . addslashes(htmlentities($gender)) . "', `Address` = '" . addslashes(htmlentities($Address)) . "', `Birthdate` = '" . addslashes(htmlentities($Birthdate)) . "' , `Birthplace` = '" . addslashes(htmlentities($Birthplace)) . "' , `Native_Prov_Father` = '" . addslashes(htmlentities($Father_Province)) . "' , `Native_Prov_Mother` = '" . addslashes(htmlentities($Mother_Province)) . "' , `Witnesses` = '" . addslashes(htmlentities($name_witnesses)) . "' ";

		$birthcertpic = 'uploads/birth_certificate/' . time() . '_' . addslashes(htmlentities($First_Name)) . ' ' . addslashes(htmlentities($Last_Name)) . '-' . $_FILES['BirthCert_Child']['name'];
		$movebirth = move_uploaded_file($_FILES['BirthCert_Child']['tmp_name'], base_app . $birthcertpic);
		if ($movebirth) {
			$data .= " , `BirthCert_Child` = '{$birthcertpic}' ";
		}

		$marriagecertpic = 'uploads/marriage_certificate/' . time() . '_' . addslashes(htmlentities($First_Name)) . ' ' . addslashes(htmlentities($Last_Name)) . '-' . $_FILES['MarriageCert_Guardian']['name'];
		$movemarriage = move_uploaded_file($_FILES['MarriageCert_Guardian']['tmp_name'], base_app . $marriagecertpic);
		if ($movemarriage) {
			$data .= " , `MarriageCert_Guardian` = '{$marriagecertpic}' ";
		}

		$sql = "UPDATE tbl_child_dedication_events set {$data} where id = {$id}";
		$add_save = $this->conn->query($sql);

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Child Dedication event successfully updated";
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function funeral_service()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'Contact_No', 'Date_Funeral_S', 'Time_Funeral_S', 'Cause_Death', 'Venue_Location', 'gender'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$DateTime_Event = date("Y-m-d\\TH:i", strtotime($Date_Funeral_S . ' ' . $Time_Funeral_S));

		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name`='" . addslashes(htmlentities($First_Name)) . "', `Deceased_Name` = '" . addslashes(htmlentities($Last_Name)) . "' , `Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "', `DateTime_Event` = '" . addslashes(htmlentities($DateTime_Event)) . "' , `Cause_Death`='" . addslashes(htmlentities($Cause_Death)) . "', `Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "' , `Gender` = '" . addslashes(htmlentities($gender)) . "', `Status` = '0', `Transaction_No` = '" . addslashes(htmlentities($Transaction_No)) . "', `Customer_Name` = '" . addslashes(htmlentities($Customer_Name)) . "', `Event_Type` = 'Funeral Service', `customer_id` = '" . addslashes(htmlentities($Customer_ID)) . "' ";

		if (empty($id)) {
			$sql = "INSERT INTO tbl_funeral_service set $data";
		} else {
			$sql = "UPDATE tbl_funeral_service set {$data} where id = {$id}";
		}
		$add_save = $this->conn->query($sql);
		$action = empty($id) ? "added" : "updated";

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Funeral Service successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function pay_funeral_s()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Transaction_No', 'payment_type', 'price'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		if ($payment_type == 'E-Wallet') {
			function generateRandomID($length = 10)
			{
				$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomID = '';

				for ($i = 0; $i < $length; $i++) {
					$randomID .= $characters[rand(0, strlen($characters) - 1)];
				}

				return $randomID;
			}

			$randomID = (string) generateRandomID(8);

			$eventType = 'Funeral Service';

			$directlink_return =  base_url . "dashboard/?page=ja1_validation_payment&?Transaction_No=" . $Transaction_No . "&?Event_Type=" . $eventType;

			$client1 = new \GuzzleHttp\Client();

			$response1 = $client1->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
				'body' => '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":false,"payment_method_types":["gcash","grab_pay","paymaya","card"],"line_items":[{"currency":"PHP","amount":' . $price . '00,"name":"Donation","quantity":1,"description":"Payment for Funeral Service Event Jesus the Anointed One Church"}],"reference_number":"' . $randomID . '","success_url":"' . $directlink_return . '","description":"Payment for Funeral Service Event Jesus the Anointed One Church"}}}',
				'headers' => [
					'Content-Type' => 'application/json',
					'accept' => 'application/json',
					'authorization' => 'Basic c2tfdGVzdF9uRUhCY1V3MzdidEUybXZvNjZuVktzd0g6',
				],
			]);

			$dataasd = json_decode($response1->getBody(), true);
			if ($dataasd) {
				$pmId = ($dataasd["data"]["id"]);
				$sqlpmId = "UPDATE tbl_funeral_service set `paymongo_id` = '$pmId' WHERE Transaction_No = '$Transaction_No'";
				$this->conn->query($sqlpmId);
				$resp['status'] = 'success';
				$urll = ($dataasd["data"]["attributes"]["checkout_url"]);
				$resp['link'] = $urll;
				$resp['event_type'] = 'E-Wallet';
				//header("Location: $urll");
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		}
		return json_encode($resp);
		exit;
	}

	public function admin_funeral_service()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'Contact_No', 'DateTime_Death', 'Cause_Death', 'gender', 'Venue_Location', 'price', 'off_minister', 'status'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}
		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name`='" . addslashes(htmlentities($First_Name)) . "', `Deceased_Name` = '" . addslashes(htmlentities($Last_Name)) . "' , `Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "', `Cause_Death`='" . addslashes(htmlentities($Cause_Death)) . "', `DateTime_Event`='" . addslashes(htmlentities($DateTime_Death)) . "', `Venue_Location`='" . addslashes(htmlentities($Venue_Location)) . "', `Price` = '" . addslashes(htmlentities($price)) . "', `Gender` = '" . addslashes(htmlentities($gender)) . "', `tdy_rsrvtn_status`='1', `Officiating_Minister` = '" . addslashes(htmlentities($off_minister)) . "', `Status` = '" . addslashes(htmlentities($status)) . "' ";


		$sql = "UPDATE tbl_funeral_service set {$data} where id = {$id}";

		$add_save = $this->conn->query($sql);
		$action = "updated";

		if ($add_save) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$Customer_ID'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Confirmation Funeral Service (Transaction No. :" . $Transaction_No . ")";
				$mail->Body = "Welcome to JA1 Church Mega Sanctuary <br><br> Your transaction no. <b>" . $Transaction_No . "</b> of funeral service was checked by the Staff of the JA1 Church. Please check at the Booking Details of your account in the website. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$resp['message'] = " Funeral Service successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function user_funeral_service()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'First_Name', 'Last_Name', 'Contact_No', 'Date_Funeral_S', 'Time_Funeral_S', 'Cause_Death', 'Venue_Location', 'gender'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$DateTime_Event = date("Y-m-d\\TH:i", strtotime($Date_Funeral_S . ' ' . $Time_Funeral_S));

		if (!empty($data)) $data .= ", ";
		$data .= "`Full_Name`='" . addslashes(htmlentities($First_Name)) . "', `Deceased_Name` = '" . addslashes(htmlentities($Last_Name)) . "' , `Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "', `DateTime_Event` = '" . addslashes(htmlentities($DateTime_Event)) . "' , `Cause_Death`='" . addslashes(htmlentities($Cause_Death)) . "', `Venue_Location`='" . addslashes(htmlentities($Venue_Location)) . "', `Gender` = '" . addslashes(htmlentities($gender)) . "' ";


		$sql = "UPDATE tbl_funeral_service set {$data} where id = {$id}";

		$add_save = $this->conn->query($sql);
		$action = "updated";

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Funeral Service successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function blessing_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'Owner_Name', 'Contact_No', 'Fb_Name', 'Total_Guess', 'Date_Blessing', 'Time_Blessing', 'Price', 'Blessing_Type', 'Venue_Location', 'payment_type'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$DateTime_Blessing = date("Y-m-d\\TH:i", strtotime($Date_Blessing . ' ' . $Time_Blessing));

		if (!empty($data)) $data .= ", ";
		$data .= "`Owner_Name`='" . addslashes(htmlentities($Owner_Name)) . "', `Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "' , `Fb_Name` = '" . addslashes(htmlentities($Fb_Name)) . "' , `Total_Guess`='" . addslashes(htmlentities($Total_Guess)) . "', `DateTime_Blessing`='" . addslashes(htmlentities($DateTime_Blessing)) . "',  `Price`='" . addslashes(htmlentities($Price)) . "', `Blessing_Type`='" . addslashes(htmlentities($Blessing_Type)) . "', `Venue_Location` = '" . addslashes(htmlentities($Venue_Location)) . "' , `Status` = '0', `Transaction_No` = '" . addslashes(htmlentities($Transaction_No)) . "', `Customer_Name` = '" . addslashes(htmlentities($Customer_Name)) . "', `Event_Type` = 'Blessing Event', `customer_id` = '" . addslashes(htmlentities($Customer_ID)) . "' ";

		if (empty($id)) {
			$sql = "INSERT INTO tbl_blessing_event set $data";
		} else {
			$sql = "UPDATE tbl_blessing_event set {$data} where id = {$id}";
		}
		$add_save = $this->conn->query($sql);
		$action = empty($id) ? "added" : "updated";

		if ($payment_type == 'Walk-In') {
			if ($add_save) {
				$resp['status'] = 'success';
				$resp['event_type'] = 'Walk-In';
				$resp['message'] = " Blessing Event successfully " . $action;
				$this->settings->set_flashdata('success', $resp['message']);
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		} else if ($payment_type == 'E-Wallet') {
			function generateRandomID($length = 10)
			{
				$characters = '0123456789aABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomID = '';

				for ($i = 0; $i < $length; $i++) {
					$randomID .= $characters[rand(0, strlen($characters) - 1)];
				}

				return $randomID;
			}

			$randomID = (string) generateRandomID(8);

			$eventType = 'Blessing Event';

			$directlink_return = "http://localhost/JA1/dashboard/?page=ja1_validation_payment&?Transaction_No=" . $Transaction_No . "&?Event_Type=" . $eventType;

			$client1 = new \GuzzleHttp\Client();

			$response1 = $client1->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
				'body' => '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":false,"payment_method_types":["gcash","grab_pay","paymaya","card"],"line_items":[{"currency":"PHP","amount":' . $Price . '00,"name":"Donation","quantity":1,"description":"Payment for Blessing Event Jesus the Anointed One Church"}],"reference_number":"' . $randomID . '","success_url":"' . $directlink_return . '","description":"Payment for Blessing Event Jesus the Anointed One Church"}}}',
				'headers' => [
					'Content-Type' => 'application/json',
					'accept' => 'application/json',
					'authorization' => 'Basic c2tfdGVzdF9uRUhCY1V3MzdidEUybXZvNjZuVktzd0g6',
				],
			]);

			$dataasd = json_decode($response1->getBody(), true);
			if ($add_save) {
				$pmId = ($dataasd["data"]["id"]);
				$sqlpmId = "UPDATE tbl_blessing_event set `paymongo_id` = '$pmId' WHERE Transaction_No = '$Transaction_No'";
				$this->conn->query($sqlpmId);
				$resp['status'] = 'success';
				$urll = ($dataasd["data"]["attributes"]["checkout_url"]);
				$resp['link'] = $urll;
				$resp['event_type'] = 'E-Wallet';
				//header("Location: $urll");
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		}

		return json_encode($resp);
		exit;
	}

	public function pay_blessing_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Transaction_No', 'payment_type', 'price'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		if ($payment_type == 'E-Wallet') {
			function generateRandomID($length = 10)
			{
				$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomID = '';

				for ($i = 0; $i < $length; $i++) {
					$randomID .= $characters[rand(0, strlen($characters) - 1)];
				}

				return $randomID;
			}

			$randomID = (string) generateRandomID(8);

			$eventType = 'Blessing Event';

			$directlink_return =  base_url . "dashboard/?page=ja1_validation_payment&?Transaction_No=" . $Transaction_No . "&?Event_Type=" . $eventType;

			$client1 = new \GuzzleHttp\Client();

			$response1 = $client1->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
				'body' => '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":false,"payment_method_types":["gcash","grab_pay","paymaya","card"],"line_items":[{"currency":"PHP","amount":' . $price . '00,"name":"Donation","quantity":1,"description":"Payment for Blessing Event Jesus the Anointed One Church"}],"reference_number":"' . $randomID . '","success_url":"' . $directlink_return . '","description":"Payment for Blessing Event Jesus the Anointed One Church"}}}',
				'headers' => [
					'Content-Type' => 'application/json',
					'accept' => 'application/json',
					'authorization' => 'Basic c2tfdGVzdF9uRUhCY1V3MzdidEUybXZvNjZuVktzd0g6',
				],
			]);

			$dataasd = json_decode($response1->getBody(), true);
			if ($dataasd) {
				$pmId = ($dataasd["data"]["id"]);
				$sqlpmId = "UPDATE tbl_funeral_service set `paymongo_id` = '$pmId' WHERE Transaction_No = '$Transaction_No'";
				$this->conn->query($sqlpmId);
				$resp['status'] = 'success';
				$urll = ($dataasd["data"]["attributes"]["checkout_url"]);
				$resp['link'] = $urll;
				$resp['event_type'] = 'E-Wallet';
				//header("Location: $urll");
			} else {
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
				$resp['message'] = " error:" . $sql;
			}
		}
		return json_encode($resp);
		exit;
	}


	public function admin_blessing_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'Owner_Name', 'Blessing_Type', 'Contact_No', 'DateTime_Blessing', 'Venue_Location', 'price', 'off_minister', 'status'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}
		if (!empty($data)) $data .= ", ";
		$data .= "`Owner_Name`='" . addslashes(htmlentities($Owner_Name)) . "', `Blessing_Type` = '" . addslashes(htmlentities($Blessing_Type)) . "' , `Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "', `DateTime_Blessing` = '" . addslashes(htmlentities($DateTime_Blessing)) . "' , `Venue_Location`='" . addslashes(htmlentities($Venue_Location)) . "', `Price` = '" . addslashes(htmlentities($price)) . "', `Officiating_Minister` = '" . addslashes(htmlentities($off_minister)) . "', `tdy_rsrvtn_status`='1', `Status` = '" . addslashes(htmlentities($status)) . "' ";


		$sql = "UPDATE tbl_blessing_event set {$data} where id = {$id}";

		$add_save = $this->conn->query($sql);
		$action = "updated";

		if ($add_save) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$Customer_ID'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Confirmation Event (Transaction No. :" . $Transaction_No . ")";
				$mail->Body = "Welcome to JA1 Church Mega Sanctuary <br><br> Your transaction no. <b>" . $Transaction_No . "</b> of blessing event was checked by the Staff of the JA1 Church. Please check at the Booking Details of your account in the website. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$resp['message'] = " Blessing Event successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function user_blessing_event()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'Customer_Name', 'Customer_ID', 'Transaction_No', 'Owner_Name', 'Blessing_Type', 'Contact_No', 'Date_Blessing', 'Time_Blessing', 'Venue_Location'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		$DateTime_Blessing = date("Y-m-d\\TH:i", strtotime($Date_Blessing . ' ' . $Time_Blessing));

		if (!empty($data)) $data .= ", ";
		$data .= "`Owner_Name`='" . addslashes(htmlentities($Owner_Name)) . "', `Blessing_Type` = '" . addslashes(htmlentities($Blessing_Type)) . "' , `Contact_No` = '" . addslashes(htmlentities($Contact_No)) . "', `DateTime_Blessing` = '" . addslashes(htmlentities($DateTime_Blessing)) . "' , `Venue_Location`='" . addslashes(htmlentities($Venue_Location)) . "' ";


		$sql = "UPDATE tbl_blessing_event set {$data} where id = {$id}";

		$add_save = $this->conn->query($sql);
		$action = "updated";

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Blessing Event successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}

	public function send_donation()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('amount'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}

		function generateRandomID($length = 10)
		{
			$characters = '0123456789aABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomID = '';

			for ($i = 0; $i < $length; $i++) {
				$randomID .= $characters[rand(0, strlen($characters) - 1)];
			}

			return $randomID;
		}

		$randomID = (string) generateRandomID(8);

		$client = new \GuzzleHttp\Client();

		$directl =  base_url . "dashboard/?page=ja1_churchdonation";

		$response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
			'body' => '{"data":{"attributes":{"send_email_receipt":false,"show_description":true,"show_line_items":false,"payment_method_types":["gcash","grab_pay","paymaya","card"],"line_items":[{"currency":"PHP","amount":' . $amount . '00,"name":"Donation","quantity":1,"description":"Donation for Jesus the Anointed One Church"}],"reference_number":"' . $randomID . '","success_url":"' . $directl . '","description":"Donation for Jesus the Anointed One Church"}}}',
			'headers' => [
				'Content-Type' => 'application/json',
				'accept' => 'application/json',
				'authorization' => 'Basic c2tfdGVzdF9uRUhCY1V3MzdidEUybXZvNjZuVktzd0g6',
			],
		]);

		$dataasd = json_decode($response->getBody(), true);

		$urll = ($dataasd["data"]["attributes"]["checkout_url"]);
		//if($urll){
		$resp['status'] = 'success';
		$resp['link'] = $urll;

		/*$resp['message'] = " Donation for JA1 successfully ";
			$this->settings->set_flashdata('success', $resp['message']);
		}else{
			$resp['status'] = 'failed';
			$resp['message'] = " Donation for JA1 failed ";
			$this->settings->set_flashdata('success', $resp['message']);
		}*/


		return json_encode($resp);
		exit;
		header("Location: $urll");
	}


	function delete_birtday_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_birthday_event` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Cancelled Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of birthday event was cancelled by the Staff of the JA1 Church. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of birthday event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_wedding_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_wedding_event` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Cancelled Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of wedding event was cancelled by the Staff of the JA1 Church. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of wedding event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_blessing_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_blessing_event` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Cancelled Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of blessing event was cancelled by the Staff of the JA1 Church. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of blessing event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_child_dedication_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_child_dedication_events` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Cancelled Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of child dedication event was cancelled by the Staff of the JA1 Church. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of child dedication event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function delete_funeral_s_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_funeral_service` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Cancelled Funeral Service (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of funeral service was cancelled by the Staff of the JA1 Church. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of funeral service successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function user_delete_birtday_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_birthday_event` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Cancelled Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of birthday event was cancelled by the Staff of the JA1 Church. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of birthday event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function user_delete_wedding_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_wedding_event` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Deleted Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of wedding event was deleted. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of wedding event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function user_delete_blessing_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_blessing_event` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Deleted Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of blessing event was deleted. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of blessing event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function user_delete_child_dedication_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_child_dedication_events` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Deleted Event (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of child dedication event was deleted. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of child dedication event successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function user_delete_funeral_s_record()
	{
		extract($_POST);
		$customertn = $name;
		$customerid = $custid;

		$del = $this->conn->query("DELETE FROM `tbl_funeral_service` where id = '{$id}'");
		if ($del) {
			$sqlchkem = ("SELECT * FROM users WHERE id = '$customerid'");
			$sqlchkem1 = $this->conn->query($sqlchkem);
			$sqlchkem1r = mysqli_fetch_assoc($sqlchkem1);
			$gmailem = $sqlchkem1r['username'];

			$recipient_email = "$gmailem"; // Change this to the recipient's Gmail address
			$sender_email = "ja1mainreservation@gmail.com"; // Your Gmail address
			$sender_password = "jftx esbf yicw lajo"; // Your Gmail password

			$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = SMTP::DEBUG_OFF;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->IsHTML(true);
				$mail->Username = $sender_email;
				$mail->Password = $sender_password;
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;

				$mail->setFrom($sender_email);
				$mail->addAddress($recipient_email);
				$mail->Subject = "Deleted Funeral Service (Transaction No. :" . $customertn . ")";
				$mail->Body = "Hello with the Transaction No. <b>" . $customertn . "</b> of funeral service was deleted. Please create again of that said event. <br><br> Thank you";

				$mail->send();
				$emailsent = "Email sent successfully.";
			} catch (Exception $e) {
				$emailsenterr = "Email could not be sent. Error: {$mail->ErrorInfo}";
			}

			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "  <b>" . $customertn . "</b> of funeral service successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	public function add_church_clndr_admin(){
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'colorpick', 'title', 'start_datetime', 'end_datetime'))) {
				if (!empty($data)) $data .= ", ";
				$data .= "'$k' = '$v'";
			}
		}
		

		if (!empty($data)) $data .= ", ";
		$data .= "`title`='" . addslashes(htmlentities($title)) . "', `start` = '" . addslashes(htmlentities($start_datetime)) . "', `end` = '" . addslashes(htmlentities($end_datetime)) . "', `color` = '" . addslashes(htmlentities($colorpick)) . "' ";

		if (empty($id)) {
			$sql = "INSERT INTO events set $data";
		} else {
			$sql = "UPDATE events set {$data} where id = {$id}";
		}
		$add_save = $this->conn->query($sql);
		$action = empty($id) ? "added" : "updated";

		if ($add_save) {
			$resp['status'] = 'success';
			$resp['message'] = " Church Calendar successfully " . $action;
			$this->settings->set_flashdata('success', $resp['message']);
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			$resp['message'] = " error:" . $sql;
		}
		return json_encode($resp);
		exit;
	}
}

$Content = new Content();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'update':
		echo $Content->update();
		break;

	case 'registration':
		echo $Content->registration();
		break;

	case 'register_confirmation':
		echo $Content->register_confirmation();
		break;

	case 'forgot_pass':
		echo $Content->forgot_pass();
		break;
		
	case 'reset_pass':
		echo $Content->reset_pass();
		break;

	case 'send_donation':
		echo $Content->send_donation();
		break;

	case 'birthday_event':
		echo $Content->birthday_event();
		break;

	case 'pay_birthday_event':
		echo $Content->pay_birthday_event();
		break;

	case 'admin_birthday_event':
		echo $Content->admin_birthday_event();
		break;

	case 'user_birthday_event':
		echo $Content->user_birthday_event();
		break;

	case 'wedding_event':
		echo $Content->wedding_event();
		break;

	case 'admin_wedding_event':
		echo $Content->admin_wedding_event();
		break;

	case 'user_wedding_event':
		echo $Content->user_wedding_event();
		break;

	case 'child_dedication_events':
		echo $Content->child_dedication_events();
		break;

	case 'pay_child_dedication_event':
		echo $Content->pay_child_dedication_event();
		break;

	case 'admin_child_dedication_events':
		echo $Content->admin_child_dedication_events();
		break;

	case 'user_child_dedication_events':
		echo $Content->user_child_dedication_events();
		break;

	case 'funeral_service':
		echo $Content->funeral_service();
		break;

	case 'pay_funeral_s':
		echo $Content->pay_funeral_s();
		break;

	case 'admin_funeral_service':
		echo $Content->admin_funeral_service();
		break;

	case 'user_funeral_service':
		echo $Content->user_funeral_service();
		break;

	case 'blessing_event':
		echo $Content->blessing_event();
		break;

	case 'pay_blessing_event':
		echo $Content->pay_blessing_event();
		break;

	case 'admin_blessing_event':
		echo $Content->admin_blessing_event();
		break;

	case 'user_blessing_event':
		echo $Content->user_blessing_event();
		break;

	case 'delete_birtday_record':
		echo $Content->delete_birtday_record();
		break;

	case 'delete_wedding_record':
		echo $Content->delete_wedding_record();
		break;

	case 'delete_blessing_record':
		echo $Content->delete_blessing_record();
		break;

	case 'delete_child_dedication_record':
		echo $Content->delete_child_dedication_record();
		break;

	case 'delete_funeral_s_record':
		echo $Content->delete_funeral_s_record();
		break;

	case 'user_delete_birtday_record':
		echo $Content->user_delete_birtday_record();
		break;

	case 'user_delete_wedding_record':
		echo $Content->user_delete_wedding_record();
		break;

	case 'user_delete_blessing_record':
		echo $Content->user_delete_blessing_record();
		break;

	case 'user_delete_child_dedication_record':
		echo $Content->user_delete_child_dedication_record();
		break;

	case 'user_delete_funeral_s_record':
		echo $Content->user_delete_funeral_s_record();
		break;

	case 'add_church_clndr_admin':
		echo $Content->add_church_clndr_admin();
		break;



	default:
		// echo $sysset->index();
		break;
}
