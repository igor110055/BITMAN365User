<?php
    class AdminUser {
        // DB stuff
        private $conn;
        private $tbl_bit_users = "tbl_bit_users";
        private $tbl_bit_access = "tbl_bit_access";
        private $tbl_bit_trans_headers = "tbl_bit_transaction_headers";
        private $tbl_bit_bank = "tbl_bit_banklists";
        private $tbl_bit_game_type = "tbl_bit_game_types";
        private $tbl_bit_admin_log = "tbl_bit_admin_logs";

        //properties  
		public function __construct($db){
			$this->conn = $db;
		}

        // check if account exists
        public function checkUserAccountId($acctcode){
            $query = "SELECT u_Account_Code FROM ".$this->tbl_bit_users. " WHERE u_Account_Code = '$acctcode'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        // check if nickname exists
        public function checkNicknameIfExists($nickname){
            $query = "SELECT * FROM ".$this->tbl_bit_users. " WHERE u_Nickname = '$nickname'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getBankList(){
            $query = "SELECT * FROM ".$this->tbl_bit_bank." ORDER BY m_Bank_Name ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        //user registration
		public function postRegistration($arr){
			$query = "INSERT INTO ". $this->tbl_bit_users ." (u_Account_Code,u_Nickname,u_Password,u_Mobile_Number,u_Bank_Holder_Name,u_Bank_Code,u_Account_Number,u_Recommended_Point,u_Ip_Address,u_Full_consent,u_Terms_Condition1,u_Terms_Condition2,u_Entry_Date)
			SELECT * FROM (SELECT :account_code AS u_Account_Code,:nickname AS u_Nickname,:password AS u_Password,:mobile_number AS u_Mobile_Number,:account_holder AS u_Bank_Holder_Name,:bank_code AS u_Bank_Code,:account_number AS u_Account_Number,:rec_point AS u_Recommended_Point,:ip_address AS u_Ip_Address,:full_consent AS u_Full_consent,:term_cond1 AS u_Terms_Condition1,:term_cond2 AS u_Terms_Condition2,:entry_date AS u_Entry_Date) AS temp
			WHERE NOT EXISTS (
				SELECT u_Account_Code FROM ". $this->tbl_bit_users ." WHERE u_Account_Code = :account_code) LIMIT 1;
            INSERT INTO ".$this->tbl_bit_game_type." (g_Account_Code) VALUES(:account_code)";
			$stmt = $this->conn->prepare($query);

			$account_code = $arr["account_code"];
            $nickname = $arr["nickname"];
            $password = $arr["password"];
            $mobile_number = $arr["mobile_number"];
            $account_holder = $arr["account_holder"];
            $bank_code = $arr["bank_code"];
            $account_number = $arr["account_number"];
            $rec_point = $arr["rec_point"];
            $ip_address = $arr["ip_address"];
            $full_consent = $arr["full_consent"];
            $term_cond1 = $arr["term_cond1"];
            $term_cond2 = $arr["term_cond2"];
            $entry_date = $arr["entry_date"];

			$stmt->bindParam(":account_code", $account_code, PDO::PARAM_STR);
			$stmt->bindParam(":nickname", $nickname, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":mobile_number", $mobile_number, PDO::PARAM_STR);
			$stmt->bindParam(":account_holder", $account_holder, PDO::PARAM_STR);
			$stmt->bindParam(":bank_code", $bank_code, PDO::PARAM_STR);
			$stmt->bindParam(":account_number", $account_number, PDO::PARAM_STR);
			$stmt->bindParam(":rec_point", $rec_point, PDO::PARAM_STR);
			$stmt->bindParam(":ip_address", $ip_address, PDO::PARAM_STR);
			$stmt->bindParam(":full_consent", $full_consent, PDO::PARAM_STR);
			$stmt->bindParam(":term_cond1", $term_cond1, PDO::PARAM_STR);
			$stmt->bindParam(":term_cond2", $term_cond2, PDO::PARAM_STR);
			$stmt->bindParam(":entry_date", $entry_date, PDO::PARAM_STR);
			if($stmt->execute()){
                return true;
            }
            return false;
		}

		public function login($account_code,$password){
			$query = "SELECT
            U.u_Account_Code,
            U.u_Nickname,
            U.u_Password,
            U.u_Mobile_Number,
            U.u_Ip_Address,
            U.u_Access_Code,
            U.u_isAdminUser,
            H.t_Amount_in_Total,
            H.t_Currency
            FROM ".$this->tbl_bit_users." AS U 
            JOIN ".$this->tbl_bit_access." A ON U.u_Access_Code = A.m_Access_Code 
            LEFT JOIN ".$this->tbl_bit_trans_headers." H ON U.u_Account_Code = H.t_Account_Code 
            WHERE U.u_Account_Code = '$account_code' AND U.u_Password = '$password'
            AND U.u_Status_Id NOT IN(1)
            AND U.u_UseNoUse IN(1) 
            AND U.u_isAdminUser IN(1) LIMIT 1";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
            $num_row = $stmt->rowCount();
            if($num_row > 0 ){
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $_SESSION['admin_session'] = $row;
                    return true;
                }
            }else{
                return false;
            }
        }

        public function userLogs($isType,$account_code,$get_ip){
            $query = "INSERT INTO ".$this->tbl_bit_admin_log." (l_Account_Code,l_LogInDateTime,l_Current_Ip,l_Access_Domain,l_Device_Use,l_Browser_Use,l_isActive) VALUES (:AccountCode,:LogInDateTime,:CurrentIp,:AccessDomain,:DeviceUse,:BrowserUse,:isActive)";
            $stmt = $this->conn->prepare($query);

            $code = $account_code;
            $device = $isType;
            $logindtime = date('Y-m-d h:i:s');
            $browser = 'Chrome';
            $domain = $_SERVER['SERVER_NAME'];
            $ip = $get_ip;
            $active = 1;

            $stmt->bindParam(':AccountCode', $code, PDO::PARAM_STR);
            $stmt->bindParam(':LogInDateTime', $logindtime, PDO::PARAM_STR);
            $stmt->bindParam(':CurrentIp', $ip, PDO::PARAM_STR);
            $stmt->bindParam(':AccessDomain', $domain, PDO::PARAM_STR);
            $stmt->bindParam(':DeviceUse', $device, PDO::PARAM_STR);
            $stmt->bindParam(':BrowserUse', $browser, PDO::PARAM_STR);
            $stmt->bindParam(':isActive', $active, PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function destroyUserSession($code){
            $query = "UPDATE ".$this->tbl_bit_admin_log." SET l_LogOutDateTime = :logoutdtime, l_isActive = :status WHERE l_Account_Code = :code AND DATE(l_LogInDateTime) = :logdate AND l_isActive IN(1)";
            $stmt = $this->conn->prepare($query);

            $acode = $code;
            $logoutdtime = date('Y-m-d h:i:s');
            $logdate = date('Y-m-d');
            $status = 0;

            $stmt->bindParam(':code', $acode, PDO::PARAM_STR);
            $stmt->bindParam(':logoutdtime', $logoutdtime, PDO::PARAM_STR);
            $stmt->bindParam(':logdate', $logdate, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->execute();
        }
		
		 // Check if the user is already logged in
         public function is_logged_in() {
            // Check if user session has been set
            if (isset($_SESSION['admin_session'])) {
                return true;
            }
        }
    
        // Redirect user
        public function redirect($url) {
            ob_start();
            header("Location: $url");
            exit;
        }
    }