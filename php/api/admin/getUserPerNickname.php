<?php
    include_once 'includes.php';
    $database = new Database();
    $db = $database->getConnection();

    $query = new Admininfo($db);
    $auth = new Authentication($db);
    $stmt = $query->getUserPerNickname($_GET["nickname"]);

    $sql = $stmt->rowCount();
    if($sql > 0){
        $output = '';
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = $datas[0];
        $password = $auth->encrypt_decrypt('decrypt', $data["u_Password"]);
        $array = array(
            "Id" => $data["u_Id"],
            "Account_Code" => $data["u_Account_Code"],
            "Nickname" => $data["u_Nickname"],
            "Password" => $password,
            "Mobile_Number" => $data["u_Mobile_Number"],
            "Bank_Holder_Name" => $data["u_Bank_Holder_Name"],
            "Bank_Code" => $data["u_Bank_Code"],
            "BankName" => $data["BankName"],
            "Account_Number" => $data["u_Account_Number"],
            "Recommended_Point" => $data["u_Recommended_Point"],
            "Ip_Address" => $data["u_Ip_Address"],
            "Domain" => ($data["l_Access_Domain"]) ? $data["l_Access_Domain"] : $data["u_Access_Domain"],
            "Access_Code" => $data["u_Access_Code"],
            "Status_Id" => $data["u_Status_Id"],
            "Full_consent" => $data["u_Full_consent"],
            "Terms_Condition1" => $data["u_Terms_Condition1"],
            "Terms_Condition2" => $data["u_Terms_Condition2"],
            "Entry_Date" => $data["u_Entry_Date"],
            "LogInDateTime" => $data["l_LogInDateTime"],
            "Device_Use" => $data["l_Device_Use"],
            "Browser_Use" => $data["l_Browser_Use"],
            "Current_Ip" => ($data["l_Current_Ip"]) ? $data["l_Current_Ip"] : $data["u_Ip_Address"],
            "ServerIp" => $_SERVER["REMOTE_ADDR"],
            "TotalCashAmount" => $data["TotalCashAmount"],
            "TotalDepositAmount" => $data["TotalDepositAmount"],
            "TotalDepositDailyAmount" => $data["TotalDepositDailyAmount"],
            "TotalWithdrawAmount" => $data["TotalWithdrawAmount"],
            "TotalWithdrawDailyAmount" => $data["TotalWithdrawDailyAmount"],
            "TotalTradingDailyAmount" => $data["TotalTradingDailyAmount"],
            "TotalProfitDailyAmount" => $data["TotalProfitDailyAmount"],
            "TotalDisqualifyDailyAmount" => $data["TotalDisqualifyDailyAmount"],
            "isActive" => (float)$data["l_isActive"]
        );
        echo json_encode($array);
    }else{
        echo json_encode(0);
    }
?>