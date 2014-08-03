                  				<?PHP
                  				$forum_board_id = $_GET['forum_board_id'];
                  				$forum_subject_id = $_GET['forum_subject_id'];
                  				
                  				// 判斷是否為回覆文章的依據，$forum_article_id == 0 表示發表新文章。
                  				if (!isset($_GET['forum_article_id'])){	$forum_article_id = 0;	} else {	$forum_article_id = $_GET['forum_article_id'];	}
                  				
                  				$link_INTRO_DB = conn_INTRO_DB();											// 開啟資料庫連結
                  				$Query_forum_board = mysql_query("Select `forum_group_id`, `forum_board_title`, `forum_board_manager`
                  					From `forum_board_Tab` Where `forum_board_id` = '$forum_board_id';");
                  				$Data_forum_board = mysql_fetch_array($Query_forum_board);
                  				
                  				$feedback_is_bm = is_bm($Data_forum_board['forum_board_manager']);
                  				
                  				$Query_forum_group = mysql_query("Select `forum_group_title` From `forum_group_Tab` Where `forum_group_id` = '$Data_forum_board[forum_group_id]';");
                  				$Data_forum_group = mysql_fetch_array($Query_forum_group);
                  				
                  				if ((strlen($Data_forum_board['forum_board_title']) <= 0) or (!isset($_SESSION['user_email']))){
                  					
                  					closeDB($link_INTRO_DB);														// 關閉資料庫連結
                  					showalert("很抱歉，查無此看版或您尚未登入！");
                  					gotourl("?func=forum_list_article&forum_board_id=".$forum_board_id);
                  					
                  				}
                  				
                  				// 讀取看版主題，開始。
                  				if ($forum_subject_id > 0){
                  					
                  					if ($feedback_is_bm == "Y"){
                  						
                  						$Query_forum_subject = mysql_query("Select `forum_subject_title` From `forum_subject_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id';");
                  						
                  						
                  					} else {
                  						
                  						$Query_forum_subject = mysql_query("Select `forum_subject_title` From `forum_subject_Tab` 
                  							Where `forum_board_id` = '$forum_board_id' and `forum_subject_id` = '$forum_subject_id' and `forum_on_line_status` = 'Y';");
                  						
                  					}
                  					
                  					$Data_forum_subject = mysql_fetch_array($Query_forum_subject);
                  					
                  					if (strlen($Data_forum_subject['forum_subject_title']) <= 0){
                  						
                  						closeDB($link_INTRO_DB);													// 關閉資料庫連結
                  						showalert("很抱歉，無此看版主題！");
                  						gotourl("?func=forum_list_article&forum_board_id=".$forum_board_id);
                  						
                  					}
                  					
                  				}
                  				// 讀取看版主題，結束。
                  				
                  				// 如果為回覆文章則取得文章標題，開始。
                  				if ($forum_article_id > 0){
                  					
                  					$Query_forum_article_title = mysql_query("Select `forum_article_title` From `forum_article_Tab` Where `forum_board_id` = '$forum_board_id'
                  						and `forum_subject_id` = '$forum_subject_id' and `forum_article_id` = '$forum_article_id' and `forum_reply_id` = '0';");
                  					$Data_forum_article_title = mysql_fetch_array($Query_forum_article_title);
                  					$Data_forum_article_title['forum_article_title'] = "Re: ".$Data_forum_article_title['forum_article_title'];
                  					
                  				}
                  				// 如果為回覆文章則取得文章標題，結束。
                  				?>
                  				<!-- 計概討論區 -- 發表文章，開始。 -->
                  				<br>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td width="7" height="57" background="img/bg_title_bar01.gif">&nbsp;</td>
                  						<td width="40" align="center" background="img/bg_title_bar02.gif"><img src="img/bg_title_bar04.gif" width="26" height="26"></td>
                  						<td background="img/bg_title_bar02.gif" class="tfont_1">計概討論區</td>
                  						<td width="9" background="img/bg_title_bar03.gif">&nbsp;</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  					<tr>
                  						<td class="tfont_2"><img src="img/icon_menu.gif" width="15" height="14" /> 
                  							<?PHP
                  							echo "<a href=\"?func=forum\"><font color=\"#0000FF\">".$Data_forum_group['forum_group_title']."</font></a> / ";
                  							echo "<a href=\"?func=forum_list_article&forum_board_id=".$forum_board_id."\"><font color=\"#0000FF\">".$Data_forum_board['forum_board_title']."</font></a> / ";
                  							
                  							if ($forum_subject_id > 0){
                  								
                  								echo "<a href=\"?func=forum_list_article&forum_board_id=".$forum_board_id."&forum_subject_id=".$forum_subject_id."\"><font color=\"#0000FF\">".$Data_forum_subject['forum_subject_title']."</font></a> / ";
                  								
                  							}
                  							
                  							if ($forum_article_id == 0){	echo "發表文章";	} else {	echo "回覆文章";	}
                  							?>
                  						</td>
                  					<tr>
                  					<!-- 發表主題、文章，開始。 -->
                  					<tr>
                  						<td align="right">
                  							<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  								<tr>
                  									<td class="lfont_1" height="40"></td>
                  								</tr>
                  							</table>
                  						</td>
                  					<tr>
                  					<!-- 發表主題、文章，結束。 -->
                  					<tr>
                  						<td align="center">
                  							<form action="" method="post" name="Form_Forum_Subject_Add" id="Form_Forum_Subject_Add">
                  								<table width="600" border="0" cellspacing="0" cellpadding="0">
                  									<tr>
                  										<td bgcolor="#A4A4A4">
                  											<table width="100%" border="0" cellspacing="1" cellpadding="3">
                  												<tr>
                  													<td width="64" bgcolor="#95ACEC" class="cfont_1" align="center"><font color="#FFFFFF">文章標題</font><font color="#FFFFFF" class="sfont_1">*</font></td>
                  													<td bgcolor="#FFFFFF"><input name="Form_Title" type="text" id="Form_Title" size="70" maxlength="30" class="form_1"<?PHP	if ($forum_article_id > 0){	echo " value=\"".$Data_forum_article_title['forum_article_title']."\"";	}	?> /></td>
                  												</tr>
                  												<tr>
                  												  <td align="center" valign="top" bgcolor="#95ACEC" class="cfont_1"><font color="#FFFFFF">文章內容</font><font color="#FFFFFF" class="sfont_1">*</font></td>
                  												  <td bgcolor="#FFFFFF"><textarea name="Form_Content" id="Form_Content" cols="59" rows="30" class="form_1"></textarea></td>
                  												</tr>
                  											</table>
                  										</td>
                  									</tr>
                  									<tr>
                  										<td class="cfont_1">
                  											## 注意：星號 * 為必填欄位
                  											<?PHP
                  											if ($feedback_is_bm == "Y"){	echo "<br><font color=\"red\">## 您是版主，得在 [文章內容] 中自行使用 HTML。</font>";	}
                  											?>
                  										</td>
                  									</tr>
                  									<tr>
                  										<td>
                  											<div align="right"><br />
                  											<input type="hidden" name="Form_Board_ID" id="Form_Board_ID" value="<?PHP	echo $forum_board_id;	?>">
                  											<input type="hidden" name="Form_Subject_ID" id="Form_Subject_ID" value="<?PHP	echo $forum_subject_id;	?>">
                  											<input type="hidden" name="Form_Article_ID" id="Form_Article_ID" value="<?PHP	echo $forum_article_id;	?>">
                  											<input type="hidden" name="Form_Function" id="Form_Function" value="forum_article_add">
                  											<input type="submit" name="button" id="button" value="發表文章" />
                  											</div>
                  										</td>
                  									</tr>
                  								</table>
                  							</form>
                  						</td>
                  					</tr>
                  				</table>
                  				<br>
                  				<!-- 計概討論區 -- 發表文章，結束。 -->