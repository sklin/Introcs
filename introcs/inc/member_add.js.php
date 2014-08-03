<script language="JavaScript" type="text/JavaScript">
<!--
function check_accound(){
	var CKname = Form_Member_Add.Form_Account_Add.value;
	var CKpath = "user_check_accound.php?account=" + CKname; 
  //alert(CKpath);
	window.open(CKpath, 'popupwindow', 'width=400,height=300,scrollbar=no');
}

function check_data() {
	
	if ((Form_Member_Add.Form_Account_Add.value.length < 3) || (Form_Member_Add.Form_Account_Add.value.length > 15)) {
		alert ("很抱歉，帳號的長度必須介於 3 至 15 個字元喔！");
		Form_Member_Add.Form_Account_Add.focus();
		return false;
	}	else {
		for( indx = 0 ; indx < Form_Member_Add.Form_Account_Add.value.length ; indx++ ) {
			if(!((Form_Member_Add.Form_Account_Add.value.charAt(indx)>= 'a' && Form_Member_Add.Form_Account_Add.value.charAt(indx) <= 'z') || (Form_Member_Add.Form_Account_Add.value.charAt(indx)>= 'A' && Form_Member_Add.Form_Account_Add.value.charAt(indx) <= 'Z') || (Form_Member_Add.Form_Account_Add.value.charAt(indx)>= '0' && Form_Member_Add.Form_Account_Add.value.charAt(indx) <= '9'))) {
				alert ("很抱歉，您的帳號只能是數字、英文，其他符號都不能使用喔！");
				return false;
			}
  	}
	}
	
	if (Form_Member_Add.Form_Password_Add.value.length < 6) {
		alert ("很抱歉，為了您帳號的安全，密碼的長度最少需要 6 碼喔！");
		Form_Member_Add.Form_Password_Add.focus();
		return false;
	}	else {
		if (Form_Member_Add.Form_Password_Add.value != Form_Member_Add.Form_Password_Check.value) {
			alert ("很抱歉，您兩次輸入的密碼都不一樣，為避免您遺忘或手誤，請重新確認！");
			Form_Member_Add.Form_Password_Check.focus();
			return false;
		}
	}
	
	if (Form_Member_Add.Form_Name.value.length == 0) {
		alert ("很抱歉，請輸入您的姓名喔！");
		Form_Member_Add.Form_Name.focus();
		return false;
	}
	
	if (Form_Member_Add.Form_EMail.value.length == 0) {
		alert ("很抱歉，會員申請需要 E-Mail 認證喔！");
		Form_Member_Add.Form_EMail.focus();
		return false;
	}
	
	return true;
	
}
//-->
</script>