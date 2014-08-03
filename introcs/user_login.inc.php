                    <!-- 使用者登入功能，開始。 -->
                    <form name="Form_Login" method="post" action="">
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td bgcolor="#A4A4A4">
                        	<table width="150" border="0" cellspacing="1" cellpadding="0">
                            <tr>
                              <td valign="top" bgcolor="#FAFAFA">
                              	<?PHP
                              	if (!isset($_SESSION['user_email'])){
                              	?>
                              	<table width="100%" border="0" cellspacing="3" cellpadding="1">
                              		<tr>
                              			<td colspan="2"><img src="img/title_login_small.gif" alt="使用者登入" width="120" height="11"></td>
                              		</tr>
                              		<tr>
                              			<td class="sfont_1" width="26">帳號</td>
                              			<td class="sfont_1">
                              				<input name="Form_User_Name" type="text" id="Form_User_Name" size="12" class="sfont_1" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF">@
                              				<select name="Form_Server" id="Form_Server" class="sfont_2" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF">
                              					<option value="nctu.edu.tw">nctu.edu.tw</option>
                              					<option value="mail.nctu.edu.tw">mail.nctu.edu.tw</option>
                              					<option value="faculty.nctu.edu.tw">faculty.nctu.edu.tw</option>
                              					<option value="cc.nctu.edu.tw">cc.nctu.edu.tw</option>
                              					<option value="cs.nctu.edu.tw">cs.nctu.edu.tw</option>
                              					<option value="cm.nctu.edu.tw">cm.nctu.edu.tw</option>
                              					<option value="mail.cl.nthu.edu.tw">mail.cl.nthu.edu.tw</option>
                              				</select>
                              			</td>
                              		</tr>
                              		<tr>
                              			<td class="sfont_1">密碼</td>
                              			<td class="sfont_1"><input name="Form_Password" type="password" class="sfont_1" id="Form_Password" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF" value="" size="12"></td>
                              		</tr>
                              		<tr>
                              			<td class="cfont_1"><a href="?func=how_to_login">說明</a></td>
                              			<td align="right"><input name="Form_Function" type="hidden" id="Form_Function" value="login"><input type="image" src="img/icon_login.gif"></td>
                              		</tr>
                              		<?PHP
                              		/*
                              		<tr>
                              			<td colspan="2"">
                              				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              					<tr>
                              						<td class="cfont_1"><a href="?func=member_add">註冊</a></td>
                              						<td align="right" class="cfont_1"><a href="?func=password_forget">忘記密碼</a></td>
                              					</tr>
                              				</table>
                              			</td>
                              		</tr>
                              		*/
                              		?>
                              	</table>
                              	<?PHP
                              	} else {
                              	?>
                              	<table width="100%" border="0" cellspacing="3" cellpadding="1">
                              		<tr>
                              			<td class="cfont_1"><?PHP	echo $_SESSION['user_account']." 歡迎您！";?></td>
                              		</tr>
                              		<tr>
                              			<td class="lfont_1" align="right"><a href="?func=logout">登出</a></td>
                              		</tr>
                              	</table>
                              	<?PHP
                              	}
                              	?>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                    </form>
                    <!-- 使用者登入功能，結束。 -->