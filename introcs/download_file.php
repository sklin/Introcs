<?PHP
// include 所需檔案，開始。
include_once("inc/website.conf.php");
include_once("inc/connDB.inc.php");
include_once("inc/shareFunctions.inc.php");
// include 所需檔案，結束。

$link_INTRO_DB = conn_INTRO_DB();																								// 開啟資料庫連結

if ($_GET['file_sn']){
	
	$file_sn = $_GET['file_sn'];
	
	$Query_File = mysql_query("Select `file_title`, `file_name` From `file_Tab` Where `file_sn` = '$file_sn';");
	$Data_File = mysql_fetch_array($Query_File);
	$filename_path = "/net/alpha/cychao/download/file_system/".$Data_File['file_name'];
	
	if ((strlen($Data_File['file_name']) > 0) and (file_exists($filename_path))){
		
		clearstatcache();																														// 清除檔案狀態的 cache
		closeDB($link_INTRO_DB);																										// 關閉資料庫連結
		
		$sub_filename_from = strrpos($Data_File['file_name'], ".");
		// 副檔名最多只取 . 後三位，開始。
		if (strlen($Data_File['file_name']) >= $sub_filename_from + 1 + 3){
			
			$sub_filename_end = 3;
			
		} else {
			
			$sub_filename_end = strlen($Data_File['file_name']) - ($sub_filename_from + 1);
			
		}
		// 副檔名最多只取 . 後三位，結束。
		
		$sub_filename = ".".substr($Data_File['file_name'], $sub_filename_from + 1, $sub_filename_end);
		$new_filename = strtr($Data_File['file_title'], " ", "_").$sub_filename;
		
		$header_content = "Content-Disposition: attachment; filename=".$new_filename;
		header('Content-type: application/octet-stream');
		header($header_content);
		readfile($filename_path);
		
				
	} else {
		
		clearstatcache();																														// 清除檔案狀態的 cache
		closeDB($link_INTRO_DB);																										// 關閉資料庫連結
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		showalert("很抱歉，無此檔案！");
		gotourl("./?func=download");
		
	}
	
} else {
	
	closeDB($link_INTRO_DB);																											// 關閉資料庫連結
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	showalert("很抱歉，無此檔案！");
	gotourl("./?func=download");
	
}
?>
