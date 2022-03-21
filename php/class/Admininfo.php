<?php
    class Admininfo {
        // DB stuff
        private $conn;
        private $tbl_bit_user = "tbl_bit_users";
        private $tbl_bit_notice = "tbl_bit_notice";
        private $tbl_bit_guide = "tbl_bit_guide";
        private $tbl_bit_deposit = "tbl_bit_transactions_cashin_details";
        private $tbl_bit_withdraw = "tbl_bit_transactions_withdraw_details";
        private $tbl_bit_Money_transaction = "tbl_bit_transaction_headers";
        private $tbl_bit_bank = "tbl_bit_banklists";
        private $tbl_bit_wss_result = "tbl_bit_wss_results";
        private $tbl_bit_reserved_result = "tbl_bit_reserved_results";
        private $tbl_bit_inquiry = "tbl_bit_inquiries";
        private $tbl_bit_sound = "tbl_bit_sounds";
        
        //properties  
		public function __construct($db){
			$this->conn = $db;
		}

        public function getResultHistoryListRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_wss_result." W
            LEFT JOIN ".$this->tbl_bit_reserved_result." R ON W.r_Time_Unix = R.r_Time_Unix WHERE W.r_StatusId IN(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getResultHistoryList(){
            $query = "SELECT
            R.r_Time_Unix AS resTime,
            W.r_Time_Datetime AS Date_Time,
            W.r_Price_Result,
            W.r_Game_Result,
            W.JsonDataResult,
            W.r_Game_Type
            FROM ".$this->tbl_bit_wss_result." W
            LEFT JOIN ".$this->tbl_bit_reserved_result." R ON W.r_Time_Unix = R.r_Time_Unix WHERE W.r_StatusId IN(1) ORDER BY W.r_Time_Unix DESC";
            return $query;
        }
        public function getWithdrawCanceledRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_withdraw." WHERE t_Cashout_Status In(2)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getWithdrawCanceledList(){
            $query = "SELECT
            U.u_Recommended_Point,
            U.u_Account_Code,
            U.u_Nickname,
            U.u_Bank_Holder_Name,
            U.u_Ip_Address,
            U.u_Account_Number,
            W.t_Total_Amount_Cash_Out,
            W.t_Cashout_Date,
            B.m_Bank_Name
            FROM ".$this->tbl_bit_withdraw." W
            JOIN ".$this->tbl_bit_user." U ON W.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_bank." B ON U.u_Bank_Code = B.m_BankId
            WHERE  W.t_cashout_Status In(2) ORDER BY W.t_Cashout_Date DESC";
            return $query;
        }
        public function getWithdrawApprovedRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_withdraw." WHERE t_Cashout_Status In(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getWithdrawApprovedList(){
            $query = "SELECT
            U.u_Recommended_Point,
            U.u_Account_Code,
            U.u_Nickname,
            U.u_Bank_Holder_Name,
            U.u_Ip_Address,
            U.u_Account_Number,
            W.t_Total_Amount_Cash_Out,
            W.t_Cashout_Date,
            B.m_Bank_Name
            FROM ".$this->tbl_bit_withdraw." W
            JOIN ".$this->tbl_bit_user." U ON W.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_bank." B ON U.u_Bank_Code = B.m_BankId
            WHERE  W.t_cashout_Status In(1) ORDER BY W.t_Cashout_Date DESC";
            return $query;
        }
        public function getDepositCanceledRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_deposit." WHERE t_Cashin_Status In(2)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getDepositCanceledList(){
            $query = "SELECT
            U.u_Recommended_Point,
            U.u_Account_Code,
            U.u_Nickname,
            U.u_Bank_Holder_Name,
            U.u_Ip_Address,
            D.t_Total_Amount_Cash_In,
            D.t_Cashin_Date
            FROM ".$this->tbl_bit_deposit." D
            JOIN ".$this->tbl_bit_user." U ON D.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
            WHERE  D.t_cashin_Status In(2) ORDER BY D.t_Cashin_Date DESC";
            return $query;
        }
        public function getDepositApprovedRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_deposit." WHERE t_Cashin_Status In(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getDepositApprovedList(){
            $query = "SELECT
            U.u_Recommended_Point,
            U.u_Account_Code,
            U.u_Nickname,
            U.u_Bank_Holder_Name,
            U.u_Ip_Address,
            D.t_Total_Amount_Cash_In,
            D.t_Cashin_Date
            FROM ".$this->tbl_bit_deposit." D
            JOIN ".$this->tbl_bit_user." U ON D.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
            WHERE  D.t_cashin_Status In(1) ORDER BY D.t_Cashin_Date DESC";
            return $query;
        }
        public function getWithdrawRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_withdraw." WHERE t_Cashout_Status In(0)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getWithdrawList(){
            $query = "SELECT
            U.u_Recommended_Point,
            U.u_Account_Code,
            U.u_Nickname,
            U.u_Bank_Holder_Name,
            U.u_Ip_Address,
            U.u_Account_Number,
            T.t_Amount_in_Total,
            W.t_Id AS UniqueId,
            W.t_Total_Amount_Cash_Out,
            W.t_Cashout_Date,
            B.m_Bank_Name
            FROM ".$this->tbl_bit_withdraw." W
            JOIN ".$this->tbl_bit_user." U ON W.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_bank." B ON U.u_Bank_Code = B.m_BankId
            WHERE  W.t_cashout_Status In(0) ORDER BY W.t_Cashout_Date DESC";
            return $query;
        }
        public function getDepositRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_deposit." WHERE t_Cashin_Status In(0)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getDepositList(){
            $query = "SELECT
            U.u_Recommended_Point,
            U.u_Account_Code,
            U.u_Nickname,
            U.u_Bank_Holder_Name,
            U.u_Ip_Address,
            T.t_Amount_in_Total,
            D.t_Id AS UniqueId,
            D.t_Total_Amount_Cash_In,
            D.t_Cashin_Date
            FROM ".$this->tbl_bit_deposit." D
            JOIN ".$this->tbl_bit_user." U ON D.t_Account_Code = U.u_Account_Code
            JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
            WHERE  D.t_cashin_Status In(0) ORDER BY D.t_Cashin_Date DESC";
            return $query;
        }
        public function getNoticeList(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_Deleted_Date IS NULL ORDER BY n_Registration_Time DESC";
            return $query;
        }
        public function getNoticeRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_Deleted_Date IS NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getGuideList(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_Deleted_Date IS NULL ORDER BY g_Registration_Time DESC";
            return $query;
        }
        public function getGuideRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_Deleted_Date IS NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function postNotice($formdata){
            $query = "INSERT INTO ".$this->tbl_bit_notice." (n_Title,n_Details,n_Writer,n_IsPublic,n_Registration_Time) VALUES (:Title,:Details,:Writer,:IsPublic,:RegistrationTime)";
            $stmt = $this->conn->prepare($query);

            $title = $_POST["title"];
            $usenonuse = $_POST["use_nonuse"];
            $regdate = $_POST["register_date"];
            $message = $_POST["message"];
            $writer = $_SESSION["user_session"]["u_Account_Code"];

            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            $stmt->bindParam(':IsPublic', $usenonuse, PDO::PARAM_STR);
            $stmt->bindParam(':RegistrationTime', $regdate, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postNoticeUpdate($formdata){
            $query = "UPDATE ".$this->tbl_bit_notice." 
            SET
            n_Title = :Title,
            n_Details = :Details,
            n_Writer = :Writer,
            n_IsPublic = :IsPublic
            WHERE n_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $_POST["id_e"];
            $title = $_POST["title_e"];
            $usenonuse = $_POST["use_nonuse_e"];
            $message = $_POST["message_e"];
            $writer = $_SESSION["user_session"]["u_Account_Code"];

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            $stmt->bindParam(':IsPublic', $usenonuse, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postNoticeDelete($id){
            $query = "UPDATE ".$this->tbl_bit_notice." 
            SET
            n_Deleted_Date = :Date
            WHERE n_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $id;
            $date = date('Y-m-d h:i');
            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Date', $date, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postNoticeDeleteMultiple($arr){
            print_r($arr);
            $count = count($arr);
            for($i = 0; $i <= $count; $i++){
                $query = "UPDATE ".$this->tbl_bit_notice." SET n_Deleted_Date = '".date('Y-m-d h:i')."' WHERE n_Id = '".$arr[$i]."'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            }
        }
        public function getNoticePerId($id){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_Id = '".$id."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function postGuide($formdata){
            $query = "INSERT INTO ".$this->tbl_bit_guide." (g_Title,g_Details,g_Writer,g_IsPublic,g_Registration_Time) VALUES (:Title,:Details,:Writer,:IsPublic,:RegistrationTime)";
            $stmt = $this->conn->prepare($query);

            $title = $_POST["title"];
            $usenonuse = $_POST["use_nonuse"];
            $regdate = $_POST["register_date"];
            $message = $_POST["message"];
            $writer = $_SESSION["user_session"]["u_Account_Code"];

            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            $stmt->bindParam(':IsPublic', $usenonuse, PDO::PARAM_STR);
            $stmt->bindParam(':RegistrationTime', $regdate, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postGuideUpdate($formdata){
            $query = "UPDATE ".$this->tbl_bit_guide." 
            SET
            g_Title = :Title,
            g_Details = :Details,
            g_Writer = :Writer,
            g_IsPublic = :IsPublic
            WHERE g_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $_POST["id_e"];
            $title = $_POST["title_e"];
            $usenonuse = $_POST["use_nonuse_e"];
            $message = $_POST["message_e"];
            $writer = $_SESSION["user_session"]["u_Account_Code"];

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            $stmt->bindParam(':IsPublic', $usenonuse, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postGuideDelete($id){
            $query = "UPDATE ".$this->tbl_bit_guide." 
            SET
            g_Deleted_Date = :Date
            WHERE g_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $id;
            $date = date('Y-m-d h:i');
            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Date', $date, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postGuideDeleteMultiple($arr){
            $count = count($arr);
            for($i = 0; $i <= $count; $i++){
                $query = "UPDATE ".$this->tbl_bit_guide." SET g_Deleted_Date = '".date('Y-m-d h:i')."' WHERE g_Id = '".$arr[$i]."'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            }
        }
        public function getGuidePerId($id){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_Id = '".$id."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function postDepositUpdate($get){
            $query = "UPDATE ".$this->tbl_bit_deposit." SET t_Cashin_Status = :Status WHERE t_Id = :Id;
            UPDATE ".$this->tbl_bit_Money_transaction." SET t_Amount_in_Total = :Total WHERE t_Account_Code = :Code";
            $stmt = $this->conn->prepare($query);

            $id = $get["id"];
            $total = $get["total_amount"];
            $code = $get["code"];
            $status = 1;

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':Total', $total, PDO::PARAM_STR);
            $stmt->bindParam(':Code', $code, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postDepositDelete($id){
            $query = "UPDATE ".$this->tbl_bit_deposit." SET t_Cashin_Status = :Status WHERE t_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $id;
            $status = 2;
            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Status', $status, PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postWithdrawUpdate($get){
            $query = "UPDATE ".$this->tbl_bit_withdraw." SET t_Cashout_Status = :Status WHERE t_Id = :Id;
            UPDATE ".$this->tbl_bit_Money_transaction." SET t_Amount_in_Total = :Total WHERE t_Account_Code = :Code";
            $stmt = $this->conn->prepare($query);

            $id = $get["id"];
            $total = $get["total_amount"];
            $code = $get["code"];
            $status = 1;

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':Total', $total, PDO::PARAM_STR);
            $stmt->bindParam(':Code', $code, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postWithdrawDelete($id){
            $query = "UPDATE ".$this->tbl_bit_withdraw." SET t_Cashout_Status = :Status WHERE t_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $id;
            $status = 2;
            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Status', $status, PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function getInfoCnt(){
            $query = "SELECT 
            COUNT(u_Status_Id) AS UserApplication,
            (SELECT COUNT(t_Cashin_Status) AS Cnt FROM ".$this->tbl_bit_deposit." WHERE t_Cashin_Status IN(0) GROUP BY t_Cashin_Status) AS DepositApplication,
            (SELECT COUNT(t_Cashout_Status) AS Cnt FROM ".$this->tbl_bit_withdraw." WHERE t_Cashout_Status IN(0) GROUP BY t_Cashout_Status) AS WithdrawApplication,
            (SELECT COUNT(t_Inquiry_Status_Id) AS Cnt FROM ".$this->tbl_bit_inquiry." WHERE t_Inquiry_Status_Id IN(0) GROUP BY t_Inquiry_Status_Id) AS InquiryApplication
            FROM ".$this->tbl_bit_user." WHERE u_Status_Id IN(1) GROUP BY u_Status_Id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getNotification(){
            $query = "SELECT COUNT(s_TypeName) AS TypeCnt  FROM ".$this->tbl_bit_sound." WHERE s_TypeName IN('on') GROUP BY s_TypeName";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function checkCategoryRequest(){
            $query = "SELECT s_Notif_Type,s_TypeName FROM ".$this->tbl_bit_sound;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function setToMUte(){
            $query = "UPDATE ".$this->tbl_bit_sound." SET s_TypeId = 0, s_TypeName = 'off'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>