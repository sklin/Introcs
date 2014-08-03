<?PHP
/****************************************************************************************************************
 * NCTU INTRO - http://intro.cs.nctu.edu.tw/																		Account Functions Include File	*
 * Develop environment: Apache 2.0.40 & PHP 4.2.2																Programmer: JasonChung					*
 ****************************************************************************************************************
 * Date: 2008/09/09																																															*
 ****************************************************************************************************************
 * List:																																																				*
 * function userlogin($_POST): JasonChung, 2007/09/09																														*
 * function is_bm($bm_array): JasonChung, 2008/10/09																														*
 ****************************************************************************************************************/

// === User Login Function (by JasonChung, 2008/09/09) ==========================================================
function userlogin($_POST){
	
	unset($feedback_userlogin);																										// 刪除 feedback 變數，以確保最後回傳值。
	
	$authen_server = array(																												// 允許認證之伺服器（均為小寫）
		"nctu.edu.tw" => "{pop3.nctu.edu.tw/pop3/notls}INBOX",
		"mail.nctu.edu.tw" => "{mail2.nctu.edu.tw/imap/ssl/notls/novalidate-cert}INBOX",
		"faculty.nctu.edu.tw" => "{faculty.nctu.edu.tw/pop3/ssl/notls/novalidate-cert}INBOX",
		"cc.nctu.edu.tw" => "{pop3.cc.nctu.edu.tw/pop3/ssl/notls/novalidate-cert}INBOX",
		"cs.nctu.edu.tw" => "{imap.cs.nctu.edu.tw/imap/ssl/notls/novalidate-cert}INBOX",
		"cm.nctu.edu.tw" => "{pop3.cm.nctu.edu.tw/pop3/notls}INBOX",
		"mail.cl.nthu.edu.tw" => "{mail.cl.nthu.edu.tw/pop3/notls}INBOX");
	
	if ((strlen(trim($_POST['Form_User_Name'])) > 0) and (strlen(trim($_POST['Form_Password'])) > 0) and (isset($authen_server[$_POST['Form_Server']]))) {
		
		$user_authen = @imap_open($authen_server[$_POST['Form_Server']], $_POST['Form_User_Name'], $_POST['Form_Password']);
		
		if ($user_authen){
			
			$_SESSION['user_account'] = $_POST['Form_User_Name'];
			$_SESSION['user_email'] = $_POST['Form_User_Name']."@".$_POST['Form_Server'];
			
			$feedback_userlogin[0] = "Y";
			$feedback_userlogin[1] = $_POST['Form_User_Name']."@".$_POST['Form_Server']." 歡迎您的蒞臨！";
			imap_close($user_authen);
			
		} else {
			
			$feedback_userlogin[0] = "N";
			$feedback_userlogin[1] = "很抱歉，登入失敗！\\n(".imap_last_error().")";
			
		}
	    	
	} else {
		
		$feedback_userlogin[0] = "N";
		$feedback_userlogin[1] = "很抱歉，您的登入資料不完整，請確實填寫。";
		
	}
	
	return $feedback_userlogin;																										// 回傳結果、訊息
	
}


// === Query Board Manager Function (by JasonChung, 2008/10/09) =================================================
function is_bm($bm){
	
	unset($feedback_is_bm);																												// 刪除 feedback 變數，以確保最後回傳值。
	
	if (isset($_SESSION['user_email'])){
		
		$bm_array = array_unique(explode("##", $bm));
		if (in_array($_SESSION['user_email'], $bm_array)){
			
			$feedback_is_bm = "Y";
			
		} else {
			
			$feedback_is_bm = "N";
			
		}
		
	} else {
		
		$feedback_is_bm = "N";
		
	}
	
	return $feedback_is_bm;																												// 回傳結果、訊息
	
}
?>