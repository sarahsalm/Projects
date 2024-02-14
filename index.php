<?php 


	require_once 'includes/DbOperation.php';
	
	$response = array(); 

	//// http://----Ur IP Address ---/heroapi/HeroApi/v1/?op=addheroes
	
	if(isset($_GET['op'])){
		
		switch($_GET['op']){
			

				/// Check URL and testing API
				/// http://=======Enter your IP Address------ /heroapi/HeroApi/v1/?op=addheroes
				/// Require POST
			case 'addheroes':
				if(isset($_POST['name']) && isset($_POST['role'])){
					$db = new DbOperation(); 
					if($db->createHeroes($_POST['name'], $_POST['role'])){
						$response['error'] = false;
						$response['message'] = 'Artist added successfully';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add artist';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 
			
			////http://----Enter your IP Address -----/heroapi/HeroApi/v1/?op=getheroes
			////Require GET
			case 'getheroes':
				$db = new DbOperation();
				$hero = $db->getHeroes();
				if(count($hero)<=0){
					$response['error'] = true; 
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false; 
					$response['hero'] = $hero;
				}
			break; 
			case 'login':
				if(isset($_POST['email']) && isset($_POST['password'])){
				$db = new DbOperation();
				$user = $db->login($_POST['email'], $_POST['password']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break; 
			case 'signUp':
				if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone'])){
					$key = "";
					if(isset($_POST['secretKey'])){
						$key = $_POST['secretKey'];
					}
				$db = new DbOperation();
				if($db->signUp($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['password'],$_POST['phone'],$key)){
					$response['error'] = false;
					$response['message'] = 'user added successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add user';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break; 
			case 'getUserInfo':
				if(isset($_POST['id'])){
				$db = new DbOperation();
				$user = $db->getUserInfo($_POST['id']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'getSecretKey':
				if(isset($_POST['id'])){
				$db = new DbOperation();
				$user = $db->getSecretKey($_POST['id']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'addAddress':
				if(isset($_POST['id']) && isset($_POST['city']) && isset($_POST['country'])){
					
				$db = new DbOperation();
				if($db->addAddress($_POST['id'],$_POST['country'],$_POST['city'],$_POST['address1'],$_POST['address2'],$_POST['building'],$_POST['floor'],$_POST['depno'])){
					$response['error'] = false;
					$response['message'] = 'Address added successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add address';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'getUserAddress':
				if(isset($_POST['id'])){
				$db = new DbOperation();
				$user = $db->getUserAddress($_POST['id']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user address not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'updateAddress':
				if(isset($_POST['rowID']) && isset($_POST['id']) && isset($_POST['city']) && isset($_POST['country'])){
					
				$db = new DbOperation();
				if($db->updateAddress($_POST['rowID'],$_POST['id'],$_POST['country'],$_POST['city'],$_POST['address1'],$_POST['address2'],$_POST['building'],$_POST['floor'],$_POST['depno'])){
					$response['error'] = false;
					$response['message'] = 'Address updated successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add address';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'getSecretKey':
				if(isset($_POST['id'])){
				$db = new DbOperation();
				$user = $db->getSecretKey($_POST['id']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user address not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'addSecretKey':
				if(isset($_POST['id']) && isset($_POST['secretKey'])){
					
				$db = new DbOperation();
				if($db->addSecretKey($_POST['id'],$_POST['secretKey'])){
					$response['error'] = false;
					$response['message'] = 'Address added successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add address';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'addFinanicalInfo':
				if(isset($_POST['userID']) && isset($_POST['cardType']) && isset($_POST['cardName']) && isset($_POST['cardNumber'])
				&& isset($_POST['expiryDate']) && isset($_POST['CVV'])){
					
				$db = new DbOperation();
				if($db->addFinanicalInfo($_POST['userID'],$_POST['cardType'],$_POST['cardName'],$_POST['cardNumber'],$_POST['expiryDate'],
				$_POST['CVV'])){
					$response['error'] = false;
					$response['message'] = 'Finanical added successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add Finanical';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'getUserFinanical':
				if(isset($_POST['id'])){
				$db = new DbOperation();
				$user = $db->getUserFinanical($_POST['id']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user finanical not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			
			case 'updateFinanicalInfo':
				if(isset($_POST['rowID']) && isset($_POST['userID']) && isset($_POST['cardType']) && isset($_POST['cardName']) && isset($_POST['cardNumber'])){
					
				$db = new DbOperation();
				if($db->updateFinanicalInfo($_POST['rowID'],$_POST['userID'],$_POST['cardType'],$_POST['cardName'],$_POST['cardNumber'],$_POST['expiryDate'],
				$_POST['CVV'])){
					$response['error'] = false;
					$response['message'] = 'finanical updated successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add finanical';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			case 'getTransaction':
				if(isset($_POST['id'])){
				$db = new DbOperation();
				$user = $db->getTransaction($_POST['id']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user transaction not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break;
			 case 'getOTP':
				if(isset($_POST['id'])){
				$db = new DbOperation();
				$user = $db->getOTP($_POST['id']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user OTP not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break;
			case 'addOTP':
				if(isset($_POST['trID']) && isset($_POST['OTP'])) {
					
				$db = new DbOperation();
				if($db->addOTP($_POST['trID'],$_POST['OTP'])){
					$response['error'] = false;
					$response['message'] = 'otp added successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add otp';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			 case 'getDesiredCard':
				if(isset($_POST['id']) && isset($_POST['cardType'])){
				$db = new DbOperation();
				$user = $db->getDesiredCard($_POST['id'],$_POST['cardType']);
				if(count($user)<=0){
					$response['error'] = true; 
					$response['user'] = 'user OTP not found';
				}else{
					$response['error'] = false; 
					$response['user'] = $user;
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break;
			case 'addAcceptTransaction':
				if(isset($_POST['userID']) && isset($_POST['trID']) && isset($_POST['cardID']) && isset($_POST['cardType']) && isset($_POST['cardNumber'])) {
					
				$db = new DbOperation();
				if($db->addAcceptTransaction($_POST['userID'],$_POST['trID'],$_POST['cardID'],$_POST['cardType'],$_POST['cardNumber'])){
					$response['error'] = false;
					$response['message'] = 'accept added successfully';
				}else{
					$response['error'] = true;
					$response['message'] = 'Could not add accept';
				}
			}
				else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}

			break;
			default:
				$response['error'] = true;
				$response['message'] = 'No operation to perform';
			
		}
		
	}else{
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}

	if(isset($_POST['secKey'])){
		$ecommerce = 'amazon';
		$db = new DbOperation();
		$d = $db->checkSecFromEcomm($_POST['secKey'],$ecommerce,$_POST['card']);
		if($d == ""){
			header('Location: buyPage.html');
		}
		else{
			header('Location: OTPAuth.php');
		}
		return;
	}

	if(isset($_POST['txtotp'])){
		$db = new DbOperation();
		$result = $db->verfiyOTP($_POST['txtotp']);
		if(count($result)<=0){
			header('Location: OTPAuth.php?error=true');
		}
		else{
			
			$cardInfo = $db->getCardInfo($result['trID'],$result['userID']);
			if(count($cardInfo)<=0){
				header('Location: OTPAuth.php?error=true1');
			}
			else{
				for ($i=0; $i < count($cardInfo); $i++) { 
					echo'<h2> Card type is : '.$cardInfo[$i]['cardType'] . "</h2>  "; 
					echo'<h2> Card Number is : '.$cardInfo[$i]['cardNumber'] . "</h2><br/>"; 
				}

				//header('Location: OTPAuth.php?error=false');
			}

		
			//header('Location: OTPAuth.php?error=false');
		}
		return;
	}
	
	if(isset($_GET['id'])){
		echo $_GET['id'];
		return;
	}
	
	echo json_encode($response);