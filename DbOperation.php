<?php

class DbOperation {
    private $con;
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

	public function createHeroes($name, $role){
		$stmt = $this->con->prepare("INSERT INTO `hero` (`name`, `role`) VALUES (?, ?);");
		$stmt->bind_param("ss",$name, $role);
		if($stmt->execute())
			return true; 
		return false; 
	}

	public function login($email,$pass){
		$stmt = $this->con->prepare("SELECT id from users_information where email = ? and password = ?");
		$stmt->bind_param("ss",$email, $pass);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($id);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
		 array_push($userInfo, $temp);
	}
	//echo "select id from users_information where email = '$email' and password = '$pass'";
		return $userInfo;
	}

	public function getUserInfo($userid){
		$stmt = $this->con->prepare("SELECT firstName,lastName,email,phone from users_information where id = ?");
		$stmt->bind_param("s",$userid);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($fname,$lname,$email,$phone);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['firstName'] = $fname; 
			$temp['lastName'] = $lname; 
			$temp['email'] = $email; 
			$temp['phone'] = $phone; 
		 array_push($userInfo, $temp);
	}
	//echo "select id from users_information where email = '$email' and password = '$pass'";
		return $userInfo;
	}
	

	public function signUp($fname,$lname,$email,$password,$phone,$secretkey){
		$stmt = $this->con->prepare("INSERT INTO `users_information` (`firstName`, `lastName`,`email`,`phone`,`password`,`secretKey`) VALUES (?, ?, ?, ? , ? , ?);");
		$stmt->bind_param("ssssss",$fname, $lname,$email,$phone,$password,$secretkey);
		if($stmt->execute())
			return true; 
		return false; 
	}

	public function addAddress($id,$country,$city,$address1,$address2,$building,$floor,$depno){
		$stmt = $this->con->prepare("INSERT INTO `address` (`userID`, `country`,`city`,`streetAddress1`,`streetAddress2`,`building`,`floor`,`depNo`) VALUES (?, ?, ?, ? , ? , ?,?,?);");
		$stmt->bind_param("ssssssss",$id,$country,$city,$address1,$address2,$building,$floor,$depno);
		if($stmt->execute())
			return true; 
		return false; 
	}

	public function getUserAddress($userid){
		$stmt = $this->con->prepare("SELECT id , country,city,streetAddress1,streetAddress2,building,floor,depNo from `address` where userID = ?");
		$stmt->bind_param("s",$userid);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($id,$country,$city,$streetAddress1,$streetAddress2,$building,$floor,$depNo);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['country'] = $country; 
			$temp['city'] = $city; 
			$temp['streetAddress1'] = $streetAddress1; 
			$temp['streetAddress2'] = $streetAddress2; 
			$temp['building'] = $building; 
			$temp['floor'] = $floor; 
			$temp['depNo'] = $depNo; 
		 array_push($userInfo, $temp);
	}
	//echo "select id from users_information where email = '$email' and password = '$pass'";
		return $userInfo;
	}
	public function updateAddress($id,$userID,$country,$city,$address1,$address2,$building,$floor,$depno){
		$stmt = $this->con->prepare("UPDATE `address` SET  `country` = ?,`city` = ?,`streetAddress1` = ?,`streetAddress2` = ?,`building` = ?,`floor` = ?,`depNo` = ? where userID = ? and id = ?;");
		$stmt->bind_param("sssssssss",$country,$city,$address1,$address2,$building,$floor,$depno,$userID,$id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	public function getSecretKey($id){
		$stmt = $this->con->prepare("SELECT secretKey from users_information where id = ?");
		$stmt->bind_param("s",$id);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($secretkey);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['secretKey'] = $secretkey; 
		 array_push($userInfo, $temp);
	}
	//echo "select id from users_information where email = '$email' and password = '$pass'";
		return $userInfo;
	}
	public function addSecretKey($id,$secretkey){
		$stmt = $this->con->prepare("UPDATE `users_information` SET `secretKey` = ? where id = ?;");
		$stmt->bind_param("ss",$secretkey,$id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	public function addFinanicalInfo($userID,$cardType,$cardName,$cardNumber,$expiryDate,$CVV){
		$stmt = $this->con->prepare("INSERT INTO `users_card_financail` (`userID`, `cardType`, `cardName`, `cardNumber`, `expiryDate`, `CVV`) VALUES  (?, ?,?,?,?,?);");
		$stmt->bind_param("ssssss",$userID,$cardType,$cardName,$cardNumber,$expiryDate,$CVV);
		if($stmt->execute())
			return true; 
		return false; 

	}
	public function getUserFinanical($userid){
		$stmt = $this->con->prepare("SELECT id , cardType,cardName,cardNumber,expiryDate,CVV from `users_card_financail` where userID = ?");
		$stmt->bind_param("s",$userid);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($id,$cardType,$cardName,$cardNumber,$expiryDate,$CVV);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['cardType'] = $cardType; 
			$temp['cardName'] = $cardName; 
			$temp['cardNumber'] = $cardNumber; 
			$temp['expiryDate'] = $expiryDate; 
			$temp['CVV'] = $CVV; 
		 array_push($userInfo, $temp);
	}
		return $userInfo;
	}

	public function updateFinanicalInfo($id,$userID,$cardType,$cardName,$cardNumber,$expiryDate,$CVV){
		$stmt = $this->con->prepare("UPDATE `users_card_financail` SET  `cardType` = ?,`cardName` = ?,`cardNumber` = ?,`expiryDate` = ?,`CVV` = ? where userID = ? and id = ?;");
		$stmt->bind_param("sssssss",$cardType,$cardName,$cardNumber,$expiryDate,$CVV,$userID,$id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	public function checkSecFromEcomm($secKey,$ecommerce,$cardType){
		$stmt = $this->con->prepare("SELECT id from `users_information` where secretKey = ?;");
		$stmt->bind_param("s",$secKey);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id);
		$stmt->fetch();
		if($id != ""){
			$stmt = $this->con->prepare("INSERT INTO `transaction_order` (`userID`,`ecommerceName`,`cardType`,`OTPcode`) VALUES  (?,?,?,?);");
			$otp_empty=' ';
			$stmt->bind_param("ssss",$id,$ecommerce,$cardType,$otp_empty);
			$stmt->execute();
			$stmt->store_result();
			$stmt = $this->con->prepare("SELECT trID FROM `transaction_order` ORDER BY trID DESC LIMIT 1;");
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();

		}
		return $id;
	}
	public function getTransaction($userid){
		$stmt = $this->con->prepare("SELECT trID , ecommerceName , cardType,OTPcode from `transaction_order` where userID = ?");
		$stmt->bind_param("s",$userid);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($trID,$ecommerceName,$cardType,$OTPcode,);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['trID'] = $trID; 
			$temp['ecommerceName'] = $ecommerceName; 
			$temp['cardType'] = $cardType; 
			$temp['OTPcode'] = $OTPcode; 
		 array_push($userInfo, $temp);
	}
		return $userInfo;
	}

	public function getOTP($id){
		$stmt = $this->con->prepare("SELECT OTPcode from `transaction_order` where trID = ?;");
		$stmt->bind_param("s",$id);
		$userInfo = array();
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($otp);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['OTPcode'] = $otp; 
		 array_push($userInfo, $temp);
	}
		return $userInfo;

	}
	 	public function addOTP($id , $otp){
		$stmt = $this->con->prepare("UPDATE `transaction_order` SET `OTPcode` =  ? where trID = ? ;");
		$stmt->bind_param("ss",$otp,$id);
		if($stmt->execute())
			return true; 
		return false; 

	}

	 	public function getDesiredCard($userid,$cardType){
		$stmt = $this->con->prepare("SELECT id , cardNumber from `users_card_financail` where userID = ? and cardType = ?");
		$stmt->bind_param("ss",$userid,$cardType);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($id,$cardNumber);
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['cardNumber'] = $cardNumber; 
		 array_push($userInfo, $temp);
	}
		return $userInfo;
	}
		 	public function verfiyOTP($otp){
		$stmt = $this->con->prepare("SELECT trID , userID from `transaction_order` where OTPcode = ?");
		$stmt->bind_param("s",$otp);
		$userInfo = array();
		$stmt->execute();
		$stmt->bind_result($trID,$userID);
		while($stmt->fetch()){
			$userInfo['trID'] = $trID; 
			$userInfo['userID'] = $userID; 
		 
	}
		return $userInfo;
	}
	public function getCardInfo($trID,$userID){
		$stmt = $this->con->prepare("SELECT cardType , cardNumber from `accept_transaction` where trID = ? and userID = ? and 
		checked != ?;");
		$ch = "true";
		$stmt->bind_param("sss",$trID,$userID,$ch);
		$userInfo = array();
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($cardType,$cardNumber);
		$check = false;
		while($stmt->fetch()){
			$temp = array(); 
			$temp['cardType'] = $cardType; 
			$temp['cardNumber'] = $cardNumber; 
		 array_push($userInfo, $temp);
		 $check = true;
	}
	if($check){
		$stmt = $this->con->prepare("UPDATE `accept_transaction` SET checked = ? where trID= ? and userID = ?;");
		$stmt->bind_param("sss",$ch,$trID,$userID);
		$stmt->execute();
	}
	
		return $userInfo;
	}
	public function addAcceptTransaction($userID,$trID,$cardID,$cardType,$cardNumber){
		$stmt = $this->con->prepare("INSERT INTO `accept_transaction` (`userID`, `trID`, `cardID`, `cardType`, `cardNumber`) VALUES  (?, ?,?,?,?);");
		$stmt->bind_param("sssss",$userID,$trID,$cardID,$cardType,$cardNumber);
		if($stmt->execute())
			return true; 
		return false; 

	}
	public function getHeroes(){
		$stmt = $this->con->prepare("SELECT id, name, role FROM hero");
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($id, $name, $role);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id'] = $id; 
			$temp['name'] = $name; 
			$temp['role'] = $role; 
			array_push($artists, $temp);
		}
		return $artists; 
	}
}

