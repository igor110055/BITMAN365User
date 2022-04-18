<?php
    class Userinfo {
        // DB stuff
        private $conn;
        private $tbl_bit_notice = "tbl_bit_notice";
        private $tbl_bit_guide = "tbl_bit_guide";
        private $tbl_bit_inquiry = "tbl_bit_inquiries";
        private $tbl_bit_faq = "tbl_bit_faqs";
        private $tbl_bit_transaction_history = "tbl_bit_transaction_histories";
        private $tbl_bit_wss_result = "tbl_bit_wss_results";
        private $tbl_bit_betting_detail = "tbl_bit_betting_details";
        private $tbl_bit_user = "tbl_bit_users";
        private $tbl_bit_transactions_cashin_detail = "tbl_bit_transactions_cashin_details";
        private $tbl_bit_transactions_withdraw_detail = "tbl_bit_transactions_withdraw_details";
        private $tbl_bit_note = "tbl_bit_notes";
        
        
        //properties  
		public function __construct($db){
			$this->conn = $db;
		}
        
        ///rowcount
        public function getFAQRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_faq." WHERE f_Deleted_Date IS NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        ///rowcount
        public function getGuideRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_IsPublic IN(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getNoteRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_note." ORDER BY e_Registration_Time";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getNoticeRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_IsPublic IN(1)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getInquiryRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_inquiry;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getUserHistoryRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_user;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function getUserTransactionRowCount(){
            $query = "SELECT * FROM ".$this->tbl_bit_betting_detail;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        //execute datarow
        public function getFAQList(){
            $query = "SELECT * FROM ".$this->tbl_bit_faq." WHERE f_Deleted_Date IS NULL ORDER BY f_Updated_Date DESC";
            return $query;
        }
        public function getNoticeList(){
            $query = "SELECT * FROM ".$this->tbl_bit_notice." WHERE n_IsPublic IN(1) ORDER BY n_Registration_Time DESC";
            return $query;
        }
        public function getGuideList(){
            $query = "SELECT * FROM ".$this->tbl_bit_guide." WHERE g_IsPublic IN(1) ORDER BY g_Registration_Time DESC";
            return $query;
        }
        public function getNoteList(){
            $query = "SELECT *
            FROM ".$this->tbl_bit_note." N 
            JOIN ".$this->tbl_bit_user." U ON N.e_Account_Code = U.u_Account_Code 
            ORDER BY N.e_Updated_Date DESC";
            return $query;
        }
        public function getInquiryList(){
            $query = "SELECT * FROM ".$this->tbl_bit_inquiry." ORDER BY t_Inquiry_Date DESC";
            return $query;
        }
        public function getUserHistoryList(){
            $query = "SELECT
            U.u_Account_Code AS parent_code,
            U.u_Bank_Code,
            U.u_Bank_Holder_Name,
            U.u_Account_Number,
            H.h_Event,
            H.h_Plus,
            H.h_Status,
            H.h_Minus,
            H.h_Processing_Time,
            H.h_UpdatedDate,
            (SELECT t_Cashin_Status FROM tbl_bit_transactions_cashin_details WHERE t_Account_Code = parent_code ORDER BY t_Cashin_Date LIMIT 1) AS t_Cashin_Status,
            (SELECT t_Cashout_Status FROM tbl_bit_transactions_withdraw_details WHERE t_Account_Code = parent_code ORDER BY t_Cashout_Date LIMIT 1) AS t_Cashout_Status
            -- (SELECT t_Cashin_Date FROM tbl_bit_transactions_cashin_details WHERE t_Account_Code = parent_code ORDER BY t_Cashin_Date LIMIT 1) AS t_Cashin_Date,
            -- (SELECT t_Cashout_Date FROM tbl_bit_transactions_withdraw_details WHERE t_Account_Code = parent_code ORDER BY t_Cashin_Date LIMIT 1) AS t_Cashout_Date
            FROM tbl_bit_transaction_histories H
            JOIN tbl_bit_users U ON H.h_Account_Code = U.u_Account_Code";
            return $query;
        }


        public function getUserTransactionList(){
            // $query = "SELECT *
            // FROM ".$this->tbl_bit_trans_history." H
            // JOIN ".$this->tbl_bit_user." U ON H.h_Account_Code = U.u_Account_Code

                $query = "SELECT * FROM ".$this->tbl_bit_betting_detail." WHERE b_DeletedDate IS NULL ORDER BY b_UpdatedDate DESC";
                return $query;
        }
      
    }
?>