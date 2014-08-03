                  				<!-- 會員中心（加入會員），開始。 -->
                  				<br>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td width="7" height="57" background="img/bg_title_bar01.gif">&nbsp;</td>
                  						<td width="40" align="center" background="img/bg_title_bar02.gif"><img src="img/bg_title_bar04.gif" width="26" height="26"></td>
                  						<td background="img/bg_title_bar02.gif" class="tfont_1">會員中心</td>
                  						<td width="9" background="img/bg_title_bar03.gif">&nbsp;</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<form name="Form_Member_Add" method="post" action="">
                  				<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  					<tr>
                  						<td><?PHP	if (!isset($_POST['Form_Agree'])){	echo "會員同意條款";	} else {	echo "會員個人資料";	}	?></td>
                  					</tr>
                  					<tr>
                  						<td>
                  							<?PHP
                  							if (!isset($_POST['Form_Agree'])){
                  							?>
                  							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  								<tr>
                  									<td align="center"><textarea name="textarea" cols="120" rows="20" class="sfont_1"><?PHP include_once("member_agree_rules.txt");?></textarea></td>
                  								</tr>
                  								<tr>
                  									<td align="right">
                  										<br>
                  										<input name="Form_Agree" type="hidden" id="Form_Agree" value="Y">
                  										<input type="submit" name="Form_Sumit" id="Form_Sumit" value="我已閱讀並同意，下一步。">
                  									</td>
                  								</tr>
                  							</table>
                  							<?PHP
                  							} else {
                  							?>
                  							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  								<tr>
                  									<td bgcolor="#666666">
                  										<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  											<tr>
                  												<td width="70" align="center" bgcolor="#CCCCCC" class="tfont_2">帳　　號</td>
                  												<td colspan="3" bgcolor="#FAFAFA"><input name="Form_Account_Add" type="text" class="sfont_1" id="Form_Account_Add" size="15" maxlength="15" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF">
               												    <font class="sfont_3">（僅限英文、數字，長度至少 3 個字元，最長不得超過 15 個字元。）　<a href="javascript: check_accound()"><font color="red">點此檢查帳號是否已被申請</font></a></font></td>
                  											</tr>
                  											<tr>
                  												<td align="center" bgcolor="#CCCCCC" class="tfont_2">設定密碼</td>
                  												<td bgcolor="#FAFAFA"><input name="Form_Password_Add" type="password" class="sfont_1" id="Form_Password_Add" size="15" maxlength="20" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF"></td>
                  												<td width="70" align="center" bgcolor="#CCCCCC" class="tfont_2">確認密碼</td>
                  												<td bgcolor="#FAFAFA"><input name="Form_Password_Check" type="password" class="sfont_1" id="Form_Password_Check" size="15" maxlength="20" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF"></td>
                  											</tr>
                  											<tr>
                  												<td align="center" bgcolor="#CCCCCC" class="tfont_2">姓　　名</td>
                  												<td colspan="3" bgcolor="#FAFAFA"><input name="Form_Name" type="text" class="sfont_1" id="Form_Name" size="15" maxlength="10" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF"></td>
                  											</tr>
                  											<tr>
                  												<td align="center" bgcolor="#CCCCCC" class="tfont_2">性　　別</td>
                  												<td bgcolor="#FAFAFA" class="sfont_1">
                  													<input name="Form_Sex" type="radio" value="B" checked> 男　
                  													<input name="Form_Sex" type="radio" value="G"> 女
                  												</td>
                  												<td align="center" bgcolor="#CCCCCC" class="tfont_2">生　　日</td>
                  												<td bgcolor="#FAFAFA" class="sfont_1">西元
                  													<select name="Form_Birthday_Y" id="Form_Birthday_Y"><?PHP
                  														for ($i = date("Y") - 10; $i >= date("Y") - 100; $i--){
                  															
                  															echo "                  														<option value=\"".$i."\"";
                  															if ($i == date("Y") - 15){	echo " selected";	}															// default 申請年紀為 15 歲
                  															echo ">".$i."</option>\n";
                  															
                  														}
                  														?>
                  													</select> 年
                  													<select name="Form_Birthday_M" id="Form_Birthday_M"><?PHP
                  														for ($i = 1; $i <= 12; $i++){
                  															
                  															echo "                  														<option value=\"".$i."\"";
                  															if ($i == 7){	echo " selected";	}
                  															echo ">".$i."</option>\n";
                  															
                  														}
                  														?>
                  													</select> 月
                  													<select name="Form_Birthday_D" id="Form_Birthday_D"><?PHP
                  														for ($i = 1; $i <= 31; $i++){
                  															
                  															echo "                  														<option value=\"".$i."\"";
                  															if ($i == 15){	echo " selected";	}
                  															echo ">".$i."</option>\n";
                  															
                  														}
                  														?>
                  													</select>
                  												</td>
                  											</tr>
                  											<tr>
                  												<td align="center" bgcolor="#CCCCCC" class="tfont_2">E-Mail</td>
                  												<td colspan="3" bgcolor="#FAFAFA"><input name="Form_EMail" type="text" class="sfont_1" id="Form_EMail" size="68" maxlength="58" style="border-left-style:none; border-top-style:none; border-right-style:none; border-bottom-style: groove; background-color:#E4F6FF">
               												    <font class="sfont_3">（寄發註冊確認信用）</font></td>
                  											</tr>
                  										</table>
                  									</td>
                  								</tr>
                  								<tr>
                  									<td align="right">
                  										<br>
                  										<input name="Form_Function" type="hidden" id="Form_Function" value="member_add">
                  										<input type="submit" name="Form_Sumit" id="Form_Sumit" value="申請會員" onClick="return check_data()">
                  									</td>
               								  </tr>
                  							</table>
                  							<?PHP
                  							}
                  							?>
                  						</td>
                  					</tr>
                  				</table>
                  				</form>
                  				<!-- 會員中心（加入會員），結束。 -->