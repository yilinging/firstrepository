<?php
$serverName = "140.116.XX.XX"; //資料庫所在IP 
$uid = "OOOOO"; //帳號
$pwd = "XXXXX"; //密碼
$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"資料庫名稱");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn == false)
{
    echo "失敗";
    die( print_r( sqlsrv_errors(), true));
}
echo "success";
?>
