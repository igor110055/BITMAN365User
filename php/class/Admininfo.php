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
        private $tbl_bit_user_log_header = "tbl_bit_user_log_headers";
        private $tbl_bit_user_log = "tbl_bit_user_logs";
        private $tbl_bit_betting_detail = "tbl_bit_betting_details";
        private $tbl_bit_trans_history = "tbl_bit_transaction_histories";
        private $tbl_bit_answer_template = "tbl_bit_answer_templates";
        private $tbl_bit_game_type = "tbl_bit_game_types";
        private $tbl_bit_faq = "tbl_bit_faqs";
        private $tbl_bit_note = "tbl_bit_notes";
        
        //properties  
		public function __construct($db){
			$this->conn = $db;
		}
        public function getNoteList(){
            $query = "SELECT * FROM ".$this->tbl_bit_note." WHERE e_Deleted_Date IS NULL ORDER BY e_Registration_Time DESC";
            return $query;
        }
        public function getNoteRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_note." WHERE e_Deleted_Date IS NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getFAQList(){
            $query = "SELECT * FROM ".$this->tbl_bit_faq." WHERE f_Deleted_Date IS NULL ORDER BY f_Updated_Date DESC";
            return $query;
        }
        public function getFAQRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_faq." WHERE f_Deleted_Date IS NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getUserTransactionList($code,$year,$month){
            $query = "SELECT *
            FROM ".$this->tbl_bit_trans_history." WHERE (h_Transaction_Type, h_Processing_Time) IN (
                SELECT h_Transaction_Type, max(h_Processing_Time) AS date
                FROM ".$this->tbl_bit_trans_history."
                WHERE  h_Account_Code = '".$code."'
                AND YEAR(h_Processing_Time) = '".$year."'
                AND MONTH(h_Processing_Time) = '".$month."'
                GROUP BY h_Transaction_Type
            )";
            return $query;
        }
        public function getUserTransactionRowCount($code,$year,$month){
            $query = "SELECT *
            FROM ".$this->tbl_bit_trans_history." WHERE (h_Transaction_Type, h_Processing_Time) IN (
                SELECT h_Transaction_Type, max(h_Processing_Time) AS date
                FROM ".$this->tbl_bit_trans_history."
                WHERE  h_Account_Code = '".$code."'
                AND YEAR(h_Processing_Time) = '".$year."'
                AND MONTH(h_Processing_Time) = '".$month."'
                GROUP BY h_Transaction_Type
            )";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getInquiryList(){
            $query = "SELECT *,U.u_Nickname
            FROM ".$this->tbl_bit_inquiry." I
            JOIN ".$this->tbl_bit_user." U ON I.t_Account_Code = U.u_Account_Code
            ORDER BY I.t_Inquiry_Date DESC";
            return $query;
        }
        public function getInquiryRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_inquiry;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
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
            LEFT JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
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
            LEFT JOIN ".$this->tbl_bit_Money_transaction." T ON T.t_Account_Code = U.u_Account_Code
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

            $title = $formdata["title"];
            $usenonuse = $formdata["use_nonuse"];
            $regdate = $formdata["register_date"];
            $message = $formdata["notice_details"];
            $writer = $_SESSION["admin_session"]["u_Account_Code"];

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

            $id = $formdata["id_e"];
            $title = $formdata["title_e"];
            $usenonuse = $formdata["use_nonuse_e"];
            $message = $formdata["notice_details_e"];
            $writer = $_SESSION["admin_session"]["u_Nickname"];

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
            $count = count($arr);
            for($i = 0; $i <= $count; $i++){
                $query = "UPDATE ".$this->tbl_bit_notice." SET n_Deleted_Date = '".date('Y-m-d h:i:s')."' WHERE n_Id = '".@$arr[$i]."'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            }
            return true;
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

            $title = $formdata["title"];
            $usenonuse = $formdata["use_nonuse"];
            $regdate = $formdata["register_date"];
            $message = $formdata["guide_details"];
            $writer = $_SESSION["admin_session"]["u_Account_Code"];

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

            $id = $formdata["g_id_e"];
            $title = $formdata["g_title_e"];
            $usenonuse = $formdata["g_use_nonuse_e"];
            $message = $formdata["g_guide_details_e"];
            $writer = $_SESSION["admin_session"]["u_Nickname"];

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
                $query = "UPDATE ".$this->tbl_bit_guide." SET g_Deleted_Date = '".date('Y-m-d h:i:s')."' WHERE g_Id = '".@$arr[$i]."'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            }
            return true;
        }
        public function postFAQ($formdata){
            $query = "INSERT INTO ".$this->tbl_bit_faq." (f_Title,f_Details,f_Writer,f_UseUnUse,f_Registration_Date) VALUES (:Title,:Details,:Writer,:Usenonuse,:RegistrationDate)";
            $stmt = $this->conn->prepare($query);

            $title = $formdata["f_title"];
            $usenonuse = $formdata["f_use_nonuse"];
            $regdate = $formdata["f_register_date"];
            $message = $formdata["faq_details"];
            $writer = $_SESSION["admin_session"]["u_Nickname"];

            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            $stmt->bindParam(':Usenonuse', $usenonuse, PDO::PARAM_STR);
            $stmt->bindParam(':RegistrationDate', $regdate, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postFAQUpdate($formdata){
            $query = "UPDATE ".$this->tbl_bit_faq." 
            SET
            f_Title = :Title,
            f_Details = :Details,
            f_Writer = :Writer,
            f_UseUnuse = :Usenonuse
            WHERE f_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $formdata["f_id_e"];
            $title = $formdata["f_title_e"];
            $usenonuse = $formdata["f_use_nonuse_e"];
            $message = $formdata["faq_details_e"];
            $writer = $_SESSION["admin_session"]["u_Nickname"];

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            $stmt->bindParam(':Usenonuse', $usenonuse, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postFAQDeleteMultiple($arr){
            $count = count($arr);
            for($i = 0; $i <= $count; $i++){
                $query = "UPDATE ".$this->tbl_bit_faq." SET f_Deleted_Date = '".date('Y-m-d h:i:s')."' WHERE f_Id = '".@$arr[$i]."'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            }
            return true;
        }
        public function postInquiry($formdata){
            $query = "INSERT INTO ".$this->tbl_bit_answer_template." (a_Title,a_Answer_Details) VALUES (:title,:details)";
            $stmt = $this->conn->prepare($query);

            $title = $formdata["inquiry_answer_title"];
            $details = $formdata["inquiry_answer_details"];

            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':details', $details, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postFAQDelete($id){
            $query = "UPDATE ".$this->tbl_bit_faq."
            SET
            f_Deleted_Date = :Date
            WHERE f_Id = :Id";
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
        public function postInquiryUpdate($formdata){
            $query = "UPDATE ".$this->tbl_bit_inquiry." 
            SET
            t_Manager_Reply = :Reply,
            t_Inquiry_Status_Id = :Status,
            t_Response_Time = :Date
            WHERE t_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $_POST["i_id_e"];
            $details = $_POST["i_inquiry_details_e"];
            $date = date('Y-m-d h:i:s');
            $status = 1;

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Reply', $details, PDO::PARAM_STR);
            $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':Date', $date, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function getGuidePerId($id){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_Id = '".$id."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function checkTransactionHeaders($code){
            $query = "SELECT * FROM ".$this->tbl_bit_Money_transaction." WHERE t_Account_Code = '".$code."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $rowcount = $stmt->rowCount();
            return $rowcount;
        }
        public function postDepositUpdate($get){
            $checkTH = $this->checkTransactionHeaders($get["code"]);
            if($checkTH == 1){
                $query = "UPDATE ".$this->tbl_bit_deposit." SET t_Cashin_Status = :Status WHERE t_Id = :Id;
                UPDATE ".$this->tbl_bit_Money_transaction." SET t_Amount_in_Total = :Total WHERE t_Account_Code = :Code;
                INSERT INTO ".$this->tbl_bit_trans_history." (h_Transaction_Type, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Processing_Time) VALUES (:Transaction_Type, :Account_Code, :Event, :Contract_Time, :Plus, :Minus, :Current_Balance, :Process_Time)";
                $stmt = $this->conn->prepare($query);

                $id = $get["id"];
                $total = $get["total_amount"];
                $code = $get["code"];
                $status = 1;
                $transtype = 'Deposit';
                $date = date('Y-m-d h:i:s');
                $event = '증금';
                $plus = $get["cashin"];
                $minus = 0;
                $ctime = '-';

                $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
                $stmt->bindParam(':Total', $total, PDO::PARAM_STR);
                $stmt->bindParam(':Code', $code, PDO::PARAM_STR);
                //history
                $stmt->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
                $stmt->bindParam(':Account_Code', $code, PDO::PARAM_STR);
                $stmt->bindParam(':Event', $event, PDO::PARAM_STR);
                $stmt->bindParam(':Contract_Time', $ctime, PDO::PARAM_STR);
                $stmt->bindParam(':Plus', $plus, PDO::PARAM_STR);
                $stmt->bindParam(':Minus', $minus, PDO::PARAM_STR);
                $stmt->bindParam(':Current_Balance', $total, PDO::PARAM_STR);
                $stmt->bindParam(':Process_Time', $date, PDO::PARAM_STR);
                if($stmt->execute()){
                    return true;
                }
                return false;
            }else{
                $query = "UPDATE ".$this->tbl_bit_deposit." SET t_Cashin_Status = :Status WHERE t_Id = :Id;
                INSERT INTO ".$this->tbl_bit_Money_transaction." (t_Account_Code,t_Amount_in_Total,t_Currency,t_Entry_Date) VALUES (:Code,:Total,:Currency,:Date);
                INSERT INTO ".$this->tbl_bit_trans_history." (h_Transaction_Type, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Processing_Time) VALUES (:Transaction_Type, :Account_Code, :Event, :Contract_Time, :Plus, :Minus, :Current_Balance, :Process_Time)";
                $stmt = $this->conn->prepare($query);

                $total = $get["total_amount"];
                $code = $get["code"];
                $currency = 'Dollar';
                $date = date('Y-m-d h:i:s');
                $status = 1;
                $transtype = 'Deposit';
                $event = '증금';
                $plus = $get["cashin"];
                $minus = 0;
                $ctime = '-';

                $id = $get["id"];
                $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
                $stmt->bindParam(':Code', $code, PDO::PARAM_STR);
                $stmt->bindParam(':Total', $total, PDO::PARAM_STR);
                $stmt->bindParam(':Currency', $currency, PDO::PARAM_STR);
                $stmt->bindParam(':Date', $date, PDO::PARAM_STR);

                //history
                $stmt->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
                $stmt->bindParam(':Account_Code', $code, PDO::PARAM_STR);
                $stmt->bindParam(':Event', $event, PDO::PARAM_STR);
                $stmt->bindParam(':Contract_Time', $ctime, PDO::PARAM_STR);
                $stmt->bindParam(':Plus', $plus, PDO::PARAM_STR);
                $stmt->bindParam(':Minus', $minus, PDO::PARAM_STR);
                $stmt->bindParam(':Current_Balance', $total, PDO::PARAM_STR);
                $stmt->bindParam(':Process_Time', $date, PDO::PARAM_STR);
                
                if($stmt->execute()){
                    return true;
                }
                return false;
            }
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
            $checkTH = $this->checkTransactionHeaders($get["code"]);
            $query = "UPDATE ".$this->tbl_bit_withdraw." SET t_Cashout_Status = :Status WHERE t_Id = :Id;
            UPDATE ".$this->tbl_bit_Money_transaction." SET t_Amount_in_Total = :Total WHERE t_Account_Code = :Code;
            INSERT INTO ".$this->tbl_bit_trans_history." (h_Transaction_Type, h_Account_Code, h_Event, h_Contract_Time, h_Plus, h_Minus, h_Current_Balance, h_Processing_Time) VALUES (:Transaction_Type, :Account_Code, :Event, :Contract_Time, :Plus, :Minus, :Current_Balance, :Process_Time)";
            $stmt = $this->conn->prepare($query);

            $id = $get["id"];
            $total = $get["total_amount"];
            $code = $get["code"];
            $status = 1;
            $date = date('Y-m-d h:i:s');
            $status = 1;
            $transtype = 'Withdraw';
            $event = '출금';
            $plus = 0;
            $minus = $get["cashout"];
            $ctime = '-';

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':Total', $total, PDO::PARAM_STR);
            $stmt->bindParam(':Code', $code, PDO::PARAM_STR);
            //history
            $stmt->bindParam(':Transaction_Type', $transtype, PDO::PARAM_STR);
            $stmt->bindParam(':Account_Code', $code, PDO::PARAM_STR);
            $stmt->bindParam(':Event', $event, PDO::PARAM_STR);
            $stmt->bindParam(':Contract_Time', $ctime, PDO::PARAM_STR);
            $stmt->bindParam(':Plus', $plus, PDO::PARAM_STR);
            $stmt->bindParam(':Minus', $minus, PDO::PARAM_STR);
            $stmt->bindParam(':Current_Balance', $total, PDO::PARAM_STR);
            $stmt->bindParam(':Process_Time', $date, PDO::PARAM_STR);
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
        public function postuserUpdateByAdmin($formdata,$pass){
            $query = "UPDATE ".$this->tbl_bit_user." SET u_Password = :user_pass, u_Bank_Code = :bankid WHERE u_Account_Code = :accountid;
            UPDATE ".$this->tbl_bit_game_type." SET g_BTCUSD = :btcusd, g_ETHUSD = :ethusd, g_XRPUSD = :xrpusd WHERE g_Account_Code = :accountid";
            $stmt = $this->conn->prepare($query);

            $user_pass = $pass;
            $accountid = $formdata["accountid"];
            $bankid = $formdata["bankid"];
            $btcusd = $formdata["btcusd"];
            $ethusd = $formdata["ethusd"];
            $xrpusd = $formdata["xrpusd"];

            $stmt->bindParam(':user_pass', $user_pass, PDO::PARAM_STR);
            $stmt->bindParam(':accountid', $accountid, PDO::PARAM_STR);
            $stmt->bindParam(':bankid', $bankid, PDO::PARAM_STR);
            $stmt->bindParam(':btcusd', $btcusd, PDO::PARAM_STR);
            $stmt->bindParam(':ethusd', $ethusd, PDO::PARAM_STR);
            $stmt->bindParam(':xrpusd', $xrpusd, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postforceStopUsingWebsite($get){
            $query = "UPDATE ".$this->tbl_bit_user." SET u_UseNoUse = :usenoneuse WHERE u_Account_Code = :code";
            $stmt = $this->conn->prepare($query);
            $code = $get["code"];
            $usenoneuse = $get["usenoneuse"];
            $stmt->bindParam(':code', $code, PDO::PARAM_STR);
            $stmt->bindParam(':usenoneuse', $usenoneuse, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function postNote($formdata){
            $query = "INSERT INTO ".$this->tbl_bit_note." (e_Title,e_Details,e_Writer,e_Registration_Time) VALUES (:Title,:Details,:Writer,:RegistrationTime)";
            $stmt = $this->conn->prepare($query);

            $title = $formdata["title_note"];
            $regdate = date('Y-m-d h:i');
            $message = $formdata["note_details"];
            $writer = $_SESSION["admin_session"]["u_Nickname"];

            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            $stmt->bindParam(':RegistrationTime', $regdate, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postNoteUpdate($formdata){
            $query = "UPDATE ".$this->tbl_bit_note." 
            SET
            e_Title = :Title,
            e_Details = :Details,
            e_Writer = :Writer
            WHERE e_Id = :Id";
            $stmt = $this->conn->prepare($query);

            $id = $formdata["id_note"];
            $title = $formdata["e_title_note"];
            $message = $formdata["e_note_details"];
            $writer = $_SESSION["admin_session"]["u_Nickname"];

            $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':Title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':Details', $message, PDO::PARAM_STR);
            $stmt->bindParam(':Writer', $writer, PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function postNoteDelete($id){
            $query = "UPDATE ".$this->tbl_bit_note." 
            SET
            e_Deleted_Date = :Date
            WHERE e_Id = :Id";
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
        public function postNoteDeleteMultiple($arr){
            $count = count($arr);
            for($i = 0; $i <= $count; $i++){
                $query = "UPDATE ".$this->tbl_bit_note." SET e_Deleted_Date = '".date('Y-m-d h:i:s')."' WHERE e_Id = '".@$arr[$i]."'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
            }
            return true;
        }
        public function getInfoCntUser(){
            $query = "SELECT COUNT(u_Status_Id) AS Cnt FROM ".$this->tbl_bit_user." WHERE u_Status_Id IN(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getInfoCntDep(){
            $query = "SELECT COUNT(t_Cashin_Status) AS Cnt FROM ".$this->tbl_bit_deposit." WHERE t_Cashin_Status IN(0)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getInfoCntWid(){
            $query = "SELECT COUNT(t_Cashout_Status) AS Cnt FROM ".$this->tbl_bit_withdraw." WHERE t_Cashout_Status IN(0)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function getInfoCntInq(){
            $query = "SELECT COUNT(t_Inquiry_Status_Id) AS Cnt FROM ".$this->tbl_bit_inquiry." WHERE t_Inquiry_Status_Id IN(0)";
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
        public function getUserList(){
            $query = "SELECT * FROM ".$this->tbl_bit_user." WHERE u_Status_Id IN(2)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getUserPerNickname($nname){
            $query = "SELECT *,
            u_Account_Code AS CodeParent,
            u_Bank_Code AS BankParent,
            (SELECT m_Bank_Name FROM ".$this->tbl_bit_bank." WHERE m_BankId = BankParent) AS BankName,
            (SELECT l_LogInDateTime FROM ".$this->tbl_bit_user_log_header." WHERE DATE(l_LogInDateTime) = '".date('Y-m-d')."' AND l_Account_Code = CodeParent AND l_isActive IN(1) ORDER BY l_LogInDateTime DESC LIMIT 1) AS l_LogInDateTime,
            (SELECT l_Device_Use FROM ".$this->tbl_bit_user_log_header." WHERE DATE(l_LogInDateTime) = '".date('Y-m-d')."' AND l_Account_Code = CodeParent AND l_isActive IN(1) ORDER BY l_LogInDateTime DESC LIMIT 1) AS l_Device_Use,
            (SELECT l_Browser_Use FROM ".$this->tbl_bit_user_log_header." WHERE DATE(l_LogInDateTime) = '".date('Y-m-d')."' AND l_Account_Code = CodeParent AND l_isActive IN(1) ORDER BY l_LogInDateTime DESC LIMIT 1) AS l_Browser_Use,
            (SELECT l_Access_Domain FROM ".$this->tbl_bit_user_log_header." WHERE DATE(l_LogInDateTime) = '".date('Y-m-d')."' AND l_Account_Code = CodeParent AND l_isActive IN(1) ORDER BY l_LogInDateTime DESC LIMIT 1) AS l_Access_Domain,
            (SELECT l_Current_Ip FROM ".$this->tbl_bit_user_log_header." WHERE DATE(l_LogInDateTime) = '".date('Y-m-d')."' AND l_Account_Code = CodeParent AND l_isActive IN(1) ORDER BY l_LogInDateTime DESC LIMIT 1) AS l_Current_Ip,
            (SELECT l_isActive FROM ".$this->tbl_bit_user_log_header." WHERE DATE(l_LogInDateTime) = '".date('Y-m-d')."' AND l_Account_Code = CodeParent AND l_isActive IN(1) ORDER BY l_LogInDateTime DESC LIMIT 1) AS l_isActive,
            (SELECT t_Amount_in_Total FROM ".$this->tbl_bit_Money_transaction." WHERE t_Account_Code = CodeParent) AS TotalCashAmount,
            (SELECT SUM(t_Total_Amount_Cash_In) AS cnt FROM ".$this->tbl_bit_deposit." WHERE t_Account_Code = CodeParent) AS TotalDepositAmount,
            (SELECT SUM(t_Total_Amount_Cash_In) AS cnt FROM ".$this->tbl_bit_deposit." WHERE t_Account_Code = CodeParent AND DATE(l_LogInDateTime) = '".date('Y-m-d')."') AS TotalDepositDailyAmount,
            (SELECT SUM(t_Total_Amount_Cash_Out) AS cnt FROM ".$this->tbl_bit_withdraw." WHERE t_Account_Code = CodeParent) AS TotalWithdrawAmount,
            (SELECT SUM(t_Total_Amount_Cash_Out) AS cnt FROM ".$this->tbl_bit_withdraw." WHERE t_Account_Code = CodeParent AND DATE(t_Cashout_Date) = '".date('Y-m-d')."') AS TotalWithdrawDailyAmount,
            (SELECT SUM(b_betAmount) AS cnt FROM ".$this->tbl_bit_betting_detail." WHERE b_Account_Code = CodeParent AND DATE(b_UpdatedDate) = '".date('Y-m-d')."') AS TotalTradingDailyAmount,
            (SELECT SUM(b_Total_BetAmount) AS cnt FROM ".$this->tbl_bit_betting_detail." WHERE b_Account_Code = CodeParent AND DATE(b_UpdatedDate) = '".date('Y-m-d')."' AND b_Result IN(1)) AS TotalProfitDailyAmount,
            (SELECT SUM(b_betAmount) AS cnt FROM ".$this->tbl_bit_betting_detail." WHERE b_Account_Code = CodeParent AND DATE(b_UpdatedDate) = '".date('Y-m-d')."' AND b_Result IN(2)) AS TotalDisqualifyDailyAmount
            FROM ".$this->tbl_bit_user." WHERE u_Nickname = '".$nname."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getInquiryPerId($id){
            $query = "SELECT * FROM ".$this->tbl_bit_inquiry." I
            JOIN ".$this->tbl_bit_user." U ON I.t_Account_Code = U.u_Account_Code
            WHERE t_Id = '".$id."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getAnswerTemplateList(){
            $query = "SELECT * FROM ".$this->tbl_bit_answer_template." ORDER BY a_Updated_Date DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function checkAdminUserPass($admin_pass){
            $query = "SELECT * FROM ".$this->tbl_bit_user." WHERE u_Password = '".$admin_pass."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getFAQPerId($id){
            $query = "SELECT * FROM ".$this->tbl_bit_faq." WHERE f_Id = '".$id."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getNotePerId($id){
            $query = "SELECT * FROM ".$this->tbl_bit_note." WHERE e_Id = '".$id."'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getMembershipList(){
            $query = "SELECT
                DISTINCT
                U.u_Id,
                U.u_Recommended_Point,
                U.u_Account_Code,
                U.u_Account_Code AS parent_code,
                U.u_Nickname,
                U.u_Bank_Holder_Name,
                U.u_Entry_Date,
                U.u_Ip_Address,
                H.l_LogInDateTime,
                H.l_Current_Ip,
                CASE
                    WHEN U.u_State = 1 THEN '이용'
                    WHEN U.u_State = 2 THEN '접속중'
                    WHEN U.u_State = 3 THEN '정지'
                END AS u_State,
                CASE WHEN (SELECT t_Amount_in_Total FROM ".$this->tbl_bit_Money_transaction." WHERE t_Account_Code = parent_code) > 0 THEN (SELECT t_Amount_in_Total FROM ".$this->tbl_bit_Money_transaction." WHERE t_Account_Code = parent_code) ELSE 0 END AS Holding_amount,
                CASE WHEN (SELECT SUM(t_Total_Amount_Cash_In) AS cnt FROM ".$this->tbl_bit_deposit." WHERE t_Account_Code = parent_code) > 0 THEN  (SELECT SUM(t_Total_Amount_Cash_In) AS cnt FROM ".$this->tbl_bit_deposit." WHERE t_Account_Code = parent_code) ELSE 0 END AS TotalDepositAmount,
                CASE WHEN (SELECT SUM(t_Total_Amount_Cash_Out) AS cnt FROM ".$this->tbl_bit_withdraw." WHERE t_Account_Code = parent_code) > 0 THEN (SELECT SUM(t_Total_Amount_Cash_Out) AS cnt FROM ".$this->tbl_bit_withdraw." WHERE t_Account_Code = parent_code) ELSE 0 END AS TotalWithdrawAmount,
                (SELECT COUNT(l_Account_Code) AS cnt FROM ".$this->tbl_bit_user_log." WHERE l_Account_Code = parent_code) AS ConnectionCnt
                FROM tbl_bit_users U 
                LEFT JOIN ".$this->tbl_bit_user_log_header." H ON U.u_Account_Code = H.l_Account_Code
                ";
            return $query;
        }
        public function getMembershipRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_user." 
            WHERE u_isAdminUser IN(0)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getPointList(){
            $query = "SELECT u_Recommended_Point FROM ".$this->tbl_bit_user." WHERE u_isAdminUser IN(0) AND u_Recommended_Point NOT IN('-')";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        // public function getAccessDate(){
        //     $query = "SELECT MAX(DATE(H.l_LogInDateTime)) AS l_LogInDateTime 
        //     FROM ".$this->tbl_bit_user_log_header." H
        //     JOIN ".$this->tbl_bit_user." U ON H.l_Account_Code = U.u_Account_Code
        //     WHERE U.u_isAdminUser IN(0)
        //     GROUP BY DATE(H.l_LogInDateTime) ORDER BY DATE(H.l_LogInDateTime) DESC";
        //     $stmt = $this->conn->prepare($query);
        //     $stmt->execute();
        //     return $stmt;
        // }
        // public function getSubscriptionDate(){
        //     $query = "SELECT DISTINCT(DATE(u_Entry_Date)) AS u_Entry_Date FROM ".$this->tbl_bit_user." WHERE u_State IN(1) AND u_isAdminUser IN(0)";
        //     $stmt = $this->conn->prepare($query);
        //     $stmt->execute();
        //     return $stmt;
        // }
    }
?>